<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::paginate(10);
        return view('orders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view("orders.create", compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'status' => 'required|in:0,1',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ], [
            'customer_id.required' => 'Vui lòng chọn khách hàng.',
            'customer_id.exists' => 'Khách hàng không tồn tại.',
            'order_date.required' => 'Vui lòng chọn ngày đặt hàng.',
            'order_date.date' => 'Ngày đặt hàng không hợp lệ.',
            'status.required' => 'Vui lòng chọn trạng thái đơn hàng.',
            'status.in' => 'Trạng thái đơn hàng không hợp lệ.',
            'products.required' => 'Vui lòng thêm ít nhất một sản phẩm.',
            'products.*.product_id.required' => 'Sản phẩm không được để trống.',
            'products.*.product_id.exists' => 'Sản phẩm không tồn tại   .',
            'products.*.quantity.required' => 'Số lượng không được để trống.',
            'products.*.quantity.integer' => 'Số lượng phải là số nguyên.',
            'products.*.quantity.min' => 'Số lượng tối thiểu là 1.',
        ]);

        // Start a transaction
        DB::beginTransaction();
        try {
            // Create the order
            Log::info($validated);
            $order = Order::create([
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'status' => $validated['status'],
            ]);

            // Add order details
            foreach ($validated['products'] as $product) {
                $order->orderDetails()->create([
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                ]);

                // Update product quantity in stock
                $productModel = Product::find($product['product_id']);
                if ($productModel) {
                    $productModel->decrement('quantity', $product['quantity']);
                }
            }

            // Commit the transaction
            DB::commit();
            $route = redirect()->route('orders.index')->with('success', 'Tạo đơn hàng thành công');

            return response()->json($route->getTargetUrl());
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            return response()->json([
                'message' => 'Đã xảy ra lỗi khi tạo đơn hàng',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::with('orderDetails.product')->findOrFail($id);

        // Lấy danh sách khách hàng và sản phẩm
        $customers = Customer::all();
        $products = Product::all();

        // Trả về view chỉnh sửa đơn hàng
        return view('orders.edit', compact('order', 'customers', 'products'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'status' => 'required|in:0,1', // 0: Chưa thanh toán, 1: Đã thanh toán
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Start a transaction
        DB::beginTransaction();
        try {
            // Find the order
            $order = Order::findOrFail($id);

            // Update order basic info
            $order->update([
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'status' => $validated['status'],
            ]);

            // Restore stock for the existing order details
            foreach ($order->orderDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->increment('quantity', $detail->quantity); // Restore stock
                }
            }

            // Delete existing order details
            $order->orderDetails()->delete();

            // Add updated order details
            foreach ($validated['products'] as $product) {
                $order->orderDetails()->create([
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                ]);

                // Decrement stock for updated products
                $productModel = Product::find($product['product_id']);
                if ($productModel) {
                    $productModel->decrement('quantity', $product['quantity']);
                }
            }

            // Commit the transaction
            DB::commit();

            $route = redirect()->route('orders.index')->with('success', 'Sửa đơn hàng thành công');

            return response()->json($route->getTargetUrl());
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            return response()->json([
                'message' => 'Đã xảy ra lỗi khi cập nhật đơn hàng',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        OrderDetail::where('order_id', $id)->delete();
        Order::find($id)->delete();

        return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công');
    }
}

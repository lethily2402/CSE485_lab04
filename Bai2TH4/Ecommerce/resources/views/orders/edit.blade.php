@extends('layouts.master')

@section('title', 'Chỉnh sửa đơn hàng')

@section('content')
    <div class="card mt-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title m-0">Chỉnh sửa đơn hàng</h4>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
        <div class="card-body p-0">
            <form method="POST" id="editOrderForm">
                @csrf
                @method('PUT')
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title m-0">Thông tin chung</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Tên khách hàng</label>
                                    <select name="customer_id" id="customer_id" class="form-select">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == $order->customer_id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order_date" class="form-label">Ngày đặt hàng</label>
                                    <input type="date" name="order_date" id="order_date" class="form-control"
                                        value="{{ $order->order_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chưa thanh toán
                                        </option>
                                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã thanh toán
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Cập nhật sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <label class="input-group-text bg-secondary-subtle" for="product_id">
                                        Nguyên vật liệu
                                    </label>
                                    <select name="product_id" id="product_id" class="form-select">
                                        <option value="default">Chọn sản phẩm</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group align-items-center">
                                    <label class="input-group-text bg-secondary-subtle" for="quantity">
                                        Số lượng
                                    </label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1"
                                        value="1">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="button" id="addProduct">Thêm</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div id="productList" class="mb-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">
                                    @foreach ($order->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->product->name }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger remove-product"
                                                    data-id="{{ $detail->product_id }}">Xóa</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary" id="saveBtn">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let listProduct = @json(
                $order->orderDetails->map(fn($detail) => [
                        'product_id' => $detail->product_id,
                        'quantity' => $detail->quantity,
                    ]));

            // Handle adding products
            $("#addProduct").click(function() {
                const product_id = $("#product_id").val();
                if(product_id == "default"){
                    alert("Chưa chọn tên sản phẩm");
                }
                const quantity = $("#quantity").val();
                const productName = $("#product_id option:selected").text();

                listProduct.push({
                    product_id: product_id,
                    quantity: quantity
                });

                $("#productTableBody").append(`
                    <tr>
                        <td>${productName}</td>
                        <td>${quantity}</td>
                        <td><button type="button" class="btn btn-sm btn-danger remove-product" data-id="${product_id}">Xóa</button></td>
                    </tr>
                `);
            });

            // Handle removing products
            $(document).on('click', '.remove-product', function() {
                const product_id = $(this).data('id');
                listProduct = listProduct.filter(item => item.product_id !== product_id);
                $(this).closest('tr').remove();
            });

            // Handle final submission
            $("#saveBtn").click(function() {
                if (listProduct.length === 0) {
                    alert('Vui lòng thêm ít nhất một sản phẩm');
                    return;
                }

                const orderData = {
                    customer_id: $("#customer_id").val(),
                    order_date: $("#order_date").val(),
                    status: $("#status").val(),
                    products: listProduct
                };

                $.ajax({
                    url: '{{ route('orders.update', $order->id) }}',
                    method: 'PUT',
                    data: orderData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.href = response;
                    },
                    error: function(error) {
                        alert('Có lỗi xảy ra khi cập nhật đơn hàng');
                    }
                });
            });
        });
    </script>
@endsection

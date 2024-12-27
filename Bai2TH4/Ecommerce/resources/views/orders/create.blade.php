@extends('layouts.master')

@section('title', 'Thêm đơn hàng')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title m-0">Thêm đơn hàng</h4>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Thêm mới đơn hàng</a>
    </div>
    <div class="card-body p-0">
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
                                <option value="default" default>Chọn khách hàng</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="order_date" class="form-label">Ngày đặt hàng</label>
                            <input type="date" name="order_date" id="order_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" id="status" class="form-select">
                                <option value="default" default>Chọn trạng thái</option>
                                <option value="0">Chưa thanh toán</option>
                                <option value="0">Đã thanh toán</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0">Thêm sản phẩm</h5>
            </div>
            <div class="card-body">
                <form method="POST" id="formProduct">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <label class="input-group-text bg-secondary-subtle" for="product_id">
                                    Sản phẩm
                                </label>
                                <select name="product_id" id="product_id" class="form-select">
                                    <option value="default" default>Chọn sản phẩm</option>
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
                                    value='1'>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <button class="btn btn-primary w-100" type="submit">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div id="productList" class="mb-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="productTableBody"></tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <button type="button" class="btn btn-primary" id="saveBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let listProduct = [];

        // Handle adding products
        $("#formProduct").on("submit", function(event) {
            event.preventDefault();

            const product_id = $("#product_id").val();
            if (product_id == "default") {
                alert("Chưa chọn sản phẩm");
                return;
            }
            const quantity = $("#quantity").val();
            const productName = $("#product_id option:selected").text();

            listProduct.push({
                product_id: product_id,
                quantity: quantity
            });

            // Add to table
            $("#productTableBody").append(`
                    <tr>
                        <td>${productName}</td>
                        <td>${quantity}</td>
                        <td><button type="button" class="btn btn-sm btn-danger remove-product" data-id="${product_id}">Xóa</button></td>
                    </tr>
                `);

            // Reset form
            $("#quantity").val(1);
        });

        // Handle removing products
        $(document).on('click', '.remove-product', function() {
            const product_id = $(this).data('id');
            listProduct = listProduct.filter(item => item.product_id !== product_id);
            $(this).closest('tr').remove();
        });

        // Handle final submission
        $("#saveBtn").click(function() {
            // Lấy giá trị từ form
            const customer_id = $("#customer_id").val();
            const order_date = $("#order_date").val();
            const status = $("#status").val();

            // Kiểm tra các trường bắt buộc
            if (customer_id === "default") {
                alert("Vui lòng chọn tên khách hàng.");
                return;
            }

            if (!order_date) {
                alert("Vui lòng chọn ngày đặt hàng.");
                return;
            }

            if (status === "default") {
                alert("Vui lòng chọn trạng thái.");
                return;
            }

            if (listProduct.length === 0) {
                alert("Vui lòng thêm ít nhất một sản phẩm vào đơn hàng.");
                return;
            }

            // Tạo dữ liệu để gửi
            const orderData = {
                customer_id: customer_id,
                order_date: order_date,
                status: status,
                products: listProduct
            };

            console.log(orderData);

            // Gửi AJAX
            $.ajax({
                url: '/orders',
                method: 'POST',
                data: orderData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.href = response;
                },
                error: function(error) {
                    alert('Có lỗi xảy ra khi lưu đơn hàng.');
                    console.log(error.responseText);
                }
            });
        });
    });
</script>
@endsection
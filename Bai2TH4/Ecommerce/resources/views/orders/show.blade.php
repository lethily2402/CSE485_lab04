@extends('layouts.master')

@section('title', 'Quản lý đơn hàng')

@section('content')
    <div class="card mt-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title m-0">Quản lý đơn hàng</h4>
            <a href="{{ route('orders.create') }}" class="btn btn-primary">Thêm mới đơn hàng</a>
        </div>
        <div class="card-body p-0">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title m-0">Thông tin chung</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Tên khách hàng:</strong> {{ $order->customer->name }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Ngày đặt hàng:</strong> {{ $order->order_time }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Trạng thái:</strong> {{ $order->status ? 'Chưa thanh toán' : 'Đã thanh toán' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Thông tin chi tiết đơn hàng</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped m-0">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-start" scope="col">Tên sản phẩm</th>
                                <th class="text-start" scope="col">Đơn giá</th>
                                <th class="text-start" scope="col">Số lượng</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($order->orderDetails as $each)
                                <tr>
                                    <td class="text-center" scope="col">{{ $each->id }}</td>
                                    <td class="text-start">{{ $each->product->name }}</td>
                                    <td class="text-start">{{ $each->product->price }}</td>
                                    <td class="text-start">{{ $each->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

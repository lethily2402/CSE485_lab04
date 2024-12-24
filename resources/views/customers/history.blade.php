@extends('layouts.master')

@section('title', 'Lịch sử mua hàng')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-12 d-flex align-items-center justify-content-center flex-column gap-3">
            <div class="card border-0 shadow overflow-hidden" style="width: 650px">
                <div class="card-header">
                    <h5 class="h5 card-title mb-0">Thông tin chung</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="fw-medium m-0">Tên khách hàng</p>
                            <h6 class="h6 text-muted fw-normal m-0">{{ $customer->name }}</h6>
                        </div>
                        <div class="col-md-6">
                            <p class="fw-medium m-0">Địa chỉ</p>
                            <p class="text-muted fw-normal m-0">{{ $customer->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="fw-medium m-0">Email</p>
                            <h6 class="h6 text-muted fw-normal m-0">
                                {{ $customer->email }}
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <p class="fw-medium m-0">Số điện thoại</p>
                            <h6 class="h6 text-muted fw-normal m-0">{{ $customer->phone }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow overflow-hidden" style="width: 650px">
                <div class="card-header">
                    <h5 class="h5 card-title mb-0">Lịch sử mua hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover m-0">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col" class="py-2 text-center">#</th>
                                    <th scope="col" class="py-2 text-start">Ngày đặt hàng</th>
                                    <th scope="col" class="py-2 text-start">Trạng thái</th>
                                    <th scope="col" class="py-2 text-start"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($customer->orders as $each)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $each->id }}</td>
                                    <td class="text-start">{{ $each->order_time }}</td>
                                    <td class="text-start">{{ $each->status ? 'Chưa thanh toán' : 'Đã thanh toán'}}</td>
                                    <!-- <td class="text-start">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-maximize"></i>
                                        </button>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end align-items-center gap-2">
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
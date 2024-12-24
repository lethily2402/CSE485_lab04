@extends('layouts.master')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title m-0">Quản lý đơn hàng</h4>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Thêm mới đơn hàng</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-start" scope="col">Tên khách hàng</th>
                        <th class="text-start" scope="col">Ngày đặt hàng</th>
                        <th class="text-center" scope="col">Trạng thái đơn hàng</th>
                        <!-- <th class="text-center" scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $each)
                    <tr>
                        <td class="text-center" scope="col">{{ $each->id }}</td>
                        <td class="text-start">{{ $each->customer->name }}</td>
                        <td class="text-start">{{ $each->order_time }}</td>
                        <td class="text-center">{{ $each->status ? 'Chưa thanh toán' : 'Đã thanh toán'}}</td>
                        <!-- <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <a class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@if ($data->hasPages())
            <div class="card-footer">
                <div class="paginate">
                    {{-- Đây là phần hiển thị phân trang --}}
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
@endsection
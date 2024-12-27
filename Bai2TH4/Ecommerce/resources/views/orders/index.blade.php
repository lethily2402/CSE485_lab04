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
                        <td class="text-center">{{ $each->status ? 'Chưa thanh toán' : 'Đã thanh toán' }}</td>
                        <td class="text-center">
                            <a href="{{ route('orders.show', $each->id) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('orders.edit', $each->id) }}"
                                class="btn btn-sm btn-outline-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#modalDelete{{ $each->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalDelete{{ $each->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="modalDelete{{ $each->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalDelete{{ $each->id }}Label">
                                                Xóa sản phẩm</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Bạn có chắc chắn về việc xóa sản phẩm này không?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <form action="{{ route('orders.destroy', $each->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="btn btn-primary">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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
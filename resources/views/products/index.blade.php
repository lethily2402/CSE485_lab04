@extends('layouts.master')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title m-0">Quản lý sản phẩm</h4>
            <a href="#" class="btn btn-primary">Thêm sản phẩm</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped m-0">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-start" scope="col">Tên sản phẩm</th>
                        <th class="text-start text-nowrap" scope="col">Mô tả</th>
                        <th class="text-center" scope="col">Giá tiền</th>
                        <th class="text-center" scope="col">Số lượng</th>
                        <th class="text-center" scope="col">Hành động</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach ($data as $each)
                        <tr>
                            <td class="text-center">{{ $each->id }}</td>
                            <td class="text-start">{{ $each->name }}</td>
                            <td class="text-start">{{ $each->description }}</td>
                            <td class="text-center">{{ number_format(round($each->price), 3, '.', ',') }} VNĐ</td>
                            <td class="text-center">{{ $each->quantity }}</td>
                            <td class="text-center">
                                <a href="{{ route('products.show', $each) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-warning">
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
                                                <button type="button" class="btn btn-primary">Xóa</button>
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
        @if ($data->hasPages())
            <div class="card-footer">
                <div class="paginate">
                    {{-- Đây là phần hiển thị phân trang --}}
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection

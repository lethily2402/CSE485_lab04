@extends('layouts.master')

@section('title', 'Quản lý phiếu mượn sách')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title m-0">Quản lý phiếu mượn sách</h4>
        <a href="{{ route('borrows.create') }}" class="btn btn-primary">Thêm phiếu mượn sách</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-start" scope="col">Tên độc giả</th>
                        <th class="text-start" scope="col">Tên sách</th>
                        <th class="text-center" scope="col">Ngày mượn</th>
                        <th class="text-center" scope="col">Ngày trả</th>
                        <th class="text-start" scope="col">Trạng thái</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $each)
                    <tr>
                        <td class="text-center" scope="col">{{ $each->id }}</td>
                        <td class="text-start">{{ $each->reader->name }}</td>
                        <td class="text-start">{{ $each->book->name }}</td>
                        <td class="text-center">{{ $each->borrow_time }}</td>
                        <td class="text-center">{{ $each->return_time }}</td>
                        <td class="text-start">{{ $each->condition }}</td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route("borrows.edit", $each) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal-{{ $each->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <div class="modal fade" id="deleteModal-{{ $each->id }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                                                    Confirmation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this borrowing?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form
                                                    action="{{ route('borrows.destroy', $each) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
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
@endsection
@extends('layouts.master')

@section('title', 'Quản lý phiếu mượn sách')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title m-0">Quản lý phiếu mượn sách</h4>
        <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Quay lại</a>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
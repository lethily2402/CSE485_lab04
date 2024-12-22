@extends('layouts.master')

@section('title', 'Quản lý khách hàng')

@section('content')
    <div class="card mt-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title m-0">Quản lý khách hàng</h4>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Thêm khách hàng</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped m-0">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-start" scope="col">Tên khách hàng</th>
                        <th class="text-start" scope="col">Địa chỉ</th>
                        <th class="text-start" scope="col">Số điện thoại</th>
                        <th class="text-start" scope="col">Email</th>
                        <th class="text-center" scope="col">Hành động</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach ($data as $each)
                        <tr>
                            <td class="text-center">{{ $each->id }}</td>
                            <td class="text-start">{{ $each->name }}</td>
                            <td class="text-start">{{ $each->address }}</td>
                            <td class="text-start">{{ $each->phone }}</td>
                            <td class="text-start">{{ $each->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('customers.show', $each->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('customers.edit', $each->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $each->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="card mt-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title m-0">Quản lý sản phẩm</h4>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped m-0">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-start" scope="col">Tên sản phẩm</th>
                        <th class="text-start" scope="col">Mô tả</th>
                        <th class="text-start" scope="col">Giá</th>
                        <th class="text-start" scope="col">Số lượng</th>
                        <th class="text-center" scope="col">Hành động</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach ($products as $each)
                        <tr>
                            <td class="text-center">{{ $each->id }}</td>
                            <td class="text-start">{{ $each->name }}</td>
                            <td class="text-start">{{ $each->description }}</td>
                            <td class="text-start">{{ $each->price }}</td>
                            <td class="text-start">{{ $each->quantity }}</td>
                            <td class="text-center">
                                <a href="{{ route('products.show', $each->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $each->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('products.destroy', $each->id) }}" method="POST" class="d-inline">
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
           
        </div>
    </div>
@endsection

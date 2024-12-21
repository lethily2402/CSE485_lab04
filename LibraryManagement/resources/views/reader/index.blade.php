@extends('layouts.master')

@section('title', 'Quản lý độc giả')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title m-0">Quản lý độc giả</h4>
        <button class="btn btn-primary">Thêm độc giả</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th  class="text-center" scope="col">#</th>
                        <th  class="text-start" scope="col">Tên độc giả</th>
                        <th  class="text-center" scope="col">Ngày sinh</th>
                        <th  class="text-start" scope="col">Địa chỉ</th>
                        <th  class="text-end" scope="col">Số điện thoại</th>
                        <th  class="text-center" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $each)
                    <tr>
                        <td class="text-center" scope="col">{{ $each->id }}</td>
                        <td class="text-start">{{ $each->name }}</td>
                        <td class="text-center">{{ $each->birthdate }}</td>
                        <td class="text-censtartter">{{ $each->address }}</td>
                        <td class="text-end">{{ $each->phone }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
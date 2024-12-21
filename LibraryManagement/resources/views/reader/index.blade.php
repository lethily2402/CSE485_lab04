@extends('layouts.master')

@section('title', 'Quản lý độc giả')

@section('content')
    <div class="card mt-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title m-0">Quản lý độc giả</h4>
            <a href="{{ route('readers.create') }}" class="btn btn-primary">Thêm độc giả</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped m-0">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-start" scope="col">Tên độc giả</th>
                        <th class="text-center" scope="col">Ngày sinh</th>
                        <th class="text-start" scope="col">Địa chỉ</th>
                        <th class="text-end" scope="col">Số điện thoại</th>
                        <th class="text-center" scope="col">Hành động</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach ($data as $each)
                        <tr>
                            <td class="text-center" scope="col">{{ $each->id }}</td>
                            <td class="text-start">{{ $each->name }}</td>
                            <td class="text-center">{{ $each->birthday }}</td>
                            <td class="text-start">{{ $each->address }}</td>
                            <td class="text-end">{{ $each->phone }}</td>
                            <td class="text-center">
                                <!-- View Button -->
                                <a href="{{ route('readers.show', $each->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('readers.edit', $each->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('readers.destroy', $each->id) }}" method="POST" style="display:inline-block;">
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
        <div class="card-footer">
            <!-- Pagination Links -->
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

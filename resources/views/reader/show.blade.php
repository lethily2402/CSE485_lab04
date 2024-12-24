@extends('layouts.master')

@section('title', 'Chi tiết độc giả')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4>Chi tiết độc giả</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $reader->id }}</td>
                </tr>
                <tr>
                    <th>Tên độc giả</th>
                    <td>{{ $reader->name }}</td>
                </tr>
                <tr>
                    <th>Ngày sinh</th>
                    <td>{{ $reader->birthday }}</td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>{{ $reader->address }}</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>{{ $reader->phone }}</td>
                </tr>
            </table>
            <a href="{{ route('readers.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
        </div>
    </div>
@endsection

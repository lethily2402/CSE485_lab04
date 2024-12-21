@extends('layouts.master')

@section('title', 'Chỉnh sửa độc giả')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4>Chỉnh sửa độc giả</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('readers.update', $reader->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tên độc giả</label>
                    <input type="text" name="name" class="form-control" value="{{ $reader->name }}" required>
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" name="birthday" class="form-control" value="{{ $reader->birthday }}" required>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="{{ $reader->address }}" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ $reader->phone }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection

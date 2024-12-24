@extends('layouts.master')

@section('title', 'Thêm độc giả')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4>Thêm độc giả</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('readers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Tên độc giả</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" name="birthday" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Lưu</button>
            </form>
        </div>
    </div>
@endsection

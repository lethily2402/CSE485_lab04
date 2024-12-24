@extends('layouts.master')

@section('title', 'Chỉnh sửa khách hàng')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">Chỉnh sửa khách hàng</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Tên khách hàng</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $customer->address) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $customer->phone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
@endsection

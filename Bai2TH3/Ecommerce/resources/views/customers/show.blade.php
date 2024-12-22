@extends('layouts.master')

@section('title', 'Chi tiết khách hàng')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">Chi tiết khách hàng</h4>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $customer->id }}</p>
            <p><strong>Tên:</strong> {{ $customer->name }}</p>
            <p><strong>Địa chỉ:</strong> {{ $customer->address }}</p>
            <p><strong>Số điện thoại:</strong> {{ $customer->phone }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
@endsection

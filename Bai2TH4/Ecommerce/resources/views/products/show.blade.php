@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">Chi tiết sản phẩm</h4>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $product->id }}</p>
            <p><strong>Tên:</strong> {{ $product->name }}</p>
            <p><strong>Mô tả:</strong> {{ $product->description }}</p>
            <p><strong>Giá:</strong> {{ $product->price }}</p>
            <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
@endsection

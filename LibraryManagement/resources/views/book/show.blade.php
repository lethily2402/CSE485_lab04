@extends('layouts.master')

@section('title', 'Xem chi tiết sách')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-center">
                <div class="card border-0 shadow overflow-hidden" style="width: 650px">
                    <div class="row g-0" style="height: 300px;">
                        <div class="col-md-12">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div class="row">
                                    <h5 class="h5 card-title border-bottom mb-3">Information</h5>
                                    <div class="col-md-6">
                                        <p class="fw-medium m-0">Tên sách</p>
                                        <h6 class="h6 text-muted fw-normal m-0">{{ $book->name }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="fw-medium m-0">Tên tác giả</p>
                                        <h6 class="h6 text-muted fw-normal m-0">{{ $book->author }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="fw-medium m-0">Loại sách</p>
                                        <h6 class="h6 text-muted fw-normal m-0">{{ $book->category }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="fw-medium m-0">Năm xuất bản</p>
                                        <h6 class="h6 text-muted fw-normal m-0">{{ $book->year }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="fw-medium m-0">Số lượng</p>
                                        <h6 class="h6 text-muted fw-normal m-0">{{ $book->quantity }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Quay lại</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

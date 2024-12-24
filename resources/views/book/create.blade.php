@extends('layouts.master')

@section('title', 'Thêm sách')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="w-50 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title m-0">Tạo sách</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('books.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Tên sách</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           placeholder="Nhập tên sách">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="author" class="form-label">Tên tác giả</label>
                                    <input type="text" name="author" id="author"
                                           class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}"
                                           placeholder="Nhập tên tác giả">
                                    @if ($errors->has('author'))
                                        <span class="text-danger">
                                            {{ $errors->first('author') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label">Loại sách</label>
                                    <input type="text" name="category" id="category"
                                           class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                                           placeholder="Nhập loại sách">
                                    @if ($errors->has('category'))
                                        <span class="text-danger">
                                            {{ $errors->first('category') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="year" class="form-label">Năm xuất bản</label>
                                    <input class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}"
                                           type="number" name="year" id="year" min="1990" max="2024"
                                           value="2024">
                                    @if ($errors->has('year'))
                                        <span class="text-danger">
                                            {{ $errors->first('year') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="form-label">Số lượng</label>
                                    <input class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                           type="number" name="quantity" id="quantity" min="1" value="1">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">
                                            {{ $errors->first('quantity') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-end my-4 gap-3">
                                    <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Quay lại</a>
                                    <button type="submit" class="btn btn-success">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

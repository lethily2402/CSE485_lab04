@extends('layouts.master')

@section('title', 'Sửa phiếu mượn sách')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="w-50 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title m-0">Sửa phiếu mượn sách</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('borrows.update', $borrow->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="book_id" class="form-label">Book</label>
                                <select name="book_id" class="form-select">
                                    <option value="default" disabled selected>Chọn sách</option>
                                    @foreach ($books as $book)
                                    @if ($book->id == $borrow->book_id)
                                    <option value="{{ $book->id }}" selected>{{ $book->name }}</option>
                                    @else
                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reader_id" class="form-label">Tên độc giả</label>
                                <select name="reader_id" class="form-select">
                                    <option value="default" disabled selected>Chọn độc giả</option>
                                    @foreach ($readers as $reader)
                                    @if ($reader->id == $borrow->reader_id)
                                    <option value="{{ $reader->id }}" selected>{{ $reader->name }}</option>
                                    @else
                                    <option value="{{ $reader->id }}">{{ $reader->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="borrow_date" class="form-label">Borrow Date</label>
                                <input class="form-control" type="date" name="borrow_date" id="borrow_date" value="{{ $borrow->borrow_date}}">
                            </div>
                            <div class="d-flex justify-content-end mt-4 gap-3">
                                <a href="{{ route('borrows.index') }}" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.master')

@section('title', 'Quản lý sách')

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title m-0">Quản lý sách</h4>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Thêm sách</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped m-0">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-start" scope="col">Tên sách</th>
                        <th class="text-start" scope="col">Tác giả</th>
                        <th class="text-start" scope="col">Phân loại</th>
                        <th class="text-end" scope="col">Năm phát hành</th>
                        <th class="text-end" scope="col">Số lượng</th>
                        <th class="text-center" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    @foreach ($data as $each)
                        <tr>
                            <td class="text-center" scope="col">{{ $each->id }}</td>
                            <td class="text-start">{{ $each->name }}</td>
                            <td class="text-start">{{ $each->author }}</td>
                            <td class="text-start">{{ $each->category }}</td>
                            <td class="text-end">{{ $each->year }}</td>
                            <td class="text-end">{{ $each->quantity }}</td>
                            <td class="text-center">
                                <a href="{{ route('books.show', $each) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('books.edit', $each) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $each->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <div class="modal fade" id="modalDelete{{ $each->id }}" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1"
                                     aria-labelledby="modalDelete{{ $each->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalDelete{{ $each->id }}Label">
                                                    Xóa sách</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn về việc xóa sách này không?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                <form action="{{ route('books.destroy', $each) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($data->hasPages())
            <div class="card-footer">
                <div class="paginate">
                    {{-- Đây là phần hiển thị phân trang --}}
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
    @if (session('message') && session('type'))
        <div class="toast-container rounded position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body bg-{{ session('type') }} d-flex align-items-center justify-content-between">
                    <div class=" d-flex justify-content-center align-items-center gap-2">
                        @if (session('type') == 'success')
                            <i class="fas fa-check-circle text-light fs-5"></i>
                        @elseif(session('type') == 'danger')
                            <i class="fas fa-xmark-circle text-light fs-5"></i>
                        @elseif(session('type') == 'info' || session('type') == 'secondary')
                            <i class="fas fa-info-circle text-light fs-5"></i>
                        @endif
                        <h6 class="h6 text-white m-0">{{ session('message') }}</h6>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const toastLiveExample = $('#liveToast');
            const toastBootstrap = new bootstrap.Toast(toastLiveExample.get(0));
            toastBootstrap.show();
        })
    </script>
@endsection

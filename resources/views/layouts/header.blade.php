<div class="container">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <span class="fs-4">Quản lý thư viện</span>
    </a>
    <ul class="nav nav-pills">
      <li class="nav-item"><a href="{{route('books.index')}}" class="nav-link{{ Str::startsWith(request()->url(), url('/books')) ? ' active' : '' }}">Books</a></li>
      <li class="nav-item"><a href="{{route('readers.index')}}" class="nav-link{{ Str::startsWith(request()->url(), url('/readers')) ? ' active' : '' }}">Reader</a></li>
      <li class="nav-item"><a href="{{route('borrows.index')}}" class="nav-link{{ Str::startsWith(request()->url(), url('/borrows')) ? ' active' : '' }}">Borrows</a></li>
    </ul>
  </header>
</div>
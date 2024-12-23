<div class="container">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <span class="fs-4">Quản lý đơn hàng</span>
    </a>
    <ul class="nav nav-pills">
      <li class="nav-item"><a href="{{route('orders.index')}}" class="nav-link{{ Str::startsWith(request()->url(), url('/orders')) ? ' active' : '' }}">Orders</a></li>
    </ul>
  </header>
</div>
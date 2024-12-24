<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">Quản lý khách hàng</span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="{{ route('customers.index') }}" class="nav-link{{ request()->routeIs('customers.*') ? ' active' : '' }}">
                    Customers
                </a>
            </li>
        </ul>
    </header>
</div>

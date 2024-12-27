<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">eCommerce</span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="{{ route('customers.index') }}"
                    class="nav-link{{ request()->routeIs('customers.*') ? ' active' : '' }}">
                    Customers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.index') }}"
                    class="nav-link{{ request()->routeIs('products.*') ? ' active' : '' }}">
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('orders.index') }}"
                    class="nav-link{{ request()->routeIs('orders.*') ? ' active' : '' }}">
                    Orders
                </a>
            </li>
        </ul>
    </header>
</div>

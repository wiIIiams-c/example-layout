<div class="position-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" href="#">
                <i class="bi bi-cart me-2"></i>
                Orders
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products') }}">
                <i class="bi bi-box me-2"></i>
                Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('customers*') ? 'active' : '' }}" href="#">
                <i class="bi bi-people me-2"></i>
                Customers
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="#">
                <i class="bi bi-bar-chart me-2"></i>
                Reports
            </a>
        </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Administration</span>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('settings*') ? 'active' : '' }}" href="#">
                <i class="bi bi-gear me-2"></i>
                Settings
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="#">
                <i class="bi bi-person-badge me-2"></i>
                Users
            </a>
        </li>
    </ul>
</div> 
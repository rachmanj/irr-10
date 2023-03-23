<li class="nav-item">
    <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->is('suppliers') || request()->is('suppliers/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Suppliers
      </p>
    </a>
</li>
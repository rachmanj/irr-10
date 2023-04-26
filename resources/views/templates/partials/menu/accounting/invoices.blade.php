<li class="nav-item">
    <a href="{{ route('invoices.index') }}" class="nav-link {{ request()->is('invoices') || request()->is('invoices/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Invoices
      </p>
    </a>
</li>
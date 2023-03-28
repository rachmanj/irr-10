<li class="nav-item">
    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->is('reports') || request()->is('reports/*') ? 'active' : '' }}">
      <i class="fas fa-print"></i>
      <p>
        Reports
      </p>
    </a>
  </li>
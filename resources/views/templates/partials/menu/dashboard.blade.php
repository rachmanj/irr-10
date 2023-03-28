<li class="nav-item {{ 
    request()->is('dashboard') || request()->is('dashboard/*')
        ? 'menu-open' : '' }}">
    <a href="{{ route('dashboard.index') }}" class="nav-link {{ 
    request()->is('dashboard') || request()->is('dashboard/*')
        ? 'active' : '' }}">
      <i class="fas fa-tachometer-alt"></i>
      <p>Dashboard 1</p>
    </a>
</li>
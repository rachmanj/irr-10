<li class="nav-item">
    <a href="{{ route('manufactures.index') }}" class="nav-link {{ request()->is('manufactures') || request()->is('manufactures/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Manufactures
      </p>
    </a>
</li>
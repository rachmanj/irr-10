<li class="nav-item">
    <a href="{{ route('movings.index') }}" class="nav-link {{ request()->is('movings') || request()->is('movings/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>Movings</p>
    </a>
</li>
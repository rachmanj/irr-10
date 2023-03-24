<li class="nav-item">
    <a href="{{ route('equipments.index') }}" class="nav-link {{ request()->is('equipments') || request()->is('equipments/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>Equipment List</p>
    </a>
</li>
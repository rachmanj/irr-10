<li class="nav-item">
    <a href="{{ route('plant_groups.index') }}" class="nav-link {{ request()->is('plant_groups') || request()->is('plant_groups/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Plant Groups
      </p>
    </a>
</li>
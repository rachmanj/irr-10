<li class="nav-item">
    <a href="{{ route('planttypes.index') }}" class="nav-link {{ request()->is('planttypes') || request()->is('planttypes/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Plant Types
      </p>
    </a>
</li>
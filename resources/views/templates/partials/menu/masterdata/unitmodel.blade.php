<li class="nav-item">
    <a href="{{ route('unitmodels.index') }}" class="nav-link {{ request()->is('unitmodels') || request()->is('unitmodels/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Unit Model
      </p>
    </a>
</li>
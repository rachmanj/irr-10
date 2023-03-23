<li class="nav-item">
    <a href="{{ route('unitstatuses.index') }}" class="nav-link {{ request()->is('unitstatuses') || request()->is('unitstatuses/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Unit Status
      </p>
    </a>
</li>
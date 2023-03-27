<li class="nav-item">
    <a href="{{ route('unitnohistories.index') }}" class="nav-link {{ request()->is('unitnohistories') || request()->is('unitnohistories/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>Unit Number Change</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('asset_categories.index') }}" class="nav-link {{ request()->is('asset_categories') || request()->is('asset_categories/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Asset Categories
      </p>
    </a>
</li>
<li class="nav-item {{ 
    request()->is('documents') || request()->is('documents/*')
        ? 'menu-open' : '' }}">
    <a href="{{ route('documents.index') }}" class="nav-link {{ 
    request()->is('documents') || request()->is('documents/*')
        ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
      <p>Documents</p>
    </a>
</li>
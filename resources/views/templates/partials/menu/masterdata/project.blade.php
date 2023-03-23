<li class="nav-item">
    <a href="{{ route('projects.index') }}" class="nav-link {{ request()->is('projects') || request()->is('projects/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Projects
      </p>
    </a>
</li>
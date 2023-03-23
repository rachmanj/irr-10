<li class="nav-item">
    <a href="{{ route('doctypes.index') }}" class="nav-link {{ request()->is('doctypes') || request()->is('doctypes/*') ? 'active' : '' }}">
      <i class="far fa-circle nav-icon"></i>
      <p>
        Document Types
      </p>
    </a>
</li>
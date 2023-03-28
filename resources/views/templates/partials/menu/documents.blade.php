<li class="nav-item">
    <a href="{{ route('documents.index') }}" class="nav-link {{ 
    request()->is('documents') || request()->is('documents/*')
        ? 'active' : '' }}">
        <i class="fas fa-file"></i>
      <p>Documents</p>
    </a>
</li>
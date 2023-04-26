<li class="nav-item {{ 
    request()->is('suppliers') || request()->is('suppliers/*')
    ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ 
    request()->is('suppliers') || request()->is('suppliers/*')
    ? 'active' : '' }}">
    <i class="fas fa-folder"></i>
    <p>
      Master Data
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
        @include('templates.partials.menu.masterdata.suppliers')
  </ul>
</li>
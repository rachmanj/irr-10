<li class="nav-item {{ 
    request()->is('invoices') || request()->is('invoices/*')
    ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ 
    request()->is('invoices') || request()->is('invoices/*')
    ? 'active' : '' }}">
    <i class="fas fa-folder"></i>
    <p>
      Accounting
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
        @include('templates.partials.menu.accounting.invoices')
  </ul>
</li>
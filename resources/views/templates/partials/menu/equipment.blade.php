<li class="nav-item {{ 
    request()->is('equipments') || request()->is('equipments/*') ||
    request()->is('movings') || request()->is('movings/*') ||
    request()->is('unitnohistories') || request()->is('unitnohistories/*')
        ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ 
    request()->is('equipments') || request()->is('equipments/*') ||
    request()->is('movings') || request()->is('movings/*') ||
    request()->is('unitnohistories') || request()->is('unitnohistories/*')
        ? 'active' : '' }}">
      <i class="fas fa-snowplow"></i>
      <p>
        Equipments
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
        @include('templates.partials.menu.equipments.list')
        @include('templates.partials.menu.equipments.movings')
        @include('templates.partials.menu.equipments.unitnohistories')
    </ul>
</li>
<li class="nav-item {{ 
    request()->is('asset_categories') || request()->is('asset_categories/*') ||
    request()->is('doctypes') || request()->is('doctypes/*') ||
    request()->is('manufactures') || request()->is('manufactures/*') ||
    request()->is('projects') || request()->is('projects/*') ||
    request()->is('planttypes') || request()->is('planttypes/*') ||
    request()->is('plant_groups') || request()->is('plant_groups/*') ||
    request()->is('suppliers') || request()->is('suppliers/*') ||
    request()->is('unitmodels') || request()->is('unitmodels/*') ||
    request()->is('unitstatuses') || request()->is('unitstatuses/*')
    ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ 
    request()->is('asset_categories') || request()->is('asset_categories/*') ||
    request()->is('doctypes') || request()->is('doctypes/*') ||
    request()->is('manufactures') || request()->is('manufactures/*') ||
    request()->is('projects') || request()->is('projects/*') ||
    request()->is('planttypes') || request()->is('planttypes/*') ||
    request()->is('plant_groups') || request()->is('plant_groups/*') ||
    request()->is('suppliers') || request()->is('suppliers/*') ||
    request()->is('unitmodels') || request()->is('unitmodels/*') ||
    request()->is('unitstatuses') || request()->is('unitstatuses/*')
    ? 'active' : '' }}">
    <i class="fas fa-folder"></i>
    <p>
      Master Data
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
        @include('templates.partials.menu.masterdata.asset_categories')
        @include('templates.partials.menu.masterdata.doctypes')
        @include('templates.partials.menu.masterdata.manufacture')
        @include('templates.partials.menu.masterdata.project')
        @include('templates.partials.menu.masterdata.planttypes')
        @include('templates.partials.menu.masterdata.plant_groups')
        @include('templates.partials.menu.masterdata.suppliers')
        @include('templates.partials.menu.masterdata.unitmodel')
        @include('templates.partials.menu.masterdata.unitstatus')
    </li>
  </ul>
</li>
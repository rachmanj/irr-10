<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>ARK</b>Fleet <small>v.10</small></span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
          <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
        </div>
      </div> --}}
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          {{-- @include('dashboard.index') --}}
          @include('templates.partials.menu.dashboard')
  
          @include('templates.partials.menu.equipment')
  
          {{-- @include('templates.partials.menu.movings') --}}
          
          @include('templates.partials.menu.documents')
  
          @include('templates.partials.menu.reports')
  
            @include('templates.partials.menu.masterdata')

            <li class="nav-header">ADMIN</li>
            @include('templates.partials.menu.users')
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    @include('templates.partials.head')

  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('templates.partials.navbar')
        <!-- /.navbar -->
        @include('sweetalert::alert')

        <!-- Main Sidebar Container -->
        @include('templates.partials.sidebar')
        <!-- End Main Sidebar Container -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        {{-- Content Header --}}
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">@yield('title_page')</h1>
              </div><!-- /.col -->
              @include('templates.partials.breadcrumb')
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        {{-- End Content Header --}}
        
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
              @yield('content')
            </div><!-- /.container-fluid -->
        </div>  <!-- /.content -->


      </div>  <!-- /.content-wrapper -->
      
      
      <!-- start footer -->
        @include('templates.partials.footer')
      <!-- /.end footer -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @include('templates.partials.script')

  </body>
</html>
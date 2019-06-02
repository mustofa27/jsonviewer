<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>JSON Viewer</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin_template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_template/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin_template/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_template/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin_template/dist/css/skins/_all-skins.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
    <div id="app">
        <div class="wrapper">
            <header class="main-header">
            <!-- Logo -->
              <a href="{{ route('home') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>JS</b>ON</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">JSON<b>Viewer</b></span>
              </a>
              <!-- Header Navbar: style can be found in header.less -->
              <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </div>
              </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
              <section class="sidebar">
              <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                <li>
                  <a href="{{ route('home') }}">
                    <i class="fa fa-th"></i> <span>All Airlines</span>
                  </a>
                  <a href="{{ route('airlines', ['kode' => 'AWQ', 'terminal'=>'t1']) }}">
                    <i class="fa fa-th"></i> <span>AWQ Terminal 1</span>
                  </a>
                  <a href="{{ route('airlines', ['kode' => 'AWQ', 'terminal'=>'t2']) }}">
                    <i class="fa fa-th"></i> <span>AWQ Terminal 2</span>
                  </a>
                </li>
                </ul>
              </section>
              <!-- /.sidebar -->
            </aside>
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version</b> 1.0.0
            </div>
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('admin_template/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('admin_template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin_template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('admin_template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin_template/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_template/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin_template/dist/js/demo.js') }}"></script>
    <!-- page script -->
    <script>
      $(document).ready(function() {
          var table = $('#table1').DataTable({
              serverSide: true,
              processing: true,
              searching: true,
              ajax: {
                  url : '{!! route('ajax') !!}',
                  dataType : 'json',
                  type : 'POST',
                  data  : function( d ) {
                    d._token      = "{{ csrf_token() }}";
                    d.kode        = $('#kode').val();
                    /*d.tanggal       = $('#tanggal').val();*/
                    d.terminal      = $('#terminal').val();
                  }
              },
              columns: [
                  { data: 'airline', name: 'airline' },
                  { data: 'callsign2', name: 'callsign2' },
                  { data: 'regno', name: 'regno' },
                  { data: 'airport_name', name: 'airport_name' },
                  { data: 'belt', name: 'belt'},
                  { data: 'new_time', name: 'new_time'},
                  { data: 'est', name: 'est'},
                  { data: 'act', name: 'act'},
                  { data: 'block', name: 'block'},
                  { data: 'bay', name: 'bay'},
                  { data: 'status', name: 'status'},
                  { data: 'terminal', name: 'terminal'}
                  /*{ 
                      "data": "id",
                      "render": function ( data, type, full ) 
                      {
                              send =''
                              if(hapus!=''){
                                  send = send+adel+hapus.slice(0, -8)+data+"/delete"+bdel;
                              }
                              return send;
                      }
                  }*/
              ]
              ,
              sDom: "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-sm-12 col-md-6 col-lg-6'i><'col-sm-12 col-md-6 col-lg-6 center'p>>",
              oLanguage: 
              {
                  sLengthMenu: "_MENU_ records per page"
              }
          });

          var el = document.getElementById('show');
          el.addEventListener("click", function(e){
              table.ajax.reload();
          });
      });
    </script>
</body>
</html>

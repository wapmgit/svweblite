<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SysVent@s</title>

  <!-- Google Font: Source Sans Pro
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
  <!-- Ionicons
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bootstrap 4
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}"> -->
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- select -->
  <link rel="stylesheet" href="{{asset('plugins/select/css/bootstrap-select.min.css')}}">
  <!-- JQVMap
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}"> -->
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote 
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">-->
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
 </head>
     @if(Auth::user()->nivel=="A")
<body class="hold-transition sidebar-mini layout-fixed">
@else
	   <body class="hold-transition skin-blue sidebar-collapse">
 @endif

<div class="wrapper">

  <!-- Preloader -->
    <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake img-circle" src="{{asset('dist/img/logosistema.png')}}"  alt="NKS sistemas" height="70" width="70">
  </div>
-->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
      @if(Auth::user()->nivel=="A")    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      @endif
	  </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
		<a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
       Cerrar Sesión</a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        </form>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	  <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" title="Salir">
    <i class="fa-solid fa-door-open">
	</i>
        </a>
      </li>  


      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa  fa-navicon "></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center">
          <div class="dropdown-divider"></div>
          <a href="{{route('cajaventas')}}" class="dropdown-item">
            <i class="fa fa-line-chart mr-2"></i> Corte de Caja
			
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('newventa')}}" class="dropdown-item">
            <i class="fa fa-cart-plus mr-2"></i> Facturar
  
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('ventacaja')}}" class="dropdown-item">
            <i class="fa  fa-area-chart mr-2"></i> Ventas
          </a>
        </div>
    
      </li>
      <!-- Notifications Dropdown Menu 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>  @if(Auth::user()->nivel=="A") 
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>@endif
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
<?Php  $foto=Auth::user()->img; ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('dist/img/logosistemas.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SysVent@sLite </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/'.$foto)}}" class="img-circle elevation-2" alt="User Image">		
        </div>	<span class="brand-text font-weight-light"></span>
        <div class="info">
          <a href="{{ route('logout') }}"        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" 
		class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!--    <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>-->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Archivo
                <i class="fas fa-angle-left right"></i>             
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('clientes')}}"class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('proveedores')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('vendedores')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('icategoria')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grupos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('articulos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Articulos</p>
                </a>
              </li>
            </ul>
          </li>
		          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
               Ingresos y Egresos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('compras')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('ventas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ventas</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{route('gastos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gastos</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{route('ajustes')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ajuste de Inventario</p>
                </a>
              </li>
			    <li class="nav-item">
                <a href="{{route('cxc')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuentas Por Cobrar</p>
                </a>
              </li>
			 <li class="nav-item">
                <a href="{{route('cxp')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuentas Por Pagar</p>
                </a>
              </li>
            </ul>
          </li>
		 <!--  <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-truck"></i>
              <p>
              Pedidos
                <i class="fas fa-angle-left right"></i>             
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{route('pedidos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reportepedido')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Articulos en Pedido</p>
                </a>
              </li>

			<li class="nav-item">
                <a href="{{route('pdescargados')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pedidos Web</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Informes de Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('resumenventas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Resumen de Ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cortecaja')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Corte de Caja</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{route('detalleingresos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Detalle de Ingresos</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{route('reportecxc')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuentas por Cobrar</p>
                </a>
              </li>
				<!-- <li class="nav-item">
                <a href="{{route('reportecxcv')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuentas por Vendedor</p>
                </a>
              </li> -->
			  <li class="nav-item">
                <a href="{{route('utilidadventas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Utilidad en Ventas</p>
                </a>
              </li>	
			  <li class="nav-item">
                <a href="{{route('ventasarticulo')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ventas de un Articulo</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Informes de Compras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('resumencompras')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Resumen de Compras</p>
                </a>
              </li>
             <!-- <li class="nav-item">
                <a href="{{route('resumengastos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Resumen de Gastos</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{route('retenciones')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Retenciones</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="{{route('reportecxp')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuentas por Pagar</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('detallegresos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Detalle de Pagos</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{route('comprasarticulo')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compras de un Articulo</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-print"></i>
              <p>
               Otros Informes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reportearticulos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reporte de Articulos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('listaprecios')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de Precios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('stockcero')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Existencia Cero</p>
                </a>
              </li>
			 	<li class="nav-item">
             <a href="{{route('balance')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Balance Ing./Egre.</p>
                </a>
              </li>
				<li class="nav-item">
                <a href="{{route('catalogo')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Catalogo</p>
                </a>
              </li>
			 <!-- 	<li class="nav-item">
                <a href="{{route('aclientes')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Analisis Clientes</p>
                </a>
				</li> -->
				<li class="nav-item">
                <a href="{{route('repclientes')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de Clientes</p>
                </a>
				</li>
				<li class="nav-item">
                <a href="repproveedores" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de Proveedores</p>
                </a>
				</li>
            </ul>
          </li>  @if(Auth::user()->id==8)   
		  <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Cuentas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('bancos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
            </ul>
          </li> 
		  @endif<!--
		  		  <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Libros de Impuestos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
			  	<li class="nav-item">
                <a href="{{route('librocompras')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Libro de Compras</p>
                </a>
              </li>
				<li class="nav-item">
                <a href="{{route('libroventas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Libro de Ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('valorizado')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventaro Valorizado</p>
                </a>
              </li>
			<li class="nav-item">
                <a href="{{route('correlativof')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Correlativo Fiscal</p>
                </a>
              </li>
            </ul>
          </li>
        <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Comisiones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('comisiones')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comisones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('comisionxp')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comi. por Pagar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('comisionespagadas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comi. por Pagadas</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-header">Configuracion</li>
		            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Sistema
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
			 @if(Auth::user()->id==1) 
			              <li class="nav-item">
                <a href="{{route('iempresas')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empresas</p>
                </a>
              </li>@endif
              <li class="nav-item">
                <a href="{{route('tasas')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tasa de Cambio</p>
                </a>
              </li>
			<li class="nav-item">
                <a href="{{route('monedas')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monedas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('showusuarios')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('acercade')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Acerca de</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="{{route('calc')}}" class="nav-link">
              <i class="nav-icon fa fa-calculator"></i>
              <p>
                Calculadora
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('bloc')}}" class="nav-link">
              <i class="nav-icon fa fa-sticky-note"></i>
              <p>
                Bloc de Notas
              </p>
            </a>
          </li>

-->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Ayuda
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

  
              <li class="nav-item">
                <a href="{{route('ayuda')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sistema</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper px-2 py-2">
       @yield('contenido')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
<strong>Copyright &copy; 2015-2024 <a href="#">W&W Sistemas</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
 
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap 
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>-->
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script> -->
<!-- overlayScrollbars
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script> -->
<!-- select -->
<script src="{{asset('plugins/select/js/bootstrap-select.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE App-->
<script src="https://kit.fontawesome.com/808781cc1c.js" crossorigin="anonymous"></script> 
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>-->
    @stack ('scripts')
</body>
</html>


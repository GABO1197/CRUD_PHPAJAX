<?php
	session_start();
	if(!isset($_SESSION['S_IDEUSUARIO'])){
		header('Location: ../Login/index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>curso PHP AJAX</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plantilla/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plantilla/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../plantilla/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plantilla/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plantilla/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plantilla/plugins/summernote/summernote-bs4.min.css">
  <!-- skins -->
  <!-- <link rel="stylesheet" href="../Plantilla/dist/css/AdminLTE1.min.css"> -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!-- <link rel="stylesheet" href="../Plantilla/dist/css/skins/_all-skins.min.css"> -->
  <!-- datatable -->
  <link rel="stylesheet" href="../plantilla/plugins/DataTables/datatables.min.css">
  <link rel="stylesheet" href="../plantilla/plugins/select2/css/select2.min.css">

</head>
<style>
  .swal2-popup{
    font-size: 1rem !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../plantilla/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
     
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
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
      </li>
      <li class="dropdown user user-menu ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img id="img_nav" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['S_USER'];?></span>
            </a>
            <ul class="dropdown-menu w-150">
              <!-- User image -->
              <li class="user-header">
                <img id="img_subnav" class="img-circle" alt="User Image">

                <p>
                <?php echo $_SESSION['S_USER'];?> - Web Developer
                  <small>Member since sept. 2023</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer d-flex justify-content-center ">
                <div class="pull-left p-2">
                  <a href="#" onclick="AbrirModalEditarContra()" class="btn btn-default btn-flat  ">Cambiar Contrase&ntilde;a</a>
                </div>
                
                <div class="pull-right p-2">
                  <a href="../controlador/usuario/controlador_cerrar_sesion.php" class="btn btn-default btn-flat ">SALIR</a>
                </div>
              </li>
            </ul>
          </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
 
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../plantilla/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img id="img_lateral" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="pull-left info">
          <a href="#"><?php echo $_SESSION['S_USER'];?></a>
          <!-- <br>
          <a href="#"><i class="fa fa-circle text-success"> Online</i></a> -->
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_listar.php')" class="nav-link active">
              <i class="nav-icon fa fa-users"></i>
              <p>
                USUARIO
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <section class="content">
    <input type="text" id="txtidprincipal" value="<?php echo $_SESSION['S_IDEUSUARIO'];?>"hidden>
    <input type="text" id="usuarioprincipal" value="<?php echo $_SESSION['S_USER'];?>"hidden>
      <div class="row p-2" id="contenido_principal">
      <div class="col-md-12">
        <div class="card card-warning shadow">
          
            <div class="card-header with-border">
                <h3 class="card-title">BIENVENIDO AL CONTENIDO PRINCIPAL</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            <div class="card-body">

                CONTENIDO PRINCIPAL
            </div>
        </div>
</div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>




<!-- ./wrapper -->
<div class="modal fade" id="modal_editar_contra"  aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar contrase&ntilde;a   </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                <input type="text" class="form-control" id="txt_contra_bd" placeholder="Contrase&ntilde;a Actual" hidden>
                <br>
                  <label for="">Contrase&ntilde;a Actual</label>
                  <input type="password" class="form-control" id="txt_contra_actual" placeholder="Contrase&ntilde;a Actual"><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Nueva Contrase&ntilde;a</label>
                  <input type="password" class="form-control" id="txt_contra_nueva" placeholder="Nueva Contrase&ntilde;a"><br>
                </div>
                <div class="col-lg-12">
                  <label for="">Repita la Contrase&ntilde;a</label>
                  <input type="password" class="form-control" id="txt_contra_re" placeholder="Repita la Contrase&ntilde;a"><br>
                </div>
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"><b>&nbsp;cerrar</b></i></button>
              <button type="button" class="btn btn-success" onclick="Editar_contra()"><i class="fa fa-check"><b>&nbsp;Actualizar</b></i></button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>

<!-- ssssss -->


<!-- jQuery -->
<script src="../plantilla/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plantilla/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- mis procesos js -->
<script src="../js/proceso.js"></script>
<!-- Bootstrap 4 -->
<script src="../plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plantilla/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plantilla/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plantilla/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plantilla/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plantilla/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plantilla/plugins/moment/moment.min.js"></script>
<script src="../plantilla/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plantilla/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plantilla/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plantilla/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../plantilla/dist/js/adminlte.js"></script>
<script src="../plantilla/plugins/select2/js/select2.min.js"></script>
<script src="../plantilla/plugins/sweetalert2/sweetaler2.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../plantilla/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../plantilla/dist/js/pages/dashboard.js"></script> -->



<!-- datatablet -->
<script src="../plantilla/plugins/DataTables/datatables.min.js"></script>
<!-- usuario foto -->
<script src="../js/usuario.js"></script>
<script>
 TraerDatosUsuario();
</script>
<script>
  var idioma_espanol = {
			select: {
			rows: "%d fila seleccionada"
			},
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
			"sInfo":           "Registros del (_START_ al _END_) total de _TOTAL_ registros",
			"sInfoEmpty":      "Registros del (0 al 0) total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "<b>No se encontraron datos</b>",
			"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
			},
			"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
	 }
  function cargar_contenido(contenedor,contenido){
    $("#"+contenedor).load(contenido);
}
</script>

</script>
</body>
</html>

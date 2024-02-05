 <?php 
if (strlen(session_id())<1) 
  session_start();

  ?>
 <!DOCTYPE html>
<html>
<head>
<link href="../../imagenes/EXAMPLE.ico" type="i/x-icon" rel="shortcut icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tiendas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../css/listaestilos.css">
  <link rel="stylesheet" href="../../public/css/font-awesome.min.css">

  <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
  <!-- Morris chart --><!-- Daterange picker -->
 <link rel="stylesheet" href="img/apple-touch-ico.png">
 <link rel="stylesheet" href="img/favicon.ico">
<!-- DATATABLES-->
<link rel="stylesheet" href="../../public/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="../../public/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="../../public/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="../../public/css/bootstrap-select.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">NAVEGACIÓM</span>
      </a>

      <div class="navbar-custom-menu"  >
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
          <a href="../ajax/usuario.php?op=salir" ><i class="fa fa-sign-out" style="color: #ffff"></i> <span>Salir</span> </a></center>
            
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

<br>

<center><a href="perfil.php" ><i class="fa fa-gears" style="color: red; text-transform: uppercase;"></i> <span><?php echo $_SESSION['nombre']; ?></span> </a></center>
<br>
       
                  <?php 

  echo ' <li><a href="tiendas.php"><i class="fa  fa-shopping-basket"></i> <span>Tiendas</span></a>
        </li>';

        ?>


<?php 

  echo '  <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Mis Pedidos</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="espera.php"><i class="fa fa-circle-o"></i>En Espera de ser pagados</a></li>
            <li><a href="confirmado.php"><i class="fa fa-circle-o"></i>Recibidos</a></li>
            <li><a href="cancelado.php"><i class="fa fa-circle-o"></i>Cancelado</a></li>
            <li><a href="pendientes.php"><i class="fa fa-circle-o"></i>Todos los pedidos pendientes</a></li>
          </ul>
        </li>';

        ?>  
               
           <?php 

echo ' <li><a href="reporte.php"><i class="fa  fa-bar-chart"></i> <span>Reporte de compras</span></a>
      </li>';

      ?>
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
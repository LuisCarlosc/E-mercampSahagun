 <?php 
if (strlen(session_id())<1) 
  session_start();

  ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tienda </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
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

  <header class="main-header ">
    <!-- Logo -->
    <a href="escritorio.php" class="logo"  >
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>  </b> </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b> </b> </span>
    </a>
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
        
<center><img src="../../files/administrador/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image" width="100px" height="100px">
<br>
<a href="perfil.php" ><i class="fa fa-gears" style="color: red"></i> <span><?php echo $_SESSION['nombre']; ?></span> </a></center>
<br><br>

       <?php 
if ($_SESSION['escritorio']==1) {
  echo ' <li><a href="escritorio.php"><i class="fa  fa-desktop"></i> <span>Panel de control</span></a>
        </li>';
}
        ?>




<?php 
if ($_SESSION['tiendas']==1) {
  echo ' <li><a href="tiendas.php"><i class="fa  fa-shopping-basket"></i> <span>Tiendas</span></a>
        </li>';
}
        ?>




        <?php 
if ($_SESSION['usuarios']==1) {
  echo ' <li><a href="usuario.php"><i class="fa  fa-users"></i> <span>Usuarios</span></a>
        </li>';
}



        ?>
        <?php 
if ($_SESSION['administrador']==1) {
  echo ' <li><a href="administrador.php"><i class="fa  fa-user"></i> <span>Administrador</span></a>
        </li>';
}
        ?>

           

 
        
            
            
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
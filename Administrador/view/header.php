 <?php 
if (strlen(session_id())<1) 
  session_start();

  ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Proyecto </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link href="../../imagenes/EXAMPLE.ico" type="i/x-icon" rel="shortcut icon" />
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
    
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">NAVEGACIÓM</span>
      </a>
     
      <div class="navbar-custom-menu"  >
        <ul class="nav navbar-nav">


        <li class="dropdown messages-menu">
            <a href="pedidos.php" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <!--Notificacion-->
              <span id="count" class="label label-success" style="font-size: 15px"> <?php
   
   require_once("../../config/Conexion.php");  
  
  $sql = "SELECT COUNT(*) total FROM tienda, pedido,cliente WHERE cliente.idcliente=pedido.idcliente 
  and pedido.estado='Confirmado' 
  and pedido.estadoPago='Pendiente' and DATE(fechahora)=curdate() and tienda.idtienda= ".$_SESSION['idtienda'];
  
   $result = mysqli_query($conexion, $sql);
   $fila = mysqli_fetch_assoc($result);
   echo  $fila['total'];
   ?></span>
            </a>

           
          </li>


          <div class="navbar-custom-menu"  >
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
          <a href="../ajax/usuario.php?op=salir" ><i class="fa fa-sign-out" style="color: #ffff"></i> <span>Salir</span> </a></center>
            
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
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
<br>
        
<center><img src="../../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image" width="100px" height="100px">
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
if ($_SESSION['categoria']==1) {
  echo ' <li><a href="categoria.php"><i class="fa  fa-folder-open"></i> <span>Categorias</span></a>
        </li>';
}



        ?>
        <?php 
if ($_SESSION['producto']==1) {
  echo ' <li><a href="producto.php"><i class="fa  fa-shopping-bag"></i> <span>Productos</span></a>
        </li>';
}
        ?>

<?php 
echo '  <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Mis Pedidos</span>
            
          </a>
          <ul class="treeview-menu">
            <li><a href="pedidos.php"><i class="fa fa-circle-o"></i>Pedidos sin entregar</a></li>
            <li><a href="pedidosentregados.php"><i class="fa fa-circle-o"></i>Pedidos entregados</a></li>
          </ul>
        </li>';

        ?> 
          

          <?php 
if ($_SESSION['reportes']==1) {
  echo '  <li><a href="reportes.php"><i class="fa  fa-file-pdf-o"></i> <span>Reportes</span></a>
  </li>';
}
        ?>  
              <?php 
if ($_SESSION['usuarios']==1) {
  echo ' <li><a href="usuario.php"><i class="fa  fa-users"></i> <span>Usuarios</span></a>
        </li>';
}
        ?>  

 
        
            
            
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
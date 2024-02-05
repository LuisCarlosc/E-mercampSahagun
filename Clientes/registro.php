
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  
  <!-- Font Awesome -->

  <link rel="stylesheet" href="../public/css/font-awesome.min.css">

  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <!-- Morris chart --><!-- Daterange picker -->

<!-- DATATABLES-->
<link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
<link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">
<link rel="stylesheet" href="../public/css/bootstrap-select.min.css">


</head>



<div class="contenedor-solicitud">
<div class="box-header with-border" >

<div class="panel-body panel-solicitud" id="formularioregistros" >
  <form  action="validar.php" id="perfil" method="POST" enctype="multipart/form-data">

  


  <div  class="form-group col-lg-3  col-md-3 col-xs-12">
  <h1 class="box-title"> <a href="../index.php" class="btn btn-warning" >  <i class="fa fa-chevron-left"></i> </a>  </h1>
  <br>
  <br>
<p  >Con Menú a la mano mobile podrás generar pedidos en tu restuarante favorito con mas comodidad,
 mayor eficiencias y faclidad. Que estas esperando para crear tu cuentas y empezar a disfrutar 
  lo que te brinda esta App web movil. </p>


  </div>


  <div  class="form-group col-lg-9 col-md-9col-xs-12">
<center> <h4>FORMULARIO DE REGISTRO</h4>
</center>  <br>

 
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre </label>
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="2512" placeholder="Nombre " autocomplete="off" required  >
    </div> 
    
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
       <label for="">Correo Electronico</label>
      <input class="form-control" type="text" name="email" id="email" maxlength="2512" placeholder="Correo electronico" autocomplete="off" required  >
     </div>
    
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Usuario</label>
      <input class="form-control" type="text" name="login" id="login" maxlength="256" placeholder="Usuario de acceso" autocomplete="off" required  >
    </div>
   
   
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Clave</label>
      <input class="form-control" type="password" name="clave" id="clave" maxlength="256" placeholder="Contraseña" autocomplete="off" required  >
    </div>

     <div class="form-group col-lg-6 col-md-6 col-xs-12">

    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
<center>
<br>
<input type="submit"  value="Crear tu cuenta"  class="btn btn-Warning"><i class="fa fa-"   > </i>
</center>
     

    </div>
          
 


</div>


 
</form>

   
</div>

</div>




  <script type="text/javascript" src="../../js/bootstrap-filestyle.js"> </script>

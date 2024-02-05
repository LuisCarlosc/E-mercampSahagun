<?php

@session_start();
if(!isset($_SESSION['nombre'])){
  session_destroy();
  ?>
<script language="javascript">
    window.location = "../";
</script>
  <?php
}
include("../../config/Conexion.php");
 $db = new Conexion();

//  if(isset($_POST["view"]))
//  {

$sql_usuario = $db->query("select * from usuarios where id = ".$_SESSION['id']." ");
$array_usuario = $sql_usuario->fetch_assoc();
$user = $array_usuario['nombre'];
$id = $array_usuario['id'];



$query = $db->query("SELECT * FROM mensaje m inner join usuarios u on m.de = u.id WHERE m.para = $id  order by m.id DESC"); 

 $num = $query->num_rows;
 $output = '';

 if($num > 0)
 {

  $output .= '
  <div class="col-md-9 active tab-pane" id="inbox">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inboxttttt</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Buscar Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  <!-- Aqui va la cantidad de mensajes -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              
              <div class="table-responsive mailbox-messages " >
                <table class="table table-hover table-striped">
                  <tbody>
  
  ';
     while($array_mensaje = $query->fetch_array()) {
        $fecha_recepcion = $array_mensaje[5];
        $fecha_bd = explode("-", $fecha_recepcion);
        $fecha_e = $fecha_bd[2]."-".$fecha_bd[1]."-".$fecha_bd[0];
        
        $output .= '
        
        <tr>
       
          <!-- Emisor -->
          
        
        <td class="mailbox-star"><a href="#"><i class="fa fa-envelope text-yellow"></i></a></td>

        <td class="mailbox-name"><a href="leer-email.php?mensaje='. $array_mensaje[0].' ">'. $array_mensaje[12] .'</a></td>
        
        <!--/Emisor -->

        <!-- Asunto y mensaje -->';
         
        
        if($array_mensaje['leido']=='no'){

          
        $output .=

        '<td class="mailbox-subject"><b>' .$array_mensaje[3].'</b> -' .$array_mensaje[4]. '</td>' ; 

        }

        else{
          $output .=
          
          '<td class="mailbox-subject">' .$array_mensaje[3]. '-' .$array_mensaje[4]. '</td>' ;
        

      }

      $output .=
      '<!-- /Asunto y mensaje -->
      <td class="mailbox-attachment"></td>
      <td class="mailbox-date">' .$fecha_e. '</td>
    </tr>';
      
  }
}

else
 {

  $output .= '
  <div class="col-md-9 active tab-pane" id="inbox">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Inbox</h3>
     </div>
      <div class="table-responsive mailbox-messages " >
        <table class="table table-hover table-striped">
        <tbody>
  
  ';
  
  $output .= '
        
  <tr>
  
  <td class="mailbox-star"><a href="#"></a></td>

  <td class="mailbox-name">NO TIENES MENSAJES</td>
';
 }



//NOTIFICACIONES ADICIONALES
$query_1 = $db->query("SELECT * FROM mensaje WHERE leido= 'no' and para = '$id'");
 $count = $query_1->num_rows;
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);

 //}
?>
 
 
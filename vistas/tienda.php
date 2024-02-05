<?php
    include('header2.php')
?>
    <div class="contenedor-tienda" >

        <br>
        <center><form action="tienda.php" method="POST">
            <input type="text" class="buscador" style="width:50%; border-radius: 5px;border-top: none; 
                border-left: none; border-right:none;border-color: blue;height: 35px;" name="buscar" 
                placeholder=" Buscar..." autocomplete="off"  >
                
                
                <button type="submit" class="btn btn-primary" style="border-radius: 8px">
                    <i class="fa fa-search"></i> Buscar...
                </button>
        </form></center>

        <HR>

        <div class="row">
            <div class="col-sm-12">
                <table class="listado">
                    <?php
                    include ("read.php");

                    if($sql_query->num_rows>0){
                        while($row=mysqli_fetch_array($sql_query)){?>
                            <tr>
                                <td>
                                    <div class="listado-tienda">
                                        <div class="logo-tienda">
                                            <a href="../Administrador/view/loginUsers.php?idtienda=<?php echo $row["idtienda"]; ?>">    <img class="imagen-tiendas" src='../files/tiendas/<?php echo $row["imagen"]; ?>'  height='200px' width='180px'   > </a>  
                                        </div>

                                        <center> <a href="pedido.php?id=<?php echo $row["idtienda"]; ?>" class="small-box-footer" style="color:blue; style=  border-radius: 70px;"> 
    <font style="text-transform: uppercase;"> <strong>  <p><?php echo $row["nombre"]; ?>  </strong>  </font> <br> &nbsp <?php echo $row["tipo"]; ?>&nbsp <br>     </p>   </a></center>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        echo "No hay coincidencia de su busqueda ";
                    }
                    ?>
                    
                </table>
            </div>
        </div> 
    </div>
    
    <script type="text/javascript" src="../../js/bootstrap-filestyle.js"> </script>
<script src="../js/header.js"></script>
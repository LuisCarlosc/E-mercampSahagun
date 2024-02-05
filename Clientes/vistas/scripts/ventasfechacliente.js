var tabla;

//funcion que se ejecuta al inicio
function init(){

   listar();
    //cargamos los items al select cliente
   $.post("../ajax/articulo.php?op=select", function(r){
   	$("#idtienda").html(r);
   	$('#idtienda').selectpicker('refresh');
   });

}

//funcion listar
function listar(){
	var  fecha_inicio = $("#fecha_inicio").val();
	 var fecha_fin = $("#fecha_fin").val();
	 var idtienda = $("#idtienda").val();
	
		tabla=$('#tbllistado').dataTable({
			"aProcessing": true,//activamos el procedimiento del datatable
			"aServerSide": true,//paginacion y filrado realizados por el server
			dom: 'Bfrtip',//definimos los elementos del control de la tabla
			buttons: [
					 
			],
			"ajax":
			{
				url:'../ajax/consultas.php?op=ventasfechacliente',
				data:{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, idtienda: idtienda},
				type: "get",
				dataType : "json",
				error:function(e){
					console.log(e.responseText);
				}
			},
			"bDestroy":true,
			"iDisplayLength":5,//paginacion
			"order":[[0,"desc"]]//ordenar (columna, orden)
		}).DataTable();
	}
	

init();  
var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })

  
}

//funcion limpiar
function limpiar(){

	$("#nombre").val("");
	
	$("#idmesa").val("");
}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	mostrarform(false);
}



//funcion listar
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  
		],
		"ajax":
		{
			url: "../ajax/espera.php?op=listar",
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}




//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/categoria.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(false);
     		tabla.ajax.reload();
     	}
     });

     limpiar();
}

function mostrar(idpedido){
	$.post("../ajax/venta.php?op=mostrar",{idpedido : idpedido},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			$("#nombre").val(data.nombre);
			$("#descripcion").val(data.descripcion);
			$("#idpedido").val(data.idpedido);
			
		})
}


//funcion para desactivar
function desactivar(idpedido){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/venta.php?op=desactivar", {idpedido: idpedido}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idcategoria){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/categoria.php?op=activar", {idcategoria: idcategoria}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
function eliminar(idtienda){
	bootbox.confirm("¿Esta seguro de eliminar este dato?", function(result){
		if (result) {

			$.post("../ajax/restaurantes.php?op=eliminar", {idrestaurante: idrestaurante}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
function generarbarcode(){
	codigo=$("#codigo").val();
	JsBarcode("#barcode",codigo);
	$("#print").show();

}

function imprimir(){
	$("#print").printArea();
}

init();
var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
  confirmado();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })

  
}

//funcion limpiar
function limpiar(){

	$("#nombre").val("");
	
	$("#idtienda").val("");
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

function confirmado(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  
		],
		"ajax":
		{
			url: "../ajax/pendientes.php?op=confirmado",
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,//paginacion
		"order":[[1,"desc"]]//ordenar (columna, orden)
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
	$.post("../ajax/pendientes.php?op=mostrar",{idpedido : idpedido},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#fechahora").val(data.fechahora);
			$("#idpedido").val(data.idpedido);
			
			//ocultar y mostrar los botones
			$("#btnGuardar").hide();
			$("#btnCancelar").show();
			$("#btnAgregarArt").hide();
		});
	$.post("../ajax/pendientes.php?op=listarDetalle&id="+idpedido,function(r){
		$("#detalles").html(r);
	});

}


//funcion para desactivar
function desactivar(idcategoria){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/categoria.php?op=desactivar", {idcategoria: idcategoria}, function(e){
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

			$.post("../ajax/Tiendas.php?op=eliminar", {idtienda: idtienda}, function(e){
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
var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })

   //cargamos los items al celect categoria
   $.post("../ajax/articulo.php?op=selectCategoria", function(r){
   	$("#idcategoria").html(r);
   	$("#idcategoria").selectpicker('refresh');
   });
   $("#imagenmuestra").hide();
}

//funcion limpiar
function limpiar(){
	$("#nombre").val("");
	$("#telefono").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
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
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/tiendas.php?op=listar',
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
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/tiendas.php?op=guardaryeditar",
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

function mostrar(idtienda){
	$.post("../ajax/tiendas.php?op=mostrar",{idtienda : idtienda},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			$("#tipo").val(data.tipo);
			$("#tipo").selectpicker('refresh');
			
			$("#nombre").val(data.nombre);
			$("#telefono").val(data.telefono);
			$("#imagenmuestra").show();
			$("#imagenmuestra").attr("src","../../files/tiendas/"+data.imagen);
			$("#imagenactual").val(data.imagen);
			$("#idtienda").val(data.idtienda);
			
		})
}


//funcion para desactivar
function desactivar(idtienda){
	bootbox.confirm("¿Esta seguro de desactivar esta tienda?" , function(result){
		if (result) {
			$.post("../ajax/tiendas.php?op=desactivar", {idtienda: idtienda}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idtienda){
	bootbox.confirm("¿Esta seguro de activar esta tienda?" , function(result){
		if (result) {
			$.post("../ajax/tiendas.php?op=activar", {idtienda: idtienda}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
function eliminar(idtienda){
	bootbox.confirm("¿Esta seguro de eliminar este dato?", function(result){
		if (result) {

			$.post("../ajax/tiendas.php?op=eliminar", {idtienda: idtienda}, function(e){
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
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
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url: "../ajax/mesas.php?op=listar",
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
     	url: "../ajax/mesas.php?op=guardaryeditar",
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

function mostrar(idmesa){
	$.post("../ajax/mesas.php?op=mostrar",{idmesa : idmesa},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			$("#nombre").val(data.nombre);
			$("#tipo").selectpicker('refresh');
			$("#tipo").val(data.tipo);
		
			$("#idmesa").val(data.idmesa);
			
		})
}


//funcion para desactivar
function desactivar(idmesa){
	bootbox.confirm("¿Esta seguro de activar esta mesa?" , function(result){
		if (result) {
			$.post("../ajax/mesas.php?op=desactivar", {idmesa: idmesa}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idmesa){
	bootbox.confirm("¿Esta seguro de activar esta mesa?" , function(result){
		if (result) {
			$.post("../ajax/mesas.php?op=activar", {idmesa: idmesa}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
function eliminar(idrestaurante){
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
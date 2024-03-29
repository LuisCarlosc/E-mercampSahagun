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
	$("#Nit").val("");
	$("#nombre").val("");
	
	$("#direccion").val("");
	$("#telefono").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
	$("#idtienda").val("");
}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	
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
			url:'../ajax/restaurantes.php?op=listar',
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
     	url: "../ajax1/restaurantes.php?op=guardaryeditar",
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

 
}

function mostrar(idrestaurante){
	$.post("../ajax/restaurantes.php?op=mostrar",{idrestaurante : idrestaurante},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			$("#Nit").val(data.Nit);
			$("#tipo").val(data.tipo);
			$("#tipo").selectpicker('refresh');
			
			$("#nombre").val(data.nombre);
			$("#direccion").val(data.direccion);
			$("#telefono").val(data.telefono);
			$("#imagenmuestra").show();
			$("#imagenmuestra").attr("src","../files/restaurantes/"+data.imagen);
			$("#imagenactual").val(data.imagen);
			$("#idrestaurante").val(data.idrestaurante);
			
		})
}


//funcion para desactivar
function desactivar(idrestaurante){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/restaurantes.php?op=desactivar", {idrestaurante: idrestaurante}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idrestaurante){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/restaurantes.php?op=activar", {idrestaurante: idrestaurante}, function(e){
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
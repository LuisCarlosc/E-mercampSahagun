var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })

   $("#imagenmuestra").hide();
//mostramos los permisos
$.post("../ajax/administrador.php?op=permisos&id=", function(r){
	$("#permisos").html(r);
});
}

//funcion limpiar
function limpiar(){
	$("#nombre").val("");
    $("#cedula").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#clave").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idusuario").val("");
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
			url:'../ajax/administrador.php?op=listar',
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
     	url: "../ajax/administrador.php?op=guardaryeditar",
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

function mostrar(id_administrador){
	$.post("../ajax/administrador.php?op=mostrar",{id_administrador : id_administrador},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			$("#nombre").val(data.nombre);
            $("#cedula").val(data.cedula);
            $("#telefono").val(data.telefono);
            $("#correo").val(data.correo);
            $("#clave").val(data.clave);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src","../files/administrador/"+data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#id_administrador").val(data.id_administrador);


		});
	$.post("../ajax/administrador.php?op=permisos&id="+id_administrador, function(r){
	$("#permisos").html(r);
});
}


//funcion para desactivar
function desactivar(id_administrador){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/administrador.php?op=desactivar", {id_administrador : id_administrador}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(id_administrador){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/administrador.php?op=activar", {id_administrador : id_administrador}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


init();
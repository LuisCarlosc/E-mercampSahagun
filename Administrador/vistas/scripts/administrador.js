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
	$("#permisosadmin").html(r);
});
}

//funcion limpiar
function limpiar(){
	$("#nombre").val("");
    $("#cedula").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#clave").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#iduser").val("");
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

function mostrar(idadmin){
	$.post("../ajax/administrador.php?op=mostrar",{idadmin : idadmin},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			$("#nombre").val(data.nombre);
            $("#cedula").val(data.cedula);
            $("#telefono").val(data.telefono);
            $("#email").val(data.email);
            $("#clave").val(data.clave);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src","../files/administrador/"+data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#idadmin").val(data.idadmin);


		});
	$.post("../ajax/administrador.php?op=permisos&id="+idadmin, function(r){
	$("#permisosadmin").html(r);
});
}


//funcion para desactivar
function desactivar(idadmin){
	bootbox.confirm("¿Esta seguro de desactivar este administrador?", function(result){
		if (result) {
			$.post("../ajax/administrador.php?op=desactivar", {idadmin : idadmin}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idadmin){
	bootbox.confirm("¿Esta seguro de activar este administrador?" , function(result){
		if (result) {
			$.post("../ajax/administrador.php?op=activar", {idadmin : idadmin}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


init();
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
$.post("../ajax/A_usuarios.php?op=permisos&id=", function(r){
	$("#permisosusers").html(r);
});


$.post("../ajax/usuario.php?op=select", function(r){
	$("#idtienda").html(r);
	$("#idtienda").selectpicker('refresh');
});
}

//funcion limpiar
function limpiar(){
	$("#nombre").val("");
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
			url:'../ajax/A_usuarios.php?op=listar',
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
     	url: "../ajax/A_usuarios.php?op=guardaryeditar",
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

function mostrar(iduser){
	$.post("../ajax/A_usuarios.php?op=mostrar",{iduser : iduser},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
		
			$("#nombre").val(data.nombre);
            $("#telefono").val(data.telefono);
        	$("#cargo").val(data.cargo);
			$("#cargo").selectpicker('refresh');
			$("#email").val(data.email);
			$("#clave").val(data.clave);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src","../../files/usuarios/"+data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#iduser").val(data.iduser);


		});
	$.post("../ajax/A_usuarios.php?op=permisos&id="+iduser, function(r){
	$("#permisosusers").html(r);
});
}


//funcion para desactivar
function desactivar(iduser){
	bootbox.confirm("¿Esta seguro de desactivar este usuario?", function(result){
		if (result) {
			$.post("../ajax/A_usuarios.php?op=desactivar", {iduser : iduser}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(iduser){
	bootbox.confirm("¿Esta seguro de activar este usuario?" , function(result){
		if (result) {
			$.post("../ajax/A_usuarios.php?op=activar", {iduser : iduser}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


init();
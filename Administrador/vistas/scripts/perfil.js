var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   

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

//funcion listar

//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/perfil.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(true);
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
            $("#correo").val(data.correo);
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
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/administrador.php?op=activar", {idadmin : idadmin}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


init();
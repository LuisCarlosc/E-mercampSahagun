var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   });

   //cargamos los items al select cliente
   var idtienda = $("#idtienda").val();
   $.post("../ajax/confirmar.php?id="+idtienda, function(r){
   	$("#idtienda").html(r);
   	$('#idtienda').selectpicker('refresh');
   });

}

//funcion limpiar
function limpiar(){

	$("#id_cita").val("");
	$("#peso").val("");
	

	
	$(".filas").remove();
	$("#totales").html("0");

	//obtenemos la fecha actual
	var now = new Date();
	var day =("0"+now.getDate()).slice(-2);
	var month=("0"+(now.getMonth()+1)).slice(-2);
	var hora = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
	var today=now.getFullYear()+"-"+(month)+"-"+(day)+" "+(hora);
	$("#fechahora").val(today);



}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
	

	}else{

		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();
	
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	
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
			url:'../ajax/venta.php?op=listar',
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

function listarArticulos(){
	var idtienda = $("#idtienda").val();
	tabla=$('#tblarticulos').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [

		],
		"ajax":
		{
			url:'../ajax/tienda.php?id='+ idtienda,
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
     //$("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/venta.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos ,window.location='espera.php' );

		 }
		 
     });
	
	 limpiar();
	
}

function desactivar(){
	bootbox.confirm("¿Esta seguro de desactivar este pedido?", function(result){
		if (result) {
			$.post("../ajax/atendercita.php?op=desactivar", { }, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
function mostrar(){
	
	$.post("../ajax/informacion.php?id=4",function(r){
		$("#producto").html(r);
	});

}



//declaramos variables necesarias para trabajar con las compras y sus detalles
var impuesto=18;
var cont=0;
var detalles=0;

$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto(){
	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
	if (tipo_comprobante=='Factura') {
		$("#impuesto").val(impuesto);
	}else{
		$("#impuesto").val("0");
	}
}


function agregarDetalle(idproducto,nombre,precio){
	var cantidad=1;
	

	if (idproducto!="") {
		var subtotal=precio*cantidad;
		var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger btn-xs" onclick="eliminarDetalle('+cont+')">X</button></td>'+
        '<td><input type="hidden" name="idproducto[]" value="'+idproducto+'"> '+nombre+' <br>  <input type="number" name="cantidad[]" value="'+cantidad+'"> <input type="hidden" name="precio[]" id="precio[]" value="'+precio+'"> <strong> precio: </strong>  '+precio+'   <br>  <strong> subtotal:</strong>    <span id="subtotal'+cont+'" name="subtotal">'+subtotal+ ' </span> <button type="button" onclick="modificarSubtotales()" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i></button> </td>'+
		'</tr>';
		cont++;
		detalles++;
		$('#detalles').append(fila);
		modificarSubtotales();S

	}else{
		alert("error al ingresar el detalle, revisar las datos del articulo ");
	}
}

function modificarSubtotales(){
	var cant=document.getElementsByName("cantidad[]");
	var prev=document.getElementsByName("precio[]");
	var sub=document.getElementsByName("subtotal");


	for (var i = 0; i < cant.length; i++) {
		var inpV=cant[i];
		var inpP=prev[i];
		var inpS=sub[i];
	


		inpS.value=(inpV.value*inpP.value)
		document.getElementsByName("subtotal")[i].innerHTML=inpS.value;
	}

	calcularTotales();
}

function calcularTotales(){
	var sub = document.getElementsByName("subtotal");
	var total=0.0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#totales").html("$" + total);
	$("#total").val(total);
	evaluar();
}

function evaluar(){

	if (detalles>0) 
	{
		$("#btnGuardar").show();
	}
	else
	{
		$("#btnGuardar").hide();
		cont=0;
	}
}

function eliminarDetalle(indice){
$("#fila"+indice).remove();
calcularTotales();
detalles=detalles-1;

}

init();
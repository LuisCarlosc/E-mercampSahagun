

//funcion que se ejecuta al inicio
function init(){

$.post("../ajax/usuario.php?op=select", function(r){
	$("#idrestaurante").html(r);
	$("#idrestaurante").selectpicker('refresh');
});
}


init();
$("#formularioAcceso").on('submit', function(e)
{
    e.preventDefault();
    idtiendaa=$("#idtiendaa").val();
	logina=$("#logina").val();
	clavea=$("#clavea").val();

	$.post("../ajax/usuario.php?op=verificar",
        {"idtiendaa":idtiendaa, "logina":logina, "clavea":clavea},
        function(data)
        {
           if (data!="null")
            {
            	$(location).attr("href","escritorio.php");
            }else{
            	bootbox.alert("Usuario y/o Password incorrectos");
            }
        });
})
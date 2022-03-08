<?php
include("includes/conexion.php");
conectar();
@session_start();
?>
<!-- Bootstrap core CSS-->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<link href="vendor/datatables/jquery.dataTables.min.css" rel="stylesheet">

<link href="vendor/datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin.css" rel="stylesheet">
<link rel="stylesheet" href="select2/css/select2.min.css">
<link rel="stylesheet" href="select2/css/select2-bootstrap4.min.css">




<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datepicker/bootstrap-datepicker.min.js"></script>
<script src="vendor/datepicker/bootstrap-datepicker.es.min.js"></script>
<script src="select2/js/select2.full.min.js"></script>


<script type="text/javascript">
	function buscar_productos(codigo)	
	{
		if($("#codigo").val().length > 0)
		{
			$.get("modulos/listado_productos.php?codigo="+codigo, function(dato){
				if(dato.indexOf("Error:")==-1)
				{
					var res = dato.split("|");
					$("#fotos").html('<img src="fotos_productos/'+res[1]+'" style="height: 10em;" align="center"/>');
					$("#producto").val(res[0]);
					$(".listado").html('');
					$('#boton_agregar').attr("disabled", false);
				//cambio el foco
				$( "#cantidad" ).focus();
				//agregar_tabla();
			}
			else
			{
				$(".listado").html(dato);
				$("#producto").val('');
				$('#boton_agregar').attr("disabled", true);
			}
		});
		}
	}
	
	function agregar_tabla()
	{
	//borro msj vacio
	$('.odd').hide();
	//saco los datos del producto
	var separado=$("#producto").val().split('[');
	nombre=separado[0];
	precio=separado[1].slice(0,-1);

	console.log(separado,nombre,precio);
	//agrego el registro a la tabla
	$(".detalles").append('<tr><td>1</td><td>'+nombre+'<input type="hidden" name="nombres[]" value="'+nombre+'|'+$("#cantidad").val()+'"/></td><td>'+$("#cantidad").val()+'</td><td class="sumar">'+(precio*$("#cantidad").val())+'</td><td><span class="btn btn-secondary del">Quitar</span></td></tr>');
	//sumo el total de la compra
	sumar_columna();
}

function sumar_columna()
{
	var total=0;
	$(".sumar").each(function(){
		total+=parseFloat($(this).html()) || 0;
	});
	
	$(".totales").html('<div class="alert alert-success"><b>TOTAL: </b>$'+total+'</div>');
	//pongo el foco en codigo de producto para buscar uno nuevo
	$( "#codigo" ).val('');
	$( "#cantidad" ).val('');
	
	$( "#codigo" ).focus();
}
</script>
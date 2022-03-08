<?php
//acciones
if($_GET[finalizar]=="ok")
{
	//controlo que no este vacio
	if(!empty($_POST[nombres]))
	{
		//inserto la cabecera
		$sql=mysql_query("insert into ventas (total) values(0)");
		if(!mysql_error())
		{
			$total=0;
			$id_venta=mysql_insert_id();
			foreach($_POST[nombres] as $datos)
			{
				//saco el ID
				$datos_formulario=explode('|',$datos);
				$idp=mysql_fetch_array(mysql_query("select *from productos where titulo='".trim($datos_formulario[0])."'"));
				
				//inserto el detalle
				$suma=$datos_formulario[1]*$idp[precio];
				$sql=mysql_query("insert into detalle_ventas (id_venta, id_producto, cantidad, precio, total) values($id_venta, $idp[id], ".$datos_formulario[1].", '".$idp[precio]."', '".$suma."')");
				$sql=mysql_query("UPDATE productos SET cantidad = cantidad - ".$datos_formulario[1]." WHERE id = {$idp[id]}");
				if(mysql_error())
				{
					//error al insertar un registro
				}
				//echo "<h1>$datos</h1>";
				$total=$total+$suma;
			}
			//actualizo el total de la venta
			$sql=mysql_query("update ventas set total='".$total."' where id=".$id_venta);
			if(!mysql_error())
			{
				echo "<script>alert('Venta Finalizada');</script>";
			}
				else
				{
					echo "<script>alert('Error: no se pudo finalizar la venta');</script>";
				}
		}
			else
			{
				//erro al insertar la cabecera
				echo "<script>alert('Error: no se pudo registrar la venta');</script>";
			}
	}
}
//fin de acciones
?>
<div class="container">
  <div class="card card-register mx-auto mt-5">
	<div class="card-header">
		Ventas 
		<!--FINALIZAR VENTA-->
		<button class="btn btn-danger" type="button" style="float: right;" onClick="finalizar()">Finalizar Venta</button>
	</div>
	<div class="card-body">
	  <form>
		<div class="form-group">
		  <div class="form-row">
			<div class="col-md-6">
			  <div class="form-label-group">
				<input type="text" id="codigo" name="codigo" class="form-control" placeholder="Cod. Producto" autofocus="autofocus" onKeyUp="buscar_productos(this.value)" tabindex="1" autocomplete="off" required>
				<label for="codigo">Cod. Producto</label>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-label-group">
				<input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" tabindex="2" autocomplete="off" required>
				<label for="cantidad">Cantidad</label>
			  </div>
			</div>
		  </div>
		</div>
		<div class="form-group">
		  <div class="form-label-group">
			<input type="text" id="producto" class="form-control" placeholder="Producto" required="required" disabled value="">
			<label for="producto">Producto</label>
		  </div>
		</div>
		  
			<div class="form-group">
			  <div class="form-label-group" id="fotos" style="text-align: center;">
				
			  </div>
			</div>
		  
		<button class="btn btn-primary btn-block" type="button" tabindex="3" id="boton_agregar" onClick="agregar_tabla()">Agregar</button>
	  </form>
	  	<!--MUESTRO TOTAL-->
	  	<div class="text-center totales"></div>
	  	<!--MUESTRO ERRORES-->
		<div class="text-center listado"></div>
	</div>
  </div>
</div>

		
<div class="card mb-3">
	<div class="card-header">
	<i class="fas fa-table"></i>
	  Detalle de Venta
	</div>
	<div class="card-body">
		<form method="post" id="venta" action="index.php?pagina=ventas&finalizar=ok">
			<table id="tabla" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Item</th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody class="detalles">

			</tbody>
			</table>
			</form>
	</div>
</div>
		
	
<script type="text/javascript">
var table
$(document).ready(function(){	
	// evento para eliminar la fila
	$("#tabla").on("click", ".del", function(){
		$(this).parents("tr").remove();
		sumar_columna();
	});
	
	//Inicio la tabla
	var id_tabla=$('#tabla').DataTable({
		"searching": false,
		"paging":   false,
        "ordering": false,
        "info":     false,
		"sZeroRecords": false,
		"sEmptyTable": false,
		language: {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
	
	//id_tabla.clear().draw();
	
});
	
//manejo del enter
$(document).on('keyup', '#cantidad', function(e) {
	if($("#cantidad").val().length > 0)
	{
		 if(e.keyCode == 13 ) {
			$( "#boton_agregar" ).focus();
		 }
	}

});

function finalizar()
{
	$( "#venta" ).submit();
}
</script>

<?php
session_start();
include("../includes/conexion.php");
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.- Registro de Asistencia <?php echo date('Y');?> -.</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<style>
body{
	font-size:1em;
	background-color:#fff;
}
#listado{
	text-align:left;
}
.noimprimir{
	display:none;
}
#centro_cargos a{
	width:100%;
}
@page {
  size: Legal landscape; 
  margin: 2cm;
}

.salto_pagina{ 
  page-break-after:always;
}
	table{
		border: solid 1px #000;
		width: 100%;
		float: left;
	}
	td{
		border: solid 1px #000;
	}
</style>
</head>

<body>
<p><b>Listado de stock a la fecha del d&iacute;a <?php echo date('d-m-Y');?></b></p>
<div id="container">
	<div id="contenedor">
        <div id="contenido">
            <table width="100%" class="table table-striped table-bordered table-hover mt-2" id="tabla-reportes">
				<thead>
					<tr>
						<th>Item</th>
						<th>Código</th>
						<th>Título</th>
						<th>Descripción</th>
						<th>Cantidad</th>
						<th>Precio</th>
					</tr>
				</thead>
				<?php 

				$q = mysql_query("
					SELECT *
					FROM productos
					");

				if(mysql_num_rows($q)!=0)
				{
					$can=1;
					while($r=mysql_fetch_array($q))
					{
						?>
						<tr>
							<td><?php echo $can; ?></td>
							<td><?php echo $r[codigo]; ?></td>
							<td><?php echo $r[titulo]; ?></td>
							<td><?php echo $r[descripcion]; ?></td>
							<td><?php echo $r[cantidad]; ?></td>
							<td><?php echo '$'.number_format($r[precio],'2',',','.'); ?></td>	
						</tr>
						<?php
						$can++;
					}
				}
				?>
				<script>

					$(document).ready(function(){

						var table = $('#tabla-reportes').DataTable({
							"paging":   false,
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


					});
				</script>

			</table>
        </div>
     </div>
</div>
</body>
</html>  
<script>window.print();</script>
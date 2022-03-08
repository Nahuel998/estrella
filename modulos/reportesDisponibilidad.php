<div class="container mt-3">
	<div class="card">
		<div class="card-header">
			Disponibilidad de Productos
		</div>
		<div class="card-body">
			<table width="100%" class="table table-striped table-bordered table-hover mt-2" id="tabla-reportes">
				<thead>
					<tr>
						<th>Item</th>
						<th>Código</th>
						<th>Título</th>
						<th>Lote</th>
						<th>Vencimiento</th>
						<th>Cantidad Total</th>
						<th>Precio</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<?php

				$q = mysql_query("
					SELECT *
					FROM productos
					");

				if (mysql_num_rows($q) != 0) {
					$can = 1;

					while ($r = mysql_fetch_array($q)) {
						$f = mysql_query("
								SELECT *
								FROM entradas WHERE id_producto=$r[id] ;
								");
						$p=mysql_fetch_array($f);
				?>
						<tr>
							<td><?php echo $can; ?></td>
							<td><?php echo $r[codigo]; ?></td>
							<td><?php echo $r[titulo]; ?></td>
							<td><select class="form-control" id="">
									
									<?php
									while ($valores = mysql_fetch_array($f)) {
										echo '<option value="'.$valores[id].'">'.$valores[id].'</option>';
									}
									?>

								</select>
							</td>
							<td>
							</td>
							<td><?php echo $p[cantidad]; ?></td>
							<td><?php echo '$' . number_format($r[precio], '2', ',', '.'); ?></td>
							<td class="text-center">
								<a href="index.php?pagina=productos&id=<?php echo $r[id]; ?>&ver=ok" title="Editar"><i class="fa fa-edit"></i></a>
							</td>
						</tr>
				<?php
						$can++;
					}
				}
				?>
				<script>
					$(document).ready(function() {

						var table = $('#tabla-reportes').DataTable({
							language: {
								"sProcessing": "Procesando...",
								"sLengthMenu": "Mostrar _MENU_ registros",
								"sZeroRecords": "No se encontraron resultados",
								"sEmptyTable": "Ningún dato disponible en esta tabla",
								"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
								"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
								"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
								"sInfoPostFix": "",
								"sSearch": "Buscar:",
								"sUrl": "",
								"sInfoThousands": ",",
								"sLoadingRecords": "Cargando...",
								"oPaginate": {
									"sFirst": "Primero",
									"sLast": "Último",
									"sNext": "Siguiente",
									"sPrevious": "Anterior"
								},
								"oAria": {
									"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
									"sSortDescending": ": Activar para ordenar la columna de manera descendente"
								}
							}
						});


					});
				</script>

			</table>
			<div class="alert alert-success" role="alert">
				<p style="text-align: right;">
					<button type="button" onClick="imprimo()">Imprimir</button>
				</p>
			</div>
		</div>
		<div class="card-footer">
		</div>
	</div>
</div>
<script type="text/javascript">
	function imprimo() {
		window.open("modulos/imprimir_stock.php");
	}
</script>
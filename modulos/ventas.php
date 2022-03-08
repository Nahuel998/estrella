<?php
//acciones
if ($_GET[finalizar] == "ok") {
	//controlo que no este vacio
	if (!empty($_POST[nombres])) {
		//inserto la cabecera
		$sql = mysql_query("insert into ventas (total) values(0)");
		if (!mysql_error()) {
			$total = 0;
			$id_venta = mysql_insert_id();
			foreach ($_POST[nombres] as $datos) {
				//saco el ID
				$datos_formulario = explode('|', $datos);
				$idp = mysql_fetch_array(mysql_query("select *from productos where titulo='" . trim($datos_formulario[0]) . "'"));

				//inserto el detalle
				$suma = $datos_formulario[1] * $idp[precio];
				$sql = mysql_query("insert into detalle_ventas (id_venta, id_producto, cantidad, precio, total, met_pago) values($id_venta, $idp[id], " . $datos_formulario[1] . ", '" . $idp[precio] . "', '" . $suma . "', '" .$_POST[met_pago] . "')");
				//$sql = mysql_query("UPDATE productos SET cantidad = cantidad - " . $datos_formulario[1] . " WHERE id = {$idp[id]}" );
				$sql = mysql_query("UPDATE entradas SET cantidad = cantidad - " . $datos_formulario[1] . " WHERE id_producto = {$idp[id]} ORDER BY id ASC" );
				if (mysql_error()) {
					//error al insertar un registro
				}
				//echo "<h1>$datos</h1>";
				$total = $total + $suma;
			}
			//actualizo el total de la venta
			$sql = mysql_query("update ventas set total='" . $total . "' where id=" . $id_venta);
			//actualizo los lotes
			//$lote = mysql_fetch_array(mysql_query("select * from entradas where id_producto= {$idp[id]} order by id asc" ));

			if (!mysql_error()) {
				echo "<script>alert('Venta Finalizada');</script>";
			} else {
				echo "<script>alert('Error: no se pudo finalizar la venta');</script>";
			}
		} else {
			//erro al insertar la cabecera
			echo "<script>alert('Error: no se pudo registrar la venta');</script>";
		}
	}
}
//fin de acciones
?>
<div class="container-fluid mt-3 ">
	<div class="row">
		<div class="col" style="height: 350px;">
			<div class="card card-register mx-auto mb-3">
				<div class="card-header">
					<div class="row">
						<div class="col d-flex align-items-center justify-content-start">
							<h2>Ventas</h2>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form>
						<!--<div class="form-row">
							<div class="form-group col">
								<label for="monto">Monto $</label>
								<input type="number" id="monto" name="Monto" class="form-control" placeholder="Monto" required>
							</div>
						</div> -->
						<div class="form-row">
							<div class="form-group col">
								<label for="nombre">Nombre:</label>
								<select name="nombre" id="nombre" class="form-control" multiple="" tabindex="1" >
									<?php
									$q = mysql_query("
										SELECT id, titulo,codigo
										FROM productos 
										");

									if (mysql_num_rows($q) != 0) {
										while ($r = mysql_fetch_array($q)) {
									?>
											<option value="<?php echo $r[id] ?>"><?php echo $r[titulo] ?></option>
											<option value="<?php echo $r[id] ?>"><?php echo $r[codigo] ?></option>
									<?php
										}
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col">
								<label for="cantidad">Cantidad</label>
								<input type="number" id="cantidad" name="cantidad" class="form-control" value="1" tabindex="2" autocomplete="off" required>
							</div>
						</div>

						<div class="form-group">
							<div class="form-label-group text-center" id="fotos">

							</div>

						</div>

						<button class="btn btn-primary btn-block" type="button" tabindex="3" id="boton_agregar">Agregar</button>
					</form>
					<!--MUESTRO TOTAL-->

					<!--MUESTRO ERRORES-->
					<div class="text-center listado"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card mb-3" style="height: 465px;">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Detalle de Venta
					<div class="form-group mx-sm-3 mb-2">


						<button class="btn btn-danger mt-2" style="float:left" type="button" tabindex="5" onClick="finalizar()">Finalizar Venta</button>
					</div>

				</div>
				<div class="card-body" style="overflow-y: scroll; height: 260px;">
					<form method="post" id="venta" action="index.php?pagina=ventas&finalizar=ok">
						<select class="custom-select " name="met_pago" id="met_pago" tabindex="4" >
							<option  value="Efectivo" selected>Efectivo</option>
							<option value="Visa">Visa</option>
							<option value="Maestro">Maestro</option>
							<option value="Mercado Pago">Mercado Pago</option>
						</select>
						<table id="tabla" class=" display" style="width:100%">
							<thead>
								<tr>
									<th>Item</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody class=" detalles ">

							</tbody>
						</table>
					</form>

				</div>
				<div class="text-center totales" style="margin: 0;"></div>
			</div>


		</div>
	</div>
</div>


<script type="text/javascript">
	var table;
	var producto;
	var contador = 0;

	$(document).ready(function() {
		

		$('#nombre').select2({
			theme: "bootstrap4",
			placeholder: "Escriba o Seleccione un producto",
			maximumSelectionLength: 1
		});

		$("#tabla").on("click", ".del", function() {
			$(this).parents("tr").remove();
			contador=contador-1;
			sumar_columna();
		});

		var id_tabla = $('#tabla').DataTable({

			"searching": false,
			"paging": false,
			"ordering": false,
			"info": false,
			"sZeroRecords": false,
			"sEmptyTable": false,
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

		$('#nombre').change(function() {
			
			$.ajax({
				method: 'GET',
				url: 'modulos/controladorProductos.php',
				data: {
					requerimientos: 'getProducto',
					id_producto: $('#nombre').val()[0]
				},
				statusCode: {
					200: function(data) {
						data = $.parseJSON(data);
						producto = data;
						imagen = data.foto;
						//$('#fotos').html("<img src='fotos_productos/20210921013841.jpg' class='img-thumbnail'  style='max-height:200; max-width:200;'/>");
						$('#cantidad').focus().select();
					}
				}
			});
		});

		

		/*$('#boton_agregar').click(function() {
			$("#nombre").focus();
			nombre_producto = $("#nombre").val();
			monto = $("#monto").val();
			if (nombre_producto == "" && monto !== "") {

				$(".detalles").append('<tr><td>1</td><td>Varios</td><td>1</td><td class="sumar">' + monto + '</td><td><span class="btn btn-secondary del">Quitar</span></td></tr>');
				var total = 0;
				$(".sumar").each(function() {
					total += parseFloat($(this).html()) || 0;
				});

				$(".totales").html('<div class="alert alert-success"><b>Bultos: </b>' + contador + '<h3><b>TOTAL: </b>' + total + '</h3></div>');
				$("#monto").val('');

				contador++;
			}
		});*/


		$('#boton_agregar').click(function() {
			$('.odd').hide();
			nombre = producto.titulo;
			precio = producto.precio;


			if ($("#cantidad").val() != 0) {

				$(".detalles").append('<tr><td>' + producto.id + '</td><td>' + nombre + '<input type="hidden" name="nombres[]" value="' + nombre + '|' + $("#cantidad").val() + '"/></td><td>' + $("#cantidad").val() + '</td><td class="sumar">' + (precio * $("#cantidad").val()) + '</td><td><span class="btn btn-secondary del">Quitar</span></td></tr>');
				contador++;

			}


			var total = 0;
			$(".sumar").each(function() {
				total += parseFloat($(this).html()) || 0;
			});

			$(".totales").html('<div class="alert alert-success"><b>Bultos: </b>' + contador + '<h3><b>TOTAL: </b>$' + total + '</h3></div>');

			$('#nombre').val(null).trigger('change').focus();
			
			$("#cantidad").val('1');
			

			//$("#nombre").focus();



		});





	});






	function finalizar() {
		$("#venta").submit();
		
	}
</script>
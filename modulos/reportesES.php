<div class="container">
	<div class="card">
		<div class="card-header">
			Ventas
			<?php
			if(empty($_POST[fechahasta]))
				{
					?>
					 del d&iacute;a
					<?php
					$q = mysql_query("
						SELECT d.id, d.id_venta, d.id_producto, p.titulo, d.cantidad, d.total, codigo, fecha, met_pago
						FROM detalle_ventas d 
						JOIN ventas v ON (v.id = d.id_venta)
						JOIN productos p ON (p.id = d.id_producto)
						where date_format(v.fecha,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d')
						");
					
				}
					else
					{
						?>
						 por rango de fechas: <strong><?php echo $_POST[fechadesde].' hasta '.$_POST[fechahasta];?></strong>
						<?php
						$fd=str_replace('/','-',$_POST[fechadesde]);
						$fh=str_replace('/','-',$_POST[fechahasta]);
						
						$q = mysql_query("
						SELECT d.id, d.id_venta, d.id_producto, p.titulo, d.cantidad, d.total, codigo, fecha, met_pago
						FROM detalle_ventas d 
						JOIN ventas v ON (v.id = d.id_venta)
						JOIN productos p ON (p.id = d.id_producto)
						where date_format(v.fecha, '%Y-%m-%d') between date_format('".str_replace('/','-',date("Y-m-d", strtotime($fd)))."', '%Y-%m-%d') and date_format('".str_replace('/','-',date("Y-m-d", strtotime($fh)))."', '%Y-%m-%d')");
					}
			?>
		</div>
		<div class="card-body">
			<form action="index.php?pagina=reportesES" method="post">
				<div class="row">
					<div class="input-group mb-2 col-sm">
						<div class="input-group-prepend">
							<label for="fechadesde" class="input-group-text">Fecha Desde</label>
						</div>
						<input class="form-control datepicker" type="text" class="form-control" id="fechadesde" name="fechadesde" required>
					</div>

					<div class="input-group mb-2 col-sm">
						<div class="input-group-prepend">
							<label for="fechahasta" class="input-group-text">Fecha Hasta</label>
						</div>
						<input class="form-control datepicker" type="text" class="form-control" id="fechahasta" name="fechahasta" required>
					</div>
					<button type="submit" class="btn btn-primary btn-block" style="margin-bottom: 2%;">Consultar</button>
				</div>
			</form>
			<script type="text/javascript">
				$('.datepicker').datepicker({
					autoclose: true,
					format: 'dd/mm/yyyy',
					language: 'es'
				});

				function generar(){
					$.ajax({
						method: 'GET',
						url: 'controlarReportes.php',
						data: {
							requerimiento: 'getByDate',
							tipo: $('#inputGroupSelect01').val(),
							fechadesde: $('#fechadesde').val(),
							fechahasta: $('#fechahasta').val()
						}
					});
				}
			</script>

			<table width="100%" class="table table-striped table-bordered table-hover mt-2" id="tabla-reportes">
				<thead>
					<tr>
						<th>Item</th>
						<th>Fecha</th>
						<th>Titulo</th>
						<th>Cantidad</th>
						<th>Total</th>
						<th>Metodo de pago</th>
					</tr>
				</thead>
				<?php 
				if(mysql_num_rows($q)!=0)
				{	
					$suma_efectivo=0;
					$suma_MP=0;
					$suma_visa=0;
					$suma_master=0;
					$can=1;
					$suma_total=0;
					while($r=mysql_fetch_array($q))
					{
						?>
						<tr>
							<td><?php echo $can; ?></td>
							<td><?php date_default_timezone_set('America/Los_Angeles');
							echo date("d/m/y G:i", strtotime($r[fecha])); ?></td>
							<td><?php echo $r[titulo]; ?></td>
							<td><?php echo $r[cantidad]; ?></td>
							<td><?php echo '$'.number_format($r[total],'2',',','.'); ?></td>
							<td><?php echo $r[met_pago]; ?></td>
						</tr>
						<?php
						
						if($r[8]=="Efectivo"){
							$suma_efectivo=$suma_efectivo+$r[total];

						}else if($r[8]=="Visa"){
							$suma_visa=$suma_visa+$r[total];

						}else if($r[met_pago]=="Mercado Pago"){
							$suma_MP=$suma_MP+$r[total];

						}else if($r[8]=="Maestro"){
							$suma_master=$suma_master+$r[total];

						}
						
						$suma_total=$suma_total+$r[total];
						$can++;
					}
				}
				?>
				<script>


					$(document).ready(function(){
						$.fn.dataTable.ext.search.push(
							function (settings, data, dataIndex) {

								var min = $('#fechadesde').datepicker("getDate");
								var max = $('#fechahasta').datepicker("getDate");
								
								datesplit = data[1].split('/');
								var checkDate = new Date("20"+datesplit[2]+"/"+datesplit[1]+"/"+datesplit[0]+"/");

								var rtn = false;     
								if (min == null && max == null) { rtn = true; }
								else if (min == null && checkDate <= max) { rtn = true;}
								else if(max == null && checkDate >= min) {rtn = true;}
								else if (checkDate <= max && checkDate >= min) { rtn = true; }

								return rtn;
							}
							);

						var table = $('#tabla-reportes').DataTable({
							"paging":   true,
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

						$("#fechadesde").datepicker({ onSelect: function () { table.draw(); } });
						$("#fechahasta").datepicker({ onSelect: function () { table.draw(); } });
						$('#fechadesde').change( function() { table.draw(); });
						$('#fechahasta').change( function() { table.draw(); });

					});
				</script>

			</table>
			<div class="alert alert-success" role="alert">
			 <p style="text-align: right;">
				
				<span id="totales">EFECTIVO: <strong><?php echo '$'.number_format($suma_efectivo,'2',',','.'); ?></strong></span><br>
				<span id="totales">VISA: <strong><?php echo '$'.number_format($suma_visa,'2',',','.'); ?></strong></span><br>
				<span id="totales">MAESTRO: <strong><?php echo '$'.number_format($suma_master,'2',',','.');?></strong></span><br>
				<span id="totales">MERCADO PAGO: <strong><?php echo '$'.number_format($suma_MP,'2',',','.');?></strong></span><br>
				<span id="totales">TOTAL DE VENTAS: <strong><?php echo '$'.number_format($suma_total,'2',',','.');?></strong></span><br>
				<button type="button" onClick="imprimo()">Imprimir</button>
			</p>
			</div>
		</div>
		<div class="card-footer">
		</div>
	</div>	
</div>
<script type="text/javascript">
function imprimo()
	{
		var n=$("#tabla-reportes").html()+$("#totales").html();
		//alert(n);
		/////var det=$("#det").html();
		/////var nuevo=$("#nuevonuevo").html()+' | '+$("#nuevonuevo2").html();
		$.post("modulos/imprimir.php?cargar=ok",{valor:n}, function(dato){ window.open("modulos/imprimir.php"); });
	}
</script>
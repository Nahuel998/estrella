

<div class="container">
	<div class="card card-register mx-auto mt-3">
		<div class="card-header">
			<h2>Entradas</h2> 
		</div>
		<div class="card-body">
			<form>
				<div class="form-row">
					<div class="form-group col">
						<label for="nombre">Nombre:</label>
						<select name="nombre" id="nombre" class="form-control" multiple="" tabindex="1">
							<?php 
							$q = mysql_query("
								SELECT id, titulo, codigo
								FROM productos 
								");

							if(mysql_num_rows($q)!=0) {
								while($r=mysql_fetch_array($q)){
									?>
									<option value="<?php echo $r[id]?>"><?php echo $r[titulo]?></option>
									<option value="<?php echo $r[id]?>"><?php echo $r[codigo]?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">
						<label for="obs">Fecha de Vencimiento:</label>
						<input  class="form-control "  type="date"  tabindex="2" placeholder="Fecha de vencimiento" id="ven">
					</div>
					<!-- <div class="form-group col">
						<label for="obs">Lote:</label>
						<select class="form-control" id="exampleFormControlSelect1">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div> -->
				</div>

				<div class="form-row">
					<div class="form-group col">
						<label for="cantidad">Cantidad</label>
						<input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" required value="1" tabindex="2">
					</div>
				</div>
				
				<div class="form-group">
					<div id="fotos" class="text-center">
					</div>
				</div>

				<button class="btn btn-primary btn-block" type="button" tabindex="3" id="boton_agregar" tabindex="3">Agregar</button>
			</form>
		</div>
	</div>
	<div id="div-tabla-guardado" class="collapse mb-3">
		<p>Agregados Recientemente</p>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Producto</th>
					<th scope="col">Cantidad</th>
				</tr>
			</thead>
			<tbody id="body-table">

			</tbody>
		</table>		
	</div>
</div>

<script type="text/javascript">

	var id_producto

	$(document).ready(function(){	

		$('#nombre').select2({
			theme: "bootstrap4",
			placeholder: "Escriba o Seleccione un producto"
		}).focus();


		$('#nombre').change(function(){
			$.ajax({
				method: 'GET',
				url: 'modulos/controladorProductos.php',
				data: {
					requerimientos: 'getImagen',
					id_producto: $('#nombre').val()[0]
				},
				statusCode: {
					200: function(data){
						nombre=data.nombre;
						$('#fotos').html("<img src='fotos_productos/" + data + "' class='img-thumbnail'  style='max-height:200; max-width:200;'/>");
						$('#cantidad').focus().select();
					}
				}
			});
		});

		$('#boton_agregar').click(function(){
			console.log($('#nombre').select2('data')[0].text);
			console.log($('#ven').val());
			$.ajax({
				method: 'POST',
				url: 'modulos/controladorProductos.php',
				data: {
					requerimientos: 'addCantidad',
					cantidad: $('#cantidad').val(),
					id_producto: $('#nombre').val()[0],
					fecha:$('#ven').val(),
				},
				statusCode: {
					200: function(data){
						$('#div-tabla-guardado').show();
						$('#body-table').prepend('<tr><th>'+ $('#nombre').select2('data')[0].text +'</th><th>'+ $('#cantidad').val() +'</th></tr>');

					}
				}
			});
		});

	});
	
</script>

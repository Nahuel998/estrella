<?php

if ($_GET[add] == "ok") {

	if ($_POST[titulo] != "") {
		//controlo si tiene foto
		if ($_FILES['archivo']['name'] != "") {
			$archivo = $_FILES['archivo']['name'];
			$extension = explode(".", $archivo);
			$can = count($extension);
			$final = $can - 1;
			//subo la imagen
			if (($extension[$final] == "jpg") || ($extension[$final] == "jpeg") || ($extension[$final] == "png") || ($extension[$final] == "JPG")) {
				if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
					//saco el nombre de la fotito
					$img = date('Ymdhis') . "." . $extension[$final];
					copy($_FILES['archivo']['tmp_name'], "fotos_productos/" . $img);
				}
			}
		}
		//fin de controlar si tiene foto

		$sql = mysql_query("insert into productos (titulo, precio, codigo, foto) values('$_POST[titulo]', '$_POST[precio]', '$_POST[codigo]', '" . $img . "')");
		if (!mysql_error()) {
			echo "<script>alert('Registro Insertado Correctamente.'+ '$_POST[codigo]');</script>";
			echo "<script>window.location='index.php?pagina=productos';</script>";
		} else {
			echo "<script>alert('Error: No se pudo insertar el registro.');</script>";
		}
	} else {
		echo "<script>alert('Complete los Campos Obligatorios (*).');</script>";
	}
}

if ($_GET[mod] == "ok") {

	if ($_POST[titulo] != "") {
		//controlo si tiene foto
		if ($_FILES['archivo']['name'] != "") {
			$archivo = $_FILES['archivo']['name'];
			$extension = explode(".", $archivo);
			$can = count($extension);
			$final = $can - 1;
			//subo la imagen
			if (($extension[$final] == "jpg") || ($extension[$final] == "jpeg") || ($extension[$final] == "png") || ($extension[$final] == "JPG")) {
				if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
					//saco el nombre de la fotito
					$img = date('Ymdhis') . "." . $extension[$final];
					$nuevo = ", foto='" . $img . "'";
					copy($_FILES['archivo']['tmp_name'], "fotos_productos/" . $img);
				}
			}
		}
		//fin de controlar si tiene foto

		$sql = mysql_query("update productos set titulo='$_POST[titulo]', vencimiento='$_POST[obs]', cantidad=$_POST[cantidad], precio='$_POST[precio]', codigo='$_POST[codigo]'$nuevo where id=$_POST[id]");
		if (!mysql_error()) {
			echo "<script>alert('Registro Modificado Correctamente.');</script>";
		} else {
			echo "<script>alert('Error: No se pudo Modificar el registro.');</script>";
		}
	} else {
		echo "<script>alert('Complete los Campos Obligatorios (*).');</script>";
	}
	echo "<script>window.location='index.php?pagina=productos';</script>";
}

if ($_GET[del] != "") {

	$sql = mysql_query("delete from productos where id=$_GET[id]");

	if (!mysql_error()) {
		echo "<script>alert('Registro Eliminado Correctamente.');</script>";
	} else {
		echo "<script>alert('Error: No se pudo Eliminar el registro.');</script>";
	}
	echo "<script>window.location='index.php?pagina=productos';</script>";
}

?>

<div class="container mt-3">
	<div class="card card-register mx-auto mb-3">
		<div class="card-header">
			<h2>Alta de Productos</h2>
		</div>
		<div class="card-body">
			<?php if ($_GET[ver] == "ok") {
				$action = "index.php?pagina=productos&mod=ok";
				$rs = mysql_fetch_array(mysql_query("select * from productos where id=" . $_GET[id]));
			} else {
				$action = "index.php?pagina=productos&add=ok";
			}
			?>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" id="id" name="id" value="<?php echo $rs[id]; ?>" />

				<div class="form-row">
					<div class="form-group col">
						<label for="titulo">Título:</label>
						<input type="text" id="titulo" name="titulo" class="form-control" placeholder="Titulo" autocomplete="false" autofocus="autofocus" required="required" tabindex="1" value="<?php echo $rs[titulo]; ?>">
					</div>
				</div>

				<!--<div class="form-row">
					<div class="form-group col">
						<label for="obs">Fecha de Vencimiento:</label>
						<input type="date" id="obs" class="form-control " tabindex="2" placeholder="Fecha de vencimiento" name="obs" <?php echo $rs[vencimiento]; ?>>
					</div>
					<div class="form-group col">
						<label for="">Lote:</label>
						<select class="form-control" id="exampleFormControlSelect1">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
				</div> -->

				<div class="form-row">
					<!--<div class="form-group col">
						<label for="cantidad">Cantidad:</label>
						<input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad" required="required" tabindex="3" value="<?php echo $rs[cantidad]; ?>">
					</div>-->
					<div class="form-group col">
						<label for="precio">Precio:</label>
						<input type="number" id="precio" name="precio" class="form-control" placeholder="Precio" required="required" step="0.01" tabindex="2" value="<?php echo $rs[precio]; ?>">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col">
						<label for="codigo">Código de Barras:</label>
						<input type="number" id="codigo" name="codigo" class="form-control" placeholder="Código de Barra" tabindex="3" value="<?php echo $rs[codigo]; ?>">
					</div>
				</div>

				<div class="form-group">
					<div class="form-label-group">
						<input type="file" id="archivo" name="archivo" class="form-control">
						<label for="foto">Foto</label>
						<?php if ($rs[foto] != "") { ?>
							<div class="text-center mt-2">
								<img src="fotos_productos/<?php echo $rs[foto]; ?>" width="20%" style="text-align:center;">
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="alert alert-danger" style="display:none;"></div>
				<button type="submit" tabindex="4" class="btn btn-primary btn-block">Aceptar</button>
			</form>
			<!-- <div class="text-center">
            <a class="d-block small mt-3" href="login.html">Login Page</a>
            <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>-->
		</div>
	</div>

</div>
<div class="container">
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Listado de Productos
		</div>
		<div class="card-body">
			<table id="example" class="display" style="width:100%">
				<thead>
					<tr>
						<th>Item</th>
						<th>Codigo</th>
						<th>Titulo</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php $q = mysql_query("select * from productos");
					if (mysql_num_rows($q) != 0) {
						$can = 1;
						while ($r = mysql_fetch_array($q)) {
					?>
							<tr>
								<td><?php echo $can; ?></td>
								<td><?php echo $r[codigo]; ?></td>
								<td><?php echo $r[titulo]; ?></td>
								<td><?php echo $r[cantidad]; ?></td>
								<td><?php echo "$" . $r[precio]; ?></td>
								<td>
									<a href="index.php?pagina=productos&id=<?php echo $r[id]; ?>&ver=ok" title="Editar"><i class="fa fa-edit"></i></a>
									<a href="javascript:if(confirm('Esta Seguro?')){ window.location='index.php?pagina=productos&id=<?php echo $r[id]; ?>&del=ok'; }" title="Eliminar"><i class="fa fa-eraser"></i></a>
								</td>
							</tr>
					<?php
							$can++;
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$("#codigo")
			.keyup(function() {
				var n = $("#codigo").val();

				$.get("modulos/buscar_codigo.php?bus=ok&valor=" + n, function(dato) {
					if ($.trim(dato) == "existe") {
						$(".alert-danger").show().text("El Codigo ya existe");
						$(".btn-block").attr("disabled", true);
					} else {
						$(".alert-danger").hide();
						$(".btn-block").attr("disabled", false);
					}
				});
			});

		$('.datepicker').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy',
			language: 'es'
		});


		$('#example').DataTable({
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
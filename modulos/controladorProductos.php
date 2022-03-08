<?php 

include("../includes/conexion.php");
conectar();
//@session_start();

if ($_POST) {
	switch ($_POST['requerimientos']) {

		case 'addCantidad':
			$f=$_POST['fecha'];
		$sql=mysql_query("INSERT INTO entradas (id_producto, fecha ,cantidad) VALUES ({$_POST['id_producto']},'$f',{$_POST['cantidad']})");
		if ($sql) {
			$sql = mysql_query("UPDATE productos SET cantidad = cantidad + {$_POST['cantidad']} WHERE id = {$_POST['id_producto']}");
			if ($sql) {
				echo 'Datos Guardados Correctamente';
				http_response_code(200);
			} else {
				echo 'Error al intentar guardar los datos';
				http_response_code(500);	
			}
		} else {
			echo 'Error al intentar guardar los datos';
			http_response_code(500);
		}

		break;

		default:
			# code...
		break;
	}
}

if($_GET) {
	switch ($_GET['requerimientos']) {
		case 'getCantidad':
		$sql = mysql_query("SELECT * from productos WHERE codigo = {$_GET[codigo]}");
		if ($sql){
			$rta = mysql_fetch_assoc($sql);
			echo json_encode($rta);
			http_response_code(200);
		} else {
			echo 'Error al intentar obtener los datos';
			http_response_code(500);
		}
		break;
		
		case 'getImagen':
		$sql = mysql_query("SELECT foto FROM productos WHERE id = {$_GET[id_producto]} ");
		if ($sql){
			$rta = mysql_fetch_assoc($sql);
			echo $rta[foto];
			http_response_code(200);
		} else {
			echo 'Error al intentar obtener los datos';
			http_response_code(500);
		}

		break;

		case 'getProducto':
		$sql = mysql_query("SELECT * FROM productos WHERE id = {$_GET[id_producto]} ");
		if ($sql){
			$rta = mysql_fetch_assoc($sql);
			echo json_encode($rta);
			http_response_code(200);
		} else {
			http_response_code(204);
		}
		break;

		default:
			# code...
		break;
	}
}
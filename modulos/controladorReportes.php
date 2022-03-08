<?php

include("./includes/conexion.php");
conectar();

switch ($_GET['requerimiento']) {
	case 'getByDate':
	$sql = "SELECT * FROM detalle_ventas d JOIN ventas v ON v.id = d.id_venta";
	if ($_GET["fechadesde"]) {
		$sql += "WHERE fecha BETWEEN '{$_GET['fechadesde']}' AND '{$_GET['fechahasta']}' ");
} else {
	$sql += "WHERE fecha <= '$_GET['fechahasta']' ";
}

$q = mysql_query($sql);
		# code...
}
break;

default:
		# code...
break;
}




?>
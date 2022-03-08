<?php
session_start();
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
<div id="container">
	<div id="contenedor">
        <div id="contenido">
            <?php		
			if($_GET[cargar]!="")
			{ 
				$_SESSION[html]='<table>'.$_POST[valor].'</table>';

			}
				else{
					echo $_SESSION[html];
				}
				
				echo "<p>".@date('d/m/Y, H:i')."hs.</p>";	
        	?>
        </div>
     </div>
</div>
</body>
</html>  
<script>window.print();</script>
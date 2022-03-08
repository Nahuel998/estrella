<?php
include("../includes/conexion.php");
conectar();

if($_GET[bus]=="ok")
{
	if(!empty($_GET[valor]))
	{
		$q=mysql_query("select * from productos where codigo='".$_GET[valor]."'");
		if(mysql_num_rows($q)!=0)
		{
			echo "existe";
		}
		else
		{
			echo "no";
		}
	}
}
?>
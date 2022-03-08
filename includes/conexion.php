<?php
function conectar()
{
	global $con;
	$ret = false;
		$con = mysql_connect("localhost","root","rootroot");
		if ($con != false)
		{
				mysql_select_db("estrella",$con);
				$ret = true;
		}
			else
			{
				echo "ERROR TODO VA A EXPLOTAR";
			}
		
	return $ret;
}

function desconectar()
{
	global $con;
	mysql_close($con);
}

?>
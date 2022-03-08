<?php
if(!empty($_GET[codigo]))
{
	include("../includes/conexion.php");
	conectar();

	$sql=mysql_query("select *from productos where codigo='".$_GET[codigo]."'");
	if(mysql_num_rows($sql)!=0)
	{
		$r=mysql_fetch_array($sql);
		echo $r[titulo]." [".$r[precio]."]|".$r[foto];
	}
		else
		{
			?>
			<div class="alert alert-danger"><b>Error: </b>No existe el producto.</div>
			<?php
		}
}	
?>
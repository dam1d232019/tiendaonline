<?php include ("../config/config.php"); ?>
<?php 
 session_start();
 $suma=0;
 if(isset($_GET['p'])){

 $_SESSION['producto'][$_SESSION['contador']]=$_GET['p'];
 $_SESSION['unidades'][$_SESSION['contador']]=$_GET['cant'];
 $_SESSION['contador']++;
 }

for($i=0;$i<($_SESSION['contador']);$i++)
{
	$consulta=$conn->Execute("SELECT *FROM productos WHERE id=".$_SESSION['producto'][$i]."");
		while(!$consulta->EOF)
		{
			echo("<table class='table'>");
			echo "<tr><td>". $_SESSION['unidades'][$i]."</td><td>".$consulta->fields['nombre']."</td><td>". ($_SESSION['unidades'][$i]*$consulta->fields['precio'])."</td></tr>";
			$suma+=$consulta->fields['precio'] *  $_SESSION['unidades'][$i];
			$consulta->moveNext();
		}
}
echo("<tr class='success'><td></td><td>Subtotal:</td><td>".$suma."</tr>");
echo("</table>");
?>
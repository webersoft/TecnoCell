<?php

require 'config.php';

$orden = $_POST['id'];
$letra = substr($orden,0,1);
$num = substr($orden,1);

if($_POST['respuesta'] == "si") {
  mysqli_query($conexion, "UPDATE nuevaorden
                        SET confirmado=1
                      WHERE letra='$letra' AND orden='$num'");
} else {
  mysqli_query($conexion, "UPDATE nuevaorden
                        SET confirmado=2
                      WHERE letra='$letra' AND orden='$num'");
}

$destinatario = "info@tecnocell.com.ar";
$headers ="From:tecnocell <info@tecnocell.com.ar>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$asunto = "Confirmacion de presupuesto orden Nº$_POST[id]";

$mensaje = "<html><body>";
$mensaje .= "<h1>Confirmacion de presupuesto en Tecnocell</h1>";
$mensaje .= "<p>http://www.tecnocell.com.ar/app/search.php?id=$_POST[id]</p>";
$asunto = "Confirmacion de presupuesto orden Nº$_POST[id]";

$mensaje = "<html><body>";
$mensaje .= "<h1>Confirmacion de presupuesto en Tecnocell</h1>";
$mensaje .= "<p>http://www.tecnocell.com.ar/app/search.php?id=$_POST[id]</p>";
$mensaje .="</body></html>";

mail($destinatario,$asunto,$mensaje,$headers);



 ?>

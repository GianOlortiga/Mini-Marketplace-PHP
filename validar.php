<?php
include("resource/conexion.php");
session_start(); 
$hdn_verificar = intval($_GET['ck']);
$codigo = intval($_GET['ck']);
if(empty($codigo) || !isset($codigo)){
	
    header("Location:./index.php");
}else{

$c = mysql_query("SELECT * FROM anuncios WHERE codigo = $codigo");
$cr = mysql_fetch_array($c);

$data_key = substr(md5(microtime()), 1, 32); 
$email = $cr['correo'];
$headers = "De: gocomputersystem@gmail.com";
$asunto = "VENDELO EN EL VALLE: Tu anuncio ya se encuentra publicado";
$mensaje = 
"Gracias por usar la plataforma VENDELO EN EL VALLE, Tú anuncio se ha publicado. Ahora los compradores pueden ver tu anuncio en internet. En caso desees Editar/Eliminar tú anuncio copia o pega, o da click en este enlace: ".$sitio_web."/producto-editar.php?ck=".$codigo."&key".$data_key;

if(@mail($email,$asunto,$mensaje,$headers)){
  	$_SESSION['sms'] = "Su anuncio se ha <b>activado</b> con éxito. En esta página puede editar/eliminar su anuncio.";
  	$_SESSION['sms-type'] = "info";
  	mysql_query("UPDATE anuncios SET estado=1 WHERE codigo=$codigo");
  	header("Location: ./producto-editar.php?id=$id&re=1&ck=$hdn_verificar&k=$data_key");
}else{
	$_SESSION['sms'] = "El anuncio se ha <b>activado</b> con éxito. Pero no se envío el email";
	$_SESSION['sms-type'] = "info";
	mysql_query("UPDATE anuncios SET estado=1 WHERE codigo=$codigo");
  	header("Location: ./producto-editar.php?id=$id&re=1&ck=$hdn_verificar&k=$data_key");
} 
}
?>
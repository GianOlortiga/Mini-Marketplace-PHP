<?php 
/*
Autor: Gian Olórtiga
Proyecto: Mini Marketplace de Compra y Venta
Versión: 1.0
Compatible: PHP Versión 5,7,8
*/

$servidor="localhost";
$user="root";
$password="";
$db="vendelovalle";

$mysqli=mysqli_connect($servidor,$user,$password,$db);

//Importante colocar el dominio del sitio web ya que se sincroniza con varias acciones de la web
$sitio_web="http://localhost/vendelovalle";

if (mysqli_connect_errno($mysqli)){
	echo "Error al conectar:".mysqli_connect_error();
}

//Simplificamos los métodos mysqli
function listar($mysqli, $tabla){
    $q = "SELECT * FROM ".$tabla;
    return mysqli_query($mysqli, $q);
}
function filas($q){
    return mysqli_num_rows($q);
}
function q($mysqli, $q){
    return mysqli_query($mysqli, $q);
}
function filtrar($mysqli, $input){
    return mysqli_real_escape_string($mysqli,$input);
}
function datos($q){
    return mysqli_fetch_array($q);
}
function cerrar($mysqli){
    return mysqli_close($mysqli);
}


//Funciones para optimización de imagenes
function optimizar_imagen($rtOriginal, $max_ancho, $max_alto, $destino, $nombre_final) {

	//Redimensionar

	$original = imagecreatefromjpeg($rtOriginal);

	list($ancho,$alto)=getimagesize($rtOriginal);

	$x_ratio = $max_ancho / $ancho;
	$y_ratio = $max_alto / $alto;


	if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
		$ancho_final = $ancho;
		$alto_final = $alto;

	}elseif (($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;

	}else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}

	$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

	imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

	imagedestroy($original);

	imagejpeg($lienzo,$destino.$nombre_final);

	return true; 
}

//Subimos la imagen con menos calidad
function optimizar_imagen_min($origen, $destino, $nombre_final) {

      $imagen = imagecreatefromjpeg($origen);

      $calidad = 85;

	  imagejpeg($imagen, $destino.$nombre_final , $calidad);
	  
	  return true; 
}
?>
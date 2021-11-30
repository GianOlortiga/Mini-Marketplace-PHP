<?php
include("../resource/conexion.php"); 

//Datos hidden que se envian con el código del anuncio
$delete_hdn=intval($_POST['delete_hdn']);
$codigo=intval($_POST['codigo_hdn']);
$hdn_verificar=$codigo-2368;
$id=intval($_POST['cid']);

//Validamos código
if($delete_hdn!=$hdn_verificar){
	$_SESSION['sms'] = "Hubo un problema al <b>eliminar</b> el anuncio. Porfavor intente nuevamente.";
	$_SESSION['sms-type'] = "danger";
	header("Location: ../producto-editar.php?id=$id&re=error");
}else{

	//Seleccionamos el anuncio
	$anuncio = q($mysqli,"SELECT * FROM anuncios WHERE codigo=$codigo");
	$reg = datos($anuncio);
	$imagen1 = $reg['imagen1'];
	$imagen2 = $reg['imagen2'];
	$imagen3 = $reg['imagen3'];
	$rutaimg1 = "../img/anuncios/$imagen1";
	$rutaimg2 = "../img/anuncios/$imagen2";
	$rutaimg3 = "../img/anuncios/$imagen3";

	//Validamos las imagenes para eliminarlas
	if($imagen1!='generica.jpg'){
		if(file_exists($rutaimg1)){
			unlink($rutaimg1);
		}
	}
	if(file_exists($rutaimg2)){
		unlink($rutaimg2);
	}
	if(file_exists($rutaimg3)){
		unlink($rutaimg3);
	}

	//Eliminamos el anuncio
	q($mysqli,"DELETE FROM anuncios WHERE codigo=$codigo");

	$_SESSION['sms'] = "El producto se ha <b>eliminado</b> con éxito.";
	$_SESSION['sms-type'] = "info";
	header("Location: ../index.php");
}
?>
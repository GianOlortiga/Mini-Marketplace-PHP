<?php
session_start();
include("../resource/conexion.php");

//Datos del producto
$categoriahija = intval($_POST['categoriahija']);
$nombre = filtrar($mysqli,$_POST['nombre']);
$descripcion = filtrar($mysqli,$_POST['descripcion']);
$precio = filtrar($mysqli,$_POST['precio']);
$precioOferta = filtrar($mysqli,$_POST['precio-oferta']);
$distrito = filtrar($mysqli,$_POST['distrito']);

//Datos de contacto, Evitamos que la persona deje nombre y solo dejarán correo y whatsapp
$name = filtrar($mysqli,$_POST['name']);
$correo = filtrar($mysqli,$_POST['correo']);
$telefono = filtrar($mysqli,$_POST['telefono']);


//Seleccionamos la categoría hija para grabar en campo oculto para SEO
$cat = q($mysqli,"SELECT * FROM categoria_hija WHERE id_cathija = '$categoriahija'");
$dcat = datos($cat);
$name_cat = $dcat['nombre'];

$categoria_hdn = "anuncios, productos ".$name_cat." en ".$distrito.", ".$name_cat." ".$distrito.", ".$name_cat.", ".$keywords;

$codigo=intval($_POST['codigo']);
$id=intval($_POST['cid']);

$hdn_verificar=$codigo+1234;

$tamañoimg1 = $_FILES['img_anuncio_fls']['size'];
$tamañoimg2 = $_FILES['img_anuncio2_fls']['size'];
$tamañoimg3 = $_FILES['img_anuncio3_fls']['size'];


$medidasimagen1= getimagesize($_FILES['img_anuncio_fls']['tmp_name']);
$medidasimagen2= getimagesize($_FILES['img_anuncio2_fls']['tmp_name']);
$medidasimagen3= getimagesize($_FILES['img_anuncio3_fls']['tmp_name']);

//Parámetros optimización, resolución máxima permitida
$max_ancho = 520;
$max_alto = 600;

$ruta = "../img/anuncios/";

//obtenemos los datos del anuncio segun el código
$verificar=q($mysqli,"SELECT * FROM anuncios WHERE codigo=$hdn_verificar");
$num_reg=filas($verificar);
$reg_v=datos($verificar);


//Validamos campos vacios
if (empty($categoriahija) || empty($nombre) || empty($name) || empty($correo) || empty($distrito) || empty($descripcion) || empty($user) || empty($precio)){
	
	$_SESSION['sms'] = "<b>Error:</b> Debe completar todo los campos requeridos. Porfavor intente nuevamente.";
	$_SESSION['sms-type'] = "danger";
	header("Location: ../producto-editar.php?ck=$hdn_verificar&re=empty");

}else{

	//Validamos si campo imagen 1 está vacio
	//Si no está vacio quiere decir que trae imagen y debemos actualizar
	if (!empty($_FILES['img_anuncio_fls']['tmp_name'])){

		$d_img=$reg_v['imagen1'];
		$eliminar="../img/anuncios/$d_img";

		if(file_exists($eliminar)){
			unlink($eliminar);
			q($mysqli,"UPDATE anuncios SET imagen1='' WHERE codigo=$hdn_verificar");
		}

		//Validamos peso
		if ($tamañoimg1>10485760){
			$_SESSION['sms'] = "Error: La imagen excede el tamaño maximo permitido de 10mb. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=maxsize");
		}

		//Validamos tipo
		if ($_FILES["img_anuncio_fls"]["type"] =="image/jpeg"){

			$imagen1 = time()."-1.jpg";

		}else{
			$_SESSION['sms'] = "Error: La imagen debe ser de formato JPG. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=nottype");
		}
		
		//Validamos tamaño
		if($medidasimagen1[0] < 520 ){
			$resultado = optimizar_imagen_min($_FILES['img_anuncio_fls']['tmp_name'], $ruta, $imagen1);
		}else{
			$resultado = optimizar_imagen($_FILES['img_anuncio_fls']['tmp_name'], $max_ancho, $max_alto, $ruta, $imagen1);
		}

		//Si se sube nueva imagen
		if ($resultado){

			q($mysqli,"UPDATE anuncios SET imagen1='$imagen1' WHERE codigo = $hdn_verificar");

		}else{
			$_SESSION['sms'] = "Hubo un problema al actualizar el Producto. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=notimg1");
		}
	}

	//Imagen 2
	if (!empty($_FILES['img_anuncio2_fls']['tmp_name'])){
		$d_img2=$reg_v['imagen2'];
		$eliminar2="../img/anuncios/$d_img2";

		if(file_exists($eliminar2)){
			unlink($eliminar2);
			q($mysqli,"UPDATE anuncios SET imagen2='' WHERE codigo=$hdn_verificar");
		}
		if ($tamañoimg2>10485760){
			$_SESSION['sms'] = "Error: La imagen excede el tamaño maximo permitido de 10mb. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=maxsize");
		}
		if ($_FILES["img_anuncio2_fls"]["type"] =="image/jpeg"){
			$imagen2 = time()."-2.jpg";
		}else{
			$_SESSION['sms'] = "Error: La imagen debe ser de formato JPG. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=nottype");
		
		}
		if($medidasimagen2[0] < 520 ){
			$resultado2 = optimizar_imagen_min($_FILES['img_anuncio2_fls']['tmp_name'], $ruta, $imagen2);
		}else{
			$resultado2 = optimizar_imagen($_FILES['img_anuncio2_fls']['tmp_name'], $max_ancho, $max_alto, $ruta, $imagen2);
		}
		if ($resultado2){
			mysql_query("UPDATE anuncios SET imagen2='$imagen2' WHERE codigo = $hdn_verificar");
		}else{
			$_SESSION['sms'] = "Hubo un problema al actualizar el Producto. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=notimg2");
		}
	}

	//Imagen 3
	if (!empty($_FILES['img_anuncio3_fls']['tmp_name'])){
		$d_img3=$reg_v['imagen3'];
		$eliminar3="../img/anuncios/$d_img3";
		if(file_exists($eliminar3)){
			unlink($eliminar3);
			q($mysqli,"UPDATE anuncios SET imagen3='' WHERE codigo=$hdn_verificar");
		}
		if ($tamañoimg3>10485760){
			$_SESSION['sms'] = "Error: La imagen excede el tamaño maximo permitido de 10mb. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=maxsize");
		}
		if ($_FILES["img_anuncio3_fls"]["type"] =="image/jpeg"){
			$imagen3 = time()."-3.jpg";
		}else{
			$_SESSION['sms'] = "Error: La imagen debe ser de formato JPG. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=nottype");
		}
		if($medidasimagen3[0] < 520 ){
			$resultado3 = optimizar_imagen_min($_FILES['img_anuncio3_fls']['tmp_name'], $ruta, $imagen3);
		}else{
			$resultado3 = optimizar_imagen($_FILES['img_anuncio3_fls']['tmp_name'], $max_ancho, $max_alto, $ruta, $imagen3);
		}
		if ($resultado3){
			q($mysqli,"UPDATE anuncios SET imagen3='$imagen3' WHERE codigo = $hdn_verificar");
		}else{
			$_SESSION['sms'] = "Hubo un problema al actualizar el Producto. Intente nuevamente.";
			$_SESSION['sms-type'] = "danger";
			header("Location: ../producto-editar.php?ck=$hdn_verificar&re=notimg3");
		}
	}

	q($mysqli,"UPDATE anuncios SET categoriahija_id='$categoriahija', categoria_hdn='$categoria_hdn', name_n='$name', correo='$correo', telefono='$telefono', distrito='$distrito', nombre='$nombre', descripcion='$descripcion', precio='$precio', precio_oferta='$precioOferta' WHERE codigo = $hdn_verificar");

	$_SESSION['sms'] = "El producto se ha <b>actualizado</b> con éxito.";
	$_SESSION['sms-type'] = "info";

	header("Location: ../producto-editar.php?ck=$hdn_verificar&re=success");
}
?>
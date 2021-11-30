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

//Datos de contacto
$name = filtrar($mysqli,$_POST['name']);
$correo = filtrar($mysqli,$_POST['correo']);
$telefono = filtrar($mysqli,$_POST['telefono']);

//Definimos el usuario master para administración, por ahora 1
$user = 1;

//Creamos un código irrepetible
$codigo_simple = rand(0000000,9999999);
$codigo = $codigo_simple+time();

//Seleccionamos la categoría hija para grabar en campo oculto para SEO
$cat =q($mysqli,"SELECT * FROM categoria_hija WHERE id_cathija = $categoriahija");

$dcat = datos($cat);
$name_cat = $dcat['nombre'];

$categoria_hdn = "anuncios, productos ".$name_cat." en ".$distrito.", ".$name_cat." ".$distrito.", ".$name_cat.", ".$keywords;


$tamañoimg1 = $_FILES['img_anuncio_fls']['size'];
$tamañoimg2 = $_FILES['img_anuncio2_fls']['size'];
$tamañoimg3 = $_FILES['img_anuncio3_fls']['size'];


//Parámetros optimización, resolución máxima permitida
$max_ancho = 520;
$max_alto = 600;

$medidasimagen1= getimagesize($_FILES['img_anuncio_fls']['tmp_name']);
$medidasimagen2= getimagesize($_FILES['img_anuncio2_fls']['tmp_name']);
$medidasimagen3= getimagesize($_FILES['img_anuncio3_fls']['tmp_name']);

$ruta = "../img/anuncios/";

//Validamos campos vacios
if (empty($categoriahija) || empty($nombre) || empty($name) || empty($correo) || empty($distrito) || empty($descripcion) || empty($user) || empty($precio)){
	
	$_SESSION['sms'] = "Error: Debe completar todo los campos requeridos. Porfavor intente nuevamente.";
	$_SESSION['sms-type'] = "danger";
	header("Location: ../producto-publicar.php?re=empty");

}else{

	//Si no se ha subido imagen, definimos genérica
	if (empty($_FILES['img_anuncio_fls']['tmp_name']) && empty($_FILES['img_anuncio2_fls']['tmp_name']) && empty($_FILES['img_anuncio3_fls']['tmp_name'])){
		$imagen_generica = "generica.jpg";
		$imagen1 = $imagen_generica;
	}

	//Si alguna imagen sobrepasa el valor máximo size
	if ($tamañoimg1>10485760 || $tamañoimg2>10485760 || $tamañoimg3>10485760){
		$_SESSION['sms'] = "Error: El tamaño de las imagenes es máximo 10mb.";
		$_SESSION['sms-type'] = "danger";
		header("Location: ../producto-publicar.php?re=maxsize"); 
	}

	//Si la imagen 1 es de tipo jpg
	if ($_FILES["img_anuncio_fls"]["type"] =="image/jpeg"){
		$imagen1 = time()."-1.jpg";
	}else{
		$_SESSION['sms'] = "Error: La imagen debe ser de tipo .JPG.";
		$_SESSION['sms-type'] = "danger";
		header("Location: ../producto-publicar.php?re=nottype"); 
	}

	//Si la imagen 2 es de tipo jpg
	if ($_FILES["img_anuncio2_fls"]["type"] =="image/jpeg"){
		$imagen2 = time()."-2.jpg";
	}else{
		$_SESSION['sms'] = "Error: La imagen debe ser de tipo .JPG.";
		$_SESSION['sms-type'] = "danger";
		header("Location: ../producto-publicar.php?re=nottype"); 
	}

	//Si la imagen 3 es de tipo jpg
	if ($_FILES["img_anuncio3_fls"]["type"] =="image/jpeg"){
		$imagen3 = time()."-3.jpg";
	}else{
		$_SESSION['sms'] = "Error: La imagen debe ser de tipo .JPG.";
		$_SESSION['sms-type'] = "danger";
		header("Location: ../producto-publicar.php?re=nottype"); 
	}

	//optimizar imagen 1
	if($medidasimagen1[0] < 520 ){
		//Min define optimización mínimo
		$resultado1 = optimizar_imagen_min($_FILES['img_anuncio_fls']['tmp_name'], $ruta, $imagen1);
	}else{
		//Esta función optimiza imagenes de mayor tamaño a la resolución indicada
		$resultado1 = optimizar_imagen($_FILES['img_anuncio_fls']['tmp_name'], $max_ancho, $max_alto, $ruta, $imagen1);
	}

	//optimizar imagen 2
	if($medidasimagen2[0] < 520){
		$resultado2 = optimizar_imagen_min($_FILES['img_anuncio2_fls']['tmp_name'], $ruta, $imagen2);
	}else{
		$resultado2 = optimizar_imagen($_FILES['img_anuncio2_fls']['tmp_name'], $max_ancho, $max_alto, $ruta, $imagen2);
	}

	//optimizar imagen 3
	if($medidasimagen3[0] < 520){
		$resultado3 = optimizar_imagen_min($_FILES['img_anuncio3_fls']['tmp_name'], $ruta, $imagen3);
	}else{
		$resultado3 = optimizar_imagen($_FILES['img_anuncio3_fls']['tmp_name'], $max_ancho, $max_alto, $ruta, $imagen3);
	}


	//Si se da algún resultado
	if ($resultado1 || $resultado2 || $resultado3 || $imagen_generica){

		//Creamos un datakey sólo para enmascarar link con el código clave
		$data_key = substr(md5(microtime()), 1, 32);    
		
		//Definimos header
		$headers = "De: gocomputersystem@gmail.com";
		$asunto = "VENDELO EN EL VALLE: Hola. Valida tú anuncio para que sea publicado";
		$mensaje = 
		"Gracias por usar la plataforma VENDELO EN EL VALLE. Para validar tú anuncio, copia o pega este enlace, o da click: ".$sitio_web."/validar.php?ck=".$codigo."&key=".$data_key;

		if(@mail($correo,$asunto,$mensaje,$headers)){
			// Si se envia el email procede a guardar
			q($mysqli,"INSERT INTO anuncios (categoriahija_id,categoria_hdn,name_n,correo,telefono,distrito,nombre,descripcion,imagen1,imagen2,imagen3,precio,precio_oferta,fecha_publicacion,user_id,estado,codigo) VALUES ('$categoriahija','$categoria_hdn','$name','$correo','$telefono','$distrito','$nombre','$descripcion','$imagen1','$imagen2','$imagen3','$precio','$precioOferta',now(),'$user',0,'$codigo')");

			$_SESSION['sms'] = "El producto se ha <b>enviado</b> con éxito. En unos minutos le llegará un mensaje a su correo electrónico para que valide su anuncio.";
			$_SESSION['sms-type'] = "info";
			header("Location: ../producto-publicar.php?re=success");

		}else{
			$_SESSION['sms'] = "Error de envio SMTP. Porfavor intente de nuevo";
			$_SESSION['sms-type'] = "info";
			header("Location: ../producto-publicar.php?re=errorsmtp");
		} 
		
	}

}

?>
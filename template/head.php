<?php include("resource/buscar-listar.php")?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index"/>
<meta name="googlebot" content="index,follow"/>
<link rel='shortcut icon' href=img/logo.png>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link type="text/css" href="assets/css/jquery-ui.css" rel="stylesheet" />

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

<meta name="description" content="Bienvenido. Encuentra y publica Productos y Servicios en el Valle Chicama"/>
<meta name="keywords" content="Negocios y productos en el valle chicama, <?php echo $list_seo ?>"/>

<?php 
//Aquí definimos la procedencia de la página para colocarlo en el title
if(isset($reg_titulo_name) || isset($buscar)){
	if($total_registros > 0){?>
	<title><?php echo $reg_titulo_name ?></title>
	<?php }else{ ?>
		<?php if(empty($buscar)){ ?>
			<title><?php echo $reg_titulo_name ?></title>
		<?php }else{ ?>
			<title><?php echo $buscar ?></title>
		<?php } ?>
<?php } ?>
<?php }else{?>
<title>Vendelo en el Valle | Un lugar creado para que encuentres Productos y Servicios en el Valle Chicama</title>
<?php }?>

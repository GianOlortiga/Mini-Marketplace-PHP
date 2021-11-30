<?php 
include("resource/conexion.php");

if (!isset($_GET['busqueda']) || empty($_GET['busqueda']) || trim($_GET['busqueda'])==""){
	header("Location: index.php");
}
if (isset($_GET['id'])){
	header("Location: index.php");
}
//Iniciamos Paginación
$registros='25';
$pag = $_GET['pag'];
if (!$pag){
	$inicio = 0;
	$pag = 1;
}else{
	$inicio = ($pag -1) * $registros;
}
//Limpiamos la busqueda
$busqueda = str_replace(" ", "+", $_GET['busqueda']);
$buscar = trim($_GET['busqueda']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
	<?php include("template/head.php"); ?>
</head>
<body>
	<?php include("template/header.php");?>
	<section class="gos">
		<section class="dimensiones">
			<section class="i_dimensiones container_top cubo1">
				<div class="container">
					<div class="row">
						<?php
						//Realizamos la busqueda 
						$q_buscar=q($mysqli,"SELECT * FROM categoria_hija WHERE nombre LIKE '%$buscar%'");
						$reg_q_buscar=datos($q_buscar);

						$buscador=$reg_q_buscar['id_cathija'];
						$b=explode(' ', $buscar);
						$bi = htmlentities($b[0]);

						$entradas=q($mysqli,"SELECT * FROM anuncios WHERE categoriahija_id='$buscador' or nombre LIKE '%$buscar%' or descripcion LIKE '%$buscar%' or keywords LIKE '%$buscar%' or categoria_hdn LIKE '%$buscar%' or nombre LIKE '%$bi%' or descripcion LIKE '%$bi%' or keywords LIKE '%$bi%' or categoria_hdn LIKE '%$bi%'");
						
						$total_registros=filas($entradas);

						if ($total_registros>0){?>
							<div class="nav-thumb">
								<p class="p-resultados-cat p-resultados-global">Resultados para <strong><?php $res=(isset($buscar))?$buscar:$reg_q_buscar['nombre'];echo$res ?></strong></p>
							</div>
						<?php }else{?>
							<div class='nav-thumb w_standar'>
								<p class='p-resultados-cat p-resultados-global'>¡Lo sentimos! Tu búsqueda por <b><?=$buscar?></b>  no tuvo resultados :(</p><br><hr>
							</div>
						<?php }?>
					</div>
					<div class="row">
						<section class="principal_cat">
							<div class="col-sm-12 col-xs-12">
								<div class="row">
									<div id="container-busqueda">
										<?php
										$total_paginas=ceil($total_registros/$registros);

										//Busqueda para anuncios 
										$publicacion=q($mysqli,"SELECT * FROM anuncios WHERE categoriahija_id='$buscador' or nombre LIKE '%$buscar%' or descripcion LIKE '%$buscar%' or keywords LIKE '%$buscar%' or categoria_hdn LIKE '%$buscar%' or nombre LIKE '%$bi%' or descripcion LIKE '%$bi%' or keywords LIKE '%$bi%' or categoria_hdn LIKE '%$bi%'");
										
										include("resource/section-resultado-busqueda-q.php") ;
										?>
									</div><br>
								</div>
								<?php 
									//Incluimos paginación definiendo en la variabla $pagina el nombre de este archivo
									$pagina = "busqueda";
									include("resource/paginacion.php");
								?>
							</div>
						</section>
					</div><br>
				</div>
			</section>
		</section>
	</section>

	<?php include("template/footer.php"); ?>
	
</body>
</html>
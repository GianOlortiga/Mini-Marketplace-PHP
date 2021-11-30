<?php include("resource/conexion.php"); ?>
<?php
$tag_p = intval($_GET['tag_p']);
if (!isset($tag_p) || empty($tag_p) || trim($tag_p)==""){
	header("Location: index.php");
}
if (isset($_GET['id'])){
	header("Location: index.php");
}

//Iniciamos paginación
$registros='25';
$pag = $_GET['pag'];
if (!$pag){
	$inicio = 0;
	$pag = 1;
}else{
	$inicio = ($pag -1) * $registros;
}

//Buscamos los anuncios y categoria hijas

$q_tag=q($mysqli,"SELECT * FROM anuncios,categoria_hija WHERE categoriahija_id=id_cathija and catpadre_id=$tag_p and estado=1");

//Buscamos la categoria padre
$sql_cat_name=q($mysqli,"SELECT * FROM categoria_padre WHERE id_catpadre=$tag_p");
$total_registros=filas($q_tag);
$reg_tag=datos($sql_cat_name);

$reg_titulo_name = $reg_tag['nombre'];
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
						if ($total_registros<1){
							$nombre = $reg_tag['nombre'];
						?>
							<div class='nav-thumb w_standar'><p class='p-resultados-cat p-resultados-global'>¡Lo sentimos! Tu búsqueda por '<strong><?=$nombre?></strong>' no tuvo resultados :(</p><br><hr></div>
						<?php }else{?>
						<div class="nav-thumb">
							<p class="p-resultados-cat p-resultados-global">Resultados para <strong><?php $res=(isset($buscar))?$buscar:$reg_tag['nombre'];echo$res ?></strong></p>
						</div>
						<?php }?>
					</div>
					<div class="row">
						<section class="principal_cat">
							<div class="col-lg-3 col-sm-3 col-xs-12">
								<div id="ofert-fixed">
									<div id="ofert_details">
										<p class="title_all hidden-xs"><a href="all-categorias.php" title="Ver todos los productos del sitio">VER TODOS LOS PRODUCTOS<i class="tecla">_</i></a></p>
										<div id="categorias-busqueda">
											<p id="categorias-busqueda-p" class="cat_active"><span>Estas en:</span><?php $res=(isset($q))?$q:$reg_tag['nombre'];echo$res ?></p>
											<ul class="list_menuv">
												<?php
												//Lista vertical izquierda mostramos categorias
												$q_allcategory_h=q($mysqli,"SELECT * FROM categoria_hija WHERE catpadre_id=$tag_p");

												while($reg_allcategory=datos($q_allcategory_h)){;
													$id_cathija=$reg_allcategory['id_cathija'];
													$sql_sum1 = q($mysqli,"SELECT * FROM anuncios WHERE categoriahija_id=$id_cathija and estado=1");
													$suma=filas($sql_sum1);
												?>	
													<li>
														<a href="categoria.php?tag=<?=$id_cathija ?>"><?=$reg_allcategory['nombre'] ?> <span class="total-cat">(<?=$suma?>)</span></a>
													</li>
													
												<?php }?>
											</ul>	
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-9 col-sm-9 col-xs-12">
								<div class="row">
									<div id="container-busqueda">
										<?php 
										$total_paginas=ceil($total_registros/$registros);

										//Obtenemos los anuncios
										$publicacion=q($mysqli,"SELECT *,anuncios.nombre as nombre_producto FROM anuncios,categoria_hija WHERE categoriahija_id=id_cathija and catpadre_id=$tag_p ORDER BY id DESC LIMIT $inicio, $registros");
										?>
										<?php include("resource/section-resultado-busqueda-q.php") ;?>

									</div><br>
								</div>
								<?php 
									//Incluimos paginación definiendo en la variabla $pagina el nombre de este archivo
									$pagina = "categoria-p";
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
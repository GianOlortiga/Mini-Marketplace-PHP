<?php 
include("resource/conexion.php");
if (isset($_GET['id'])){
	header("Location: index.php");
}
//Definimos paginacion
$registros='25';
$pag = $_GET['pag'];
if (!$pag){
	$inicio = 0;
	$pag = 1;
}else{
	$inicio = ($pag -1) * $registros;
}
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
						//Mostramos productos
						$entradas=q($mysqli,"SELECT * FROM anuncios WHERE estado=1");
						
						$total_registros=filas($entradas);
						if ($total_registros>0){
						?>
						<div class="nav-thumb">
							<p class="p-resultados-cat p-resultados-global"> <strong>Todos los anuncios:</strong> <?= $total_registros;?></p>
						</div>
						
						<?php }else{
						$hiddenclass="style=display:none !important;";
						?>
						<div class='nav-thumb w_standar'>
							<p class='p-resultados-cat p-resultados-global'> Aún no tenemos publicaciones</p><br><hr>
						</div>
						<?php }?>
						
					</div>
					<div class="row">
						<section class="principal_cat">
							<div class="col-lg-3 col-sm-3 col-xs-12">
								<div id="ofert-fixed">
									<div id="ofert_details">
										<div id="categorias-busqueda">
											<p id="categorias-busqueda-p" class="cat_active">TODOS LOS PRODUCTOS</p>
											<ul class="list_menuv">
											<?php
											//Listamos las categorias Padres

											$q_allcategory=listar($mysqli,"categoria_padre");
											while($reg_allcategory=datos($q_allcategory)){;
												$id_catpadre=$reg_allcategory['id_catpadre'];

												$sql_sum1 = q($mysqli,"SELECT * FROM anuncios,categoria_hija WHERE categoriahija_id=id_cathija and catpadre_id=$id_catpadre and estado=1");
												$suma=filas($sql_sum1);
											?>
												<li>		
													<a href="categoria-p.php?tag_p=<?=$id_catpadre ?>"><?=$reg_allcategory['nombre'] ?> <span class="total-cat">(<?=$suma?>)</span></a>
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
										$publicacion=q($mysqli, "SELECT * FROM anuncios WHERE estado=1 ORDER BY id DESC LIMIT $inicio, $registros ");
										?>
										<?php include("resource/section-resultado-busqueda-all.php") ;?>

									</div><br>
								</div>
								<?php 
									//Incluimos paginación definiendo en la variabla $pagina el nombre de este archivo
									$pagina = "all-categorias";
									include("resource/paginacion.php");
								?>
							</div>
						</section>
						</div>
					</div><br>
				</div>
			</section>
		</section>
	</section>
	
	<?php include("template/footer.php"); ?>

</body>
</html>
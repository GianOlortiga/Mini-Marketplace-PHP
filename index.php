<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
	<?php 
	//Inicializamos los recursos
	include("resource/conexion.php");
	include("template/head.php");
	?>
</head>
<body>
	<?php include("template/header.php");?>
	<section class="gos">
		<section class="dimensiones">
			<section class="">
				<section class="i_dimensiones container_top cubo1">
					<br>
					<section id="ulimas_ofertas" class="w_divider">
						<?php include("resource/section-ultimos-anuncios.php") ?>
					</section>
					
					<div class="vercat">
    					<div id="btn-all">
    					    <p class="title_all"><a href="all-categorias.php" title="Ver todos los productos del sitio">VER TODOS LOS PRODUCTOS<i class="tecla">_</i></a></p>
    					</div>
					</div>
					<hr>
					<section id="patrocinados">
						<?php include("resource/patrocinados.php") ?>
					</section>
					<hr>
					<section>
						<?php include("resource/colecciones.php")?>
					</section>
				
				</section>

			</section>
		</section>
	</section>

	<?php 
	//Resource de footer
	include("template/footer.php");
	?>

</body>
</html>

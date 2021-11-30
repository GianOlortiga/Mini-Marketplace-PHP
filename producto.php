<?php 
include("resource/conexion.php");

$tag_p = intval($_GET['tag_p']);
$tag = intval($_GET['tag']);
$id = intval($_GET['id']);
$busqueda = str_replace(" ", "+", $_GET['busqueda']);

if(empty($id)){
	header("Location: index.php");
}

//Seleccionamos el anuncio
$q_title=q($mysqli,"SELECT * FROM anuncios WHERE id='$id' and estado=1");
$reg=datos($q_title);

$n=filas($q_title);

//Validamos si existe resultado
if($n<1){
	header("Location: index.php");
}

$titulo=$reg['nombre'];
$keywords=$reg['categoria_hdn'];
$description = $reg['descripcion'];
$invKeywords = $reg['keywords'];
$telefono = $reg['telefono'];
$distrito = $reg['distrito'];


//Definimos el precio
if($reg['precio_oferta'] > 0){
	$precio = $reg['precio_oferta'];
	$p = $reg['precio'];
	$precio_normal = "Antes: <span>S/".$p."</span>";
}else{
	$precio = $reg['precio'];
	$p = $reg['precio_oferta'];
	$precio_normal = "Antes: <span>S/".$p."</span>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
	<?php include("template/head-anuncio.php"); ?>
	<link rel="stylesheet" type="text/css" href="js/carousel/carouselengine/initcarousel-2.css">
</head>
<body>
	<?php include("template/header.php");?>
	<section class="gos">
		<section class="dimensiones">
			<section class="i_dimensiones container_top cubo1 ">
				<div class="container anuncio">
					<div class="row">
						<div class="col-sm-9">
						<!---Menú de navegación -->
						<?php
						$id_ch=$reg['categoriahija_id'];
						//Seleccionamos la categoria hija del productos
						$q_ch=q($mysqli,"SELECT * FROM categoria_hija WHERE id_cathija=$id_ch");
						$reg_ch_id=datos($q_ch);

						//Seleccionamos la categoría hija, categoría padre donde 
						$q_cp=q($mysqli,"SELECT * FROM categoria_hija,categoria_padre WHERE id_cathija=$id_ch and catpadre_id=id_catpadre");
						$reg_cp_id=datos($q_cp);

						?>
						<p class="p-resultados-cat nav_anuncio">
							<?php
							//En el nav validamos parametros que vienen de busqueda, categoria hija, categoria padre 

							if(!empty($busqueda)){?>	
							<a href="busqueda.php?busqueda=<?=$busqueda?>">Volver a resultados</a>

							<?}elseif(!empty($tag)){?>
							<a href="categoria.php?tag=<?=$tag?>">Volver a resultados</a>

							<?}elseif(!empty($tag_p)){?> 
							<a href="categoria-p.php?tag_p=<?=$tag_p?>">Volver a resultados</a>

							<?}else{?>
							<a href="all-categorias.php">Volver a resultados</a>
							<?}?>
							
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
								
							<a href="categoria-p.php?tag_p=<?=$reg_cp_id['id_catpadre'] ?>">
								<?=$reg_cp_id['nombre'] ?>
							</a>

							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							
							<a href="categoria.php?tag=<?=$reg_ch_id['id_cathija']?>"> 
								<?=$reg_ch_id['nombre']?>
							</a>
							
							</p>
						</div>
						
						<div class="col-sm-3">
							<p class="p-num-post">ID#000<?=$reg['id'];?></p>
						</div>

					</div><hr>
				</div>
				<!--Contenido del anuncio-->
				<section class="desc_anuncio">
					<?php include("resource/section-descripcion-anuncio.php"); ?>
				</section>
			</section>
		</section>
	</section>

	<?php include("template/footer.php") ?>
	<script src="assets/js/carousel/carouselengine/amazingcarousel.js"></script>
	<script src="assets/js/carousel/carouselengine/initcarousel-2.js"></script>
	
	<script>
	$(document).ready(function(){
		
		//Datos y boton de contacto de whatsapp
		
		var ancho = $(window).width();
		var alto = $(window).height();

		$(".btn_gowap").click(function(e){
			e.preventDefault();
			var pantalla = "top=0,left=0,width=" + ancho + ",height=" + alto; 
			open('https://api.whatsapp.com/send?l=es&phone=+51<?=$telefono?>&text=Buen dia, deseo consultar del producto <?=$titulo?>, al precio: S/.<?=$precio?>','',pantalla);
		});

		//Botón para compartir de whatsapp
		$(".gowat").click(function(e){
			e.preventDefault();
			var marco = "top=0,left=0,width=" + ancho + ",height=" + alto; 
			open('https://api.whatsapp.com/send?phone=&text=<?=$titulo?>%20está%20en%20VENDELO%20EN%20EL%20VALLE%20AL%20MEJOR%20PRECIO%2c%20mira%20este%20producto%2c%20visita%20el%20sitio%20web%20<?=$sitio_web?>/producto.php?id=<?=$id ?>','',marco);
		});

	});
	</script>

	<script>
	$(document).ready(function(){
		//Slider de fotos
		$(".s_galerias").slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplaySpeed: 3500,
			speed: 700,
			fade: false,
			autoplay: true
			
		});

		//Scroll fixed para boton de contacto de anunciante
		var ofert_fixed = $('#ofert-fixed');
		var ofert_details = $('#ofert_details');
		var cont_offset = ofert_fixed.offset();
		var stop_fixed = $('#stop_fixed');
		var stop_offset = stop_fixed.offset();
		
		$(window).on('scroll', function() {
			if($(window).scrollTop() > cont_offset.top) {
				ofert_details.addClass('ofert_w');
			} else {
				ofert_details.removeClass('ofert_w');
			}
			if($(window).scrollTop() > stop_offset.top - 300) {
				ofert_details.removeClass('ofert_w');
			}
		});
	});
	</script>

</body>

</html>

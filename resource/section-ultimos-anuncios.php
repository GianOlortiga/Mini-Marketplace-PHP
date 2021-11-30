<?php 
//Seleccionamos los anuncios
$qr=listar($mysqli,"anuncios");
$total_items=filas($qr);

//Para mostrar productos en orden aleatorio
$orden = array("ASC", "DESC", "DESC", "ASC");
$columna = array("categoriahija_id", "imagen1", "id", "fecha_publicacion", "codigo", "nombre");

$r_orden = array_rand($orden);
$r_columna = array_rand($columna);

$consulta = "SELECT * FROM anuncios WHERE estado=1 ORDER BY ".$columna[$r_columna]." ".$orden[$r_orden]." LIMIT 0,32";

$q=q($mysqli,$consulta);
?>
		<div class="container">
			<div class="row">
				<div class="section_menu">
					<h2 class="section_menu_title">Ultimas Publicaciones |</h2>
					<p class="section_menu_subtitle">Vende lo que ya no uses dentro del Valle Chicama.</p>
					<a class="section_menu_link" href="all-categorias.php">Ver todos los Productos</a>
				</div>

				<?php 
				while ($reg=datos($q)) {
				?>
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 history_cat">
					<?php 
					$id_prod = $reg['user_id'];
					
					$empresa = str_replace(" ", "-", $reg['nombre']." en ".$reg['distrito']);

					$dprecio = $reg['precio'];
					$dprecio_oferta = $reg['precio_oferta'];

					if($dprecio>0){
					$x = ($dprecio_oferta * 100)/$dprecio;
					$d = 100 - $x;
					}
					?>

					<a class="c_list" href="producto.php?id=<?=$reg['id']?>&producto=<?=$empresa?>" title="<?=$reg['nombre'];?>">
						<div class="w_list">

							<?include("resource/traer_img.php")?>	
							
							<i class="history_pi32" style="background-image: url(img/anuncios/<?=$imgpic?>);"></i>
							<div class="img-anuncio-min c_div_img">
								<img class="c_list_img img-div-min img-responsive" src="img/anuncios/<?=$imgfigure?>">

								<?php if($dprecio_oferta>0){?>
								<span class="ofert_text"><?= "-".ceil($d)."%"?><span> dscto.</span></span>
								<?php }?> 

							</div>

							<div class="c_list_info">
								<div class="c_list_price_w">
									<span class="c_description"><?= $reg['nombre']?></span>
									
									<?php 
									//Verificamos si existe precio oferta
									if($reg['precio_oferta']>0){?>
									
									<span class="c_list_price">Oferta: <span>S/.<?=$reg['precio_oferta']?></span></span>
									<span class="c_list_first_price">Normal: S/.<?=$reg['precio']?></span>
									
									<?php }else{?>

									<span class="c_list_price">Precio: <span>S/.<?=$reg['precio']?></span></span>

									<?php }?>
										
									<span class="c_distrito"><span class="glyphicon glyphicon-globe"></span> <?=$reg['distrito'] ?></span>
									
								</div>
							</div>
						</div>
					</a>
				</div>
				<?php }?>
			</div>
			
		</div>
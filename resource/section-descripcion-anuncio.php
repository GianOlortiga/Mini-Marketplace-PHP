<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="h1-anuncio"><?=$titulo?></h1>
		</div>
		<div class="col-md-7 col-sm-7">
			<section id="contenido-anuncio">
				<?php 
				$descripcion = $reg['descripcion'];
				$servicios = $reg['servicios'];
				$sitioweb = $reg['sitio_web'];
				$facebook = $reg['facebook'];
				$horario = $reg['horario'];
				?>
				<div class="row">
					<div class="col-sm-12">
						<!--Slider de fotos-->
						<div id="slider_ofert">
							<div class="s_galerias">
								<?php 
								if (!empty($reg['imagen1'])){?>
									<div class="item_galery">
										<div class="">
											<div class="w_list2 w_item_galery">
												<i class="history_pi32" style="background-image: url(img/anuncios/<?=$reg['imagen1']?>);"></i>
												<a href="img/anuncios/<?=$reg['imagen1'] ?>" class="html5lightbox">
													<div class="img-anuncio-min c_div_img">
														<img class="c_list_img img-div-min img-responsive" src="img/anuncios/<?=$reg['imagen1'] ?>" alt="Foto">
													</div>
												</a>
											</div>
										</div>
									</div>
								<?}?>
								<?php 
								if (!empty($reg['imagen2'])){?>
									<div class="item_galery">
										<div class="">
											<div class="w_list2 w_item_galery">
												<i class="history_pi32" style="background-image: url(img/anuncios/<?=$reg['imagen2']?>);"></i>
												<a href="img/anuncios/<?=$reg['imagen2'] ?>" class="html5lightbox">
													<div class="img-anuncio-min c_div_img">
														<img class="c_list_img img-div-min img-responsive" src="img/anuncios/<?=$reg['imagen2'] ?>" alt="Foto_2">
													</div>
												</a>
											</div>
										</div>
									</div>
								<?}?>
								<?php 
								if (!empty($reg['imagen3'])){?>
									<div class="item_galery">
										<div class="">
											<div class="w_list2 w_item_galery">
												<i class="history_pi32" style="background-image: url(img/anuncios/<?=$reg['imagen3']?>);"></i>
												<a href="img/anuncios/<?=$reg['imagen3'] ?>" class="html5lightbox">
													<div class="img-anuncio-min c_div_img">
														<img class="c_list_img img-div-min img-responsive" src="img/anuncios/<?=$reg['imagen3'] ?>" alt="Foto_3">
													</div>
												</a>
											</div>
										</div>
									</div>
								<?}?>
							</div>
						</div>
					</div>
				</div>
				<div id="body-anuncio">
					<!--Descripcion del producto-->
					<div class="body_detalles">
						<div class="body_dint">
							<h2>SOBRE EL PRODUCTO</h2>
							<?php 
							echo "<span class='glyphicon glyphicon-globe'></span> Disitrito: ".$distrito."<br><br>";
							echo html_entity_decode($descripcion) 
							?>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="col-md-5 col-sm-5">
			<aside>
				<!--Precio y botón de contacto-->
				<div id="ofert-fixed">
					<div id="ofert_details">
						<div class="w_actions">
							<div id="precio">
								<p class="p_oferta">S/.<?=$precio?></p>
							</div>
							<div id="btn_compra">
								<?if(!empty($telefono)){?>
									<button class="btn_gowap">SOLICITAR</button>
								<?}else{?>
									<a href="mailto:<?=$reg['correo']?>">CONSULTAR</a>
								<?}?>
							</div>
							<div id="datos_est">
								<div id="compartir">
									<?php include("compartir-anuncio.php"); ?>
								</div>
							</div>
							<p>Algunas sugerencias al comprar este artículo:</p>
							<ul>
								<li>Recuerda al reunirte, tomar las medidas de prevención contra el COVID 19.</li>
								<li>Si acuerdan reunirse en la compra. Que sea lugares públicos.</li>
								<li>Te recomendamos no hacer depositos por adelantado al vendedor.</li>
							</ul>
						</div>
					</div>
				</div>
			</aside>
		</div>
	</div>

	<div id="stop_fixed"></div>

	<section id="patrocinados">
		<?php include("patrocinados.php") ?>
	</section>

	<!--Productos relacionados-->
	<div id="post-relacionados">
		<?php
		//Con el id de la categoria obtenemos anuncios de esa categoría
		$rel=$reg['categoriahija_id'];						
		$q_rel=q($mysqli,"SELECT * FROM anuncios WHERE categoriahija_id='$rel' and estado=1 ORDER BY nombre ASC  LIMIT 4");

		//Obtenemos el nombre de la categoría
		$q_rel_tag=q($mysqli,"SELECT * FROM categoria_hija WHERE id_cathija='$rel'");
		$reg_q_tag=datos($q_rel_tag);

		$reg_q_tagp=$reg_q_tag['catpadre_id'];
		?>
		<p id="post-relacionados-p">Otros productos relacionados</p>
		<div class="row">
			<?php while($q_anuncios_reg=datos($q_rel)){ ?>

			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 history_cat">
				<?php 

				$empresa = str_replace(" ", "-", $q_anuncios_reg['nombre']." en ".$distrito);

				$dprecio = $q_anuncios_reg['precio'];
				$dprecio_oferta = $q_anuncios_reg['precio_oferta'];
			
				if($dprecio>0){
					$x = ($dprecio_oferta * 100)/$dprecio;
					$d = 100 - $x;
				}

				//Validamos la etiqueta de la categoria
				if($tag){?>
					<a href="producto.php?id=<?=$q_anuncios_reg['id']?>&tag=<?=$reg_q_tag['id_cathija'] ?>&producto=<?=$empresa?>" class="c_list ultimos-a-div" title="<?=$q_anuncios_reg['nombre']?>" >
					<?}elseif($busqueda){?>
					<a href="producto.php?id=<?=$q_anuncios_reg['id']?>&busqueda=<?=$busqueda?>&producto=<?=$empresa?>" class="c_list ultimos-a-div" title="<?=$q_anuncios_reg['nombre']?>">
					<?}elseif($tag_p){?>
					<a href="producto.php?id=<?=$q_anuncios_reg['id']?>&tag_p=<?=$reg_q_tagp?>&producto=<?=$empresa?>" class="c_list ultimos-a-div" title="<?=$q_anuncios_reg['nombre']?>">
					<?}else{?>
					<a href="producto.php?id=<?php echo $q_anuncios_reg['id']?>&tag_all=<?="all"?>&producto=<?=$empresa?>" class="c_list ultimos-a-div" title="<?=$q_anuncios_reg['nombre']?>">
				<?}?>
				
				<!--Producto relacionado-->
				<div class="w_list">
					<?include("resource/traer_img_relacionados.php")?>
					<i class="history_pi32" style="background-image: url(img/anuncios/<?=$imgpic?>);"></i>
					<div class="img-anuncio-min c_div_img" >
						<img class="c_list_img img-div-min img-responsive" src="img/anuncios/<?=$imgfigure?>">
						<?if($dprecio_oferta>0){?>
						<span class="ofert_text"><?= "-".ceil($d)."%"?><span> dscto.</span></span>
						<?}?> 
					</div>
					<div class="c_list_info">
						<div class="c_list_price_w">
							
							<span class="c_description"><?=$q_anuncios_reg['nombre']?></span>
				
							<?if($q_anuncios_reg['precio_oferta']>0){?>
							<span class="c_list_price">Oferta: <span>S/.<?=$q_anuncios_reg['precio_oferta']?></span></span>
							<span class="c_list_first_price">Antes S/.<?=$q_anuncios_reg['precio']?></span>
							<?}else{?>
							<span class="c_list_price">El Mejor Precio: <span>S/.<?=$q_anuncios_reg['precio']?></span></span>
							<?}?>	
							<span class="c_distrito"><span class="glyphicon glyphicon-globe"></span> <?=$distrito?></span>
						</div>
					</div>
				</div>
				</a>
			</div>
			<?}?>
		</div>
	</div>
</div>
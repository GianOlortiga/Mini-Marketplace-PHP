    <section id="w_b3" class="container">
		<div class="section_menu">
			<h2 class="section_menu_title">COLECCIONES ESPECIALES | </h2>
			<p class="section_menu_subtitle">Encuentra más productos por estas categorías</p>
		</div>
		<div class="section_list">
			<div class="row">
				<?php
				//Listamos colecciones
				$sql=listar($mysqli,"categoria_padre");
				
				$n=filas($sql);
				while($reg=datos($sql)){
				?>
				<div class="col-lg-4 col-sm-4 col-xs-6">
					<a href="categoria-p.php?tag_p=<?= $reg['id_catpadre'];?>">
						<div class="c_special">
							<div class="w_list div_colecciones">
								<i class="history_pi32" style="background-image: url(img/categorias/<?echo $reg['imagen'];?>);"></i>
								<div class="img-anuncio-min c_div_img">
									<img class="c_list_img img-div-min img-responsive" src="img/categorias/<?= $reg['imagen'];?>">
								</div>
								<div class="texto_centrado_div">
									<p class="p-coleccion"><?= $reg['nombre'];?></p>
								</div>
							</div>
							
						</div>
					</a>
				</div>
				<?php }?>
				
			</div>
		</div>
	</section>
			<div class="flotantecat">
                <div class="">
				<h5 class="text-center">Busque por Colecciones:</h5>
				
				<?php 
				//Seleccionamos las categorías padre para la colección
				
				$sqlcatp=q($mysqli,"SELECT * FROM categoria_padre");

				$ncatp=filas($sqlcatp);

				while($regcatp=datos($sqlcatp)){
				$productoscat = str_replace(" ", "-", $regcatp['nombre']);
				
				?>
					<div class="catmin">
						<a href="categoria-p.php?tag_p=<?= $regcatp['id_catpadre'];?>&productos=<?= $productoscat?>">
							<div class="c_special">
								<div class="w_list2 div_colecciones">
									<div class="img-anuncio-min c_div_img">
										<img class="c_list_img img-div-min img-responsive" src="img/categorias/<?= $regcatp['imagen'];?>">
									</div>
									<div class="texto_centrado_div">
										<p class="p-coleccion"><?= $regcatp['nombre'];?></p>
									</div>
								</div>
								
							</div>
						</a>
					</div>
				<?php }?>

				</div>
			</div>
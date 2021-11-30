<?php 
while ($reg=datos($publicacion)) {
	$estado=$reg['estado'];
	if($estado==1){
?>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 history_cat">
			<?php 
			$id_prod = $reg['user_id'];
			
			$empresa = str_replace(" ", "-", $reg['nombre']." en ".$reg['distrito']);
			
			$dprecio = $reg['precio'];
			$dprecio_oferta = $reg['precio_oferta'];

			if($dprecio>0){
				$x = ($dprecio_oferta * 100)/$dprecio;
				$d = 100 - $x;
			}
			//Validamos el tipo de definición de parametros para redireccionar
			if(isset($busqueda)){
			?>
			<a class="c_list ultimos-a-div" href="producto.php?id=<?=$reg['id']?>&busqueda=<?=$busqueda?>&producto=<?=$empresa?>" title="<?=$reg['nombre']?>">

			<?php }elseif(!isset($tag_p)){?>

			<a class="c_list ultimos-a-div" href="producto.php?id=<?=$reg['id']?>&tag=<?=$reg_tag['id_cathija'] ?>&producto=<?=$empresa?>" title="<?=$reg['nombre']?>">
			
			<?php }else{?>

			<a class="c_list ultimos-a-div" href="producto.php?id=<?=$reg['id'];?>&tag_p=<?=$reg_tag['id_catpadre']; ?>&producto=<?=$empresa?>" title="<?=$reg['nombre']?>">
			
			<?php }?>
			
				<div class="w_list">
					<?include("resource/traer_img.php")?>

					<i class="history_pi32" style="background-image: url(img/anuncios/<?=$imgpic?>);"></i>
					<div class="img-anuncio-min c_div_img" >
						<img class="c_list_img img-div-min img-responsive" src="img/anuncios/<?=$imgfigure?>">

						<?if($dprecio_oferta>0){?>
						<span class="ofert_text"><?="-".ceil($d)."%"?><span> dscto.</span></span>
						<?}?>

					</div>
					<div class="c_list_info">
							<div class="c_list_price_w">
								
								<span class="c_description"><?=$reg['nombre']?></span>
								
								<?if($reg['precio_oferta']>0){?>
								<span class="c_list_price">Oferta: <span>S/.<?=$reg['precio_oferta']?></span></span>
								<span class="c_list_first_price">Normal: S/.<?=$reg['precio']?></span>
								<?}else{?>
								<span class="c_list_price">Precio: <span>S/.<?=$reg['precio']?></span></span>
								<?}?>	
								<span class="c_distrito"><span class="glyphicon glyphicon-globe"></span> <?=$reg['distrito'] ?></span>
							</div>
						</div>
				</div>
			</a>
		</div>
<?}}?>

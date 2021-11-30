<header>
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v4.0&appId=1635811606669620&autoLogAppEvents=1"></script>

		<!--Header superior logo-->

		<div id="h_1" class="container">
			<div class="logo logo_icon">
				<a href="index.php" title="Bienvenido a Vendelo en el Valle">
				<figure class="w_list2 logo-center">
					<div class="img-anuncio-min c_div_img">
						<img class="c_list_img img-div-min img-responsive" src="img/logo.jpg" >
					</div>
				</figure>
				</a>
			</div>
			
			<div class="box_search">
				<form id="formq" action="busqueda.php" class="form_buscar" method="get" role="search">
					<input type="text" placeholder="¡Hola! ¿Qué producto estás buscando?" class="inp_search buscar" id="buscar" name="busqueda">
					<input type="submit" value="" class="inp_btn" >
				</form>
			</div>
		
			<div class="nav_1 nav_admin">
				<ul>
					<li class="menu_text"><a class="btn-publicar" href="publicar.php" title="Publicar anuncio">PUBLICAR ANUNCIO</span></a></li>
					<li class="buscar_icon">
						<a href="javascript:void(0);" title="Buscar Producto"></a>
					</li>
				</ul>
			</div>
		</div>

		<!--Header Menú-->
		<div id="h_2" class="h_2">
			<div class="container">
				<nav id="menu">
					<div class="item_menu item_flecha menu_active">
						<a href="javascript:void(0);" class="item_p"><span class="glyphicon glyphicon-shopping-cart visible-inline-xs visible-inline-md"></span> Productos</a>
						
						<div class="submenu_lvl_01">
							<?php
							//Menú para Productos
							//Obtenemos 
							$sql =listar($mysqli,"categoria_padre");
							$n=filas($sql);
							
							while ($nsql=datos($sql)) { 
								include("resource/menu-productos.php");		   
							?>
							<div class="item_submenu_lvl_01">

								<a href="javascript:void(0);" class="item_ap item_a "><?= $rowp['nombre']; ?> (<?= $n_sum1?>)</a>

								<div class="submenu_lvl_02">
									<div class="submenu_lvl_02_interno ">
										<a class="ircatp" href="categoria-p.php?tag_p=<?= $rowp['id_catpadre'] ?>"><h3><?= $rowp['nombre'] ?></h3></a>
										<ul>
											<?php
											//Creamos el ciclo para enlistar las subcategorias

											while ($row=datos($sql_h1)){
												$id_cathija=$row['id_cathija'];

												$num=q($mysqli,"SELECT * FROM anuncios WHERE categoriahija_id=$id_cathija and estado=1");
											?>
												<li class="item_submin"><a href="categoria.php?tag=<?=$row['id_cathija']?>&categoria=<?= str_replace(" ","-", $row['nombre'])?>" class="item_a"><?=$row['nombre']?><span class="total-cat">(<?=filas($num)?>)</span></a></li>
											<?php }?>
										</ul>
									</div>
								</div>
							</div>
							<?}?>
						</div>
					</div>
					
					<div class="item_menu">
						<a href="index.php" class="item_hid"><span class="glyphicon glyphicon-th-large visible-inline-xs"></span> Página Principal</a>
					</div>
					
					<div class="item_menu item_flecha item_fblack">
						<a href="javascript:void(0);" class="item_p"><span class="glyphicon glyphicon-globe visible-inline-xs"></span> Distritos</a>
						<div class="submenu_lvl_01 no-items">
							<div class="item_submenu_lvl_01">
								<a href="busqueda.php?busqueda=ascope" class="item_ap item_a ">Ascope</a>
							</div>
							<div class="item_submenu_lvl_01">
								<a href="busqueda.php?busqueda=cartavio" class="item_ap item_a ">Cartavio</a>
							</div>
							<div class="item_submenu_lvl_01">
								<a href="busqueda.php?busqueda=casagrande" class="item_ap item_a ">Casagrande</a>
							</div>
							<div class="item_submenu_lvl_01">
								<a href="busqueda.php?busqueda=chocope" class="item_ap item_a ">Chocope</a>
							</div>
							<div class="item_submenu_lvl_01">
								<a href="busqueda.php?busqueda=paijan" class="item_ap item_a ">Paijan</a>
							</div>
							<div class="item_submenu_lvl_01">
								<a href="busqueda.php?busqueda=puerto%20malabrigo" class="item_ap item_a ">Puerto Chicama</a>
							</div>
						</div>
					</div>
					
					<div class="item_menu">
						<a href="publicar.php"  class="item_hid"><span class="glyphicon glyphicon-log-in visible-inline-xs"></span> Publicar Anuncio</a>
					</div>
				</nav>
				<button class="navbar_toggle">
					<span class="icon_bar"></span>
					<span class="icon_bar"></span>
					<span class="icon_bar"></span>
				</button>
			</div>
		</div>
		<div id="buscar_min">
				<div class="box_search">
					<form id="formq" action="busqueda.php" class="form_buscar" method="get" role="search">
						<input type="text" placeholder="¡Hola! ¿Qué producto estás buscando?" class="inp_search buscar" id="buscar" name="busqueda">
						<input type="submit" value="" class="inp_btn" >
					</form>
				</div>
				<?php 
				//Mostramos las colecciones en el buscador versión móvil
				include("resource/colecciones-buscar-movil.php")?>
		</div>
	</header>
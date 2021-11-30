<?php
if(!isset($_GET['ck']) || empty($_GET['ck'])){
	header('Location:index.php');
}
session_start();
include("resource/conexion.php");

$ck=intval($_GET['ck']);

//Validamos si el código existe
$controlador=q($mysqli,"SELECT * FROM anuncios WHERE codigo=$ck");
$resp=filas($controlador);
$reg=datos($controlador);

if($resp==0){
	header("Location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
	<?php include("template/head.php"); ?>
	<style>
	.input-img{
		background: url(img/img-imput.jpg) no-repeat 100% -3px;   
		width: 165px;
		height: 160px;
		border: 1px dashed #1D6DA6;
		overflow: hidden;
	}		   
	.input-img-min {
		background: url(img/img-imput-min.jpg) no-repeat 100% -3px;
		width: 76px;
		height: 74px;
		margin-left: 10px;
		margin-bottom: 10px;
		border: 1px dashed #1D6DA6;
		overflow: hidden;
	}
	#list, #list2, #list3{
		height: 160px;
		position: relative;
		top: -87px;
		width: 165px;
	}
	#list4{
		height: 74px;
		position: relative;
		top: -87px;
		width: 46px;
	}
	.list-preview, .list-preview-min{
		position: absolute;
		z-index: 1;
	}
	.list-preview-min{
		left: 15%;
		top: -32%;
	}
	.thumb {
		width: 165px;
		height: 160px;   
	}
	.thumb-min {
		position: relative;
		height: 74px;
		top: 27px;
		width: 76px;
		z-index: 1;
	}
	
	.files, .files-min{
		cursor:pointer;
		opacity: 0;
		filter:alpha(opacity=0);
	}
	.files{
		width: 79px;
		height: 86px;
		position: relative;
		left: 35px;
		top: 32px;
		z-index: 9999;
	}

	.files-min{
		width: 55px;
		height: 60px;
		position: relative;
		top: 16px;
		z-index: 9999;

	}
	.files-2-edit{
		position: absolute;
		float: right;
		z-index: 10;
		padding: 10px;
		bottom: 79%;
		right: -5%;
	}
	.files-2, .files-2-min{
		position: relative;
		float: right;    
		z-index: 1;
		padding: 10px;
	}
	.files-2{
		bottom:105%;
		left: 4%;
	}
	.files-2-min{
		bottom: 77%;
		left: 88%;
	}
	.files-2-min-edit{
		position: absolute;
		float: right;
		z-index: 10;
		padding: 10px;
		bottom: 21%;
		left: 51%;
	}
	.files-2:hover, .files-2-min{
		opacity: 0.7;
	}
	.files-a{
		position: relative;
		z-index: 99;
		float: right;
	}
	.button-img{
		background-image: url(img/iconocerrar.png);
		background-color: transparent;
		background-repeat: no-repeat;
		border: 0;
		position: relative;
		left: 5px;
		top: 4px;
		width: 28px;
	}
  
  	</style>
  
</head>
<body>

	<?php include("template/header.php");?>
  
	<div class="container container_top">
		<div class="row">
			<section id="admin-post" class="container_sub">
				<div class="col-sm-12 col-xs-12">
					<?if(isset($_SESSION['sms'])){?>
					<!--Mensaje de acciones-->
					<div class="alert alert-<?php echo $_SESSION['sms-type']?> alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2><?php echo $_SESSION['sms'];
						unset($_SESSION['sms']);
						unset($_SESSION['sms-type']);
						?></h2>
					</div><br>
					<?}?>

					<button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">x  ELIMINAR ANUNCIO</button>
					<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel" style="color:brown">¡Advertencia!</h4>
							</div>
							<div class="modal-body">
							<form method="post" action="action/eliminar-anuncio.php" enctype="multipart/form-data">
							<input type="hidden" name="codigo_hdn" value="<?php echo $reg['codigo']?>">
							<input type="hidden" name="delete_hdn" value="<?php echo $reg['codigo']-2368; ?>">
							<div class="form-group">
									<p class="modal-p-adv">¡Felicitaciones! si está aquí es porque ya vendio su articulo. Al dar click en "ELIMINAR ANUNCIO" su anuncio será borrado del sitio web. ¿Desea realmente eliminar su anuncio?</p><br><br>
									<input type="submit" class="form-control btn btn-danger" value="x  ELIMINAR ANUNCIO">
							</div>
							</form>
							</div>
						</div>
					</div>
					</div><br>
					<form id="publicar_form" class="form-horizontal" method="post" action="action/producto-editar.php" enctype="multipart/form-data">
						<div class="marco">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="id">*ID Anuncio:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-anuncio" name="id" id="id" value="<?=$reg['id']; ?>" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="categoriahija">*Seleccionar Subcategoria</label>
								<div class="col-sm-5">
									<?php 
									//Seleccionamos la categoría hija
									$categoriahija_id=$reg['categoriahija_id'];

									$sql=q($mysqli,"SELECT * FROM categoria_hija WHERE id_cathija=$categoriahija_id");

									$reg_edit_q=datos($sql);
									$obten_h = filas($sql);
									$id_cathija=$reg_edit_q['id_cathija'];
									$nombre_cathija=$reg_edit_q['nombre'];
									$catpadre_id=$reg_edit_q['catpadre_id'];

									$sql_cathija=q($mysqli,"SELECT * FROM categoria_hija WHERE catpadre_id=$catpadre_id");
									?>

									<select class="form-control form-control-anuncio" name="categoriahija" id="categoriahija" required>
										
										<option value="">- Seleccionar una categoria -</option>
										<?php
										//Colocamos la categoría según corresponda
										while($reg_edit_slc=datos($sql_cathija)){
											if($id_cathija!=$reg_edit_slc['id_cathija']){
											?>
												<option value="<?=$reg_edit_slc['id_cathija']?>"><?=$reg_edit_slc['nombre'];?></option>
												<?continue;
											}else{
										?>
											<option value="<?=$reg_edit_q['id_cathija']?>" selected><?=$reg_edit_q['nombre'];?></option>
										<?php }
										}?>
									</select>
								</div>
								<?php 
								//Mostramos la categoría padre

								$sql2=q($mysqli,"SELECT * FROM categoria_padre WHERE id_catpadre=$catpadre_id");

								while($reg2=datos($sql2)){
								?>
								<p class="help-block col-sm-4">Categoria: <?=$reg2['nombre']?></p>
								<?php }?>	
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="name">Tú nombre*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-anuncio" name="name" id="name" value="<?=$reg['name_n']?>" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="correo">Tú correo*</label>
								<div class="col-sm-5">
									<input type="email" class="form-control form-control-anuncio" name="correo" id="correo" value="<?=$reg['correo']?>" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="name">Tú teléfono de contacto(opcional)</label>
								<div class="col-sm-5">
									<input type="number" class="form-control form-control-anuncio" name="telefono"  value="<?=$reg['telefono']?>" id="telefono">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="nombre">*Nombre de su Producto:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-anuncio" name="nombre" id="nombre" value="<?=$reg['nombre']; ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nombre">Distrito*</label>
								<div class="col-sm-5">
									<select class="form-control form-control-anuncio"  name="distrito" id="distrito" required>
											<option value="<?=$reg['distrito']; ?>"><?=$reg['distrito']; ?></option>
											<option value="">--Distrito--</option>
											<option class="text-uppercase" value="Ascope">Ascope</option>
											<option class="text-uppercase" value="Cartavio">Cartavio</option>
											<option class="text-uppercase" value="Casagrande">Casagrande</option>
											<option class="text-uppercase" value="Chicama">Chicama</option>
											<option class="text-uppercase" value="Chiclin">Chiclin</option>
											<option class="text-uppercase" value="Chocope">Chocope</option>
											<option class="text-uppercase" value="Paijan">Paijan</option>
											<option class="text-uppercase" value="Puerto Malabrigo">Puerto Malabrigo</option>
											<option class="text-uppercase" value="Roma">Roma</option>
											<option class="text-uppercase" value="Santiago de Cao">Santiago de Cao</option>
											<option class="text-uppercase" value="Sintuco">Sintuco</option>
											<option class="text-uppercase" value="Otra localidad">Otra localidad</option>
										</select>
								</div>
							</div>

							<div class="form-group" id="focus_descripcion">
								<label class="col-sm-3 control-label">*Describa en detalle su Producto, Servicio u Oferta:</label>
								<div class="col-sm-5">
									<textarea class="form-control form-control-anuncio resize-v" name="descripcion" id="descripcion" rows="9" ><?=$reg['descripcion']; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-4 col-xs-12">
									<label class="control-label grey">
									Agrega Fotos
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-4 col-xs-12">
									<label class="control-label grey">
									foto actual Imagen 1
									</label>
									<figure class="img-categoria">
										<?php 
										//Validamos si existe imagen 1
										if (!empty($reg['imagen1'])){?>

										<img src="img/anuncios/<?=$reg['imagen1'] ?>" title="<?=$reg['imagen1'] ?>">

										<?php }else{?>

										Sin imagen

										<?php }?>
									</figure>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Subir nueva imagen:</label>
								<div class="col-sm-2 col-xs-12">
									<input type="file" onchange="valida(this)" name="img_anuncio_fls" accept="image/jpeg" />
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-4 col-xs-12">
									<label class="control-label grey">
									foto actual Imagen 2
									</label>
									<figure class="img-categoria">
										<?php 
										//Validamos si existe imagen 2
										if (!empty($reg['imagen2'])){?>

											<img src="img/anuncios/<?=$reg['imagen2'] ?>" title="<?=$reg['imagen2'] ?>">

										<?php }else{?>
											Sin imagen
										<?php }?>
									</figure>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Subir nueva imagen:</label>
								<div class="col-sm-2 col-xs-12">
									<input type="file" onchange="valida(this)" name="img_anuncio2_fls" accept="image/jpeg" />
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-4 col-xs-12">
									<label class="control-label grey">
									foto actual Imagen 3
									</label>
									<figure class="img-categoria">
										<?php 
										//Validamos si existe imagen 3
										if (!empty($reg['imagen3'])){?>
										
										<img src="img/anuncios/<?=$reg['imagen3'] ?>" title="<?=$reg['imagen3'] ?>">

										<?php }else{?>

										Sin imagen

										<?php }?>
									</figure>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Subir nueva imagen:</label>
								<div class="col-sm-2 col-xs-12">
									<input type="file" onchange="valida(this)" name="img_anuncio3_fls" accept="image/jpeg" />
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="col-sm-offset-3">
									<small class="help-block">El formato aceptado para las imagenes es JPG. El tamaño máximo permitido para cada imagen es 10 MB.</small>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="precio">*Precio Normal S/:</label>
								<div class="col-sm-5">
									<input type="number" step="0.01" class="form-control form-control-anuncio" name="precio" id="precio-normal" value="<?=$reg['precio']; ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="precio-oferta">*Precio Oferta S/ (Coloca un precio, sólo si es una oferta):</label>
								<div class="col-sm-5">
									<input type="number" step="0.01" class="form-control form-control-anuncio" name="precio-oferta" id="precio-oferta" value="<?=$reg['precio_oferta']; ?>">
								</div>
							</div>
							
							<input type="hidden" name="codigo" value="<?=$reg['codigo']-1234;?>">
							<input type="hidden" name="cid" value="<?=$reg['id']?>">
							<div class="form-group">
								<div class="col-sm-5 col-sm-offset-3">
									<input type="submit" id="send" class="form-control form-control-anuncio btn btn-primary btn-form" value="ACTUALIZAR">
								</div>
							</div>
						</div>
					</form>
					<div id="wsms">
						<div id="_GOS_">
							<div id="_AJAX_">
								<div class="alert">
									<span class="tecla">Guardando...</span> 
									<p> Subiendo sus fotos. Solo tomará unos segundos. Porfavor espere. </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div> 
	<?php include("template/footer.php"); ?>
  
	<script>
	$(document).on('ready', function(){

		//Para validar el formulario y mostrar el mensaje de envio
		$( '#_GOS_' ).draggable({
			addClasses: false,
			containment: "body"
		});

		$(".btn_close").click(function(){
			$("#wsms").removeClass('mostrar_gos');
			return false;
		});

		$("#send").click(function(){

			var name, correo, telefono, distrito, categoriahija, user, nombre, descripcion, keywords, img_anuncio_fls, img_anuncio2_fls, img_anuncio3_fls, precio, form, connect, result;

			var focus_descripcion;

			function ir(i){
			$('html, body').animate({
				scrollTop: $(i).offset().top - 100}, 500);
			}

			var verificar = true;
			var expRegNombre = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
			var expRegEmail=/^[\w\.]+@([\w-]+\.)+[\w-]{2,4}$/;


			trae = document.getElementById('trae');
			categoriahija = document.getElementById('categoriahija');
			nombre = document.getElementById('nombre');
			name = document.getElementById('name');
			correo = document.getElementById('correo');
			telefono = document.getElementById('telefono');
			distrito = document.getElementById('distrito');
			user = document.getElementById('user');
			descripcion = document.getElementById('descripcion');
			keywords = document.getElementById('keywords');
			
			precio = document.getElementById('precio-normal');
			precio_oferta = document.getElementById('precio-oferta');



			focus_descripcion = document.getElementById('focus_descripcion');

			if (categoriahija.value=="") {
			alert("Porfavor seleccione una Categoria");
			ir(categoriahija);
			categoriahija.focus();
			return false;
			}else if (name.value==""){
			alert("Porfavor coloque su nombre");
			ir(name);
			name.focus();
			return false;
			}else if (correo.value==""){
			alert("Porfavor coloque su correo");
			ir(correo);
			correo.focus();
			return false;
			}else if (distrito.value==""){
			alert("Porfavor coloque su distrito");
			ir(distrito);
			distrito.focus();
			return false;
			}else if (nombre.value==""){
			alert("Porfavor coloque el nombre de su Producto, Servicio u Oferta");
			ir(nombre);
			nombre.focus();
			return false;
			}else if (descripcion.value==""){
			alert("Porfavor describa su su Producto, Servicio u Oferta");
			ir(focus_descripcion);
			$('#focus_descripcion .nicEdit-main').focus();
			return false;
			}else if (precio.value=="" || precio.value < 1){
			alert("Porfavor coloque un Precio");
			ir(precio);
			precio.focus();
			return false;
			}else if (precio_oferta.value >= precio.value ){
			alert("El precio de oferta no puede ser mayor o igual al precio normal");
			ir(precio_oferta);
			precio_oferta.focus();
			return false;
			}else if (precio_oferta.value == "0"){
				alert("El precio de oferta no puede ser cero");
				ir(precio_oferta);
				precio_oferta.focus();
				return false;
			}else if(precio_oferta.value == ""){
				return true;
			}

		});
		document.querySelector('#publicar_form').addEventListener('submit',sendForm,false);

		function sendForm(){
			$('#wsms').addClass('mostrar_gos');
		}
	});
	</script>
	
	<script>
	//Función para validar subida de archivos
	function valida(f){

		if(f.files.length==1){
		if(f.files[0].size<10485760){
		var ext=['jpg','jpeg'];
		var v=f.value.split('.').pop().toLowerCase();
		for(var i=0,n;n=ext[i];i++){
			if(n.toLowerCase()==v)
			return
		}
		var t=f.cloneNode(true);
		t.value='';
		f.parentNode.replaceChild(t,f);
		alert('extensión no válida');
		}else{
			f.value="";
			alert('El tamaño maximo es 10MB');
		}
		}else{
		f.value="";
		alert('seleccione solo un archivo');
		}
	}
	</script>

	<?php include("template/script-editar-anuncio.php"); ?>

	<!--Editor de Texto para descripción-->
	<script  src = "js/nicedit/nicEdit.js" ></script>

	<script type="text/javascript">
	bkLib.onDomLoaded(function() { 
		new nicEditor({buttonList: ['bold', 'italic', 'underline', 'ul', 'strikeThrough', 'indent', 'outdent', 'link', 'unlink', 'subscript', 'superscript']}).panelInstance('descripcion');
	});
	</script>

</body>
</html>

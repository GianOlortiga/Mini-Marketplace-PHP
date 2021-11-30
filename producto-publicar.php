<?php
session_start();
include("resource/conexion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
	<?php include("template/head.php"); ?>
	<style>
		#publicar_form .control-label{
			font-size:17px;
		}
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

       /*	.thumb, .thumb-min{
        	z-index: -99;
       	}
      */
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
					<!--Mensajes-->
					<div class="alert alert-<?= $_SESSION['sms-type']?> alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2><?= $_SESSION['sms'];
						unset($_SESSION['sms']);
						unset($_SESSION['sms-type']);
						?></h2>
					</div><br>
					<?}?>

					<div id="selec-cat">
						<h2>Publica tús productos ¡GRATIS!</h2>
						<br>
					</div>

					<form id="publicar_form" class="form-horizontal" method="post" action="action/producto-publicar.php" enctype="multipart/form-data">
						<div class="marco"><br><br>
							
							<div class="form-group">
								<label class="col-sm-3 control-label" for="categoriahija">Seleccione una Categoria*</label>
								<div class="col-sm-5">
									<?
									$cat= intval($_GET['cat']);
									$sql=q($mysqli,"SELECT * FROM categoria_hija WHERE catpadre_id LIKE $cat ORDER BY nombre");
									?>
									<select class="form-control form-control-anuncio name_categoria" name="categoriahija" id="categoriahija" required>
										<option value="">- Seleccione una subcategoria -</option>
									<?
									while($reg=datos($sql)){
									?>
										<option class="text-capitalize" value="<?=$reg['id_cathija']?>"><?=$reg['nombre'];?></option>
									<?	
									}
									?>
									</select>
								</div>
									<?
									$sql2=q($mysqli,"SELECT * FROM categoria_padre WHERE id_catpadre=$cat");
									while($reg2=datos($sql2)){
									?>
										<p class="help-block col-sm-4">Estás en la Categoria: <?=$reg2['nombre']?></p>
									<?
									}
									?>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="name">Tú nombre*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-anuncio" name="name" id="name" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="correo">Email de contacto*</label>
								<div class="col-sm-5">
									<input type="email" class="form-control form-control-anuncio" name="correo" id="correo" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="name">Whatsapp de contacto(opcional)</label>
								<div class="col-sm-5">
									<input type="number" class="form-control form-control-anuncio" name="telefono" id="telefono">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nombre">Nombre de tú Producto*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control form-control-anuncio" name="nombre" id="nombre" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="descripcion">Descripción de tú producto*</label>
								<div class="col-sm-5">
									<textarea class="form-control form-control-anuncio" name="descripcion" id="descripcion" cols="30" rows="10" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nombre">Distrito*</label>
								<div class="col-sm-5">
									<select class="form-control form-control-anuncio"  name="distrito" id="distrito" required>
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
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Agrega fotos:</label>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
										<div class="input-img">
											<input class="files" type="file" id="img_anuncio" onchange="valida(this)" name="img_anuncio_fls" accept="image/jpeg" />
											<div id="list"></div>
										</div>			
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
										<div class="input-img">
											<input class="files" type="file" id="img_anuncio2" onchange="valida(this)" name="img_anuncio2_fls" accept="image/jpeg" />
											<div id="list2"></div>
										</div>			
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
										<div class="input-img">
											<input class="files" type="file" id="img_anuncio3" onchange="valida(this)" name="img_anuncio3_fls" accept="image/jpeg" />
											<div id="list3"></div>
										</div>			
									</div>
							</div>
							<br>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="precio">Precio de tú producto S/.*</label>
								<div class="col-sm-5">
									<input type="number" step="0.01" class="form-control form-control-anuncio" name="precio" id="precio-normal" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label" for="precio-oferta">Si deseas brinda un precio de Oferta S/.</label>
								<div class="col-sm-5">
									<input type="number" step="0.01" class="form-control form-control-anuncio" name="precio-oferta" id="precio-oferta" >
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-5 col-sm-offset-3">
									<input type="submit" class="form-control form-control-anuncio btn btn-primary btn-form" id="send" value="PUBLICAR PRODUCTO">
									<small>Al Publicar aceptas los <a href="#" class="action-y">Términos y Condiciones</a></small>
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
		//Para mostrar y validar la información del formulario
		$( '#_GOS_' ).draggable({
			addClasses: false,
			containment: "body"
		});

		$(".btn_close").click(function(){
			$("#wsms").removeClass('mostrar_gos');
			return false;
		});

		//Validamos Formulario 
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
			}
			else if (correo.value==""){
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
			alert("Porfavor coloque el nombre de su Producto");
			ir(nombre);
			nombre.focus();
			return false;
			}else if (descripcion.value==""){
			alert("Porfavor coloque una descripción de su Producto");
			ir(descripcion);
			descripcion.focus();
			return false;
			}
			else if (precio.value=="" || precio.value < 1){
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
	//Función para validar la imagen 
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
	<?php 
	//Script para mostrar el previuw de la imagen
	include("template/script-publicar-anuncio.php"); 
	?>
</body>
</html>
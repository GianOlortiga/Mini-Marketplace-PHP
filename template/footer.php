	
	<div id="btn-social">
		<div class="fb-like" data-href="https://facebook.com/mivallechicama" data-width="" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true"></div>
		<button class="shared">Compartir</button>
	</div>
	
	<div id="ir_arriba">
		<img src="img/icono-arriba2.png" alt="">
	</div>

	<div id="fondo"></div>

	<?php include("resource/info-terminos.php");?>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div id="logo_footer">
						<img src="img/logo.jpg" alt="Logo">
					</div>
					<h4>Vende lo que ya no uses con gente de nuestro Valle Chicama.</h4>
				</div>
				<div class="col-sm-3">
					<h3>De Interés</h3>
					<ul>
						<li><a href="publicar.php" >Publica tú anuncio</a></li>
						<li><a href="#" class="action-y">Términos y Condiciones</a></li>
					</ul>
				</div>
				<div class="col-sm-3">
					<h3>Servicios</h3>
					<ul>
						<li><a href="#" title="Da click para más información">Creación de Sitios Web</a></li>
						<li><a href="#" title="Da click para más información">Correos Corporativos</a></li>
					</ul>
				</div>
				<div class="col-sm-3">
					<h3>Contáctanos</h3>
					<p>
						<span class="glyphicon glyphicon-envelope glyphicon-sep"></span> Correo: <a href="mailto:gocomputersystem@gmail.com" title="Escríbenos al correo">gocomputersystem@gmail.com</a>
					</p>
					<p>
						<span class="glyphicon glyphicon-user"></span> Whatsapp: <a href="https://wa.me/51927858685" target="_blank" title="Escríbenos al Whatsapp">927858685</a>
					</p>
					<ul class="social_icons">
						<li><a href="https://facebook.com/mivallechicama" target="_blank"><img src="img/fb.png" title="Siguenos en facebook"></a></li>
					</ul>
				</div>
			</div>
			<hr class="dotted">
			<div class="row">
				<p class="copy">© Copyright <span class="fecha"></span>. Todos los derechos reservados | Creado por <a href="https://facebook.com/jolortigasaucedo" title="Desarrollo Web Profesional">Gian Olórtiga</a></p>
			</div>
		</div>
	</footer>

	<script src="assets/js/jquery-2.1.4.min.js"></script>
	<script src="assets/js/jquery-ui.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	
	<script src="assets/slick/slick.min.js" type="text/javascript" charset="utf-8"></script>
	
	<script>
	//Para el previuw del buscador al teclear
	$(function() {
		var availableTags=new Array(<?php echo $arreglo; ?>);
				
		$(".buscar").autocomplete({
			source: availableTags
		});
	});

	//Efectos Scroll del Menú Principal
	$(window).scroll(function(){
		if($(this).scrollTop() > 50){
			$(".logo figure").addClass("logo_min");
			$(".box_search").addClass("box_search_top");
			$(".nav_1 ul").addClass("nav_1_ul");
			$(".s_dimensiones .slick-dots").css("top", "42px");
			$("#h_1").css("height","60px");
			$(".logo-center .img-anuncio-min").css("height","60px");
			$(".navbar_toggle").css("top","10px");
		}else{
			$(".logo figure").removeClass("logo_min");
			$(".box_search").removeClass("box_search_top");
			$(".nav_1 ul").removeClass("nav_1_ul");
			$(".s_dimensiones .slick-dots").css("top", "48px");
			$("#h_1").css("height","70px");
			$(".logo-center .img-anuncio-min").css("height","70px");
			$(".navbar_toggle").css("top","15px");
		}
	});

	</script>
	<script>
	$(document).on('ready', function(){
		//Variables para las ventanas poppup ocupen cierto ancho y alto
	    var ancho = $(window).width();
  		var alto = $(window).height();
  		var top = $(window).height() / 3;
  		var left = $(window).width() / 3; 
		
		//Compartir en facebook
	    $(".shared").click(function(){
	    		var centrar = "width=400,height=400,left=" + left + ",top=" + top;
	      		open('https://www.facebook.com/sharer.php?u=<?echo $sitio_web?>','',centrar);
	    });

		//Mostrar y cerrar Ventana de Terminos y condiciones
	    $(".action-x").click(function(e){
	    		e.preventDefault();
	    		$(".hidden-x").addClass("visible-x");
	    });
	    $(".action-y").click(function(e){
	    		e.preventDefault();
	    		$(".hidden-y").addClass("visible-y");
	    });
	    $(".btn_close_info").click(function(){
	    		 $(".hidden-x").removeClass("visible-x");
	    		 $(".hidden-y").removeClass("visible-y");
	    });

		//Colocar año en footer
		var fecha = new Date();
		var anio = fecha.getFullYear();
		$(".fecha").text(anio);

		//Efector de Menú Principal
		$(".item_a").hover(function(){
			$(".item_a").removeClass("item_hover");
			$(this).addClass("item_hover");
			
		});
		$(".item_ap").hover(function(){
			$(".item_ap").removeClass("item_active");
			$(this).addClass("item_active");
		});
		$(".item_p").hover(function(){
			$(".item_a").removeClass("item_active");
			$("#fondo").fadeIn();
		});
		$("#h_1").hover(function(){
			$("#fondo").fadeOut();
		});
		$(".item_hid").hover(function(){
			$("#fondo").fadeOut();
		});
		$(".nf a").hover(function(){
			$("#fondo").fadeOut();
		});
		$("#fondo").hover(function(){
			$("#fondo").fadeOut();
		});

		//Efecto de Menú Hamburguesa
		var opennav;
		opennav = 0;
		$('.navbar_toggle').click(function(){
				if(opennav == 0){
					$('#h_2').css('left','0');
		  			$(this).removeClass('mclose');
			  		$(this).addClass('mopen');
					$("#fondo").fadeIn();
					
			  		opennav = 1;
					 
			  	}else{
			  		if(opennav == 1){
						$('#h_2').css('left','-100%');
				  		$(this).removeClass('mopen');
				  		$(this).addClass('mclose');
						$("#fondo").fadeOut();
				  		opennav = 0;
			  		}
			  	}
		});

		//Buscador Movil
		var qopen;
		qopen = 0;
		$('.buscar_icon a').click(function(e){
			e.preventDefault();
				if(qopen == 0){
					$('#buscar_min').css('left','0');
					$(this).css('background','url(img/cerrar.png) no-repeat 13px 24px');
		  		qopen = 1;
					 
		  	}else{
		  		if(qopen == 1){
					$('#buscar_min').css('left','-100%');
					$(this).css('background','url(img/icon-buscar.png) no-repeat 14px 22px');
			  		qopen = 0;
		  		}
		  	}
		})

		//Icono ir a arriba
		$('#ir_arriba').click(function(){
			$('body, html').animate({
				scrollTop: '0px'
			}, 250);
			});
	
		$(window).scroll(function(){
			if( $(this).scrollTop() > 0 ){
				$('#ir_arriba').slideDown(300);
			} else {
				$('#ir_arriba').slideUp(300);
			}
		});
		//Logo Dragable
		$( '.logo_icon' ).draggable({
	         addClasses: false,
	         containment: "body"
	    });	
	});
	</script>
	<?php cerrar($mysqli)?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<?php 
include("resource/conexion.php");
include("template/head.php"); ?>
</head>
<body>
	<?php include("template/header.php");?>
	<div class="container container_top">
        <div class="row">
            <section id="admin-post" class="container_sub">
                <div class="col-sm-12 col-xs-12">
                    <div id="selec-cat">
                        <h2>Publica tus productos ¡GRATIS!. Elige la opción que deseas vender:</h2><br>
                    </div>
                    <div id="lista-categorias" class="row">
                    <?php
                    //Listamos las categorías padres
                    $sql=listar($mysqli,"categoria_padre");

                    $n=filas($sql);

                    while($reg=datos($sql)){
                    ?>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="categoria-publicar resultado-busqueda">
                                <a href="producto-publicar.php?cat=<?echo $reg['id_catpadre'];?>" class="ultimos-a-div">
                                    <div class="img-anuncio-min" >
                                            <img src="img/categorias/<?echo $reg['imagen'];?>" class="img-div-min">
                                    </div>
                                    <br>
                                    <div class="body-anuncio-min">
                                        <div class="container-titulo">
                                            <p><?echo $reg['nombre'];?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php }?>
                    </div>
                </div>
            </section>
        </div>
	</div>
	<?php include("template/footer.php"); ?>
</body>
</html>
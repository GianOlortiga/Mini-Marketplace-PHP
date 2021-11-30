<?php
$i = $nsql['id_catpadre'];	
							
//Preparamos la lista para cada categoría Padre

$sql_p1 = q($mysqli,"SELECT * FROM categoria_padre WHERE id_catpadre=$i");

$rowp=datos($sql_p1);
$id_catpadre = $rowp['id_catpadre'];

//Preparamos las categorias hijas de cada categoría Padre
$sql_h1 = q($mysqli,"SELECT * FROM categoria_hija WHERE catpadre_id=$id_catpadre");

//Seleccionamos los anuncios de las categorías hijas para sumar el total
$sql_sum1 = q($mysqli,"SELECT * FROM anuncios,categoria_hija WHERE categoriahija_id=id_cathija and catpadre_id=$id_catpadre and estado=1");

$n_sum1 = filas($sql_sum1);
$n_total = $n_sum1+$n_total;

$nombre_categoria = str_replace(" ", "-", $rowp['nombre']);	
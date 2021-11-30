<?php
//Esta consulta es para obtener las categorias e incluirlas en la barra de buscar al teclear
$query = q($mysqli,"SELECT * FROM categoria_hija");
while($row= datos($query)) {
      $elementos[]= '"'.$row['nombre'].'"';
      $cat_seo[]= $row['nombre'];
}
//junta los valores del array en una sola cadena de texto
$arreglo= implode(", ", $elementos);
$list_seo= implode(", ", $cat_seo);
<?php
if ($q_anuncios_reg['imagen1']){
    $imgpic = $q_anuncios_reg['imagen1'];
    $imgfigure = $q_anuncios_reg['imagen1'];
}elseif (empty($q_anuncios_reg['imagen1'])){
    $imgpic = $q_anuncios_reg['imagen2'];
    $imgfigure = $q_anuncios_reg['imagen2'];
}elseif (empty($q_anuncios_reg['imagen3'])){
    $imgpic = $q_anuncios_reg['imagen1'];
    $imgfigure =$q_anuncios_reg['imagen1'];
}else{
    $imgpic = "generica2.jpg";
    $imgfigure ="generica2.jpg";
}
?>
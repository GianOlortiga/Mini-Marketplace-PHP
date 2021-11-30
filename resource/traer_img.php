<?php
if ($reg['imagen1']){
    $imgpic = $reg['imagen1'];
    $imgfigure = $reg['imagen1'];
}elseif (empty($reg['imagen1'])){
    $imgpic = $reg['imagen2'];
    $imgfigure = $reg['imagen2'];
}elseif (empty($reg['imagen3'])){
    $imgpic = $reg['imagen1'];
    $imgfigure =$reg['imagen1'];
}else{
    $imgpic = "generica2.jpg";
    $imgfigure ="generica2.jpg";
}
?>
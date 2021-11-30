<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	<meta name="robots" content="index"/>
    <meta name="googlebot" content="index,follow"/>
    <link rel='shortcut icon' href=img/logo.png>
	<meta name="description" content="Bienvenido a Tienda del Valle. El lugar donde podras encontrar productos y ofertas con Delivery dentro del Valle Chicama"/>
    <meta name="keywords" content="productos para delivery, delivery valle chicama, delivery chocope, delivery casagrande, delivery cartavio, delivery paijan, delivery chicama, delivery ascope, delivery roma, directorio de empresas valle chicama, productos en el valle chicama, empresas en chocope, empresas en casagrande, empresas en cartavio, empresas en roma, empresas en chiclin, empresas en chicama, empresas en ascope, empresas en paijan, empresas en molino, empresas en farias, empresas en careaga, ofertas en el valle chicama , productos valle chicama, productos en chocope, productos en casagrande, productos en paijan, productos en cartavio, productos en chicama"/>
    <?
    include("../modulos/conexion.php");
    $ip = $_SERVER['REMOTE_ADDR'];
    mysql_query("INSERT INTO rob (ip, fecha) VALUES ('$ip',now())");
    ?>
    <title>Tienda del Valle | Un lugar creado para que encuentres Productos y Servicios con Delivery en el Valle Chicama</title>
    <style>
    *{margin:0;padding:0;}
    a{color:#fff}
    body{
        font-family: 'Lato',sans-serif;
        font-size: 19px;
        font-weight:300;
    }
    img{max-width:100%;}
    section{
        width:100%;
        height:100vh;
        display:flex;
        justify-content: center;
        align-content:center;
        text-align:center;
        color:#fff;
        background:#1a73e8;
        flex-direction:column;
    }
    articule{font-size: 26px;padding: 0 10%;}
    strong{font-weight:900;}
    #compartir{margin:5% 0}
    #logo{position:absolute;top:0;left:0;}
    #logo figure{padding: 10px;}
    #logo figure img{width:120px;}
    #delivery, #botones{width:100%;}
    #delivery figure{width:150px;margin: 7px auto;}
    #wboton{padding-top:20px;padding-bottom:20px;}
    .boton{
        display:block;
        margin:10px auto;
        background-color: #fff;
        color: #039be5;
        text-decoration: none!important;
        font-size: 20px;
        font-weight:400;
        letter-spacing: .21px;
        line-height: 16px;
        padding: 20px 52px;
        width: 200px;
        border-radius: 8px;
    }
    .boton:hover{background:rgba(255,255,255,.85);}
    .text{display: block;margin-bottom: 10px;}
    .hidden-xs{display:inline-block}
    .visible-xs{display:none}
    @media screen and (max-width: 1200px){
        section{height:auto;}
    }
    @media screen and (max-width: 768px){
        .hidden-xs{display:none}
        .visible-xs{display:inline-block}
    }
    @media screen and (max-width: 480px){
        articule{font-size:26px}
        .boton{padding: 17px 42px;}
    }
    @media screen and (max-width: 375px){
        articule{font-size:24px}
        .boton{padding: 17px 27px;font-size: 19px;}
    }
    </style>
</head>
<body>
    <!-- <div id="logo">
        <figure>
            <img src="img/logo.png" alt="Logo">
        </figure>
    </div> -->
    <section>
        <div id="delivery">
            <figure>
                <img src="../img/logo.png" alt="Delivery">
            </figure>
        </div>
        <articule>
            <strong>Ups</strong> si estás aquí es porque se ha activado un localizador de robo de Sistema. <strong>¡Haz robado mi proyecto!</strong> y serás denunciado como se debe. <strong>Tús datos</strong> ya fueron registrados ;)
        </articule>
        
    </section>
</body>
</html>
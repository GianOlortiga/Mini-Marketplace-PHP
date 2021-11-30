-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-11-2021 a las 03:53:00
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vendelovalle`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `categoriahija_id` int(11) NOT NULL,
  `categoria_hdn` text NOT NULL,
  `name_n` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `distrito` varchar(50) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `keywords` text NOT NULL,
  `imagen1` varchar(50) NOT NULL,
  `imagen2` varchar(50) NOT NULL,
  `imagen3` varchar(50) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `precio_oferta` decimal(5,2) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `codigo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id`, `categoriahija_id`, `categoria_hdn`, `name_n`, `correo`, `telefono`, `distrito`, `nombre`, `descripcion`, `keywords`, `imagen1`, `imagen2`, `imagen3`, `precio`, `precio_oferta`, `fecha_publicacion`, `user_id`, `estado`, `codigo`) VALUES
(92, 114, 'anuncios, productos Electrodomésticos en Chocope, Electrodomésticos Chocope, Electrodomésticos, ', 'Gian', 'gocomputersystem@gmail.com', '927858685', 'Chocope', 'Teclado USB de Segunda', 'Teclado USB de Segunda', '', '1617818029-1.jpg', '', '', '10.00', '0.00', '2021-04-07', 1, 1, 1622129247);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_hija`
--

CREATE TABLE `categoria_hija` (
  `id_cathija` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `catpadre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_hija`
--

INSERT INTO `categoria_hija` (`id_cathija`, `nombre`, `catpadre_id`) VALUES
(97, 'Accesorios', 21),
(99, 'Escolares', 21),
(100, 'Ferreterías', 21),
(101, 'Hogar', 21),
(102, 'Mascotas', 21),
(103, 'Perfumes', 21),
(104, 'Repuestos', 21),
(105, 'Ropa', 21),
(106, 'Tragos', 21),
(112, 'Muebles', 21),
(113, 'Celulares', 21),
(114, 'Electrodomésticos', 21),
(115, 'Otros', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_padre`
--

CREATE TABLE `categoria_padre` (
  `id_catpadre` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_padre`
--

INSERT INTO `categoria_padre` (`id_catpadre`, `nombre`, `imagen`) VALUES
(21, 'Productos', '1589750121-1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_pagina`
--

CREATE TABLE `categoria_pagina` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_pagina`
--

INSERT INTO `categoria_pagina` (`id`, `nombre`) VALUES
(1, 'Quienes Somos'),
(2, 'Servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias`
--

CREATE TABLE `denuncias` (
  `id_denuncia` int(11) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `anuncio_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `denuncias`
--

INSERT INTO `denuncias` (`id_denuncia`, `motivo`, `comentario`, `anuncio_id`) VALUES
(1, '-Tiene contenido ofensivo, de naturaleza racista, sexual u obsceno', 'es de contenido sexual', 11),
(2, '-Creo que es un intento de fraude', 'me parece sospechoso', 11),
(3, 'Array', 'fraude estimado', 11),
(4, 'Array', 'Ofensivo estimado', 11),
(5, '', 'sin terminos estimado', 11),
(6, 'Array', 'ofensivo', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE `distritos` (
  `id_distrito` int(11) NOT NULL,
  `distrito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id_distrito`, `distrito`) VALUES
(1, 'Ascope'),
(2, 'Careaga'),
(3, 'Cartavio'),
(4, 'Casagrande'),
(5, 'Chicama'),
(6, 'Chiclin'),
(7, 'Chocope'),
(8, 'Farias'),
(9, 'Magdalena'),
(10, 'Molino'),
(11, 'Paijan'),
(12, 'Roma'),
(13, 'Salamanca'),
(14, 'Sintuco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `keywords` text NOT NULL,
  `imagen` varchar(20) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `catpag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`id`, `titulo`, `descripcion`, `keywords`, `imagen`, `estado`, `catpag_id`) VALUES
(1, 'Quienes Somos', 'Tienda del Valle nace.....', 'tienda del valle chicama, productos', '1589932546-1.jpg', 1, 1),
(2, 'Tu propio Sitio Web', 'Te voy a brindar tu propio sitio web totalmente gratis', 'sitio web gratis', 'imagen2.jpg', 1, 2),
(5, 'prueba', 'prueba', '', 'generica.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rob`
--

CREATE TABLE `rob` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `mac` varchar(150) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rob`
--

INSERT INTO `rob` (`id`, `ip`, `mac`, `fecha`) VALUES
(1, '::1', '', '2020-05-19'),
(2, '::1', '', '2020-05-19'),
(3, '181.176.126.186', '', '2020-06-11'),
(4, '181.176.126.186', '', '2020-06-11'),
(5, '181.176.126.186', '', '2020-06-11'),
(6, '181.176.107.242', '', '2020-06-15'),
(7, '181.176.97.253', '', '2020-06-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `distrito` varchar(20) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `membresia` varchar(50) NOT NULL,
  `estado` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `pass`, `tipo`, `ruc`, `distrito`, `direccion`, `whatsapp`, `membresia`, `estado`) VALUES
(1, 'Admin Gian', 'gocomputersystem@gmail.com', 'computogianos', 1, '', 'Chocope', '', '927858685', '3', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoriah_anuncios` (`categoriahija_id`);

--
-- Indices de la tabla `categoria_hija`
--
ALTER TABLE `categoria_hija`
  ADD PRIMARY KEY (`id_cathija`),
  ADD KEY `categoriap_categoriah` (`catpadre_id`);

--
-- Indices de la tabla `categoria_padre`
--
ALTER TABLE `categoria_padre`
  ADD PRIMARY KEY (`id_catpadre`);

--
-- Indices de la tabla `categoria_pagina`
--
ALTER TABLE `categoria_pagina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`id_denuncia`);

--
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id_distrito`);

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rob`
--
ALTER TABLE `rob`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `categoria_hija`
--
ALTER TABLE `categoria_hija`
  MODIFY `id_cathija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT de la tabla `categoria_padre`
--
ALTER TABLE `categoria_padre`
  MODIFY `id_catpadre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `categoria_pagina`
--
ALTER TABLE `categoria_pagina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `id_denuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `rob`
--
ALTER TABLE `rob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

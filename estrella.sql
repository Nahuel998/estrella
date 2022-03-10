-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-03-2022 a las 01:41:50
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estrella`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `total` float NOT NULL,
  `met_pago` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio`, `total`, `met_pago`) VALUES
(1938, 264, 819, 1, 140, 140, 'Efectivo'),
(1937, 263, 819, 1, 140, 140, 'Efectivo'),
(1936, 262, 819, 1, 140, 140, 'Efectivo'),
(1935, 261, 819, 1, 140, 140, 'Efectivo'),
(1934, 260, 819, 1, 140, 140, 'Efectivo'),
(1933, 259, 819, 8, 140, 1120, 'Mercado Pago'),
(1932, 258, 819, 4, 140, 560, 'Maestro'),
(1931, 257, 819, 1, 140, 140, 'Visa'),
(1930, 256, 819, 1, 140, 140, 'Efectivo'),
(1939, 265, 819, 1, 140, 140, 'Efectivo'),
(1940, 266, 819, 1, 140, 140, 'Efectivo'),
(1941, 267, 819, 1, 140, 140, 'Efectivo'),
(1942, 268, 819, 1, 140, 140, 'Efectivo'),
(1943, 269, 819, 1, 140, 140, 'Efectivo'),
(1944, 270, 819, 1, 140, 140, 'Efectivo'),
(1945, 271, 819, 1, 140, 140, 'Visa'),
(1946, 272, 819, 1, 140, 140, 'Mercado Pago'),
(1947, 272, 819, 1, 140, 140, 'Mercado Pago'),
(1948, 273, 819, 1, 140, 140, 'Efectivo'),
(1949, 274, 819, 1, 140, 140, 'Efectivo'),
(1950, 274, 819, 1, 140, 140, 'Efectivo'),
(1951, 274, 819, 1, 140, 140, 'Efectivo'),
(1952, 275, 819, 1, 140, 140, 'Mercado Pago'),
(1953, 275, 819, 1, 140, 140, 'Mercado Pago'),
(1954, 275, 819, 1, 140, 140, 'Mercado Pago'),
(1955, 276, 821, 1, 280, 280, 'Visa'),
(1956, 277, 821, 3, 280, 840, 'Maestro'),
(1957, 278, 819, 1, 140, 140, 'Efectivo'),
(1958, 279, 819, 3, 140, 420, 'Mercado Pago'),
(1959, 279, 821, 1, 280, 280, 'Mercado Pago'),
(1960, 280, 821, 1, 280, 280, 'Efectivo'),
(1961, 281, 821, 1, 280, 280, 'Efectivo'),
(1962, 282, 821, 10, 280, 2800, 'Efectivo'),
(1963, 283, 821, 1, 280, 280, 'Efectivo'),
(1964, 283, 819, 1, 140, 140, 'Efectivo'),
(1965, 283, 822, 1, 340, 340, 'Efectivo'),
(1966, 284, 822, 1, 340, 340, 'Efectivo'),
(1967, 285, 821, 1, 280, 280, 'Maestro'),
(1968, 286, 822, 1, 340, 340, 'Efectivo'),
(1969, 286, 819, 1, 140, 140, 'Efectivo'),
(1970, 287, 821, 2, 280, 560, 'Mercado Pago'),
(1971, 288, 821, 1, 280, 280, 'Mercado Pago'),
(1972, 288, 819, 1, 140, 140, 'Mercado Pago'),
(1973, 289, 821, 1, 280, 280, 'Efectivo'),
(1974, 290, 821, 1, 280, 280, 'Efectivo'),
(1975, 290, 822, 1, 340, 340, 'Efectivo'),
(1976, 291, 819, 1, 140, 140, 'Mercado Pago'),
(1977, 292, 827, 1, 240, 240, 'Mercado Pago'),
(1978, 293, 826, 1, 180, 180, 'Mercado Pago'),
(1979, 293, 825, 1, 160, 160, 'Mercado Pago'),
(1980, 294, 825, 1, 160, 160, 'Efectivo'),
(1981, 295, 826, 3, 180, 540, 'Mercado Pago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `id_producto`, `cantidad`, `fecha`) VALUES
(243, 825, 1, '0000-00-00'),
(242, 838, 16, '0000-00-00'),
(241, 821, 6, '2021-12-10'),
(240, 821, -4, '2021-12-09'),
(239, 820, 1, '2021-12-04'),
(238, 822, -3, '2021-12-04'),
(237, 822, -3, '0000-00-00'),
(236, 822, -3, '0000-00-00'),
(235, 822, -3, '2021-12-22'),
(234, 819, 15, '2021-12-21'),
(233, 821, -18, '2021-12-04'),
(232, 820, 13, '2021-12-11'),
(231, 821, 91, '2021-12-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `vencimiento` date NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(20) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `codigo` bigint(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `titulo`, `vencimiento`, `precio`, `cantidad`, `foto`, `codigo`) VALUES
(826, 'Mayonesa Natura 250g', '0000-00-00', 180, 0, '', 7791866001203),
(825, 'Camel 10 box', '0000-00-00', 160, 1, '', 77977229),
(824, 'Camel 20 box', '0000-00-00', 300, 0, '', 77977205),
(823, 'Camel 20 comun', '0000-00-00', 270, 0, '', 77910974),
(827, 'Lucky Strike 20 comun', '0000-00-00', 240, 0, '', 77976512),
(828, 'Lucky Strike 20 box', '0000-00-00', 290, 0, '', 77910066),
(829, 'Lucky Strike 20 comun silver', '0000-00-00', 250, 0, '', 77976970),
(830, 'Malboro 10', '0000-00-00', 170, 0, '', 77940315),
(831, 'Malboro 10 fusion blast', '0000-00-00', 170, 0, '', 77978141),
(832, 'Lucky Strike 10 original', '0000-00-00', 150, 0, '', 77976505),
(833, 'Lucky Strike 10 cool', '0000-00-00', 150, 0, '', 77976994),
(834, 'Lucky Strike 10indigo wild', '0000-00-00', 150, 0, '', 77958204),
(835, 'PhilipMorris 10 caps', '0000-00-00', 160, 0, '', 77971913),
(836, 'PhilipMorris 10', '0000-00-00', 160, 0, '', 77913418),
(837, 'chesterfield remix purple', '0000-00-00', 250, 0, '', 77973887),
(838, 'vino balbo', '0000-00-00', 240, 16, '', 7791843008294);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`) VALUES
(273, '2021-11-27 00:47:39', 140),
(272, '2021-11-27 00:46:52', 280),
(271, '2021-11-18 03:19:19', 140),
(270, '2021-11-18 02:01:46', 140),
(269, '2021-11-18 01:56:24', 140),
(268, '2021-11-18 01:55:40', 140),
(267, '2021-11-18 01:52:23', 140),
(266, '2021-11-18 01:52:19', 140),
(265, '2021-11-18 01:51:28', 140),
(264, '2021-11-18 01:51:24', 140),
(263, '2021-11-18 01:50:40', 140),
(262, '2021-11-18 01:50:15', 140),
(261, '2021-11-18 01:49:27', 140),
(260, '2021-11-18 01:48:56', 140),
(259, '2021-11-18 01:37:24', 1120),
(258, '2021-11-18 01:36:56', 560),
(257, '2021-11-18 01:36:46', 140),
(256, '2021-11-18 01:36:38', 140),
(274, '2021-11-28 22:19:05', 420),
(275, '2021-11-29 01:12:00', 420),
(276, '2021-12-03 02:35:46', 280),
(277, '2021-12-05 02:17:11', 840),
(278, '2021-12-05 02:17:44', 140),
(279, '2021-12-05 02:18:17', 700),
(280, '2021-12-05 02:26:17', 280),
(281, '2021-12-05 02:26:33', 280),
(282, '2021-12-05 02:27:01', 2800),
(283, '2021-12-05 02:33:45', 760),
(284, '2021-12-05 02:34:25', 340),
(285, '2021-12-07 02:22:15', 280),
(286, '2021-12-07 02:26:34', 480),
(287, '2021-12-07 02:27:20', 560),
(288, '2021-12-20 02:28:21', 420),
(289, '2021-12-20 02:35:09', 280),
(290, '2022-01-03 23:26:51', 620),
(291, '2022-01-03 23:27:12', 140),
(292, '2022-01-04 12:15:50', 240),
(293, '2022-02-02 03:04:11', 340),
(294, '2022-02-05 02:10:25', 160),
(295, '2022-02-05 02:23:32', 540);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1982;
--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=839;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

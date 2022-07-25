-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2022 a las 10:59:12
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `t2gobc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adquiere_productos`
--

CREATE TABLE `adquiere_productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `canjeado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adquiere_productos`
--

INSERT INTO `adquiere_productos` (`id`, `producto_id`, `empleado_id`, `canjeado`) VALUES
(1, 1, 4, 1),
(2, 1, 4, 1),
(3, 1, 4, 1),
(4, 1, 4, 1),
(5, 1, 4, 0),
(6, 1, 4, 0),
(7, 1, 4, 0),
(8, 1, 4, 0),
(9, 1, 4, 0),
(10, 1, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_canjeado`
--

CREATE TABLE `dia_canjeado` (
  `adquiere_productos_id` int(11) NOT NULL,
  `DIA` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dia_canjeado`
--

INSERT INTO `dia_canjeado` (`adquiere_productos_id`, `DIA`) VALUES
(1, '2022-04-13'),
(2, '2022-04-18'),
(3, '2022-04-26'),
(4, '2022-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `BCaddress` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT '1234',
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `BCaddress`, `pass`, `admin`) VALUES
(1, 'Terriza', '0x753e85608e29a57e02ba3c12c381325E67841eA0', '1234', 1),
(2, 'empleado', '0xE81Be967F97fa6284C67d6eD7E1fAfF5b13007CF', '1234', 0),
(3, 'pablo', '0x43f9a654bB3475eB97391a97Be7f9EEE9983477f', '1234', 1),
(4, 'jose', '0x46bFce9555aB45b11503250e54C635cD1d80AD73', '1234', 0),
(5, 'juan', NULL, '1234', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `realiza` int(11) DEFAULT NULL,
  `recibe` int(11) DEFAULT NULL,
  `organizacion` int(11) DEFAULT NULL,
  `liderazgo` int(11) DEFAULT NULL,
  `iniciativa` int(11) DEFAULT NULL,
  `teamwork` int(11) DEFAULT NULL,
  `Comentarios` text DEFAULT NULL,
  `abierto` tinyint(1) DEFAULT 1,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`id`, `realiza`, `recibe`, `organizacion`, `liderazgo`, `iniciativa`, `teamwork`, `Comentarios`, `abierto`, `fecha`) VALUES
(1, 4, 3, 10, 10, 10, 10, 'estupendo', 0, '2022-04-06'),
(2, 1, 2, 10, 10, 10, 10, 'Eres gernial chico', 0, '2022-04-05'),
(3, 4, 3, 10, 10, 10, 10, 'eres brutal', 0, '2022-04-06'),
(4, 4, 2, 10, 10, 10, 10, 'estupendo', 0, '2022-04-06'),
(5, 4, 4, 10, 10, 10, 10, '10', 0, '2022-04-13'),
(6, 4, 4, 12, 12, 12, 12, '12\n', 0, '2022-04-13'),
(7, 4, 4, 10, 10, 10, 10, '101010101', 0, '2022-04-13'),
(8, 4, 4, 12, 12, 12, 12, 'saddsa', 0, '2022-04-18'),
(9, 4, 4, 12, 12, 12, 12, 'jsodjosdj', 0, '2022-04-18'),
(10, 4, 4, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(11, 4, 4, 12, 12, 12, 12, 'Soy el mejor O-O', 0, '2022-04-18'),
(12, 4, 4, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(13, 4, 3, 10, 10, 10, 10, 'genial', 0, '2022-04-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `codigo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cerrado` tinyint(1) DEFAULT 0,
  `descripcion` text DEFAULT 'Evento para conseguir puntos',
  `valor` int(11) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`codigo`, `fecha`, `cerrado`, `descripcion`, `valor`) VALUES
(1, '2123-01-03', 1, 'este evento es muy futuro ', 56232579),
(15, '2022-04-08', 1, 'Evento para conseguir puntos', 4),
(21, '2022-04-13', 1, 'Este es otro evento ', 6),
(21, '2022-04-15', 1, 'Evento para conseguir puntos', 4),
(23, '2022-04-20', 1, 'texto evento ', 6),
(24, '2022-04-20', 1, 'texto evento ', 6),
(25, '2022-04-30', 1, 'Evento para conseguir puntos', 4),
(41, '2022-04-27', 1, 'evento ', 21),
(89, '2030-02-15', 1, 'Evento para conseguir puntos', 4),
(90, '2023-05-20', 1, 'descripcion', 3),
(178, '2022-05-09', 1, 'eventazo', 4),
(200, '2022-05-19', 0, 'Merienda  en la ofi', 4),
(500, '2022-04-20', 1, 'extra trabajo tal', 3),
(800, '2020-04-30', 1, 'evento 800', 4),
(8001, '0074-05-27', 1, 'evento tal ', 5),
(9009, '2022-04-27', 1, 'evento tal', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`) VALUES
(1, 'Dia libre', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos_mes`
--

CREATE TABLE `puntos_mes` (
  `empleado_id` int(11) NOT NULL,
  `mes` char(7) NOT NULL,
  `puntos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntos_mes`
--

INSERT INTO `puntos_mes` (`empleado_id`, `mes`, `puntos`) VALUES
(1, '2022-04', 0),
(2, '2022-04', 0),
(3, '2022-04', 8),
(4, '2022-04', 44),
(5, '2022-04', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntualidad`
--

CREATE TABLE `puntualidad` (
  `tipo` enum('periodo','diario') DEFAULT NULL,
  `fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntualidad`
--

INSERT INTO `puntualidad` (`tipo`, `fin`) VALUES
('diario', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntualidad_bonus`
--

CREATE TABLE `puntualidad_bonus` (
  `tipo` enum('SEM','MES','ANIO') DEFAULT NULL,
  `recompensa` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntualidad_bonus`
--

INSERT INTO `puntualidad_bonus` (`tipo`, `recompensa`, `activo`) VALUES
('MES', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntualidad_dias`
--

CREATE TABLE `puntualidad_dias` (
  `lunes` float DEFAULT NULL,
  `martes` float DEFAULT NULL,
  `miercoles` float DEFAULT NULL,
  `jueves` float DEFAULT NULL,
  `Viernes` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntualidad_dias`
--

INSERT INTO `puntualidad_dias` (`lunes`, `martes`, `miercoles`, `jueves`, `Viernes`) VALUES
(5, 4, 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntualidad_periodo`
--

CREATE TABLE `puntualidad_periodo` (
  `periodo` enum('SEM','MES','ANIO') DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `recompensa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntualidad_periodo`
--

INSERT INTO `puntualidad_periodo` (`periodo`, `numero`, `recompensa`) VALUES
('MES', 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `se_apunta`
--

CREATE TABLE `se_apunta` (
  `codigo_evento` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `asistencia` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `se_apunta`
--

INSERT INTO `se_apunta` (`codigo_evento`, `id_empleado`, `asistencia`) VALUES
(1, 3, 0),
(1, 4, 1),
(15, 3, 1),
(15, 4, 1),
(21, 4, 1),
(23, 4, 1),
(24, 4, 1),
(25, 4, 1),
(41, 4, 1),
(89, 3, 1),
(89, 4, 1),
(90, 4, 1),
(178, 4, 1),
(200, 4, NULL),
(500, 4, 1),
(800, 3, 1),
(800, 4, 1),
(8001, 4, 1),
(9009, 3, 0),
(9009, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `se_conecta`
--

CREATE TABLE `se_conecta` (
  `id_empleado` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `se_conecta`
--

INSERT INTO `se_conecta` (`id_empleado`, `date`, `time`) VALUES
(3, '2022-05-31', '17:36:13'),
(4, '2022-05-31', '17:35:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adquiere_productos`
--
ALTER TABLE `adquiere_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `dia_canjeado`
--
ALTER TABLE `dia_canjeado`
  ADD PRIMARY KEY (`adquiere_productos_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `realiza` (`realiza`),
  ADD KEY `recibe` (`recibe`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`codigo`,`fecha`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntos_mes`
--
ALTER TABLE `puntos_mes`
  ADD PRIMARY KEY (`empleado_id`,`mes`);

--
-- Indices de la tabla `se_apunta`
--
ALTER TABLE `se_apunta`
  ADD PRIMARY KEY (`codigo_evento`,`id_empleado`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `se_conecta`
--
ALTER TABLE `se_conecta`
  ADD PRIMARY KEY (`id_empleado`,`date`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adquiere_productos`
--
ALTER TABLE `adquiere_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adquiere_productos`
--
ALTER TABLE `adquiere_productos`
  ADD CONSTRAINT `adquiere_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `adquiere_productos_ibfk_2` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `dia_canjeado`
--
ALTER TABLE `dia_canjeado`
  ADD CONSTRAINT `dia_canjeado_ibfk_1` FOREIGN KEY (`adquiere_productos_id`) REFERENCES `adquiere_productos` (`id`);

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`realiza`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `encuesta_ibfk_2` FOREIGN KEY (`recibe`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `puntos_mes`
--
ALTER TABLE `puntos_mes`
  ADD CONSTRAINT `puntos_mes_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `se_apunta`
--
ALTER TABLE `se_apunta`
  ADD CONSTRAINT `se_apunta_ibfk_1` FOREIGN KEY (`codigo_evento`) REFERENCES `evento` (`codigo`),
  ADD CONSTRAINT `se_apunta_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);

--
-- Filtros para la tabla `se_conecta`
--
ALTER TABLE `se_conecta`
  ADD CONSTRAINT `se_conecta_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

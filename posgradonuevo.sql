-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2018 a las 09:30:43
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `posgradonuevo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(10) NOT NULL,
  `expediente` int(10) NOT NULL,
  `passwordAlumno` varchar(50) NOT NULL,
  `nombreAlumno` varchar(50) NOT NULL,
  `aPaterno` varchar(50) NOT NULL,
  `aMaterno` varchar(50) NOT NULL,
  `idPlan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `expediente`, `passwordAlumno`, `nombreAlumno`, `aPaterno`, `aMaterno`, `idPlan`) VALUES
(3, 256903, '256903', 'Erick', 'Mendez', 'Loarca', NULL),
(2, 256909, '256909', 'Ana', 'Hernández', 'Peña', 'MCC'),
(1, 256910, '256910', 'Hanna', 'Ornelas', 'Flores', 'DCC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `alumno` int(10) NOT NULL,
  `CURP` varchar(500) NOT NULL,
  `recibo_pago` varchar(500) NOT NULL,
  `cedula_inscripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`alumno`, `CURP`, `recibo_pago`, `cedula_inscripcion`) VALUES
(256909, 'documentos/44244086_1982912781772985_7206153965258407936_n.jpg', 'documentos/44244086_1982912781772985_7206153965258407936_n.jpg', 'documentos/44244086_1982912781772985_7206153965258407936_n.jpg'),
(256909, 'documentos/Documento 3.docx', 'documentos/Documento 2.docx', 'documentos/Documento 1.docx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `idPlan` varchar(10) NOT NULL,
  `nombrePlan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`idPlan`, `nombrePlan`) VALUES
('DCC', 'Doctorado en Ciencias de la Computación'),
('MCC', 'Maestría en Ciencias de la Computación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `expediente` int(10) NOT NULL,
  `password_usuario` varchar(50) NOT NULL,
  `tipo_Usuario` enum('Alumno','Coordinador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`expediente`, `password_usuario`, `tipo_Usuario`) VALUES
(256909, '256909', 'Alumno'),
(256903, '256903', 'Coordinador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`expediente`),
  ADD KEY `idPlan` (`idPlan`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD KEY `alumno` (`alumno`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`idPlan`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD KEY `expediente` (`expediente`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`idPlan`) REFERENCES `plan` (`idPlan`);

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`expediente`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`expediente`) REFERENCES `alumno` (`expediente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

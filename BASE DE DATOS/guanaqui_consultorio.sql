-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-02-2017 a las 12:02:28
-- Versión del servidor: 5.5.51-38.2
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `guanaqui_consultorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_tmp`
--

CREATE TABLE IF NOT EXISTS `caja_tmp` (
  `id` int(11) NOT NULL,
  `paciente` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `cant` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajero`
--

CREATE TABLE IF NOT EXISTS `cajero` (
  `usu` varchar(255) NOT NULL,
  `consultorio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cajero`
--

INSERT INTO `cajero` (`usu`, `consultorio`) VALUES
('112233444', '1'),
('1234567', '1'),
('0000001', '2'),
('12312312312', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_medicas`
--

CREATE TABLE IF NOT EXISTS `citas_medicas` (
  `id` int(11) NOT NULL,
  `id_paciente` varchar(255) NOT NULL,
  `id_medico` varchar(15) NOT NULL,
  `consultorio` varchar(255) NOT NULL,
  `fechai` date NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `horario` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `consulta` varchar(25) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas_medicas`
--

INSERT INTO `citas_medicas` (`id`, `id_paciente`, `id_medico`, `consultorio`, `fechai`, `observaciones`, `fecha`, `hora`, `horario`, `status`, `consulta`) VALUES
(1, '1', '112233444', '1', '2017-02-06', 'PRUEBA 1', '2017-02-06', '11:02:53', '13:10:00', 'PENDIENTE', 'PENDIENTE'),
(2, '2', '112233444', '2', '2017-02-06', 'PRUEBA 2', '2017-02-06', '11:02:16', '12:10:00', 'PENDIENTE', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas_medicas`
--

CREATE TABLE IF NOT EXISTS `consultas_medicas` (
  `id` int(11) NOT NULL,
  `id_paciente` varchar(15) NOT NULL,
  `id_medico` varchar(15) NOT NULL,
  `consultorio` int(11) NOT NULL,
  `sintomas` text NOT NULL,
  `examen` text NOT NULL,
  `diagnostico` text NOT NULL,
  `tratamiento` text NOT NULL,
  `reseta` text NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE IF NOT EXISTS `consultorios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `encargado` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`id`, `nombre`, `direccion`, `telefono`, `encargado`, `estado`) VALUES
(1, 'Ortopeda y Traumatóloga', 'Calle Estela Geraldino, No. 7 (Centro Médico Los Rios)', '(809)574-7888', 'Dra. Editha Castillo', 's'),
(2, 'Marci', 'C.H Dr PTR', '(981)814-2233', 'Cirugia General', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE IF NOT EXISTS `detalle` (
  `id` int(255) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `importe` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `consultorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(255) NOT NULL,
  `empresa` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `moneda` varchar(22) COLLATE utf8_spanish_ci NOT NULL,
  `anno` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `empresa`, `nit`, `direccion`, `pais`, `ciudad`, `tel`, `fax`, `web`, `correo`, `fecha`, `moneda`, `anno`) VALUES
(1, 'Clínica de Especialidades', '001-1505192-2', 'Calle Estela Geraldino. Clinica Los Rios', 'Rep. Dom.', 'La Vega, Jarabacoa', '809-330-7099', '809-574-7786', 'www.soporteabad.com', 'draeditha.castillo@gmail.com', '2016-02-11', 'RD$', '2014');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id` int(11) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `consultorio` int(11) NOT NULL,
  `usu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int(11) NOT NULL,
  `consulta` varchar(11) NOT NULL,
  `paciente` varchar(11) NOT NULL,
  `med1` text NOT NULL,
  `indi1` text NOT NULL,
  `med2` text NOT NULL,
  `indi2` text NOT NULL,
  `med3` text NOT NULL,
  `indi3` text NOT NULL,
  `med4` text NOT NULL,
  `indi4` text NOT NULL,
  `med5` text NOT NULL,
  `indi5` text NOT NULL,
  `med6` text NOT NULL,
  `indi6` text NOT NULL,
  `med7` text NOT NULL,
  `indi7` text NOT NULL,
  `med8` text NOT NULL,
  `indi8` text NOT NULL,
  `med9` text NOT NULL,
  `indi9` text NOT NULL,
  `med10` text NOT NULL,
  `indi10` text NOT NULL,
  `fecha` date NOT NULL,
  `consultorio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `departamento`, `estado`) VALUES
(1, 'La Plata', '1', 's'),
(2, 'Córdoba ', '2', 's'),
(3, 'Santa Fe', '3', 's'),
(4, 'Mendoza', '1', 's'),
(5, 'San Miguel del Tucumán', '5', 's'),
(6, 'Paraná', '6', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(11) NOT NULL,
  `documento` varchar(25) NOT NULL,
  `seguro` varchar(25) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `municipio` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `edad` date NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `estado` varchar(250) NOT NULL,
  `sangre` varchar(255) NOT NULL,
  `vih` varchar(255) NOT NULL,
  `peso` varchar(255) NOT NULL,
  `talla` varchar(255) NOT NULL,
  `alergia` text NOT NULL,
  `motivo` text NOT NULL,
  `medicamento` text NOT NULL,
  `enfermedad` text NOT NULL,
  `enfermedadf` text NOT NULL,
  `entrada` varchar(50) NOT NULL,
  `consultorio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `documento`, `seguro`, `nombre`, `direccion`, `departamento`, `municipio`, `telefono`, `edad`, `sexo`, `email`, `estado`, `sangre`, `vih`, `peso`, `talla`, `alergia`, `motivo`, `medicamento`, `enfermedad`, `enfermedadf`, `entrada`, `consultorio`) VALUES
(1, '473-2984792-7', '1', 'Delmar Ramon Lopez', 'col. las colinas', '', '', '4729749279', '1990-02-07', 'm', '', 's', '', 'n', '143', '', 'no', 'no', 'no', 'no', 'no', 'Consulta', 1),
(2, '199-9999999-9', '1', 'hHoasskdasdasd', 'asdasdasdasd', '', '', '1231231231', '2017-01-31', 'f', 'sadasdasd', 's', '', 'n', '90', '', 'nignunsdasdasd', 'asdasd', 'asdasd', 'asdadsd', 'sadasd', 'Consulta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(255) NOT NULL,
  `usu` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`, `usu`, `estado`) VALUES
(11, '1', '112233444', 's'),
(12, '2', '112233444', 's'),
(13, '3', '112233444', 's'),
(14, '4', '112233444', 's'),
(15, '5', '112233444', 's'),
(106, '1', '1234567', 'n'),
(107, '2', '1234567', 'n'),
(108, '3', '1234567', 'n'),
(109, '4', '1234567', 'n'),
(110, '5', '1234567', 'n'),
(111, '1', '0000001', 's'),
(112, '2', '0000001', 's'),
(113, '3', '0000001', 's'),
(114, '4', '0000001', 's'),
(115, '5', '0000001', 's'),
(116, '1', '12312312312', 's'),
(117, '2', '12312312312', 's'),
(118, '3', '12312312312', 's'),
(119, '4', '12312312312', 's'),
(120, '5', '12312312312', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_tmp`
--

CREATE TABLE IF NOT EXISTS `permisos_tmp` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos_tmp`
--

INSERT INTO `permisos_tmp` (`id`, `nombre`) VALUES
(1, 'Crear Pacientes'),
(2, 'Crear Citas'),
(3, 'Crear consultas'),
(4, 'Administracion'),
(5, 'Caja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL,
  `doc` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `doc`, `nom`, `cargo`, `estado`) VALUES
(1, '112233444', 'Administrador', 'admin', 's'),
(12, '1234567', 'Pamela Lopez', '1', 's'),
(13, '0000001', 'Kelly Rafael Abad', 'admin', 's'),
(14, '12312312312', 'Ramon Lopez', 'admin', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen`
--

CREATE TABLE IF NOT EXISTS `resumen` (
  `id` int(11) NOT NULL,
  `paciente` varchar(255) NOT NULL,
  `concepto` varchar(250) NOT NULL,
  `factura` varchar(255) NOT NULL,
  `clase` varchar(250) NOT NULL,
  `valor` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `usu` varchar(250) NOT NULL,
  `consultorio` int(11) NOT NULL,
  `estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguros`
--

CREATE TABLE IF NOT EXISTS `seguros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `seguros`
--

INSERT INTO `seguros` (`id`, `nombre`, `estado`) VALUES
(1, 'Prueba', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `config` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `nombre`, `valor`, `config`, `estado`) VALUES
(1, 'Consulta Seguro', '500', 'gn', 's'),
(2, 'Consulta Privada', '1000', 'gn', 's'),
(3, 'Otros Servicios', '500', 'gn', 's'),
(4, 'consulta', '35', 'gn', 's'),
(5, 'Consulta de Emergencia', '0', 'df', 's'),
(6, 'Colocacion de Yeso ABP', '3000', 'gn', 's'),
(7, 'Colocacion de Yeso BP', '5000', 'gn', 's'),
(8, 'Colocación de guante de yeso', '2000', 'gn', 's'),
(9, 'Consulta de Hospital', '500', 'gn', 's'),
(10, 'Cura de herida', '500', 'gn', 's'),
(11, 'Colocación de yeso SP', '3000', 'gn', 's'),
(12, 'Colocación de Yeso IP', '6000', 'gn', 's'),
(13, 'Colocacion de Calza de yeso', '5000', 'gn', 's'),
(14, 'Adosamiento falange pies', '1000', 'gn', 's'),
(15, 'Adosamiento Falange Manos', '1000', 'gn', 's'),
(16, 'Reducción de Luxación de falange manos', '5000', 'gn', 's'),
(17, 'Reducción luxación de falange Pies', '4000', 'gn', 's'),
(18, 'Yeso de fibra 5"', '400', 'no', 's'),
(19, 'Yeso de fibra 3"', '200', 'no', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_permisos`
--

CREATE TABLE IF NOT EXISTS `tipo_permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_permisos`
--

INSERT INTO `tipo_permisos` (`id`, `permiso`, `tipo`, `estado`) VALUES
(1, '1', '1', 'n'),
(2, '2', '1', 'n'),
(3, '3', '1', 'n'),
(4, '4', '1', 'n'),
(5, '5', '1', 's'),
(6, '1', '2', 's'),
(7, '2', '2', 's'),
(8, '3', '2', 's'),
(9, '4', '2', 's'),
(10, '5', '2', 's'),
(11, '1', '3', 's'),
(12, '2', '3', 's'),
(13, '3', '3', 's'),
(14, '4', '3', 's'),
(15, '5', '3', 's'),
(16, '1', '', 'n'),
(17, '2', '', 'n'),
(18, '3', '', 'n'),
(19, '4', '', 'n'),
(20, '5', '', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `nombre`) VALUES
(1, 'SECRETARIA'),
(2, 'MEDICO'),
(3, 'ORTOPEDISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `doc` varchar(255) NOT NULL,
  `con` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `salario` double NOT NULL,
  `estado` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `consultorio` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `doc`, `con`, `nombre`, `cargo`, `nota`, `salario`, `estado`, `tipo`, `consultorio`) VALUES
(16, '112233444', 'admin', 'Editha Castillo', 'Administrador', 'Ninguna', 0, 's', 'Admin', '1'),
(36, '0000001', 'rejj0121', 'ADMINISTRADOR', 'Administrador', 'Ninguna', 0, 's', 'Admin', '2'),
(37, '12312312312', '12312312312', 'Ramon Lopez', 'Administrador', 'Ninguna', 0, 's', 'Admin', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_tmp`
--
ALTER TABLE `caja_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas_medicas`
--
ALTER TABLE `citas_medicas`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `consultas_medicas`
--
ALTER TABLE `consultas_medicas`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos_tmp`
--
ALTER TABLE `permisos_tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resumen`
--
ALTER TABLE `resumen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguros`
--
ALTER TABLE `seguros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_permisos`
--
ALTER TABLE `tipo_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_tmp`
--
ALTER TABLE `caja_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `citas_medicas`
--
ALTER TABLE `citas_medicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `consultas_medicas`
--
ALTER TABLE `consultas_medicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT de la tabla `permisos_tmp`
--
ALTER TABLE `permisos_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `resumen`
--
ALTER TABLE `resumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `seguros`
--
ALTER TABLE `seguros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `tipo_permisos`
--
ALTER TABLE `tipo_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

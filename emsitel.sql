-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-08-2015 a las 16:22:10
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `emsitel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `usuario` varchar(110) NOT NULL,
  `password` varchar(110) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`usuario`, `password`, `rol`) VALUES
('admin', 'admin', 1),
('soporte', 'soporte', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_antenas`
--

CREATE TABLE IF NOT EXISTS `bd_antenas` (
  `cod_ant` int(11) NOT NULL,
  `nombre_ant` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_antenas`
--

INSERT INTO `bd_antenas` (`cod_ant`, `nombre_ant`) VALUES
(0, ''),
(1, 'Antena 1'),
(2, 'Antena 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_asesorescomerciales`
--

CREATE TABLE IF NOT EXISTS `bd_asesorescomerciales` (
  `cod_ase` int(11) NOT NULL,
  `nombre_ase` varchar(189) NOT NULL,
  `apellido_ase` varchar(189) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_asesorescomerciales`
--

INSERT INTO `bd_asesorescomerciales` (`cod_ase`, `nombre_ase`, `apellido_ase`) VALUES
(1, 'Juan', 'Jaramillo'),
(2, 'Andrea', 'Sepulveda'),
(3, 'Karen', 'Acevedo'),
(4, 'James', 'Rodriguez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_estadoservicio`
--

CREATE TABLE IF NOT EXISTS `bd_estadoservicio` (
  `cod_est` int(11) NOT NULL,
  `nombre_est` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_estadoservicio`
--

INSERT INTO `bd_estadoservicio` (`cod_est`, `nombre_est`) VALUES
(0, '......Seleccionar Estado......'),
(1, 'Por Activar'),
(2, 'Activo'),
(3, 'Retirado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_formatoscontrato`
--

CREATE TABLE IF NOT EXISTS `bd_formatoscontrato` (
  `cod_for` int(11) NOT NULL,
  `nombre_for` varchar(189) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_formatoscontrato`
--

INSERT INTO `bd_formatoscontrato` (`cod_for`, `nombre_for`) VALUES
(0, '....Seleccionar Formato.....'),
(1, 'CE'),
(2, 'CEV'),
(3, 'CVD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_municipios`
--

CREATE TABLE IF NOT EXISTS `bd_municipios` (
  `cod_mun` int(11) NOT NULL,
  `nombre_mun` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_municipios`
--

INSERT INTO `bd_municipios` (`cod_mun`, `nombre_mun`) VALUES
(1, 'Cucuta'),
(2, 'Los Patios'),
(3, 'Villa Del Rosario'),
(4, 'Pamplona'),
(5, 'tibu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_nodo`
--

CREATE TABLE IF NOT EXISTS `bd_nodo` (
  `cod_nod` int(11) NOT NULL,
  `nombre_nod` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_nodo`
--

INSERT INTO `bd_nodo` (`cod_nod`, `nombre_nod`) VALUES
(0, ''),
(1, 'Nodo 1'),
(2, 'Nodo 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_tipoconexion`
--

CREATE TABLE IF NOT EXISTS `bd_tipoconexion` (
  `cod_con` int(11) NOT NULL,
  `nombre_con` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_tipoconexion`
--

INSERT INTO `bd_tipoconexion` (`cod_con`, `nombre_con`) VALUES
(1, 'Inalambrica'),
(2, 'Fibra'),
(3, 'Otro Provedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bd_tiposervicio`
--

CREATE TABLE IF NOT EXISTS `bd_tiposervicio` (
  `cod_tp` int(11) NOT NULL,
  `nombre_tp` varchar(190) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bd_tiposervicio`
--

INSERT INTO `bd_tiposervicio` (`cod_tp`, `nombre_tp`) VALUES
(0, '....Seleccione el servicio...'),
(1, 'Voz'),
(2, 'Datos'),
(3, 'Internet'),
(4, 'Nube'),
(5, 'Telefonia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_clientes_empresariales`
--

CREATE TABLE IF NOT EXISTS `datos_clientes_empresariales` (
  `cod_emp` int(11) NOT NULL,
  `nitcedula_emp` varchar(180) NOT NULL,
  `nombre_emp` varchar(180) NOT NULL,
  `representantelegal_emp` varchar(180) NOT NULL,
  `direccion_emp` varchar(180) NOT NULL,
  `municipio_emp` int(11) NOT NULL,
  `telefono_emp` bigint(20) NOT NULL,
  `celular_emp` bigint(20) NOT NULL,
  `email_emp` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_clientes_empresariales`
--

INSERT INTO `datos_clientes_empresariales` (`cod_emp`, `nitcedula_emp`, `nombre_emp`, `representantelegal_emp`, `direccion_emp`, `municipio_emp`, `telefono_emp`, `celular_emp`, `email_emp`) VALUES
(1, '98998', 'joaquin', 'askalsj', '', 3, 0, 0, '0'),
(4, '887', 'dann', 'dad', '', 1, 0, 0, '0'),
(5, '9080', 'Claro', 'Javier', '', 2, 0, 0, '0'),
(6, '09090', 'cocacola s.a', 'juan manuel', '', 1, 0, 0, 'rojasmil@mil.com'),
(7, '8789789', 'adad', 'adad', '', 3, 0, 0, '0'),
(40, '908', 'ebenezer', 'carlos albarracin', 'calle 14#12-12', 2, 0, 0, '0'),
(41, '98ik', 'puma', 'carlos', '', 4, 0, 0, ''),
(42, '98998', 'joaquin', 'askalsj', '', 3, 0, 0, '0'),
(43, '12-12', 'Postobon', 'jlkjl', '', 1, 0, 0, ''),
(44, '238723', 'FAcebook', 'adada', '', 2, 0, 0, ''),
(45, 'sasa', 'asas', 'asasa', '', 3, 0, 0, '0'),
(46, 'ashj', 'asjasb', 'jkahs', '', 4, 0, 0, ''),
(47, '78979', 'asas', 'asas', '', 3, 0, 0, '0'),
(48, '1255abc', 'Mac Pollo', 'alfonso gutierrez', 'calle 15# 10-11', 2, 92323, 2323232, 'rojas@mil.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_clientes_personales`
--

CREATE TABLE IF NOT EXISTS `datos_clientes_personales` (
  `cod_cli` int(11) NOT NULL,
  `cedula_cli` bigint(20) NOT NULL,
  `nombre1_cli` varchar(30) NOT NULL,
  `nombre2_cli` varchar(30) NOT NULL,
  `apellido1_cli` varchar(30) NOT NULL,
  `apellido2_cli` varchar(30) NOT NULL,
  `direccion_cli` varchar(100) NOT NULL,
  `municipio_cli` int(11) NOT NULL,
  `telefono_cli` bigint(20) NOT NULL,
  `celular_cli` bigint(20) NOT NULL,
  `email_cli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_clientes_personales`
--

INSERT INTO `datos_clientes_personales` (`cod_cli`, `cedula_cli`, `nombre1_cli`, `nombre2_cli`, `apellido1_cli`, `apellido2_cli`, `direccion_cli`, `municipio_cli`, `telefono_cli`, `celular_cli`, `email_cli`) VALUES
(5, 897897, 'jesus', 'adrian', 'romaero', '', '', 3, 0, 3124469080, 'mil@mil.cpm'),
(6, 109343, 'renson', 'morales', 'javej', 'kknk', 'khlk', 1, 8678, 68768, 'rojas@mil.com'),
(7, 789789, '897897', '89789', '798789', '7989', '7897', 1, 0, 0, 'mil@mil.com'),
(12, 109378, 'danny', 'alejandro', 'rojas', 'fuentessss', 'calle 15#12-12', 2, 58467667, 3273623, 'rojas@mil.com'),
(13, 1093786701, 'Danny ', 'Alejandro', 'Rojas', 'Fuentes', 'calle 15#23-35 libertad', 1, 0, 3124469080, 'rojas2895@gmail.com'),
(14, 897, 'danny', 'r', 'rojas', '', '', 3, 0, 0, 'mil@mil.xom'),
(15, 7879, 'felipe', 'andres', 'galan', 'asas', 'lop', 4, 0, 32323233333, 'rojasmil@mil.com'),
(16, 987, 'carlos', 'albeiro', 'duarte', '', 'calle 14 980 betania', 3, 0, 0, 'LOP@MIL.COM'),
(17, 1234, 'carlos', 'alberto', 'mogolloom', '', 'calle 15', 3, 0, 0, ''),
(18, 786, 'Omarasgkadga', 'diomesdez', 'Yandel', 'ssss', 'julio', 3, 0, 0, ''),
(19, 125831, 'yony', 'se', 'tobias', 'ñato', '', 2, 0, 3124454545, ''),
(20, 3107, 'carlos', 'kkd', 'sdsmkds', '', '', 2, 0, 0, ''),
(21, 9888, 'carlos', '', 'sdsdsd', 'lskddksÃ±', '', 2, 0, 0, ''),
(22, 890898, 'skdlksj', 'kjkj', 'kljklj', '', '', 2, 0, 0, ''),
(23, 9898, 'assaas', '', 'sasas', '', '', 2, 0, 0, ''),
(24, 212121, 'askalsj', 'llkj', 'kljklj', '', '', 3, 0, 0, ''),
(25, 98989, 'assm', 'lk', 'kjlkj', '', '', 2, 0, 0, ''),
(26, 98989, 'assm', 'lk', 'kjlkj', '', '', 2, 0, 0, ''),
(27, 98989, 'assm', 'lk', 'kjlkj', '', '', 2, 0, 0, ''),
(28, 8787, 'sdassad', '', 'sdasd', '', '', 3, 0, 0, ''),
(29, 8787888, 'asasny', '', 'lklkas', '', '', 2, 0, 0, ''),
(30, 565656, 'jose', 'ernesto', 'valdes', '', '', 4, 0, 312446890, ''),
(31, 9231, 'ernesto', 'flabio', 'simon', '', '', 4, 0, 0, ''),
(32, 8787897, 'hjkh', 'khjkj', 'jjkjhkj', '', '', 1, 0, 0, ''),
(33, 8787897, 'hjkh', 'khjkj', 'jjkjhkj', '', '', 1, 0, 0, ''),
(34, 6373, 'jose', 'alexander', 'rojas', 'ibaÃ±ez', '', 4, 0, 0, ''),
(35, 3556, 'juan', '', 'omar', '', '', 5, 0, 0, ''),
(36, 1090501595, 'jose', 'alexander', 'rojas', 'ibaÃ±ez', 'calle 9 #4-24 la union', 1, 0, 3178978979, 'cocq_rocio@gmail.camor'),
(37, 78789, 'khjkh', 'H', 'HJKH', '', '', 1, 0, 0, ''),
(38, 78789, 'khjkh', 'H', 'HJKH', '', '', 1, 0, 0, ''),
(39, 87987, 'aksjk', 'jkljakld', 'jlkajd', 'lkjlkddj', '', 1, 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleservicio_empresarial`
--

CREATE TABLE IF NOT EXISTS `detalleservicio_empresarial` (
  `cod_det_emp` int(11) NOT NULL,
  `tipocone_emp` int(11) NOT NULL,
  `velmax_emp` bigint(20) NOT NULL,
  `velmin_emp` bigint(20) NOT NULL,
  `nodo_emp` int(11) NOT NULL,
  `antena_emp` int(11) NOT NULL,
  `cod_servicio_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleservicio_empresarial`
--

INSERT INTO `detalleservicio_empresarial` (`cod_det_emp`, `tipocone_emp`, `velmax_emp`, `velmin_emp`, `nodo_emp`, `antena_emp`, `cod_servicio_emp`) VALUES
(59, 3, 997, 6777, 1, 1, 59),
(60, 2, 2323, 32323, 1, 2, 60),
(61, 1, 2323, 2323, 1, 2, 61),
(62, 1, 1213, 12121, 1, 1, 62),
(63, 1, 112, 0, 1, 1, 63),
(64, 3, 1212, 1212, 1, 2, 64),
(65, 2, 1212, 1212, 1, 1, 65),
(66, 1, 0, 0, 1, 1, 66),
(67, 1, 1212, 1212, 2, 2, 67),
(68, 1, 8, 19, 1, 1, 68);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleservicio_personal`
--

CREATE TABLE IF NOT EXISTS `detalleservicio_personal` (
  `cod_det` int(11) NOT NULL,
  `tipoconex` int(11) NOT NULL,
  `velmax_det` bigint(20) NOT NULL,
  `velmin_det` bigint(20) NOT NULL,
  `nodo_det` int(11) NOT NULL,
  `antena_det` int(11) NOT NULL,
  `cod_tiposervicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleservicio_personal`
--

INSERT INTO `detalleservicio_personal` (`cod_det`, `tipoconex`, `velmax_det`, `velmin_det`, `nodo_det`, `antena_det`, `cod_tiposervicio`) VALUES
(1, 1, 0, 0, 2, 0, 1),
(2, 1, 87897, 98098, 1, 0, 2),
(3, 1, 0, 0, 2, 0, 3),
(8, 3, 0, 0, 0, 0, 8),
(9, 1, 2424, 331, 2, 1, 9),
(10, 2, 0, 0, 1, 1, 10),
(13, 1, 778, 8767, 1, 2, 13),
(14, 2, 0, 0, 1, 1, 14),
(15, 2, 7867, 78687, 1, 1, 15),
(16, 2, 0, 0, 1, 1, 16),
(17, 2, 0, 0, 1, 2, 17),
(18, 2, 787, 897, 2, 1, 18),
(19, 3, 87778988, 0, 1, 1, 19),
(20, 3, 87778988, 0, 1, 1, 20),
(21, 3, 87778988, 0, 1, 1, 21),
(22, 3, 999, 888, 2, 1, 22),
(23, 3, 999, 888, 2, 1, 23),
(24, 2, 0, 0, 2, 1, 24),
(25, 2, 0, 0, 2, 1, 25),
(26, 2, 0, 0, 1, 2, 26),
(27, 2, 0, 0, 1, 2, 27),
(28, 2, 988899, 88998, 1, 1, 28),
(29, 3, 0, 0, 2, 1, 29),
(33, 2, 0, 0, 2, 2, 33),
(34, 2, 0, 0, 1, 1, 34),
(40, 3, 0, 0, 2, 1, 40),
(41, 1, 675, 7886, 1, 2, 41),
(42, 2, 786, 7886, 2, 1, 42),
(43, 2, 0, 0, 2, 1, 43),
(44, 3, 0, 0, 1, 1, 44),
(45, 2, 0, 0, 1, 1, 45),
(46, 2, 0, 0, 1, 1, 46),
(47, 1, 0, 0, 1, 2, 47),
(48, 2, 989, 9898, 1, 2, 48),
(49, 2, 78778, 7878, 1, 2, 49),
(50, 2, 23232, 2323, 1, 2, 50),
(51, 2, 0, 0, 2, 2, 51),
(52, 2, 879, 678, 2, 1, 52),
(53, 2, 0, 0, 1, 2, 53),
(54, 2, 876, 76786, 2, 2, 54),
(55, 2, 786, 86876, 2, 1, 55),
(56, 2, 76786, 76876, 1, 1, 56),
(57, 2, 0, 0, 1, 2, 57),
(58, 1, 898, 8989, 1, 2, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_ip_backbone`
--

CREATE TABLE IF NOT EXISTS `direcciones_ip_backbone` (
  `cod_bak` int(11) NOT NULL,
  `direccionip_bak` varchar(120) NOT NULL,
  `descripcionip_bak` varchar(150) NOT NULL,
  `cod_det` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones_ip_backbone`
--

INSERT INTO `direcciones_ip_backbone` (`cod_bak`, `direccionip_bak`, `descripcionip_bak`, `cod_det`) VALUES
(13, '', '', 28),
(14, '', '', 28),
(18, '', '', 33),
(19, '', '', 34),
(26, '121.121.121.121', '', 40),
(27, '', '', 41),
(28, '', '', 41),
(29, '', '', 42),
(30, '', '', 43),
(31, '121.212.112.1', 'ESTA', 44),
(32, '', '', 45),
(33, '', '', 46),
(34, '', '', 47),
(35, '', '', 48),
(36, '', '', 49),
(37, '', '', 50),
(38, '', '', 50),
(39, '', '', 51),
(40, '', '', 51),
(41, '', '', 52),
(42, '', '', 53),
(43, '', '', 54),
(44, '190.168.235.120', 'la numero 1', 55),
(45, '190.168.212.', 'el taxi 1', 56),
(46, '190.168.122.', 'el taxi 2', 56),
(47, '190.168.', 'esta uno', 57),
(48, '190.168.230.', 'esn esta es la mejor', 57),
(49, '190.168.232.121', '97897987', 58),
(50, '190.168.232.123', '87987', 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_ip_bakcbone_emp`
--

CREATE TABLE IF NOT EXISTS `direcciones_ip_bakcbone_emp` (
  `cod_bak_emp` int(11) NOT NULL,
  `direccionip_bak_emp` varchar(50) NOT NULL,
  `descripcion_bak_emp` varchar(222) NOT NULL,
  `cod_det_emp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones_ip_bakcbone_emp`
--

INSERT INTO `direcciones_ip_bakcbone_emp` (`cod_bak_emp`, `direccionip_bak_emp`, `descripcion_bak_emp`, `cod_det_emp`) VALUES
(1, '190.168.120.120', 'seÃ±or 1', 59),
(2, '190.168.', '82383', 60),
(3, '190.168.121.121', 'la dos', 60),
(4, '190.168.', 'la numero 1', 61),
(5, '190.168.', 'la numero 2', 61),
(6, '190.168.12', '12', 62),
(7, '190.168.', '23232', 62),
(8, '190.168.', '12', 63),
(9, '190.168.121.', '1212', 64),
(10, '190.168.', '12212', 65),
(11, '190.168.', '121212', 65),
(12, '190.168.189.', 'nacion', 66),
(13, '190.168.', 'nacion', 66),
(14, '190.168.', 'gayy1', 67),
(15, '190.168.', 'gayy2', 67),
(16, '190.168.', 'esta es la otra', 68),
(17, '190.168.', 'esta es la otra', 68);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_ip_clientes`
--

CREATE TABLE IF NOT EXISTS `direcciones_ip_clientes` (
  `cod_cli` int(11) NOT NULL,
  `direccionip_cli` varchar(110) NOT NULL,
  `descripcionip_cli` varchar(170) NOT NULL,
  `cod_det` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones_ip_clientes`
--

INSERT INTO `direcciones_ip_clientes` (`cod_cli`, `direccionip_cli`, `descripcionip_cli`, `cod_det`) VALUES
(17, '', '', 28),
(18, '', '', 28),
(23, '', '', 33),
(24, '', '', 34),
(30, '', '', 40),
(31, '', '', 41),
(32, '', '', 42),
(33, '', '', 43),
(34, '121.121.211.21', 'ESTA', 44),
(35, '', '', 45),
(36, '', '', 46),
(37, '', '', 47),
(38, '', '', 48),
(39, '', '', 49),
(40, '', '', 50),
(41, '', '', 50),
(42, '', '', 51),
(43, '', '', 51),
(44, '', '', 52),
(45, '', '', 53),
(46, '', '', 54),
(47, '190.168.120.120', 'la numero  dos', 55),
(48, '190.168.', 'el taxi 1', 56),
(49, '190.168.', 'el taxi 2', 56),
(50, '190.168.', '', 57),
(51, '190.168.222.22', '', 58),
(52, '190.168.222.22', '', 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_ip_clientes_emp`
--

CREATE TABLE IF NOT EXISTS `direcciones_ip_clientes_emp` (
  `cod_cli_emp` int(11) NOT NULL,
  `direccionip_cli_emp` varchar(50) NOT NULL,
  `descripcionip_cli_emp` varchar(220) NOT NULL,
  `cod_det_emp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones_ip_clientes_emp`
--

INSERT INTO `direcciones_ip_clientes_emp` (`cod_cli_emp`, `direccionip_cli_emp`, `descripcionip_cli_emp`, `cod_det_emp`) VALUES
(1, '190.168.', 'seÃ±o1', 59),
(2, '190.168.12', 'la uno', 60),
(3, '190.168.121.121', 'la dos', 60),
(4, '190.168.223.', 'la numero 1', 61),
(5, '190.168.', 'la numero 2', 61),
(6, '190.168.', 'la numero3', 61),
(7, '190.168.', '12121', 62),
(8, '190.168.', '1212', 62),
(9, '190.168.', '23232', 62),
(10, '190.168.', '21', 63),
(11, '190.168.12', '', 64),
(12, '190.168.', '21212', 65),
(13, '190.168.', '12121', 65),
(14, '190.168.', 'nacion', 66),
(15, '190.168.', 'nacion', 66),
(16, '190.168.', 'gay1', 67),
(17, '190.168.', 'gay2', 67),
(18, '190.168.', 'esta es la1', 68),
(19, '190.168.', 'esta es la 2', 68);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_ip_equipos`
--

CREATE TABLE IF NOT EXISTS `direcciones_ip_equipos` (
  `cod_dir` int(11) NOT NULL,
  `direccion_ip` varchar(110) NOT NULL,
  `mac_ip` varchar(110) NOT NULL,
  `descripcion` varchar(230) NOT NULL,
  `cod_det` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones_ip_equipos`
--

INSERT INTO `direcciones_ip_equipos` (`cod_dir`, `direccion_ip`, `mac_ip`, `descripcion`, `cod_det`) VALUES
(3, '', '', '', 33),
(4, '', '', '', 34),
(10, '', '', '', 40),
(11, '', '', '', 41),
(12, '', '', '', 42),
(13, '', '', '', 43),
(14, '121.121.121.121', 'ESTA ', 'ESTA', 44),
(15, '222.222.222.222', '', 'ESTA', 44),
(16, '', '', '', 45),
(17, '', '', '', 46),
(18, '', '', '', 47),
(19, '', '', '', 48),
(20, '', '', '', 48),
(21, '', '', '', 48),
(22, '', '', '', 49),
(23, '', '', '', 49),
(24, '', '', '', 50),
(25, '', '', '', 50),
(26, '', '', '', 51),
(27, '', '', '', 51),
(28, '', '', '', 52),
(29, '', '', '', 53),
(30, '', '', '', 54),
(31, '190.168.', '232323', 'la numero 1', 55),
(32, '190.168.', '8789789', 'el taxi 1', 56),
(33, '190.168.', '0', 'el taxi 2', 56),
(34, '190.168.78', '0', 'la uni', 57),
(35, '190.1682222.', '222222', '', 58),
(36, '190.168.222.', '22222', '', 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_ip_equipos_emp`
--

CREATE TABLE IF NOT EXISTS `direcciones_ip_equipos_emp` (
  `cod_dir_emp` int(11) NOT NULL,
  `direccionip_emp` varchar(50) NOT NULL,
  `mac_emp` varchar(50) NOT NULL,
  `descripcion_emp` varchar(180) NOT NULL,
  `cod_det` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direcciones_ip_equipos_emp`
--

INSERT INTO `direcciones_ip_equipos_emp` (`cod_dir_emp`, `direccionip_emp`, `mac_emp`, `descripcion_emp`, `cod_det`) VALUES
(1, '190.168.', '2327327', 'seÃ±or 1', 59),
(2, '190.168.121.', 'asasa', 'la uno', 60),
(3, '190.168.', '21212', 'la dos', 60),
(4, '190.168.', '2323', 'la numero 1', 61),
(5, '190.168.', '0', 'la numero 2', 61),
(6, '190.168.', '0', 'dada', 62),
(7, '190.168.', '0', 'sdsadad', 62),
(8, '190.168.', '0', '1', 63),
(9, '190.168.', '0', '', 64),
(10, '190.168.', '0', '121212', 65),
(11, '190.168.', '0', '121212', 65),
(12, '190.168.', '0', 'nacion', 66),
(13, '190.168.', '0', 'nacion', 66),
(14, '190.168.', '', 'gay1', 67),
(15, '190.168.', '0', 'gay2', 67),
(16, '190.168.', '0', 'esta es la 1', 68),
(17, '190.168.', '0', 'est es la 2', 68);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposervicio_empresarial`
--

CREATE TABLE IF NOT EXISTS `tiposervicio_empresarial` (
  `cod_ser_emp` int(11) NOT NULL,
  `tipo_servicio_emp` int(11) NOT NULL,
  `estado_servicio_emp` int(11) NOT NULL,
  `formatocontrato_emp` int(11) NOT NULL,
  `numcontrato_emp` int(11) NOT NULL,
  `fechainicio_emp` date NOT NULL,
  `fechafin_emp` date NOT NULL,
  `asesorcomercial_emp` int(11) NOT NULL,
  `descripcioncomercial_emp` varchar(220) NOT NULL,
  `cod_ubicacion_emp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiposervicio_empresarial`
--

INSERT INTO `tiposervicio_empresarial` (`cod_ser_emp`, `tipo_servicio_emp`, `estado_servicio_emp`, `formatocontrato_emp`, `numcontrato_emp`, `fechainicio_emp`, `fechafin_emp`, `asesorcomercial_emp`, `descripcioncomercial_emp`, `cod_ubicacion_emp`) VALUES
(59, 3, 2, 2, 8923, '2015-08-20', '2015-08-11', 2, '', 82),
(60, 2, 2, 2, 9872, '2015-08-06', '2015-08-05', 3, '', 84),
(61, 4, 3, 2, 812, '2015-08-12', '2015-08-18', 1, '', 85),
(62, 2, 2, 1, 144, '2015-08-27', '2015-08-31', 2, '', 86),
(63, 2, 2, 1, 909, '2015-08-26', '2015-08-23', 2, '', 87),
(64, 2, 1, 1, 121212, '2015-08-19', '2015-08-23', 3, '', 88),
(65, 2, 1, 1, 121, '2015-08-19', '2015-09-01', 1, '', 89),
(66, 1, 2, 2, 180, '2015-08-27', '2015-08-24', 2, '', 1),
(67, 3, 2, 1, 1212, '2015-08-19', '2015-08-19', 3, '', 90),
(68, 2, 2, 1, 891, '2015-08-06', '2015-08-26', 4, '', 92);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposervicio_personal`
--

CREATE TABLE IF NOT EXISTS `tiposervicio_personal` (
  `cod_ser` int(11) NOT NULL,
  `tiposervicio` int(11) NOT NULL,
  `estadoservicio` int(11) NOT NULL,
  `formatocontrato_ser` int(11) NOT NULL,
  `numcontrato_ser` int(11) NOT NULL,
  `fechainicio_ser` date NOT NULL,
  `fechafin_ser` date NOT NULL,
  `asesorcomercial_ser` int(11) NOT NULL,
  `descripcomercial_ser` varchar(250) NOT NULL,
  `cod_ubicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiposervicio_personal`
--

INSERT INTO `tiposervicio_personal` (`cod_ser`, `tiposervicio`, `estadoservicio`, `formatocontrato_ser`, `numcontrato_ser`, `fechainicio_ser`, `fechafin_ser`, `asesorcomercial_ser`, `descripcomercial_ser`, `cod_ubicacion`) VALUES
(1, 2, 0, 1, 8798, '2015-07-10', '2015-07-16', 4, '', 2),
(2, 4, 1, 1, 76876, '2015-07-03', '2015-07-09', 3, '', 3),
(3, 3, 0, 2, 878, '2015-07-23', '2015-07-21', 3, '', 4),
(8, 3, 0, 1, 78678, '2015-07-24', '2015-07-30', 1, '', 9),
(9, 3, 2, 1, 120, '2015-07-10', '2016-05-13', 3, '', 13),
(10, 0, 0, 2, 879, '2015-07-11', '2015-07-23', 2, '', 14),
(13, 2, 1, 1, 78, '2015-07-01', '2015-07-02', 3, '', 21),
(14, 2, 2, 2, 887, '2015-07-16', '2015-07-16', 2, '', 22),
(15, 3, 1, 1, 88878, '2015-07-18', '2015-07-17', 3, '', 24),
(16, 3, 2, 1, 90, '2015-07-16', '2015-07-14', 1, '', 25),
(17, 3, 2, 2, 99, '2015-07-09', '2015-07-22', 3, '', 26),
(18, 3, 2, 2, 897, '2015-07-02', '2015-07-02', 2, '', 27),
(19, 4, 2, 2, 98, '2015-07-02', '2015-07-16', 3, '', 28),
(20, 4, 2, 2, 98, '2015-07-02', '2015-07-16', 3, '', 29),
(21, 4, 2, 2, 98, '2015-07-02', '2015-07-16', 3, '', 30),
(22, 3, 1, 2, 999, '2015-07-03', '2015-07-16', 3, '', 31),
(23, 3, 1, 2, 999, '2015-07-03', '2015-07-16', 3, '', 32),
(24, 2, 2, 2, 89, '2015-07-02', '2015-07-22', 2, '', 33),
(25, 2, 2, 2, 89, '2015-07-02', '2015-07-22', 2, '', 34),
(26, 2, 2, 1, 87, '2015-07-10', '2015-07-16', 4, '', 35),
(27, 2, 2, 1, 87, '2015-07-10', '2015-07-16', 4, '', 36),
(28, 4, 1, 1, 987, '2015-07-02', '2015-07-08', 3, '', 37),
(29, 2, 2, 1, 23, '2015-07-02', '2015-07-30', 2, '', 38),
(33, 2, 2, 1, 887, '2015-07-16', '2015-07-21', 4, '', 42),
(34, 2, 3, 2, 98, '2015-07-08', '2015-07-15', 3, '', 43),
(40, 2, 3, 3, 99, '2015-07-30', '2015-07-14', 4, 'gyuhuyyh', 47),
(41, 4, 2, 1, 99, '2015-07-21', '2015-07-22', 3, '', 47),
(42, 3, 2, 2, 989, '2015-07-15', '2015-07-08', 2, '', 59),
(43, 3, 2, 2, 98, '2015-07-09', '2015-07-22', 2, '', 60),
(44, 2, 3, 2, 899, '2015-07-15', '2015-07-09', 3, '', 61),
(45, 5, 1, 2, 987, '2015-07-08', '2015-07-21', 2, '', 62),
(46, 2, 3, 1, 89, '2015-07-17', '2015-07-22', 2, '', 63),
(47, 4, 2, 2, 9899, '2015-07-16', '2015-07-29', 3, '', 64),
(48, 1, 2, 2, 678, '2015-08-26', '2015-08-31', 3, '', 65),
(49, 3, 2, 2, 890, '2015-08-12', '2015-08-19', 2, '', 65),
(50, 5, 2, 1, 232, '2015-08-05', '2015-08-26', 4, '', 65),
(51, 5, 3, 1, 878, '2015-09-03', '2015-08-17', 2, '', 66),
(52, 2, 3, 1, 12, '2015-08-14', '2015-09-02', 3, '', 67),
(53, 3, 2, 1, 8789, '2015-08-19', '2015-08-12', 2, '', 68),
(54, 3, 2, 1, 8789, '2015-08-19', '2015-08-12', 2, '', 69),
(55, 2, 3, 2, 120, '2015-08-13', '2015-08-26', 2, '', 70),
(56, 4, 1, 3, 89789, '2015-08-27', '2015-08-26', 2, '', 71),
(57, 3, 3, 2, 893, '2015-08-13', '2015-08-31', 4, '', 72),
(58, 3, 2, 3, 78, '2015-08-20', '2015-08-26', 2, '', 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion_servicio_empresarial`
--

CREATE TABLE IF NOT EXISTS `ubicacion_servicio_empresarial` (
  `cod_ubi_emp` int(11) NOT NULL,
  `nombreubi_emp` varchar(180) NOT NULL,
  `direccionubi_emp` varchar(180) NOT NULL,
  `municipioubi_emp` int(11) NOT NULL,
  `nombre_per_sitio_ubi` varchar(180) NOT NULL,
  `apellido_per_sitio_ubi` varchar(180) NOT NULL,
  `telefono_per_sitio_ubi` bigint(20) NOT NULL,
  `celular_per_sitio_ubi` bigint(20) NOT NULL,
  `email_per_sitio_ubi` varchar(180) NOT NULL,
  `cod_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicacion_servicio_empresarial`
--

INSERT INTO `ubicacion_servicio_empresarial` (`cod_ubi_emp`, `nombreubi_emp`, `direccionubi_emp`, `municipioubi_emp`, `nombre_per_sitio_ubi`, `apellido_per_sitio_ubi`, `telefono_per_sitio_ubi`, `celular_per_sitio_ubi`, `email_per_sitio_ubi`, `cod_empresa`) VALUES
(1, 'casa 6', 'askajklsa', 4, '', '', 0, 0, '', 4),
(2, 'casa 3', 'calle 12', 2, '', '', 0, 0, '', 5),
(3, 'sasaa', 'adada', 3, '', '', 0, 0, '', 6),
(4, 'sdad', 'adad', 3, '', '', 0, 0, '', 7),
(82, 'casa 2', 'calle 10 #12-89', 3, '', '', 0, 0, '', 40),
(83, 'asas', 'ljaslkj', 1, '', '', 0, 0, '', 41),
(84, 'asas', 'asas', 4, '', '', 0, 0, '', 42),
(85, 'bodega1', 'av bocono', 1, '', '', 0, 0, '', 43),
(86, 'danny', 'asjak', 1, '', '', 0, 0, '', 44),
(87, 'asa', 'jhjh', 1, '', '', 0, 0, '', 45),
(88, 'asnas', 'asas', 3, '', '', 0, 0, '', 46),
(89, 'assa', 'asas', 2, '', '', 0, 0, '', 47),
(90, 'sdgh', 'ghjgjh', 1, '', '', 0, 0, '', 4),
(91, 'shjh', 'kjjkh', 1, '', '', 0, 0, '', 4),
(92, 'casa3', 'calle 15', 2, '', '', 0, 0, '', 4),
(93, 'hotel 1', 'calle 14#12-12', 4, '', '', 0, 0, '', 48),
(94, 'casa 7', 'colegio principal', 2, '', '', 0, 0, '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion_servicio_personal`
--

CREATE TABLE IF NOT EXISTS `ubicacion_servicio_personal` (
  `cod_ubi` int(11) NOT NULL,
  `nombre_ubi` varchar(130) NOT NULL,
  `direccion_ubi` varchar(130) NOT NULL,
  `municipio_ubi` int(11) NOT NULL,
  `nombre_per_sitio_ubi` varchar(139) NOT NULL,
  `apellido_per_sitio_ubi` varchar(138) NOT NULL,
  `telefono_per_sitio_ubi` bigint(20) NOT NULL,
  `celular_per_sitio_ubi` bigint(20) NOT NULL,
  `email_per_sitio_ubi` varchar(80) NOT NULL,
  `cod_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicacion_servicio_personal`
--

INSERT INTO `ubicacion_servicio_personal` (`cod_ubi`, `nombre_ubi`, `direccion_ubi`, `municipio_ubi`, `nombre_per_sitio_ubi`, `apellido_per_sitio_ubi`, `telefono_per_sitio_ubi`, `celular_per_sitio_ubi`, `email_per_sitio_ubi`, `cod_persona`) VALUES
(2, 'jkhk', 'hhj', 1, '887', '6876', 76876, 78678, 'juli@ddds.com', 5),
(3, 'apartamento', 'QUINTA oriental', 1, 'asjka', 'jkjh', 0, 77, 'mil@milc.om', 6),
(4, 'khjk', 'casa 34', 1, '', '', 0, 0, 'los@mol.cp', 7),
(9, 'hsdjsk', 'hjkhdjs', 1, '', '', 0, 0, 'mil@mil.com', 12),
(13, 'Casa 1', 'calle 20 #19-12 caobos', 1, 'Carlos ', 'Bustamante', 0, 3156789809, 'carlos@xn--mi-0ja.com', 13),
(14, 'cucuta', 'mil.co', 2, '', '', 0, 0, 'Sel@mil.xom', 14),
(15, 'nkd', 'jhjkj', 2, '', '', 0, 0, '', 13),
(21, 'casa 3', 'calle 30 3l llano', 1, '', '', 0, 0, '', 13),
(22, 'casa 7', 'calle 12 #12-12 llibertad', 2, '', '', 0, 0, '', 14),
(23, 'casa 5', 'jcahjkcah', 3, '', '', 0, 0, '', 13),
(24, 'casa 7', 'ankdajkdh', 1, '', '', 0, 0, '', 13),
(25, 'casa 4', 'xuxuta', 1, '', '', 0, 0, 'mil@mi.lcom', 15),
(26, 'hotel', 'JUI', 2, '', '', 0, 0, 'LOP@IL.COM', 16),
(27, 'casa 2', 'casas', 1, '', '', 0, 0, '', 15),
(28, 'ui', 'jahsas', 2, '', '', 0, 0, '', 15),
(29, 'ui', 'jahsas', 2, '', '', 0, 0, '', 15),
(30, 'ui', 'jahsas', 2, '', '', 0, 0, '', 15),
(31, '99j', 'jjj', 2, '', '', 0, 0, '', 15),
(32, 'sede 1', 'calle 120', 2, '', '', 0, 0, '', 15),
(33, '99j', 'jjj', 2, '', '', 0, 313719317, 'rojas@mil.com', 15),
(34, '99j', 'jjj', 2, '', '', 0, 0, '', 15),
(35, 'casa7', 'kajsj', 2, '', '', 0, 0, '', 15),
(36, 'casa7', 'kajsj', 2, '', '', 0, 0, '', 15),
(37, 'poli', 'lok', 2, '', '', 0, 0, '', 15),
(38, 'hhuj', 'jjh', 2, '', '', 0, 0, '', 15),
(42, 'shg', 'gjhgjh', 1, '', '', 0, 0, '', 13),
(43, 'juuad', 'uj', 3, '', '', 0, 0, '', 17),
(44, 'casa7', 'dkkdj', 2, '', '', 0, 0, '', 17),
(47, 'casa 4', 'calle 12', 3, '', '', 0, 0, '', 18),
(48, 'casa 2', 'calle 15 torcorma', 2, '', '', 0, 0, '', 19),
(49, 'kanlk', 'kjklj', 2, '', '', 0, 0, '', 20),
(50, 'sdsdssdd', 'sdsd', 2, '', '', 0, 0, '', 21),
(51, 'ssdsds', 'csds', 4, '', '', 0, 0, '', 22),
(52, 'asa', 'aas', 3, '', '', 0, 0, '', 23),
(53, 'kj', 'kjkjkl', 2, '', '', 0, 0, '', 24),
(54, 'as', 'sdsd', 3, '', '', 0, 0, '', 25),
(55, 'as', 'sdsd', 3, '', '', 0, 0, '', 26),
(56, 'as', 'sdsd', 3, '', '', 0, 0, '', 27),
(57, 'aadassadsads', 'dsdas', 1, '', '', 0, 0, '', 28),
(58, 'asas', 'sasakls', 2, '', '', 0, 0, '', 29),
(59, 'casa 2', 'calle 12 libertad', 3, '', '', 0, 3276786, '', 30),
(60, 'SDS', 'SDAS', 2, '', '', 0, 0, '', 14),
(61, 'casa45', 'av el bosque en la esquina', 2, '', '', 0, 0, '', 14),
(62, 'wejw', 'jlkj', 2, '', '', 0, 0, '', 16),
(63, 'shjk', 'kjkj', 3, '', '', 0, 0, '', 16),
(64, 'hsakjh', 'lkhkl', 1, '', '', 0, 0, '', 17),
(65, 'verifique est', 'el solo', 2, '', '', 0, 0, '', 14),
(66, 'polo', 'klad', 2, '', '', 0, 0, '', 14),
(67, 'ajgshj', 'dsds', 2, '', '', 0, 0, '', 31),
(68, 'polo', 'jhsdjsh', 2, '', '', 0, 0, '', 32),
(69, 'polo', 'jhsdjsh', 2, '', '', 0, 0, '', 33),
(70, 'casa 6', 'calle 15 #12-90 libertad', 2, '', '', 0, 0, '', 34),
(71, 'ahsjash', 'khkjhkj', 3, '', '', 0, 0, '', 35),
(72, 'casa 2', 'calle 16', 1, 'carolina', 'rojas', 0, 6287362783, '', 36),
(73, 'casa 4', 'calle 15', 4, '', '', 0, 0, '', 36),
(74, 'casa7', 'kjkj', 2, '', '', 0, 0, '', 36),
(75, 'jkhkjh', 'khkjh', 1, '', '', 0, 0, '', 36),
(76, '7687', '76786', 2, '', '', 0, 0, '', 36),
(77, 'apartamento 3', 'sdsd', 2, '', '', 0, 0, '', 36),
(78, 'kjhkj', 'hjkhjkh', 1, '', '', 0, 0, '', 36),
(79, 'KJLJ', 'HJK', 1, '', '', 0, 0, '', 37),
(80, 'KJLJ', 'HJK', 1, '', '', 0, 0, '', 38),
(81, 'sdd', 'jkldajd', 1, '', '', 0, 0, '', 39),
(82, 'asaj', 'hjkhjk', 1, '', '', 0, 0, '', 14),
(83, 'casa 898', 'aa', 2, '', '', 0, 0, '', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `documento_usu` int(11) NOT NULL,
  `nombre_usu` varchar(110) NOT NULL,
  `apellido_usu` varchar(110) NOT NULL,
  `telefono_usu` int(11) NOT NULL,
  `imagen_usu` varchar(110) NOT NULL,
  `admin` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`documento_usu`, `nombre_usu`, `apellido_usu`, `telefono_usu`, `imagen_usu`, `admin`) VALUES
(3012, 'James', 'Garcia', 56922, 'img_3012.png', 'soporte'),
(14502, 'Jose', 'Perez', 31024569, 'img_14502.png', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `bd_antenas`
--
ALTER TABLE `bd_antenas`
  ADD PRIMARY KEY (`cod_ant`);

--
-- Indices de la tabla `bd_asesorescomerciales`
--
ALTER TABLE `bd_asesorescomerciales`
  ADD PRIMARY KEY (`cod_ase`);

--
-- Indices de la tabla `bd_estadoservicio`
--
ALTER TABLE `bd_estadoservicio`
  ADD PRIMARY KEY (`cod_est`);

--
-- Indices de la tabla `bd_formatoscontrato`
--
ALTER TABLE `bd_formatoscontrato`
  ADD PRIMARY KEY (`cod_for`);

--
-- Indices de la tabla `bd_municipios`
--
ALTER TABLE `bd_municipios`
  ADD PRIMARY KEY (`cod_mun`);

--
-- Indices de la tabla `bd_nodo`
--
ALTER TABLE `bd_nodo`
  ADD PRIMARY KEY (`cod_nod`);

--
-- Indices de la tabla `bd_tipoconexion`
--
ALTER TABLE `bd_tipoconexion`
  ADD PRIMARY KEY (`cod_con`);

--
-- Indices de la tabla `bd_tiposervicio`
--
ALTER TABLE `bd_tiposervicio`
  ADD PRIMARY KEY (`cod_tp`);

--
-- Indices de la tabla `datos_clientes_empresariales`
--
ALTER TABLE `datos_clientes_empresariales`
  ADD PRIMARY KEY (`cod_emp`),
  ADD KEY `municipio_emp` (`municipio_emp`);

--
-- Indices de la tabla `datos_clientes_personales`
--
ALTER TABLE `datos_clientes_personales`
  ADD PRIMARY KEY (`cod_cli`),
  ADD KEY `municipio_cli` (`municipio_cli`);

--
-- Indices de la tabla `detalleservicio_empresarial`
--
ALTER TABLE `detalleservicio_empresarial`
  ADD PRIMARY KEY (`cod_det_emp`),
  ADD KEY `tipocone_emp` (`tipocone_emp`),
  ADD KEY `nodo_emp` (`nodo_emp`),
  ADD KEY `antena_emp` (`antena_emp`),
  ADD KEY `cod_servicio_emp` (`cod_servicio_emp`);

--
-- Indices de la tabla `detalleservicio_personal`
--
ALTER TABLE `detalleservicio_personal`
  ADD PRIMARY KEY (`cod_det`),
  ADD KEY `cod_tiposervicio` (`cod_tiposervicio`),
  ADD KEY `nodo_det` (`nodo_det`),
  ADD KEY `antena_det` (`antena_det`),
  ADD KEY `tipoconex` (`tipoconex`);

--
-- Indices de la tabla `direcciones_ip_backbone`
--
ALTER TABLE `direcciones_ip_backbone`
  ADD PRIMARY KEY (`cod_bak`),
  ADD KEY `cod_det` (`cod_det`);

--
-- Indices de la tabla `direcciones_ip_bakcbone_emp`
--
ALTER TABLE `direcciones_ip_bakcbone_emp`
  ADD PRIMARY KEY (`cod_bak_emp`),
  ADD KEY `cod_det_emp` (`cod_det_emp`);

--
-- Indices de la tabla `direcciones_ip_clientes`
--
ALTER TABLE `direcciones_ip_clientes`
  ADD PRIMARY KEY (`cod_cli`),
  ADD KEY `cod_det` (`cod_det`);

--
-- Indices de la tabla `direcciones_ip_clientes_emp`
--
ALTER TABLE `direcciones_ip_clientes_emp`
  ADD PRIMARY KEY (`cod_cli_emp`),
  ADD KEY `cod_det_emp` (`cod_det_emp`);

--
-- Indices de la tabla `direcciones_ip_equipos`
--
ALTER TABLE `direcciones_ip_equipos`
  ADD PRIMARY KEY (`cod_dir`),
  ADD KEY `cod_det` (`cod_det`);

--
-- Indices de la tabla `direcciones_ip_equipos_emp`
--
ALTER TABLE `direcciones_ip_equipos_emp`
  ADD PRIMARY KEY (`cod_dir_emp`),
  ADD KEY `cod_det` (`cod_det`);

--
-- Indices de la tabla `tiposervicio_empresarial`
--
ALTER TABLE `tiposervicio_empresarial`
  ADD PRIMARY KEY (`cod_ser_emp`),
  ADD KEY `tipo_servicio_emp` (`tipo_servicio_emp`),
  ADD KEY `estado_servicio_emp` (`estado_servicio_emp`),
  ADD KEY `formatocontrato_emp` (`formatocontrato_emp`),
  ADD KEY `asesorcomercial_emp` (`asesorcomercial_emp`),
  ADD KEY `cod_ubicacion_emp` (`cod_ubicacion_emp`);

--
-- Indices de la tabla `tiposervicio_personal`
--
ALTER TABLE `tiposervicio_personal`
  ADD PRIMARY KEY (`cod_ser`),
  ADD KEY `cod_ubicacion` (`cod_ubicacion`),
  ADD KEY `tiposervicio` (`tiposervicio`),
  ADD KEY `estadoservicio` (`estadoservicio`),
  ADD KEY `formatocontrato_ser` (`formatocontrato_ser`),
  ADD KEY `asesorcomercial_ser` (`asesorcomercial_ser`);

--
-- Indices de la tabla `ubicacion_servicio_empresarial`
--
ALTER TABLE `ubicacion_servicio_empresarial`
  ADD PRIMARY KEY (`cod_ubi_emp`),
  ADD KEY `municipioubi_emp` (`municipioubi_emp`),
  ADD KEY `cod_empresa` (`cod_empresa`);

--
-- Indices de la tabla `ubicacion_servicio_personal`
--
ALTER TABLE `ubicacion_servicio_personal`
  ADD PRIMARY KEY (`cod_ubi`),
  ADD KEY `cod_persona` (`cod_persona`),
  ADD KEY `municipio_ubi` (`municipio_ubi`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`documento_usu`),
  ADD KEY `admin` (`admin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `direcciones_ip_backbone`
--
ALTER TABLE `direcciones_ip_backbone`
  MODIFY `cod_bak` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `direcciones_ip_bakcbone_emp`
--
ALTER TABLE `direcciones_ip_bakcbone_emp`
  MODIFY `cod_bak_emp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `direcciones_ip_clientes`
--
ALTER TABLE `direcciones_ip_clientes`
  MODIFY `cod_cli` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `direcciones_ip_clientes_emp`
--
ALTER TABLE `direcciones_ip_clientes_emp`
  MODIFY `cod_cli_emp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `direcciones_ip_equipos`
--
ALTER TABLE `direcciones_ip_equipos`
  MODIFY `cod_dir` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `direcciones_ip_equipos_emp`
--
ALTER TABLE `direcciones_ip_equipos_emp`
  MODIFY `cod_dir_emp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datos_clientes_empresariales`
--
ALTER TABLE `datos_clientes_empresariales`
  ADD CONSTRAINT `datos_clientes_empresariales_ibfk_1` FOREIGN KEY (`municipio_emp`) REFERENCES `bd_municipios` (`cod_mun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datos_clientes_personales`
--
ALTER TABLE `datos_clientes_personales`
  ADD CONSTRAINT `datos_clientes_personales_ibfk_1` FOREIGN KEY (`municipio_cli`) REFERENCES `bd_municipios` (`cod_mun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleservicio_empresarial`
--
ALTER TABLE `detalleservicio_empresarial`
  ADD CONSTRAINT `detalleservicio_empresarial_ibfk_1` FOREIGN KEY (`cod_servicio_emp`) REFERENCES `tiposervicio_empresarial` (`cod_ser_emp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleservicio_empresarial_ibfk_2` FOREIGN KEY (`tipocone_emp`) REFERENCES `bd_tipoconexion` (`cod_con`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleservicio_empresarial_ibfk_4` FOREIGN KEY (`nodo_emp`) REFERENCES `bd_nodo` (`cod_nod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleservicio_empresarial_ibfk_5` FOREIGN KEY (`antena_emp`) REFERENCES `bd_antenas` (`cod_ant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleservicio_personal`
--
ALTER TABLE `detalleservicio_personal`
  ADD CONSTRAINT `detalleservicio_personal_ibfk_1` FOREIGN KEY (`cod_tiposervicio`) REFERENCES `tiposervicio_personal` (`cod_ser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleservicio_personal_ibfk_2` FOREIGN KEY (`nodo_det`) REFERENCES `bd_nodo` (`cod_nod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleservicio_personal_ibfk_3` FOREIGN KEY (`antena_det`) REFERENCES `bd_antenas` (`cod_ant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleservicio_personal_ibfk_4` FOREIGN KEY (`tipoconex`) REFERENCES `bd_tipoconexion` (`cod_con`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones_ip_backbone`
--
ALTER TABLE `direcciones_ip_backbone`
  ADD CONSTRAINT `direcciones_IP_Backbone_ibfk_1` FOREIGN KEY (`cod_det`) REFERENCES `detalleservicio_personal` (`cod_det`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones_ip_bakcbone_emp`
--
ALTER TABLE `direcciones_ip_bakcbone_emp`
  ADD CONSTRAINT `direcciones_ip_bakcbone_emp_ibfk_1` FOREIGN KEY (`cod_det_emp`) REFERENCES `detalleservicio_empresarial` (`cod_det_emp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones_ip_clientes`
--
ALTER TABLE `direcciones_ip_clientes`
  ADD CONSTRAINT `direcciones_IP_Clientes_ibfk_1` FOREIGN KEY (`cod_det`) REFERENCES `detalleservicio_personal` (`cod_det`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones_ip_clientes_emp`
--
ALTER TABLE `direcciones_ip_clientes_emp`
  ADD CONSTRAINT `direcciones_ip_clientes_emp_ibfk_1` FOREIGN KEY (`cod_det_emp`) REFERENCES `detalleservicio_empresarial` (`cod_det_emp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones_ip_equipos`
--
ALTER TABLE `direcciones_ip_equipos`
  ADD CONSTRAINT `direcciones_IP_Equipos_ibfk_1` FOREIGN KEY (`cod_det`) REFERENCES `detalleservicio_personal` (`cod_det`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones_ip_equipos_emp`
--
ALTER TABLE `direcciones_ip_equipos_emp`
  ADD CONSTRAINT `direcciones_ip_equipos_emp_ibfk_1` FOREIGN KEY (`cod_det`) REFERENCES `detalleservicio_empresarial` (`cod_det_emp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiposervicio_empresarial`
--
ALTER TABLE `tiposervicio_empresarial`
  ADD CONSTRAINT `tiposervicio_empresarial_ibfk_1` FOREIGN KEY (`tipo_servicio_emp`) REFERENCES `bd_tiposervicio` (`cod_tp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_empresarial_ibfk_2` FOREIGN KEY (`estado_servicio_emp`) REFERENCES `bd_estadoservicio` (`cod_est`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_empresarial_ibfk_3` FOREIGN KEY (`formatocontrato_emp`) REFERENCES `bd_formatoscontrato` (`cod_for`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_empresarial_ibfk_4` FOREIGN KEY (`asesorcomercial_emp`) REFERENCES `bd_asesorescomerciales` (`cod_ase`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_empresarial_ibfk_5` FOREIGN KEY (`cod_ubicacion_emp`) REFERENCES `ubicacion_servicio_empresarial` (`cod_ubi_emp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiposervicio_personal`
--
ALTER TABLE `tiposervicio_personal`
  ADD CONSTRAINT `tiposervicio_personal_ibfk_1` FOREIGN KEY (`cod_ubicacion`) REFERENCES `ubicacion_servicio_personal` (`cod_ubi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_personal_ibfk_2` FOREIGN KEY (`tiposervicio`) REFERENCES `bd_tiposervicio` (`cod_tp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_personal_ibfk_3` FOREIGN KEY (`estadoservicio`) REFERENCES `bd_estadoservicio` (`cod_est`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_personal_ibfk_4` FOREIGN KEY (`asesorcomercial_ser`) REFERENCES `bd_asesorescomerciales` (`cod_ase`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiposervicio_personal_ibfk_5` FOREIGN KEY (`formatocontrato_ser`) REFERENCES `bd_formatoscontrato` (`cod_for`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicacion_servicio_empresarial`
--
ALTER TABLE `ubicacion_servicio_empresarial`
  ADD CONSTRAINT `ubicacion_servicio_empresarial_ibfk_1` FOREIGN KEY (`cod_empresa`) REFERENCES `datos_clientes_empresariales` (`cod_emp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ubicacion_servicio_empresarial_ibfk_2` FOREIGN KEY (`municipioubi_emp`) REFERENCES `bd_municipios` (`cod_mun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicacion_servicio_personal`
--
ALTER TABLE `ubicacion_servicio_personal`
  ADD CONSTRAINT `ubicacion_servicio_personal_ibfk_1` FOREIGN KEY (`cod_persona`) REFERENCES `datos_clientes_personales` (`cod_cli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ubicacion_servicio_personal_ibfk_2` FOREIGN KEY (`municipio_ubi`) REFERENCES `bd_municipios` (`cod_mun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `admin` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

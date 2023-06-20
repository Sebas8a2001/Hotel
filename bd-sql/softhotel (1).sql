-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2022 a las 17:02:12
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `softhotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonoscreditos`
--

CREATE TABLE `abonoscreditos` (
  `codabono` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montoabono` decimal(12,2) NOT NULL,
  `fechaabono` datetime NOT NULL,
  `codsucursal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonoscreditosreservaciones`
--

CREATE TABLE `abonoscreditosreservaciones` (
  `codabono` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `codreservacion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montoabono` decimal(12,2) NOT NULL,
  `fechaabono` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonoscreditosventas`
--

CREATE TABLE `abonoscreditosventas` (
  `codabono` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montoabono` decimal(12,2) NOT NULL,
  `fechaabono` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueocaja`
--

CREATE TABLE `arqueocaja` (
  `codarqueo` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `montoinicial` float(12,2) NOT NULL,
  `ingresos` float(12,2) NOT NULL,
  `egresos` float(12,2) NOT NULL,
  `creditos` float(12,2) NOT NULL,
  `abonos` float(12,2) NOT NULL,
  `dineroefectivo` float(12,2) NOT NULL,
  `diferencia` float(12,2) NOT NULL,
  `comentarios` text NOT NULL,
  `fechaapertura` datetime NOT NULL,
  `fechacierre` varchar(30) NOT NULL,
  `statusarqueo` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `arqueocaja`
--

INSERT INTO `arqueocaja` (`codarqueo`, `codcaja`, `montoinicial`, `ingresos`, `egresos`, `creditos`, `abonos`, `dineroefectivo`, `diferencia`, `comentarios`, `fechaapertura`, `fechacierre`, `statusarqueo`) VALUES
(1, 1, 100.00, 153.40, 0.00, 0.00, 0.00, 253.40, 0.00, '', '2021-12-19 07:12:10', '2022-11-25 05:47:45', 0),
(2, 1, 100.00, 33.04, 0.00, 0.00, 0.00, 133.04, 0.00, '', '2022-11-25 05:49:10', '2022-11-27 04:54:41', 0),
(3, 1, 100.00, 477.36, 0.00, 0.00, 0.00, 0.00, 0.00, 'NINGUNO', '2022-11-29 05:40:30', '0000-00-00 00:00:00', 1),
(4, 2, 80.00, 533.36, 0.00, 0.00, 0.00, 613.36, 0.00, '', '2022-11-29 05:44:11', '2022-11-29 05:48:42', 0),
(5, 2, 120.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NINGUNO', '2022-11-29 05:49:39', '0000-00-00 00:00:00', 1),
(6, 3, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'NINGUNO', '2022-11-30 08:44:12', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `codcaja` int(11) NOT NULL,
  `nrocaja` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomcaja` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`codcaja`, `nrocaja`, `nomcaja`, `codigo`) VALUES
(1, '001', 'CAJA PRINCIPAL', 2),
(2, '100', 'CAJA RODRIGUEZ', 1),
(3, '02', 'MARBELLA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `codcategoria` int(11) NOT NULL,
  `nomcategoria` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codcategoria`, `nomcategoria`) VALUES
(1, 'PASTILLAS'),
(2, 'GALLETAS'),
(3, 'PEPITOS'),
(7, 'BEBIDAS'),
(4, 'JUGOS NATURALES'),
(5, 'ASEO PERSONAL'),
(6, 'CHOCOLATES'),
(8, 'CARAMELOS'),
(9, 'REFRESCOS DE LATA'),
(10, 'REFRESCOS DE BOTELLA'),
(11, 'TORTAS'),
(12, 'INSU. LIMPIEZA'),
(13, 'DETERGENTES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `codcliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `documcliente` int(11) NOT NULL,
  `dnicliente` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomcliente` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `paiscliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ciudadcliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccliente` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefcliente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correocliente` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `passwordcliente` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `limitecredito` float(12,2) NOT NULL,
  `fechaingreso` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `codcliente`, `documcliente`, `dnicliente`, `nomcliente`, `paiscliente`, `ciudadcliente`, `direccliente`, `telefcliente`, `correocliente`, `passwordcliente`, `limitecredito`, `fechaingreso`) VALUES
(1, 'C1', 1, '216900456', 'RUBEN DARIO CHIRINOS RODRIGUEZ', 'VE', 'CABIMAS ESTADO ZULIA', 'SECTOR PADRE GRANADO', '(0414) 7225970', '', '45e72fc395cfeed2a521192bc30ce9008bee71d7', 300.00, '2019-08-27'),
(2, 'C2', 2, '21099254', 'MOISES RODOLFO', 'VE', 'CABIMAS', 'SECTOR R10', '(0424) 6551231', '', '1bae48f0fbe2eaf45152198cfba4ee0b0a616949', 0.00, '2019-08-27'),
(3, 'C3', 2, '19144821', 'RAFAEL DE JESUS', 'VE', 'CABIMAS - ESTADO ZULIA', 'SECTOR LA PADRERA', '(0416) 5441231', 'RAF@GMAIL.COM', 'aa0b7586de1df90252560e631876f212ff1301f2', 0.00, '2019-08-27'),
(4, 'C4', 2, '1003125877', 'MARCELA DEL ROCIO', 'EC', 'URRIBARI', 'URRIBARI', '(5836) 9857885', '', 'fbe00d4012d8e3f19474c81a0183a291c54aa540', 0.00, '2019-08-27'),
(5, 'C5', 2, '15432452', 'CARLOS DAVID', 'VE', 'EL VIGIA', 'SECTOR LA PEDREGOSA', '(0424) 6541222', '', 'c3e5b78f8b0570ebea955de2740cf3183694f9c2', 0.00, '2019-08-27'),
(6, 'C6', 16, '28761982', 'RICHARD JOSSE CHIRINOS RODRIGUEZ', 'VE', 'CABIMAS', 'LOS LAURELES', '(0412) 8761009', 'RICHARDJCH@GMAIL.COM', '7b7c5179d358eb8df3ee038e450ba4e13ff0cb28', 0.00, '2019-10-17'),
(7, 'C7', 16, '18633174', 'RUBEN DARIO CHIRINOS RODRIGUEZ', 'VE', 'MERIDA', 'EL VIGIA', '(0414) 7225970', 'ELSAIYA@GMAIL.COM', '42c38bca675772b7bacc4102c079d3f250ecfa65', 0.00, '2019-11-03'),
(8, 'C8', 11, '75214587', 'JORGE', 'PE', 'LIRCAY', 'JR. CAHUIDE', '(9314) 52478', 'JUAN@GMAIL.COM', 'f8f6c65ea9feaecc930442e8e72e8f16a074fec0', 0.00, '2022-11-24'),
(9, 'C9', 11, '72318289', 'YONI BELITO SEDANO', 'PE', 'LIRCAY', 'JR. CAHUIDE ', '(9391) 64782', 'YBELITOSEDANO@GMAIL.COM', '0058aa1d720a0a778145cd896ca3fbb1402f19fd', 0.00, '2022-11-25'),
(10, 'C10', 11, '72261609', 'ELVIS ', 'PE', 'HUANCAYO', 'AVENIDA REAL', '(9874) 56321', 'ELVIS@GMAIL.COM', '2b1a82b9db244da7c11d50ad8cc5ddb558a51062', 0.00, '2022-11-25'),
(11, 'C11', 11, '88888888', 'JUAN', 'PE', 'LIMA', 'LIMA ATE', '(9874) 56254', 'JUAN@GMAIL.COM', '16f50f4168b78a35d9a684a09a921eb51d5832a8', 0.00, '2022-11-29'),
(12, 'C12', 11, '752365947', 'ANGEL', 'PE', 'LIRCAY', 'JR LIMA N 484\r\nHUANCAVELICA', '(9356) 87412', 'ANG@GMAIL.COMEL', 'e730a2efee2cd87fec234fae7c372fd174bdaf92', 0.00, '2022-11-30'),
(13, 'C13', 11, '74523698', 'JESUS', 'PE', 'LIMA', 'LIMA', '(8654) 241', 'JESUS@GMAIL.COM', '738c3cb2ed02e585e0e332c1222d36dd7f27f2c9', 0.00, '2022-11-30'),
(14, 'C14', 11, '7226165', 'MARIA GUITIERREZ', 'AU', 'LIRCAY', 'JR LIMA N 484\r\nHUANCAVELICA', '(5949', 'MARIA@GMAIL.COM', '00bb13399a70faf878628c983e62b6fc1c246ac8', 0.00, '2022-11-30'),
(15, 'C15', 11, '75468954', 'JUAN QUISPE', 'PE', 'HUANCAYO', 'HUANCAYO', '(9653) 2457', 'JUAN@GMAIL.COM', 'fdf3f65383d2a1ff0397a1b11b54aa2eb280d293', 0.00, '2022-12-02'),
(16, 'C16', 11, '75426545', 'ROSA GUZMAN', 'PE', 'LIMA', 'LIMA', '(9356) 42', 'ROSA@GMAIL.COM', 'a86473fea9b4a8514f467e3ff1aaad50cdd77e3b', 0.00, '2022-12-02'),
(17, 'C17', 11, '7548652', 'JOSE', 'PE', 'HUANCAYO', 'HUANCAYO', '(9635) 2417', 'JOSE@GMAIL.COM', '8a6267a1ac55c755de1f292224afded5dd398328', 0.00, '2022-12-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idcompra` int(11) NOT NULL,
  `codcompra` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproveedor` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `subtotalivasic` decimal(12,2) NOT NULL,
  `subtotalivanoc` decimal(12,2) NOT NULL,
  `ivac` decimal(12,2) NOT NULL,
  `totalivac` decimal(12,2) NOT NULL,
  `descuentoc` decimal(12,2) NOT NULL,
  `totaldescuentoc` decimal(12,2) NOT NULL,
  `totalpagoc` decimal(12,2) NOT NULL,
  `tipocompra` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `formacompra` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechavencecredito` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechapagado` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `statuscompra` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaemision` date NOT NULL,
  `fecharecepcion` date NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `documgerente` int(11) NOT NULL,
  `cedgerente` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomgerente` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfgerente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direcgerente` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `documenhotel` int(11) NOT NULL,
  `nrohotel` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomhotel` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfhotel` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direchotel` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `emailhotel` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `categoriahotel` int(2) NOT NULL,
  `nroactividad` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `iniciofactura` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaautorizacion` date NOT NULL,
  `llevacontabilidad` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `acerca` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `metodopago` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dsctor` decimal(12,2) NOT NULL,
  `dsctov` decimal(12,2) NOT NULL,
  `codmoneda` int(11) NOT NULL,
  `codmoneda2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `documgerente`, `cedgerente`, `nomgerente`, `tlfgerente`, `direcgerente`, `documenhotel`, `nrohotel`, `nomhotel`, `tlfhotel`, `direchotel`, `emailhotel`, `categoriahotel`, `nroactividad`, `iniciofactura`, `fechaautorizacion`, `llevacontabilidad`, `acerca`, `metodopago`, `dsctor`, `dsctov`, `codmoneda`, `codmoneda2`) VALUES
(1, 11, '40215782', 'ROY TOVAR', '979688464', 'JR. LIBERTAD N&deg; 477-479', 1, '7665287123', 'HOSTAL TOVAR', '984560644', 'LIRCAY, ANGARAES - HUANCAVELICA', 'HOSTALTOVAR@GMAIL.COM', 3, '0001', '000000001', '0000-00-00', 'NO', 'NUESTRA EXCLUSIVA ARQUITECTURA NOS PERMITE BRINDARLE LOS M&Aacute;S ALTOS NIVELES DE CONFORT Y ELEGANCIA EN AMBIENTES DISE&Ntilde;ADOS Y ACONDICIONADOS CON EL &Uacute;NICO FIN DE SATISFACER TODAS SUS EXPECTATIVAS.', 'EFECTIVO, DEP&Oacute;SITO BANCARIO, TRANSFERENCIA BANCARIA Y TARJETAS DE CR&Eacute;DITO: AMERICAN EXPRESS, DINERS, MASTERCARD, VISA.', '5.00', '0.00', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact`
--

CREATE TABLE `contact` (
  `codmensaje` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `subject` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditosxclientes`
--

CREATE TABLE `creditosxclientes` (
  `codcredito` int(11) NOT NULL,
  `codcliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montocredito` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompras`
--

CREATE TABLE `detallecompras` (
  `coddetallecompra` int(11) NOT NULL,
  `codcompra` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipoentrada` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `preciocomprac` decimal(12,2) NOT NULL,
  `precioventac` decimal(12,2) NOT NULL,
  `cantcompra` int(15) NOT NULL,
  `ivaproductoc` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descproductoc` decimal(12,2) NOT NULL,
  `descfactura` decimal(12,2) NOT NULL,
  `valortotal` decimal(12,2) NOT NULL,
  `totaldescuentoc` decimal(12,2) NOT NULL,
  `valorneto` decimal(12,2) NOT NULL,
  `lotec` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaelaboracionc` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaexpiracionc` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallereservaciones`
--

CREATE TABLE `detallereservaciones` (
  `coddetallereservacion` int(11) NOT NULL,
  `codreservacion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codhabitacion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `adultos` int(5) NOT NULL,
  `children` int(5) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `deschabitacion` decimal(12,2) NOT NULL,
  `valortotal` decimal(12,2) NOT NULL,
  `totaldescuento` decimal(12,2) NOT NULL,
  `valorneto` decimal(12,2) NOT NULL,
  `fechadetalle` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detallereservaciones`
--

INSERT INTO `detallereservaciones` (`coddetallereservacion`, `codreservacion`, `codhabitacion`, `adultos`, `children`, `desde`, `hasta`, `deschabitacion`, `valortotal`, `totaldescuento`, `valorneto`, `fechadetalle`) VALUES
(6, '0001-000000006', 'H6', 1, 0, '2022-11-30', '2022-11-30', '0.00', '38.00', '0.00', '38.00', '2022-11-30'),
(2, '0001-000000002', 'H2', 1, 0, '2022-11-26', '2022-11-27', '0.00', '76.00', '0.00', '76.00', '2022-11-25'),
(5, '0001-000000005', 'H10', 1, 0, '2022-11-30', '2022-11-30', '0.00', '20.00', '0.00', '20.00', '2022-11-30'),
(4, '0001-000000004', 'H1', 1, 0, '2022-11-30', '2022-11-30', '8.00', '38.00', '3.04', '34.96', '2022-11-30'),
(7, '0001-000000007', 'H1', 1, 0, '2022-12-02', '2022-12-03', '0.00', '40.00', '0.00', '40.00', '2022-12-02'),
(8, '0001-000000008', 'H2', 1, 0, '2022-12-02', '2022-12-03', '0.00', '76.00', '0.00', '76.00', '2022-12-02'),
(9, '0001-000000009', 'H9', 1, 0, '2022-12-06', '2022-12-07', '0.00', '70.00', '0.00', '70.00', '2022-12-06'),
(10, '0001-000000010', 'H1', 1, 0, '2022-12-06', '2022-12-07', '0.00', '70.00', '0.00', '70.00', '2022-12-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `coddetalleventa` int(11) NOT NULL,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantventa` int(15) NOT NULL,
  `preciocompra` decimal(12,2) NOT NULL,
  `precioventa` decimal(12,2) NOT NULL,
  `ivaproducto` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descproducto` decimal(12,2) NOT NULL,
  `valortotal` decimal(12,2) NOT NULL,
  `totaldescuentov` decimal(12,2) NOT NULL,
  `valorneto` decimal(12,2) NOT NULL,
  `valorneto2` decimal(12,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalleventas`
--

INSERT INTO `detalleventas` (`coddetalleventa`, `codventa`, `codproducto`, `cantventa`, `preciocompra`, `precioventa`, `ivaproducto`, `descproducto`, `valortotal`, `totaldescuentov`, `valorneto`, `valorneto2`) VALUES
(1, '0001-000000001', '6', 1, '110.00', '130.00', 'SI', '0.00', '130.00', '0.00', '130.00', '110.00'),
(2, '0001-000000002', '20', 1, '10.00', '15.00', 'SI', '0.00', '15.00', '0.00', '15.00', '10.00'),
(3, '0001-000000002', '21', 1, '10.00', '13.00', 'SI', '0.00', '13.00', '0.00', '13.00', '10.00'),
(4, '0001-000000003', '12', 1, '120.00', '150.00', 'SI', '0.00', '150.00', '0.00', '150.00', '120.00'),
(5, '0001-000000003', '10', 1, '17.00', '22.00', 'SI', '0.00', '22.00', '0.00', '22.00', '17.00'),
(6, '0001-000000003', '1', 1, '250.00', '280.00', 'SI', '0.00', '280.00', '0.00', '280.00', '250.00'),
(7, '0001-000000004', '10', 1, '17.00', '22.00', 'SI', '0.00', '22.00', '0.00', '22.00', '17.00'),
(8, '0001-000000005', '17', 1, '340.00', '380.00', 'SI', '0.00', '380.00', '0.00', '380.00', '340.00'),
(9, '0001-000000006', '4', 1, '3.00', '3.00', 'NO', '0.00', '3.00', '0.00', '3.00', '3.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `coddocumento` int(11) NOT NULL,
  `documento` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`coddocumento`, `documento`, `descripcion`) VALUES
(1, 'RUC', 'REGISTRO UNICO DE CONTRIBUYENTES'),
(11, 'DNI', 'DOCUMENTO NACIONAL DE IDENTIDAD'),
(16, 'CI', 'CI EXTRANJERA'),
(17, 'PASAPORTE', 'PASAPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_insumos`
--

CREATE TABLE `entrada_insumos` (
  `identrada` int(11) NOT NULL,
  `codentrada` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codinsumo` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precioentrada` decimal(12,2) NOT NULL,
  `cantentrada` int(5) NOT NULL,
  `fechaexpiracion` date NOT NULL,
  `codproveedor` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaentrada` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `idhabitacion` int(11) NOT NULL,
  `codhabitacion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numhabitacion` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descriphabitacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `piso` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vista` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `maxadultos` int(5) NOT NULL,
  `maxninos` int(5) NOT NULL,
  `codtarifa` int(5) NOT NULL,
  `deschabitacion` decimal(12,2) NOT NULL,
  `statushab` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`idhabitacion`, `codhabitacion`, `numhabitacion`, `descriphabitacion`, `piso`, `vista`, `maxadultos`, `maxninos`, `codtarifa`, `deschabitacion`, `statushab`) VALUES
(1, 'H1', '101', 'HABITACION PERSONAL', 'PRIMERO', 'VENTANA A LA CALLE', 1, 1, 1, '0.00', 0),
(2, 'H2', '103', 'CAMA DE 2 PLAZAS Y BA&Ntilde;O COMPARTIDO', 'PRIMERO', 'VENTANA A LA CALLE', 2, 1, 1, '0.00', 0),
(3, 'H3', '104', 'CAMA 2 PLAZAS Y BA&Ntilde;O PROPIO', 'PRIMERO', 'VENTANA A LA CALLE', 2, 1, 1, '0.00', 0),
(4, 'H4', '106', 'CAMA 2 PLAZAS Y BA&Ntilde;O COMPARTIDO', 'PRIMERO', 'SIN VENTANA A LA CALLE', 2, 1, 1, '0.00', 0),
(5, 'H5', '107', 'CAMA 2 PLAZAS Y BA&Ntilde;O PROPIO', 'PRIMERO', 'INTERMEDIA', 2, 1, 1, '0.00', 0),
(6, 'H6', '201', 'CAMA 1 1/2 PLAZAS Y BA&Ntilde;O PROPIO', 'SEGUNDO', 'VISTA A LA CALLE', 2, 0, 1, '0.00', 0),
(7, 'H7', '202', 'CAMA 1 1/2 PLAZAS Y BA&Ntilde;O COMPARTIDO', 'SEGUNDO', 'VISTA A LA CALLE', 2, 0, 1, '7.00', 0),
(8, 'H8', '203', 'CAMA 2 PLAZAS Y BA&Ntilde;O COMPARTIDO', 'SEGUNDO', 'VISTA A LA CALLE', 2, 1, 1, '0.00', 0),
(9, 'H9', '204', 'CAMA 2 PLAZAS Y BA&Ntilde;O PROPIO', 'PRIMERO', 'VISTA A LA CALLE', 2, 1, 1, '0.00', 0),
(10, 'H10', '102', 'CAMA 2PLAZAS - BA&Ntilde;O COMPARTIDO', 'PRIMERO', 'VENTANA A LA CALLE', 2, 1, 1, '0.00', 0),
(11, 'H11', '205', 'CAMA 1 1/2 Y BA&Ntilde;O COMPARTIDO', 'SEGUNDO', 'INTERMEDIO', 2, 0, 1, '0.00', 0),
(12, 'H12', '206', 'CAMA 2 PLAZAS Y BA&Ntilde;O COMPARTIDO', 'SEGUNDO', 'INTERMEDIO', 2, 1, 1, '0.00', 0),
(13, 'H13', '207', 'CAMA 2 PLAZAS Y BA&Ntilde;O PROPIO', 'SEGUNDO', 'INTERMEDIO', 2, 1, 1, '0.00', 0),
(14, 'H14', '301', 'CAMA 1 1/2 Y BA&Ntilde;O PROPIO', 'TERCERO', 'VISTA A LA CALLE', 2, 0, 1, '0.00', 0),
(15, 'H15', '302', 'CAMA 1 1/2 Y BA&Ntilde;O COMPARTIDO', 'TERCERO', 'VISTA A LA CALLE', 2, 0, 1, '0.00', 0),
(16, 'H16', '303', 'CAMA 1 1/2 BA&Ntilde;O COMPARTIDO', 'TERCERO', 'VISTA A LA CALLE', 2, 0, 1, '0.00', 0),
(17, 'H17', '304', 'CAMA 2 PLAZAS Y BA&Ntilde;O PROPIO', 'TERCERO', 'VISTA A LA CALLE', 2, 1, 1, '0.00', 0),
(18, 'H18', '305', 'CAMA 1 1/2 Y BA&Ntilde;O COMPARTIDO', 'TERCERO', 'INTERMEDIO', 2, 0, 1, '0.00', 0),
(19, 'H19', '306', 'CAMA 2 PLAZAS Y BA&Ntilde;O COMPARTIDO', 'TERCERO', 'INTERMEDIO', 2, 1, 1, '0.00', 0),
(20, 'H20', '307', 'CAMA 2 PLAZAS Y BA&Ntilde;O PROPIO', 'TERCERO', 'INTERMEDIO', 2, 1, 1, '0.00', 0),
(21, 'H21', '401', '2 CAMAS DE 2 PLAZAS Y BA&Ntilde;O PROPIO', 'CUARTO', 'VISTA ALA CALLE', 4, 3, 2, '0.00', 0),
(22, 'H22', '402', '2 CAMAS DE 2 PLAZAS Y BA&Ntilde;O PROPIO', 'CUARTO', 'VISTA A LA CALLE', 4, 3, 2, '0.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `codimpuesto` int(11) NOT NULL,
  `nomimpuesto` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `valorimpuesto` decimal(12,2) NOT NULL,
  `statusimpuesto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaimpuesto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`codimpuesto`, `nomimpuesto`, `valorimpuesto`, `statusimpuesto`, `fechaimpuesto`) VALUES
(1, 'IGV', '18.00', 'INACTIVO', '2019-06-02'),
(2, 'IVA', '13.00', 'INACTIVO', '2019-06-02'),
(3, 'ITBMS', '7.00', 'INACTIVO', '2019-06-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `idinsumo` int(11) NOT NULL,
  `codinsumo` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `insumo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `preciocompra` decimal(12,2) NOT NULL,
  `precioventa` decimal(12,2) NOT NULL,
  `existencia` int(5) NOT NULL,
  `stockminimo` int(5) NOT NULL,
  `ivainsumo` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descinsumo` decimal(12,2) NOT NULL,
  `fechaexpiracion` date NOT NULL,
  `codproveedor` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lote` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`idinsumo`, `codinsumo`, `insumo`, `codcategoria`, `preciocompra`, `precioventa`, `existencia`, `stockminimo`, `ivainsumo`, `descinsumo`, `fechaexpiracion`, `codproveedor`, `lote`) VALUES
(1, 'I1', 'ESCOBA CON PALO', 12, '130.00', '0.00', 44, 0, 'SI', '0.00', '0000-00-00', '0', '1'),
(2, 'I2', 'ESCOBA SIN PALO', 12, '100.00', '0.00', 15, 0, 'SI', '0.00', '0000-00-00', '0', '1'),
(3, 'I3', 'COLETO CON PALO', 12, '180.00', '0.00', 50, 0, 'SI', '0.00', '0000-00-00', '0', '1'),
(4, 'I4', 'JABON LIQUIDO', 13, '60.00', '0.00', 25, 0, 'SI', '0.00', '0000-00-00', '0', '1'),
(5, 'I5', 'JABON AZUL LIQUIDO 1LT', 13, '70.00', '0.00', 42, 0, 'SI', '0.00', '0000-00-00', '0', '1'),
(6, 'I6', 'JABON EN POLVO DE 4 KG', 13, '80.00', '0.00', 20, 0, 'SI', '0.00', '0000-00-00', '0', '1'),
(7, 'I7', 'LAVAPLATOS AXION', 13, '56.00', '0.00', 60, 0, 'SI', '0.00', '0000-00-00', '0', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_insumos`
--

CREATE TABLE `kardex_insumos` (
  `codkardex` int(11) NOT NULL,
  `codproceso` varchar(30) NOT NULL,
  `codresponsable` varchar(100) NOT NULL,
  `codinsumo` varchar(15) NOT NULL,
  `movimiento` varchar(35) NOT NULL,
  `entradas` int(5) NOT NULL,
  `salidas` int(5) NOT NULL,
  `devolucion` int(5) NOT NULL,
  `stockactual` int(10) NOT NULL,
  `ivainsumo` varchar(2) NOT NULL,
  `descinsumo` decimal(12,2) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `documento` text NOT NULL,
  `fechakardex` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `kardex_insumos`
--

INSERT INTO `kardex_insumos` (`codkardex`, `codproceso`, `codresponsable`, `codinsumo`, `movimiento`, `entradas`, `salidas`, `devolucion`, `stockactual`, `ivainsumo`, `descinsumo`, `precio`, `documento`, `fechakardex`) VALUES
(1, 'I1', '0', 'I1', 'ENTRADAS', 44, 0, 0, 44, 'SI', '0.00', '0.00', 'INVENTARIO INICIAL', '2021-11-24'),
(2, 'I2', '0', 'I2', 'ENTRADAS', 15, 0, 0, 15, 'SI', '0.00', '0.00', 'INVENTARIO INICIAL', '2021-11-24'),
(3, 'I3', '0', 'I3', 'ENTRADAS', 50, 0, 0, 50, 'SI', '0.00', '0.00', 'INVENTARIO INICIAL', '2021-11-24'),
(4, 'I4', '0', 'I4', 'ENTRADAS', 25, 0, 0, 25, 'SI', '0.00', '0.00', 'INVENTARIO INICIAL', '2021-11-24'),
(5, 'I5', '0', 'I5', 'ENTRADAS', 42, 0, 0, 42, 'SI', '0.00', '0.00', 'INVENTARIO INICIAL', '2021-11-24'),
(6, 'I6', '0', 'I6', 'ENTRADAS', 20, 0, 0, 20, 'SI', '0.00', '0.00', 'INVENTARIO INICIAL', '2021-11-24'),
(7, 'I7', '0', 'I7', 'ENTRADAS', 60, 0, 0, 60, 'SI', '0.00', '0.00', 'INVENTARIO INICIAL', '2021-11-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex_productos`
--

CREATE TABLE `kardex_productos` (
  `codkardex` int(11) NOT NULL,
  `codproceso` varchar(30) NOT NULL,
  `codresponsable` varchar(30) NOT NULL,
  `codproducto` varchar(15) NOT NULL,
  `movimiento` varchar(35) NOT NULL,
  `entradas` int(5) NOT NULL,
  `salidas` int(5) NOT NULL,
  `devolucion` int(5) NOT NULL,
  `stockactual` int(10) NOT NULL,
  `ivaproducto` varchar(2) NOT NULL,
  `descproducto` decimal(12,2) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `documento` text NOT NULL,
  `fechakardex` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `kardex_productos`
--

INSERT INTO `kardex_productos` (`codkardex`, `codproceso`, `codresponsable`, `codproducto`, `movimiento`, `entradas`, `salidas`, `devolucion`, `stockactual`, `ivaproducto`, `descproducto`, `precio`, `documento`, `fechakardex`) VALUES
(1, '1', '0', '1', 'ENTRADAS', 100, 0, 0, 100, 'SI', '0.00', '280.00', 'INVENTARIO INICIAL', '2021-11-24'),
(2, '2', '0', '2', 'ENTRADAS', 118, 0, 0, 118, 'SI', '0.00', '400.00', 'INVENTARIO INICIAL', '2021-11-24'),
(3, '3', '0', '3', 'ENTRADAS', 100, 0, 0, 100, 'SI', '0.00', '180.00', 'INVENTARIO INICIAL', '2021-11-24'),
(4, '4', '0', '4', 'ENTRADAS', 150, 0, 0, 150, 'SI', '0.00', '420.00', 'INVENTARIO INICIAL', '2021-11-24'),
(5, '5', '0', '5', 'ENTRADAS', 100, 0, 0, 100, 'SI', '0.00', '510.00', 'INVENTARIO INICIAL', '2021-11-24'),
(6, '6', '0', '6', 'ENTRADAS', 80, 0, 0, 80, 'SI', '0.00', '130.00', 'INVENTARIO INICIAL', '2021-11-24'),
(7, '7', '0', '7', 'ENTRADAS', 85, 0, 0, 85, 'SI', '0.00', '65.00', 'INVENTARIO INICIAL', '2021-11-24'),
(8, '8', '0', '8', 'ENTRADAS', 119, 0, 0, 119, 'SI', '0.00', '29.00', 'INVENTARIO INICIAL', '2021-11-24'),
(9, '9', '0', '9', 'ENTRADAS', 49, 0, 0, 49, 'SI', '0.00', '28.00', 'INVENTARIO INICIAL', '2021-11-24'),
(10, '10', '0', '10', 'ENTRADAS', 75, 0, 0, 75, 'SI', '0.00', '22.00', 'INVENTARIO INICIAL', '2021-11-24'),
(11, '11', '0', '11', 'ENTRADAS', 45, 0, 0, 45, 'SI', '0.00', '180.00', 'INVENTARIO INICIAL', '2021-11-24'),
(12, '12', '0', '12', 'ENTRADAS', 52, 0, 0, 52, 'SI', '0.00', '150.00', 'INVENTARIO INICIAL', '2021-11-24'),
(13, '13', '0', '13', 'ENTRADAS', 54, 0, 0, 54, 'SI', '0.00', '320.00', 'INVENTARIO INICIAL', '2021-11-24'),
(14, '14', '0', '14', 'ENTRADAS', 75, 0, 0, 75, 'SI', '0.00', '220.00', 'INVENTARIO INICIAL', '2021-11-24'),
(15, '15', '0', '15', 'ENTRADAS', 85, 0, 0, 85, 'SI', '0.00', '220.00', 'INVENTARIO INICIAL', '2021-11-24'),
(16, '16', '0', '16', 'ENTRADAS', 85, 0, 0, 85, 'SI', '0.00', '150.00', 'INVENTARIO INICIAL', '2021-11-24'),
(17, '17', '0', '17', 'ENTRADAS', 55, 0, 0, 55, 'SI', '0.00', '380.00', 'INVENTARIO INICIAL', '2021-11-24'),
(18, '18', '0', '18', 'ENTRADAS', 59, 0, 0, 59, 'SI', '0.00', '150.00', 'INVENTARIO INICIAL', '2021-11-24'),
(19, '19', '0', '19', 'ENTRADAS', 150, 0, 0, 150, 'SI', '0.00', '80.00', 'INVENTARIO INICIAL', '2021-11-24'),
(20, '20', '0', '20', 'ENTRADAS', 55, 0, 0, 55, 'SI', '0.00', '15.00', 'INVENTARIO INICIAL', '2021-11-24'),
(21, '21', '0', '21', 'ENTRADAS', 113, 0, 0, 113, 'SI', '0.00', '13.00', 'INVENTARIO INICIAL', '2021-11-24'),
(22, '0001-000000001', '0', '6', 'SALIDAS', 0, 1, 0, 79, 'SI', '0.00', '130.00', 'VENTA: 0001-000000001', '2022-11-24'),
(23, '0001-000000002', 'C10', '20', 'SALIDAS', 0, 1, 0, 54, 'SI', '0.00', '15.00', 'VENTA: 0001-000000002', '2022-11-25'),
(24, '0001-000000002', 'C10', '21', 'SALIDAS', 0, 1, 0, 112, 'SI', '0.00', '13.00', 'VENTA: 0001-000000002', '2022-11-25'),
(25, '0001-000000003', 'C10', '12', 'SALIDAS', 0, 1, 0, 51, 'SI', '0.00', '150.00', 'VENTA: 0001-000000003', '2022-11-29'),
(26, '0001-000000003', 'C10', '10', 'SALIDAS', 0, 1, 0, 74, 'SI', '0.00', '22.00', 'VENTA: 0001-000000003', '2022-11-29'),
(27, '0001-000000003', 'C10', '1', 'SALIDAS', 0, 1, 0, 99, 'SI', '0.00', '280.00', 'VENTA: 0001-000000003', '2022-11-29'),
(28, '0001-000000004', 'C10', '10', 'SALIDAS', 0, 1, 0, 73, 'SI', '0.00', '22.00', 'VENTA: 0001-000000004', '2022-11-30'),
(29, '0001-000000005', 'C16', '17', 'SALIDAS', 0, 1, 0, 54, 'SI', '0.00', '380.00', 'VENTA: 0001-000000005', '2022-12-02'),
(30, '0001-000000006', 'C1', '4', 'SALIDAS', 0, 1, 0, 4, 'NO', '0.00', '3.00', 'VENTA: 0001-000000006', '2022-12-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` datetime DEFAULT NULL,
  `detalles` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `paginas` text CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `ip`, `tiempo`, `detalles`, `paginas`, `usuario`) VALUES
(1, '::1', '2022-11-24 10:40:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'RUBENCHIRINOS'),
(2, '::1', '2022-11-24 11:08:20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(3, '::1', '2022-11-25 06:12:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(4, '::1', '2022-11-25 01:39:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', 'SOFTBELITO'),
(5, '::1', '2022-11-25 06:33:31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(6, '::1', '2022-11-25 06:40:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', 'SOFTBELITO'),
(7, '::1', '2022-11-25 06:44:44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'MARIBEL'),
(8, '::1', '2022-11-25 06:46:51', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(9, '::1', '2022-11-25 07:09:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(10, '::1', '2022-11-27 05:43:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(11, '::1', '2022-11-28 04:17:59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(12, '::1', '2022-11-28 04:40:14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(13, '::1', '2022-11-28 05:03:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(14, '::1', '2022-11-29 08:42:19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/hotel.php', 'SOFTBELITO'),
(15, '::1', '2022-11-29 04:06:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(16, '::1', '2022-11-29 06:31:08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/rooms.php', 'SOFTBELITO'),
(17, '::1', '2022-11-29 06:42:49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SECRETARIA'),
(18, '::1', '2022-11-29 06:47:57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(19, '::1', '2022-11-29 06:57:01', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', '88888888'),
(20, '::1', '2022-11-29 06:59:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/contact.php', 'SOFTBELITO'),
(21, '::1', '2022-11-30 09:39:12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(22, '::1', '2022-11-30 09:41:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', 'SOFTBELITO'),
(23, '::1', '2022-12-02 06:22:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'SOFTBELITO'),
(24, '::1', '2022-12-02 06:23:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'ELVISJHUNIOR'),
(25, '::1', '2022-12-02 06:26:27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'ELVISJHUNIOR'),
(26, '::1', '2022-12-02 07:33:46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'ELVISJHUNIOR'),
(27, '::1', '2022-12-02 07:43:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR'),
(28, '::1', '2022-12-02 08:04:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'JOSEOCHOA'),
(29, '::1', '2022-12-02 08:06:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'ELVISJHUNIOR'),
(30, '::1', '2022-12-02 08:10:10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/index.php', 'RENZO'),
(31, '::1', '2022-12-02 08:21:11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR'),
(32, '::1', '2022-12-02 09:28:46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR'),
(33, '::1', '2022-12-02 09:35:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR'),
(34, '::1', '2022-12-06 10:59:57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '/hotel/contact.php', 'ELVISJHUNIOR'),
(35, '::1', '2022-12-06 11:30:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR'),
(36, '::1', '2022-12-06 11:33:42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR'),
(37, '::1', '2022-12-06 11:35:52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR'),
(38, '::1', '2022-12-06 11:44:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', '/hotel/booking.php', 'ELVISJHUNIOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediospagos`
--

CREATE TABLE `mediospagos` (
  `codmediopago` int(11) NOT NULL,
  `mediopago` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mediospagos`
--

INSERT INTO `mediospagos` (`codmediopago`, `mediopago`) VALUES
(1, 'EFECTIVO'),
(2, 'CHEQUE A FECHA'),
(3, 'CHEQUE AL DIA'),
(4, 'NOTA DE CREDITO'),
(5, 'RED COMPRA'),
(6, 'TRANSFERENCIA'),
(7, 'TARJETA DE CREDITO'),
(8, 'CUPON');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `codmensaje` int(11) NOT NULL,
  `codigo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` datetime NOT NULL,
  `respuesta` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoscajas`
--

CREATE TABLE `movimientoscajas` (
  `codmovimiento` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `tipomovimiento` varchar(10) NOT NULL,
  `descripcionmovimiento` text NOT NULL,
  `montomovimiento` decimal(12,2) NOT NULL,
  `codmediopago` int(11) NOT NULL,
  `fechamovimiento` datetime NOT NULL,
  `codarqueo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `codnoticia` int(11) NOT NULL,
  `titulonoticia` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcnoticia` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `publicado` datetime NOT NULL,
  `statusnoticia` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`codnoticia`, `titulonoticia`, `descripcnoticia`, `publicado`, `statusnoticia`, `codigo`) VALUES
(1, 'INFORMACI&Oacute;N E INQUIETUD', 'EL HOSTAL TOVAR, INVITA A NUESTROS HUESPEDES, EN CASO DE TENER CUALQUIER INQUIETUD, QUEJA O RECLAMO DEL MISMO, POR FAVOR DIRIGIRSE A LA ADMINISTRACI&Oacute;N DEL HOSTAL PARA TOMAR NOTA DE SUS INQUIETUDES Y PODER ATENDERLOS LO MEJOR POSIBLE. ATTE. LA ADMINISTRACI&Oacute;N.', '2022-12-02 06:37:38', 'PUBLICADA', 2),
(2, 'MENSAJE DE BIENVENIDA', 'EL HOSTAL TOVAR, LES DA LA BIENVENIDA A TODOS NUESTRO HUESPEDES, DESEANDOLES, LA MEJOR ESTANCIA EN NUESTRO HOSTAL, AGRADECIENDOLES POR SU ACEPTACI&Oacute;N Y CONFIANZA, MUCHAS GRACIAS. ATTE. LA ADMINISTRACI&Oacute;N.', '2022-12-02 06:38:12', 'PUBLICADA', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `codperfil` int(11) NOT NULL,
  `nomperfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descperfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`codperfil`, `nomperfil`, `descperfil`) VALUES
(1, 'NUESTRA UBICACI&Oacute;N', 'EL HOSTAL TOVAR ESTA UBICADO JR. LIBERTAD N&deg; 477-479 BARRIO DE BELLAVISTA PROVINCIA DE ANGARAES, CIUDAD A LA QUE SIEMPRE SE VUELVE, UNA PROVINCIA PLENA EN BELLEZAS NATURALES: LAGOS, CASCADAS, ETC. FORMAN PARTE DE UN BUEN TIEMPO TUR&Iacute;STICO, EN ESTE MARCO NATURAL SE ENCUENTRA INSTALADO EN PLENO CENTRO A UNOS CUANTOS PASOS DEL PARQUE DE LA IDENTIDAD, NOS MUESTRA CON ORGULLO SUS CUATRO PISOS, TREINTA HABITACIONES DISTRIBUIDAS EN HABITACIONES. STANDARD, SUPERIOR, DEPARTAMENTOS Y SUITES, UN EDIFICIO CONSTRUIDO PARA BRINDAR AL CLIENTE EL MAYOR CONFORT, HABITACIONES EQUIPADAS CON AIRE ACONDICIONADO FR&Iacute;O-CALOR INDIVIDUAL, TELEVISOR CON CABLE, WIFI, CAJAS DE SEGURIDAD, FRIGOBAR Y ROOM SERVICES.'),
(2, 'D&Oacute;NDE ESTAMOS', 'NOS ENCONTRAMOS EN UNA ZONA EXCLUSIVA Y MUY ATRACTIVA DE LA PROVINCIA DE ANGARAES - LIRCAY, A UN PASO DE RESTAURANTES Y BARES, BANCOS, BOUTIQUES, TIENDAS, Y LIBRER&Iacute;AS. DESDE NUESTRO HOSTAL PODR&Aacute; LLEGAR, EN CINCO MINUTOS AL TERMINAL TERRESTRE.'),
(3, 'ACERCA DE NUESTRO HOTEL', 'NUESTRA EXCLUSIVA ARQUITECTURA NOS PERMITE BRINDARLE LOS M&Aacute;S ALTOS NIVELES DE CONFORT Y ELEGANCIA EN AMBIENTES DISE&Ntilde;ADOS Y ACONDICIONADOS CON EL &Uacute;NICO FIN DE SATISFACER TODAS SUS EXPECTATIVAS.'),
(4, 'QUI&Eacute;NES SOMOS', 'ESTAMOS ENTRE LOS HOTELES M&Aacute;S IMPORTANTES DE LA PROVINCIA DE ANGARAES-LIRCAY, NUESTRAS RA&Iacute;CES TIENEN INICIO EN LA CIUDAD DE LIRCAY HACE 4 A&Ntilde;OS CON LA INAUGURACI&Oacute;N DE NUESTRO HOSTAL. CON EL PASAR DE LOS A&Ntilde;OS HEMOS IDO CRECIENDO, CON EL PRINCIPAL OBJETIVO DE ASEGURAR A NUESTROS VISITANTES UNA PLACENTERA ESTAD&Iacute;A, DURANTE SU AVENTURA DE CONOCER LA PROVINCIA DE ANGARES-LIRCAY. &quot;SU SONRISA ES NUESTRO OBJETIVO&quot;.'),
(5, 'NUESTRA MISI&Oacute;N', 'NUESTRA MISI&Oacute;N ES PROVEERLES A NUESTROS CLIENTES LA EXPERIENCIA PERFECTA EN SU ESTAD&Iacute;A, SORPRENDI&Eacute;NDOLOS EN CADA EXPECTACI&Oacute;N, DESDE EL PRIMER MOMENTO QUE CONTACTE CON EL HOSTAL TOVAR HASTA EL FINAL DE SU ESTAD&Iacute;A. HACER VIVIR A NUESTROS HU&Eacute;SPEDES LA VERDADERA HOSPITALIDAD Y DIVERSIDAD DEL PERU.'),
(6, 'NUESTRA VISI&Oacute;N', 'CREAR UNA AUT&Eacute;NTICA CULTURA DE SERVICIO INSPIRADA EN LA AMABILIDAD, RA&Iacute;CES Y VALORES DE VIDA DE NUESTRA GENTE. HABIENDO VIAJADO POR EL MUNDO DESDE MUY TEMPRANA EDAD, LOS FUNDADORES HAN APRENDIDO HA APRECIAR LA BELLEZA Y LO &Uacute;NICO QUE CADA PA&Iacute;S TIENE POR OFRECER. AUNQUE EN NUESTRA OPINI&Oacute;N POCOS DESTINOS TIENEN LA HABILIDAD DE MEZCLAR SU ALMA Y LLENAR SUS M&Aacute;S GRANDES DESEOS POR LA AVENTURA, CULTURA, HISTORIA, DEPORTE, ROMANCE, QUE POSEE NUESTRA CIUDAD DE IBARRA.'),
(7, 'NUESTROS VALORES', '&bull; HOSPITALIDAD, QUE NOS LLEVA A APRECIAR E INTERESARNOS POR NUESTROS HU&Eacute;SPEDES.\r\n&bull; AUTENTICIDAD, PORQUE SOMOS FIELES A NUESTROS OR&Iacute;GENES Y CONVICCIONES.\r\n&bull; DIVERSIDAD, NUESTRO HOTEL EXPRESA UNA REALIDAD Y CULTURA DIFERENTE.\r\n&bull; CREATIVIDAD HOTELERA, PARA SUPERAR LAS EXPECTATIVAS DE NUESTROS HU&Eacute;SPEDES.\r\n&bull; TRABAJO.\r\n&bull; HONESTIDAD.\r\n&bull; COMPROMISO'),
(8, 'NUESTRA FILOSOF&Iacute;A', '&bull; SATISFACCI&Oacute;N DEL CLIENTE.\r\n&bull; DECISIONES CON RESPONSABILIDAD DE LOS COLABORADORES.\r\n&bull; DIRECCI&Oacute;N ABIERTA.\r\n&bull; TRABAJO EN EQUIPO.\r\n&bull; PRODUCTIVIDAD.'),
(9, 'OBJETIVOS ESTRATEGICOS', '1. CONVERTIR ANGARES UN CENTRO DE PRIMER ORDEN EN MATERIA DE PRESTACI&Oacute;N DE SERVICIOS EN EL MUNDO DE LOS NEGOCIOS.\r\n2. UTILIZAR EL TURISMO COMO UNA HERRAMIENTA CLAVE PARA PROMOVER LIRCAY COMO CIUDAD IDEAL PARA VISITAR, VIVIR Y HACER NEGOCIOS.\r\n3. INCENTIVAR LA IMAGEN DE LIRCAY A NIVEL NACIONAL E INTERNACIONAL A FIN DE CREAR UNA IDENTIDAD ADECUADA PARA LA INVERSI&Oacute;N TUR&Iacute;STICA GLOBAL.\r\n4. CONVERTIR EL TURISMO EN UN INSTRUMENTO CLAVE PARA LA GENERACI&Oacute;N DE EMPLEOS Y LA INCREMENTACI&Oacute;N DE LAS EXPORTACIONES.\r\n5. CREAR LAS CONDICIONES ADECUADAS PARA BRINDAR A LOS TURISTAS QUE VISITAN LIRCAY, UN SERVICIO DE BUENA CALIDAD.'),
(10, 'SERVICIOS DEL HOTEL', '1. ACCESO A INTERNET\r\n2. CAJA DE SEGURIDAD\r\n3. SERVICIO DE LAVANDERIA\r\n4. AIRE ACONDICIONADO\r\n5. SERVICIO DE RECEPCI&Oacute;N LAS 24 HORAS\r\n6. TEL&Eacute;FONO CON DISCADO DIRECTO NACIONAL E INTERNACIONAL\r\n7. CAMBIO DE MONEDA\r\n8. ZONA DE NO FUMAR EN EL RESTAURANTE\r\n9. GUARDARROPAN10. BAR-ES\r\n11. ASCENSOR-ES\r\n12. SALAS DE CONFERENCIAS\r\n13. RESTAURANTE (DESAYUNOS, BUFFETS, ALMUERZOS, CENAS, COFFEE BREAKS Y COCKTAILS.)\r\n14. SERVICIOS DE HABITACIONES\r\n15. GARAJE'),
(11, 'NUESTRAS HABITACIONES', 'NUESTRAS 30 ELEGANTES HABITACIONES Y 1 AMPLIAS SUITE, HAN SIDO ESPECIALMENTE AMBIENTADAS PARA ASEGURAR ALTOS NIVELES DE CALIDAD Y COMODIDAD, BAJO LA SUPERVISI&Oacute;N Y CALIDEZ DE NUESTRO PERSONAL, LAS MISMAS QUE DISPONEN DE:\r\n&bull; AGUA CALIENTE.\r\n&bull; AIRE ACONDICIONADO.\r\n&bull; AMENIDADES (SHAMPOO, CREMA, JAB&Oacute;N, PA&Ntilde;UELOS DESECHABLES, COSTURERO, LUSTRA ZAPATOS, GORRO DE BA&Ntilde;O).\r\n&bull; BATAS DE BA&Ntilde;O Y PANTUFLAS.\r\n&bull; CONEXI&Oacute;N A INTERNET DE BANDA ANCHA.\r\n&bull; CORRIENTE DE 220V Y 110V.\r\n&bull; FRIGOBAR.\r\n&bull; TV V&Iacute;A SAT&Eacute;LITE / TV POR CABLE.'),
(12, 'RESTAURANTE &quot;EL CALLEJ&Oacute;N&quot; ', 'NUESTRO RESTAURANTE EL CALLEJON EST&Aacute; SITUADO EN EL MISMO EDIFICIO DEL HOTEL EN EL PRIMER PISO, LO DESLUMBRAR&Aacute; CON LA DIVERSIDAD DE NUESTROS PLATOS DE LA COCINA PERUANA E INTERNACIONAL.'),
(13, 'SALA DE CONFERENCIA Y EVENTOS', 'CONTAMOS CON UN SAL&Oacute;N CON CAPACIDAD HASTA PARA 60 PERSONAS, MODERNA INFRAESTRUCTURA Y UN COMPLETO SERVICIO DE EQUIPOS AUDIOVISUALES, LOS CUALES, JUNTO CON LA EFICIENCIA DE NUESTRO PERSONAL GARANTIZAR&Aacute;N EL &Eacute;XITO DE SUS EVENTOS.'),
(14, 'BUSINESS CENTER ', 'CONTAMOS CON CONEXI&Oacute;N A INTERNET LAS 24 HORAS DEL D&Iacute;A, PARA QUE USTED PUEDA COMUNICARSE CON CUALQUIER PARTE DEL MUNDO.'),
(15, 'CAMBIO DE MONEDA EXTRANJERA', 'LA MONEDA OFICIAL ES EL SOL, REPRESENTADO CON EL S&Iacute;MBOLO &quot;S/&quot;. LA MAYOR&Iacute;A DE LOCALES ACEPTA D&Oacute;LARES AL TIPO DE CAMBIO DEL D&Iacute;A. EL SERVICIO DE CAMBIO DE MONEDA EST&Aacute; DISPONIBLE EN NUESTRA CAJA DE RECEPCI&Oacute;N, LAS 24 HORAS DEL D&Iacute;A. ADICIONALMENTE, PUEDE USTED CAMBIAR D&Oacute;LARES Y EUROS EN LOS BANCOS.'),
(16, 'M&Eacute;TODOS DE PAGO', 'EN NUESTRO ESTABLECIMIENTO:\r\n&bull; EFECTIVO\r\n&bull; TARJETAS DE CR&Eacute;DITO: AMERICAN EXPRESS, DINERS, MASTERCARD, VISA.\r\nSISTEMA DE RESERVACIONES:\r\n&bull; DEP&Oacute;SITO BANCARIO\r\n&bull; TRANSFERENCIA BANCARIA\r\n&bull; TARJETAS DE CR&Eacute;DITO: AMERICAN EXPRESS, DINERS, MASTERCARD, VISA.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `codproducto` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcategoria` int(11) NOT NULL,
  `preciocompra` decimal(12,2) NOT NULL,
  `precioventa` decimal(12,2) NOT NULL,
  `existencia` int(5) NOT NULL,
  `stockminimo` int(5) NOT NULL,
  `stockmaximo` int(5) NOT NULL,
  `ivaproducto` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descproducto` decimal(12,2) NOT NULL,
  `codigobarra` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaelaboracion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaexpiracion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codproveedor` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lote` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `stockteorico` int(10) NOT NULL,
  `motivoajuste` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `codproducto`, `producto`, `codcategoria`, `preciocompra`, `precioventa`, `existencia`, `stockminimo`, `stockmaximo`, `ivaproducto`, `descproducto`, `codigobarra`, `fechaelaboracion`, `fechaexpiracion`, `codproveedor`, `lote`, `stockteorico`, `motivoajuste`) VALUES
(1, '1', 'COCA COLA PERSONAL', 7, '3.00', '3.00', 6, 4, 6, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P4', '', 0, 'NINGUNO'),
(2, '2', 'INCA KOLA PERSONAL', 7, '3.00', '3.00', 6, 4, 6, 'SI', '0.00', '', '0000-00-00', '0000-00-00', 'P4', '', 0, 'NINGUNO'),
(3, '3', 'SPORADE PERSONAL', 7, '3.00', '3.00', 4, 4, 6, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P4', '', 0, 'NINGUNO'),
(4, '4', 'POWER PERSONAL', 7, '3.00', '3.00', 4, 1, 6, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(5, '5', 'FANTA PERSONAL', 7, '3.00', '3.00', 2, 1, 3, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(6, '6', 'AFEITADOR VERDE', 12, '3.50', '3.50', 4, 1, 10, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(7, '7', 'AFEITADOR NEGRO', 12, '1.50', '1.50', 7, 1, 10, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(8, '8', 'AGUA MINERAL PERSONAL', 7, '2.00', '2.00', 5, 1, 10, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(9, '9', 'HALLS', 8, '2.00', '2.00', 6, 5, 10, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(10, '10', 'TRIDENT', 8, '1.00', '1.00', 13, 5, 20, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(11, '11', 'CEPILLO COLGATE', 12, '3.50', '3.50', 8, 5, 12, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(12, '12', 'SHAMPOO PANTENE', 12, '1.00', '1.00', 6, 3, 10, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(13, '13', 'SHAMPOO HEAD SHOULDERS', 12, '1.00', '1.00', 8, 4, 12, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(14, '14', 'TOALLA HIGENICA NOSOTRAS', 12, '1.00', '1.00', 32, 5, 42, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(15, '15', 'PEINE', 12, '0.50', '0.50', 4, 2, 6, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(16, '16', 'PRESERVARTIVO GENS', 12, '5.00', '5.00', 5, 2, 5, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(17, '17', 'DESODORANTE NIVEA', 12, '1.20', '1.20', 4, 2, 6, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(18, '18', 'CREMA PORTUGAL', 12, '1.00', '1.00', 3, 1, 5, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(19, '19', 'PASTA DENTAL COLGATE', 12, '3.50', '3.50', 2, 1, 6, 'NO', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(20, '20', 'CARAMELOS DE LECHE', 8, '10.00', '15.00', 54, 5, 5, 'SI', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO'),
(21, '21', 'CARAMELO UVITA', 8, '10.00', '13.00', 112, 5, 5, 'SI', '0.00', '', '0000-00-00', '0000-00-00', 'P5', '', 0, 'NINGUNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` int(11) NOT NULL,
  `codproveedor` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `documproveedor` int(11) NOT NULL,
  `cuitproveedor` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomproveedor` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfproveedor` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direcproveedor` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `emailproveedor` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vendedor` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tlfvendedor` varchar(20) CHARACTER SET utf32 COLLATE utf32_spanish_ci NOT NULL,
  `fechaingreso` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `codproveedor`, `documproveedor`, `cuitproveedor`, `nomproveedor`, `tlfproveedor`, `direcproveedor`, `emailproveedor`, `vendedor`, `tlfvendedor`, `fechaingreso`) VALUES
(1, 'P1', 1, '10451248495', 'PRODUCTOS GENERICOS RSA', '(8012) 3334454', 'JR HUANTA 11', 'GENERIS@GMAIL.COM', 'JULIAN RENGIFO', '(0412) 5896632', '2019-02-13'),
(2, 'P2', 1, '3488729001-J', 'ACCESORIOS Y VENTAS DE LIMPIEZA', '(0416) 7642234', 'LA CONCORDIA', 'VENTAS@GMAIL.COM', 'LCDO. JORGE LUIS CAMACHO', '(0416) 7642234', '2019-02-13'),
(3, 'P3', 2, '872445162-J', 'ABASTO Y LICORERIA LA MORITA', '(0416) 7652345', 'AL LADO DEL CC MURALLA', 'MORITA@GMAIL.COM', 'SRA. CARMEN ALICIA CONTRERAS', '(0416) 5456998', '2019-02-13'),
(4, 'P4', 1, '00235998745-7', 'DISTRIBUIDORA MIKASA', '(0274) 9986589', 'CALLE PRINCIPAL', 'MIKASA@HOTMAIL.COM', 'LICDO. JESUS CARDOZO', '(0424) 7896583', '2019-04-30'),
(5, 'P5', 1, '9-877615234-0', 'CHUCHERIAS LA MORITA', '(0274) 9985685', 'AVENIDA INTERCOMUNAL', 'MORITA@GMAIL.COM', 'CARLOS JESUS CONTRERAS', '(0412) 5874968', '2019-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `idreservacion` int(11) NOT NULL,
  `tipodocumento` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcaja` int(11) NOT NULL,
  `codreservacion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codserie` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codautorizacion` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `iva` decimal(12,2) NOT NULL,
  `totaliva` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `descuento` decimal(12,2) NOT NULL,
  `totaldescuento` decimal(12,2) NOT NULL,
  `totalpago` decimal(12,2) NOT NULL,
  `creditopagado` decimal(12,2) NOT NULL,
  `tipopago` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `formapago` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montopagado` decimal(12,2) NOT NULL,
  `montodevuelto` decimal(12,2) NOT NULL,
  `tipotarjeta` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nrotarjeta` varchar(16) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `expira` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codverifica` int(4) NOT NULL,
  `nrotransferencia` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cheque` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `bancocheque` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechavencecredito` date NOT NULL,
  `fechapagado` date NOT NULL,
  `statuspago` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `reservacion` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `reservacion_desde` date NOT NULL,
  `reservacion_hasta` date NOT NULL,
  `fecharegistro` datetime NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`idreservacion`, `tipodocumento`, `codcaja`, `codreservacion`, `codserie`, `codautorizacion`, `codcliente`, `iva`, `totaliva`, `subtotal`, `descuento`, `totaldescuento`, `totalpago`, `creditopagado`, `tipopago`, `formapago`, `montopagado`, `montodevuelto`, `tipotarjeta`, `nrotarjeta`, `expira`, `codverifica`, `nrotransferencia`, `cheque`, `bancocheque`, `fechavencecredito`, `fechapagado`, `statuspago`, `reservacion`, `reservacion_desde`, `reservacion_hasta`, `fecharegistro`, `observaciones`, `codigo`) VALUES
(6, 'FACTURARESERVA', 1, '0001-000000006', '0001', '113826492245272767423218273641', 'C14', '18.00', '6.84', '38.00', '5.00', '2.24', '42.60', '0.00', 'CONTADO', 'EFECTIVO', '100.00', '57.40', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PAGADA', 'ACTIVA', '2022-11-30', '2022-11-30', '2022-11-30 21:50:17', '', 2),
(2, 'TICKETRESERVA', 0, '0001-000000002', '0001', '600514437351772709892044600774', 'C10', '18.00', '13.68', '76.00', '5.00', '4.48', '85.20', '0.00', 'CONTADO', 'EFECTIVO', '0.00', '0.00', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PENDIENTE', 'ACTIVA', '2022-11-26', '2022-11-27', '2022-11-25 18:39:01', '', 0),
(5, 'TICKETRESERVA', 1, '0001-000000005', '0001', '550722116966608493933212351329', 'C13', '18.00', '3.60', '20.00', '5.00', '1.18', '22.42', '0.00', 'CONTADO', 'EFECTIVO', '100.00', '77.58', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PAGADA', 'ACTIVA', '2022-11-30', '2022-11-30', '2022-11-30 21:47:52', '', 2),
(4, 'TICKETRESERVA', 0, '0001-000000004', '0001', '423369687022969383738759706159', 'C12', '18.00', '6.29', '34.96', '5.00', '2.06', '39.19', '0.00', 'CONTADO', 'EFECTIVO', '0.00', '0.00', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PENDIENTE', 'PENDIENTE', '2022-11-30', '2022-11-30', '2022-11-30 21:41:24', '', 0),
(7, 'TICKETRESERVA', 0, '0001-000000007', '0001', '935371682681228560647028000759', 'C15', '18.00', '7.20', '40.00', '5.00', '2.36', '44.84', '0.00', 'CONTADO', 'EFECTIVO', '0.00', '0.00', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PENDIENTE', 'ACTIVA', '2022-12-02', '2022-12-03', '2022-12-02 19:42:52', '', 0),
(8, 'FACTURARESERVA', 1, '0001-000000008', '0001', '922356528144741001642554676217', 'C16', '18.00', '13.68', '76.00', '5.00', '4.48', '85.20', '0.00', 'CONTADO', 'EFECTIVO', '100.00', '14.80', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PAGADA', 'ACTIVA', '2022-12-02', '2022-12-03', '2022-12-02 19:49:14', '', 2),
(9, 'TICKETRESERVA', 1, '0001-000000009', '0001', '189821695493374166059288545960', 'C6', '18.00', '12.60', '70.00', '5.00', '4.13', '78.47', '0.00', 'CONTADO', 'EFECTIVO', '100.00', '21.53', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PAGADA', 'ACTIVA', '2022-12-06', '2022-12-07', '2022-12-06 11:10:04', '', 2),
(10, 'TICKETRESERVA', 1, '0001-000000010', '0001', '802602494228976858013506966753', 'C1', '0.00', '0.00', '70.00', '5.00', '3.50', '66.50', '0.00', 'CONTADO', 'EFECTIVO', '80.00', '13.50', '0', '0', '0', 0, '0', '0', '0', '0000-00-00', '0000-00-00', 'PAGADA', 'ACTIVA', '2022-12-06', '2022-12-07', '2022-12-06 11:45:33', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_insumos`
--

CREATE TABLE `salida_insumos` (
  `idsalida` int(11) NOT NULL,
  `codsalida` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codinsumo` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `responsable` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantsalida` int(5) NOT NULL,
  `preciosalida` decimal(12,2) NOT NULL,
  `ivasalida` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descsalida` decimal(12,2) NOT NULL,
  `fechasalida` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `codservicio` int(11) NOT NULL,
  `descripcionservicio` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`codservicio`, `descripcionservicio`) VALUES
(1, 'ACCESO A INTERNET'),
(2, 'CAJA DE SEGURIDAD'),
(3, 'SERVICIO DE LAVANDERIA'),
(4, 'AIRE ACONDICIONADO'),
(5, 'SERVICIO DE RECEPCI&Oacute;N LAS 24 HORAS'),
(6, 'TEL&Eacute;FONO CON DISCADO DIRECTO NACIONAL E INTERNACIONAL'),
(7, 'CAMBIO DE MONEDA'),
(8, 'ZONA DE NO FUMAR EN EL RESTAURANTE'),
(9, 'GUARDARROPA'),
(10, 'BAR-ES'),
(11, 'ASCENSOR-ES'),
(12, 'SALAS DE CONFERENCIAS'),
(13, 'RESTAURANTE (DESAYUNOS, BUFFETS, ALMUERZOS, CENAS, COFFEE BREAKS Y COCKTAILS.)'),
(14, 'SERVICIOS DE HABITACIONES'),
(15, 'GARAJE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `codtarifa` int(11) NOT NULL,
  `codtipo` int(11) NOT NULL,
  `baja` decimal(12,2) NOT NULL,
  `media` decimal(12,2) NOT NULL,
  `alta` decimal(12,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`codtarifa`, `codtipo`, `baja`, `media`, `alta`) VALUES
(1, 1, '30.00', '30.00', '35.00'),
(2, 2, '60.00', '65.00', '70.00'),
(3, 3, '40.00', '40.00', '45.00'),
(4, 4, '35.00', '35.00', '40.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

CREATE TABLE `temporadas` (
  `codtemporada` int(11) NOT NULL,
  `temporada` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`codtemporada`, `temporada`, `desde`, `hasta`) VALUES
(1, 'BAJA', '2021-01-01', '2021-03-15'),
(2, 'MEDIA', '2021-03-16', '2021-08-31'),
(3, 'ALTA', '2021-09-01', '2021-12-31'),
(4, 'BAJA', '2022-01-01', '2022-03-15'),
(5, 'MEDIA', '2022-03-16', '2022-08-31'),
(6, 'ALTA', '2022-09-01', '2022-12-31'),
(7, 'BAJA', '2023-01-01', '2023-03-31'),
(8, 'MEDIA', '2023-04-01', '2023-07-31'),
(9, 'ALTA', '2023-08-01', '2023-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposcambio`
--

CREATE TABLE `tiposcambio` (
  `codcambio` int(11) NOT NULL,
  `descripcioncambio` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montocambio` decimal(12,3) NOT NULL,
  `codmoneda` int(11) NOT NULL,
  `fechacambio` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposhabitaciones`
--

CREATE TABLE `tiposhabitaciones` (
  `codtipo` int(11) NOT NULL,
  `nomtipo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tiposhabitaciones`
--

INSERT INTO `tiposhabitaciones` (`codtipo`, `nomtipo`) VALUES
(1, 'HABITACI&Oacute;N SIMPLE'),
(2, 'HABITACI&Oacute;N DOBLE'),
(3, 'HABITACI&Oacute;N MATRIMONIAL'),
(4, 'PERSONALES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposmoneda`
--

CREATE TABLE `tiposmoneda` (
  `codmoneda` int(11) NOT NULL,
  `moneda` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `siglas` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `simbolo` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tiposmoneda`
--

INSERT INTO `tiposmoneda` (`codmoneda`, `moneda`, `siglas`, `simbolo`) VALUES
(1, 'US DOLLAR', 'USD', '$'),
(7, 'SOLES', 'SOL', 'S/.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int(11) NOT NULL,
  `dni` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nivel` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `dni`, `nombres`, `sexo`, `direccion`, `telefono`, `email`, `usuario`, `password`, `nivel`, `status`) VALUES
(1, '123456789', 'LEIDA RODRIGUEZ', 'FEMENINO', 'SANTA CRUZ DE MORA', '(0416) 9983764', 'LEIDA@GMAIL.COM', 'SECRETARIA', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'SECRETARIA', 1),
(2, '72261609', 'ELVIS JHUNIOR MARCAS MALLMA', 'MASCULINO', 'PSJE BELLAVISTA', '(9391) 64782', 'ELVISJHUNIOR040614@GMAIL.COM', 'ELVISJHUNIOR', '2b1a82b9db244da7c11d50ad8cc5ddb558a51062', 'ADMINISTRADOR(A)', 1),
(3, '16317737', 'MARBELLA PAREDES MARQUEZ', 'FEMENINO', 'SANTA CRUZ DE MORA', '(0416) 3422924', 'PAREDESMARQUEZMARBELLA@GMAIL.COM', 'MARIBEL', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'RECEPCIONISTA', 1),
(4, '25879642', 'MOISES RODOLFO CHIRINOS LEAL', 'MASCULINO', 'SANTA CRUZ DE MORA', '(0274) 9981185', 'MOISESRODOLFOCHIRINOSLEAL@GMAIL.COM', 'MOISESCHIRINOS', '61c693a34b953b7d59146f4790452530db80cb97', 'RECEPCIONISTA', 1),
(5, '71718315', 'JOSE OCHOA PAQUIYAURI', 'MASCULINO', 'JR MARISCAL SUCRE S/N', '(9166) 57679', 'OCHOA29JOSH@GMAIL.COM', 'JOSEOCHOA', '53382b3931b61c03c013c00031a319a6bf1686e3', 'RECEPCIONISTA', 1),
(6, '72285915', 'RENZO TICLLACONDOR HUAMANI', 'MASCULINO', 'AV ARGUEDAS S/N', '(9018) 27948', 'RENZOTICLLACONDORHUAMANI@GMAIL.COM', 'RENZO', '802063b0c61c2f4e64239ef992e4702ae4f56587', 'RECEPCIONISTA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL,
  `tipodocumento` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codarqueo` int(11) NOT NULL,
  `codcaja` int(11) NOT NULL,
  `codventa` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codserie` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codautorizacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codcliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `subtotalivasi` decimal(12,2) NOT NULL,
  `subtotalivano` decimal(12,2) NOT NULL,
  `iva` decimal(12,2) NOT NULL,
  `totaliva` decimal(12,2) NOT NULL,
  `descuento` decimal(12,2) NOT NULL,
  `totaldescuento` decimal(12,2) NOT NULL,
  `totalpago` decimal(12,2) NOT NULL,
  `totalpago2` decimal(12,2) NOT NULL,
  `creditopagado` decimal(12,2) NOT NULL,
  `tipopago` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `formapago` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `montopagado` decimal(12,2) NOT NULL,
  `montodevuelto` decimal(12,2) NOT NULL,
  `fechavencecredito` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechapagado` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `statusventa` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaventa` datetime NOT NULL,
  `observaciones` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idventa`, `tipodocumento`, `codarqueo`, `codcaja`, `codventa`, `codserie`, `codautorizacion`, `codcliente`, `subtotalivasi`, `subtotalivano`, `iva`, `totaliva`, `descuento`, `totaldescuento`, `totalpago`, `totalpago2`, `creditopagado`, `tipopago`, `formapago`, `montopagado`, `montodevuelto`, `fechavencecredito`, `fechapagado`, `statusventa`, `fechaventa`, `observaciones`, `codigo`) VALUES
(1, 'TICKET', 1, 1, '0001-000000001', '0001', '9297898859078799972598572156079363962882289135079', '0', '130.00', '0.00', '18.00', '23.40', '0.00', '0.00', '153.40', '110.00', '0.00', 'CONTADO', '1', '153.40', '0.00', '0000-00-00', '0000-00-00', 'PAGADA', '2022-11-24 23:16:25', '', 2),
(2, 'TICKET', 2, 1, '0001-000000002', '0001', '9572688691484649158664501365203555913890164477459', 'C10', '28.00', '0.00', '18.00', '5.04', '0.00', '0.00', '33.04', '20.00', '0.00', 'CONTADO', '1', '50.00', '16.96', '0000-00-00', '0000-00-00', 'PAGADA', '2022-11-25 18:50:14', '', 2),
(3, 'FACTURA', 4, 2, '0001-000000003', '0001', '6996643124357147513640061105598904093712670019049', 'C10', '452.00', '0.00', '18.00', '81.36', '0.00', '0.00', '533.36', '387.00', '0.00', 'CONTADO', '', '0.00', '0.00', '0000-00-00', '0000-00-00', 'PAGADA', '2022-11-29 18:45:48', '', 1),
(4, 'TICKET', 3, 1, '0001-000000004', '0001', '1951163557735865120323334111685466628542140661653', 'C10', '22.00', '0.00', '18.00', '3.96', '0.00', '0.00', '25.96', '17.00', '0.00', 'CONTADO', '', '0.00', '0.00', '0000-00-00', '0000-00-00', 'PAGADA', '2022-11-30 21:45:15', '', 2),
(5, 'TICKET', 3, 1, '0001-000000005', '0001', '1506880009441288408270759184348873780186084733433', 'C16', '380.00', '0.00', '18.00', '68.40', '0.00', '0.00', '448.40', '340.00', '0.00', 'CONTADO', '', '0.00', '0.00', '0000-00-00', '0000-00-00', 'PAGADA', '2022-12-02 19:52:18', '', 2),
(6, 'TICKET', 3, 1, '0001-000000006', '0001', '6337575551909545723954055803776750645381858483444', 'C1', '0.00', '3.00', '0.00', '0.00', '0.00', '0.00', '3.00', '3.00', '0.00', 'CONTADO', '', '0.00', '0.00', '0000-00-00', '0000-00-00', 'PAGADA', '2022-12-06 11:47:35', '', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonoscreditos`
--
ALTER TABLE `abonoscreditos`
  ADD PRIMARY KEY (`codabono`);

--
-- Indices de la tabla `abonoscreditosreservaciones`
--
ALTER TABLE `abonoscreditosreservaciones`
  ADD PRIMARY KEY (`codabono`);

--
-- Indices de la tabla `abonoscreditosventas`
--
ALTER TABLE `abonoscreditosventas`
  ADD PRIMARY KEY (`codabono`);

--
-- Indices de la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  ADD PRIMARY KEY (`codarqueo`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`codcaja`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codcategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idcompra`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`codmensaje`);

--
-- Indices de la tabla `creditosxclientes`
--
ALTER TABLE `creditosxclientes`
  ADD PRIMARY KEY (`codcredito`);

--
-- Indices de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD PRIMARY KEY (`coddetallecompra`);

--
-- Indices de la tabla `detallereservaciones`
--
ALTER TABLE `detallereservaciones`
  ADD PRIMARY KEY (`coddetallereservacion`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`coddetalleventa`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`coddocumento`);

--
-- Indices de la tabla `entrada_insumos`
--
ALTER TABLE `entrada_insumos`
  ADD PRIMARY KEY (`identrada`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`idhabitacion`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`codimpuesto`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`idinsumo`);

--
-- Indices de la tabla `kardex_insumos`
--
ALTER TABLE `kardex_insumos`
  ADD PRIMARY KEY (`codkardex`);

--
-- Indices de la tabla `kardex_productos`
--
ALTER TABLE `kardex_productos`
  ADD PRIMARY KEY (`codkardex`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mediospagos`
--
ALTER TABLE `mediospagos`
  ADD PRIMARY KEY (`codmediopago`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`codmensaje`);

--
-- Indices de la tabla `movimientoscajas`
--
ALTER TABLE `movimientoscajas`
  ADD PRIMARY KEY (`codmovimiento`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`codnoticia`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`codperfil`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`idreservacion`);

--
-- Indices de la tabla `salida_insumos`
--
ALTER TABLE `salida_insumos`
  ADD PRIMARY KEY (`idsalida`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`codservicio`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`codtarifa`);

--
-- Indices de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD PRIMARY KEY (`codtemporada`);

--
-- Indices de la tabla `tiposcambio`
--
ALTER TABLE `tiposcambio`
  ADD PRIMARY KEY (`codcambio`);

--
-- Indices de la tabla `tiposhabitaciones`
--
ALTER TABLE `tiposhabitaciones`
  ADD PRIMARY KEY (`codtipo`);

--
-- Indices de la tabla `tiposmoneda`
--
ALTER TABLE `tiposmoneda`
  ADD PRIMARY KEY (`codmoneda`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idventa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonoscreditos`
--
ALTER TABLE `abonoscreditos`
  MODIFY `codabono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `abonoscreditosreservaciones`
--
ALTER TABLE `abonoscreditosreservaciones`
  MODIFY `codabono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `abonoscreditosventas`
--
ALTER TABLE `abonoscreditosventas`
  MODIFY `codabono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  MODIFY `codarqueo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `codcaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contact`
--
ALTER TABLE `contact`
  MODIFY `codmensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditosxclientes`
--
ALTER TABLE `creditosxclientes`
  MODIFY `codcredito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  MODIFY `coddetallecompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallereservaciones`
--
ALTER TABLE `detallereservaciones`
  MODIFY `coddetallereservacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  MODIFY `coddetalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `coddocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `entrada_insumos`
--
ALTER TABLE `entrada_insumos`
  MODIFY `identrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `codimpuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `idinsumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `kardex_insumos`
--
ALTER TABLE `kardex_insumos`
  MODIFY `codkardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `kardex_productos`
--
ALTER TABLE `kardex_productos`
  MODIFY `codkardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `mediospagos`
--
ALTER TABLE `mediospagos`
  MODIFY `codmediopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `codmensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientoscajas`
--
ALTER TABLE `movimientoscajas`
  MODIFY `codmovimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `codnoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `codperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `idreservacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `salida_insumos`
--
ALTER TABLE `salida_insumos`
  MODIFY `idsalida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `codservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `codtarifa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  MODIFY `codtemporada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tiposcambio`
--
ALTER TABLE `tiposcambio`
  MODIFY `codcambio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposhabitaciones`
--
ALTER TABLE `tiposhabitaciones`
  MODIFY `codtipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tiposmoneda`
--
ALTER TABLE `tiposmoneda`
  MODIFY `codmoneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2017 a las 13:19:06
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dimquality`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `persona` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`, `persona`, `correo`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'imera92@gmail.com'),
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'imera92@gmail.com'),
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'imera92@gmail.com'),
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'imera92@gmail.com'),
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'imera92@gmail.com'),
(0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'imera92@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apikeys`
--

CREATE TABLE `apikeys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `apikeys`
--

INSERT INTO `apikeys` (`id`, `key`, `level`, `ignore_limits`, `date_created`, `user_id`) VALUES
(11, 'p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO', 0, 0, '2017-08-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `subtotal` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `usuario`, `subtotal`) VALUES
(1, 0, '0.00'),
(2, 0, '0.00'),
(3, 0, '248.20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaproducto`
--

CREATE TABLE `categoriaproducto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `usuario` varchar(128) NOT NULL,
  `tecnico` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '0',
  `fechaFin` datetime DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoproducto`
--

CREATE TABLE `estadoproducto` (
  `id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadotransaccion`
--

CREATE TABLE `estadotransaccion` (
  `id` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariotecnico`
--

CREATE TABLE `horariotecnico` (
  `id` int(11) NOT NULL,
  `tecnico` int(11) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `dia` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horariotecnico`
--

INSERT INTO `horariotecnico` (`id`, `tecnico`, `horaInicio`, `horaFin`, `dia`) VALUES
(1, 1, '09:00:00', '17:00:00', 1),
(2, 1, '09:00:00', '17:00:00', 2),
(3, 2, '09:00:00', '17:00:00', 3),
(4, 2, '09:00:00', '17:00:00', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemtransaccion`
--

CREATE TABLE `itemtransaccion` (
  `id` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `transaccion` int(11) NOT NULL,
  `cantidad` int(4) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `itemtransaccion`
--

INSERT INTO `itemtransaccion` (`id`, `producto`, `transaccion`, `cantidad`, `subtotal`) VALUES
(1, 1, 500, 1, '248.20'),
(2, 2, 501, 1, '704.50'),
(3, 5, 501, 1, '705.85'),
(4, 36, 501, 1, '887.35'),
(5, 2, 502, 1, '704.50'),
(6, 5, 502, 1, '705.85'),
(7, 36, 502, 1, '887.35'),
(8, 2, 503, 1, '704.50'),
(9, 5, 503, 1, '705.85'),
(10, 36, 503, 1, '887.35'),
(11, 1, 504, 1, '248.20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES
(1, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"c4d82d88-c423-1ce7-b672-913b64741462\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502908094, 0.04983, '0', 403),
(2, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"bb071c40-7935-4f51-23d0-b1df5caddde0\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502908272, 0.0800719, '1', 400),
(3, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"32703d2b-c72c-c472-90ff-0f6753b4a5be\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502908293, 0.054333, '0', 403),
(4, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"ff561afe-8838-8d55-60dd-70b797b67aa1\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502908301, 0.050283, '0', 403),
(5, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"f86a7975-ea61-2a35-c778-4ce99f4eaa5d\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502908312, 0.0149529, '1', 400),
(6, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"0af2e4a9-f1cb-58aa-1900-951f4a795448\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502909540, 0.194334, '1', 400),
(7, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"5b961483-8feb-4936-c357-c49c40927e64\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502909569, 0.0357111, '1', 400),
(8, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"1d6b506d-293b-1803-3012-8a9819b3dd8f\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";}', '', '::1', 1502909651, 0.422763, '1', 400),
(9, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"242\";s:13:\"Postman-Token\";s:36:\"f80bdf02-1ae8-b5c4-cf46-68ddc18e4907\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryCQlU3kEPVwhjUmCG\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";s:8:\"username\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502909808, 0.383717, '1', 400),
(10, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"e59d3909-21e0-7ba8-474b-bbae52507f0f\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundary4j6WPwZF41zbA6Xk\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502909842, 0.0151441, '1', 0),
(11, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"154f0a60-1d30-5dd3-ec17-a15654245312\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryffHSpolwazE4K1S8\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502909951, 0.040664, '1', 0),
(12, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"fc2657c3-e294-ea22-0087-ff07c7dbb52f\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundary4x0qwJHBzB27Aokn\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910015, 0.363225, '1', 0),
(13, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"896185b0-1aaf-ba8b-6ec7-7619598dde95\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundarykkmfMBFVwmfzZag8\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910148, 0.309723, '1', 0),
(14, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"86a7f7f8-6bf7-7256-50c1-406790b7fe51\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryO40QrXc6MAmntt2v\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=894mbsq1cphnch32fk6kpbmrapdjj3nb\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910194, 1.08305, '1', 0),
(15, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"f1a1a47f-f8f0-a04a-4411-16155dc4046a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundarygdp5m3A0CgzUgmly\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=jsp9i72mh8ggkgfj316irsq76iql5nam\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910247, 0.317407, '1', 0),
(16, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"1b8a0f2c-9245-bb71-b831-360ad9165499\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundarysAZhUn2Aczy7FypL\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=jsp9i72mh8ggkgfj316irsq76iql5nam\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910792, 0.649392, '1', 400),
(17, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"28479550-d08f-bfc3-33ab-45f9bfe24ed5\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryqS11RYJSxEPGBHLQ\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=uflcofa8rpj1f4hnpau6jsb7t2e5jur0\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910824, 0.156632, '1', 0),
(18, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"0ce8319b-ce05-1c02-392e-6816880dafda\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundarypo2YBpvFWUCaClw7\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=uflcofa8rpj1f4hnpau6jsb7t2e5jur0\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910893, 0.088655, '1', 400),
(19, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"fc93720e-8563-aa59-399c-a09364e5701a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryttdAuOWoj9bkXhoE\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=uflcofa8rpj1f4hnpau6jsb7t2e5jur0\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910896, 0.051204, '1', 400),
(20, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"3aaeaf55-4631-5099-289a-b79eb3561fff\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryXKgSydIki6IY0RgW\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=uflcofa8rpj1f4hnpau6jsb7t2e5jur0\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910897, 0.088233, '1', 400),
(21, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"82abed43-339e-25d3-1aaa-c5e31fc13f6d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundarycWiEY5JBEnYzTqLb\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=uflcofa8rpj1f4hnpau6jsb7t2e5jur0\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502910898, 0.0416071, '1', 400),
(22, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"9e65f6ac-38cb-749a-4b28-33abbb5827ad\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryj7j8Cz8JyY25QRJr\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=uflcofa8rpj1f4hnpau6jsb7t2e5jur0\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911131, 0.426591, '1', 200),
(23, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"1da86cd6-7930-76e7-122a-8711e8b8ae03\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryhBzMcSnlqfLUGWet\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=t6l8psocdaddm8sd5o3c214shh5i9jde\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911167, 0.0761139, '1', 200),
(24, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"31346e4e-39da-bd54-5466-9018543491a0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:68:\"multipart/form-data; boundary=----WebKitFormBoundaryWrTPJa7ebPF7jz1y\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=t6l8psocdaddm8sd5o3c214shh5i9jde\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911193, 0.075269, '1', 200),
(25, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"40\";s:13:\"Postman-Token\";s:36:\"cd0e6df5-23e9-357c-75cf-68e64a9cb661\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=t6l8psocdaddm8sd5o3c214shh5i9jde\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"nepe\";}', '', '::1', 1502911428, 0.420989, '1', 400),
(26, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"40\";s:13:\"Postman-Token\";s:36:\"2963c91d-8065-c5ba-0962-1c77bff6104e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=t6l8psocdaddm8sd5o3c214shh5i9jde\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911454, 0.157509, '1', 200),
(27, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"40\";s:13:\"Postman-Token\";s:36:\"ac542a96-4b5f-141c-4947-308eee01c612\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911486, 0.0724699, '1', 400),
(28, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"40\";s:13:\"Postman-Token\";s:36:\"4cdf517b-8993-edd0-e5da-3e24a2105065\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911489, 0.0995562, '1', 400),
(29, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"40\";s:13:\"Postman-Token\";s:36:\"b022a9f0-5729-8f13-ee84-c8faaf4362eb\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911511, 0.267363, '1', 400),
(30, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"40\";s:13:\"Postman-Token\";s:36:\"2d1c544f-d55e-2ae2-7729-7d1a2ddac636\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502911548, 0.258829, '1', 400),
(31, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"4370cf7a-61c1-6dab-4c16-190e83ada344\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911556, 0.0377431, '1', 400),
(32, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"16e08947-97b8-5270-c08f-d74027e7a252\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:78:\"------WebKitFormBoundarydZ6orisNPJwDv0UP\r\nContent-Disposition:_form-data;_name\";s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundarydZ6orisNPJwDv0UP\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundarydZ6orisNPJwDv0UP--\r\n\";i:0;s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundarydZ6orisNPJwDv0UP\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundarydZ6orisNPJwDv0UP--\r\n\";i:1;s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundarydZ6orisNPJwDv0UP\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundarydZ6orisNPJwDv0UP--\r\n\";}', '', '::1', 1502911569, 0.0405669, '1', 400),
(33, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"40\";s:13:\"Postman-Token\";s:36:\"86f8c9e4-8dea-738d-1052-8d80e04c4d2c\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:40:\"{\n	\"user\":_\"user\",\n	\"password\":_\"asdf\"\n}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502911581, 0.0442929, '1', 400),
(34, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"37\";s:13:\"Postman-Token\";s:36:\"53e5bd4a-d0bc-2e0a-3841-9caabd5c6cc7\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:37:\"{\n	\"user\":_\"user\",\n	\"password\":_\"s\"\n}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502911589, 0.041389, '1', 400),
(35, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"ca3812fd-5dd4-2540-4aa8-829dd9b26da2\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911643, 0.317388, '1', 400),
(36, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"2d94e11c-2fe0-7b23-6931-60411b34737c\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911663, 0.0187161, '1', 400),
(37, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"2be1950e-3375-c704-7578-c2e06b510c5f\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911674, 0.0200009, '1', 400),
(38, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"d98027e7-cde7-788f-abc5-1019f2317dd9\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911687, 0.037847, '1', 400),
(39, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"15b1c196-0e40-e86d-fdd5-68578930c3f2\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911688, 0.0181651, '1', 400),
(40, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"8527b350-5ea9-dbeb-a423-f272bf6f5f33\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911725, 0.035197, '1', 400),
(41, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"5af6b59e-e186-9fd7-d8c6-7f35f4e681e1\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911749, 0.048384, '1', 400),
(42, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"28a3b979-a47f-57ae-3d29-71652990e13e\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911750, 0.024102, '1', 400),
(43, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"a43c7ed1-afba-d6a3-9b36-544ee1c2192c\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911774, 0.039263, '1', 400),
(44, 'api/login', 'post', 'a:12:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:13:\"Postman-Token\";s:36:\"8cbeeb09-676f-2239-b525-d71397a272b9\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911776, 0.0423388, '1', 400),
(45, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"ea770e48-4c4d-eea7-66a8-822eae0ccd85\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502911819, 0.328841, '1', 400),
(46, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"2608ce25-f12c-5dea-5b5b-eeae0a1698a2\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:78:\"------WebKitFormBoundarylNRZ6I1gxAAyWhJj\r\nContent-Disposition:_form-data;_name\";s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundarylNRZ6I1gxAAyWhJj\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundarylNRZ6I1gxAAyWhJj--\r\n\";i:0;s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundarylNRZ6I1gxAAyWhJj\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundarylNRZ6I1gxAAyWhJj--\r\n\";i:1;s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundarylNRZ6I1gxAAyWhJj\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundarylNRZ6I1gxAAyWhJj--\r\n\";}', '', '::1', 1502912730, 0.625615, '1', 400),
(47, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"1\";s:13:\"Postman-Token\";s:36:\"3af48545-d29d-272d-11f8-b6ffb6f5f1d1\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502912760, 0.501789, '1', 400),
(48, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"34\";s:13:\"Postman-Token\";s:36:\"e2064e00-d056-b3b4-6c2b-9cccfb624721\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";}', '', '::1', 1502912791, 0.319398, '1', 400),
(49, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:3:\"238\";s:13:\"Postman-Token\";s:36:\"83da7276-5c37-ec1f-88dd-ca8e1d832788\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:78:\"------WebKitFormBoundaryzjF17Abxn4N9xbtY\r\nContent-Disposition:_form-data;_name\";s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundaryzjF17Abxn4N9xbtY\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundaryzjF17Abxn4N9xbtY--\r\n\";i:0;s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundaryzjF17Abxn4N9xbtY\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundaryzjF17Abxn4N9xbtY--\r\n\";i:1;s:159:\"\"user\"\r\n\r\nuser\r\n------WebKitFormBoundaryzjF17Abxn4N9xbtY\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nasdf\r\n------WebKitFormBoundaryzjF17Abxn4N9xbtY--\r\n\";}', '', '::1', 1502912805, 0.159258, '1', 400),
(50, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"27\";s:13:\"Postman-Token\";s:36:\"bf6629f7-3ed8-8ab3-017c-704f84c7260d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=k9dd0ecph3toln8gcpsm34vtcv9ejndv\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:8:\"password\";}', '', '::1', 1502912839, 0.614905, '1', 400),
(51, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"23\";s:13:\"Postman-Token\";s:36:\"c8f0929c-1db2-71c2-a3f8-5e01daa61501\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=r61vljkrn4ij985aolpbtdqv7r4oicbo\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502912848, 0.739345, '1', 200),
(52, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"34\";s:13:\"Postman-Token\";s:36:\"1f7b906d-10e8-d27f-da45-ae92252129ba\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=r61vljkrn4ij985aolpbtdqv7r4oicbo\";s:34:\"{\n	user:\"user\",\n	password:\"asdf\"\n}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502913405, 0.074935, '1', 400),
(53, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"23\";s:13:\"Postman-Token\";s:36:\"c59c918e-2f8e-547c-e38b-7724d84692aa\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=r61vljkrn4ij985aolpbtdqv7r4oicbo\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502913410, 0.0400338, '1', 200),
(54, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"46\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:8:\"username\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502913725, 0.393419, '1', 400),
(55, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"23\";s:13:\"Postman-Token\";s:36:\"b96ae4a1-ec25-a090-a35a-0aada0a0cc70\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=oauadpl3it2o83k3guk592sekn8486mb\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502914032, 0.512861, '1', 200),
(56, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"24\";s:13:\"Postman-Token\";s:36:\"c17aac8c-5d89-fc8a-6ce3-8070c035b968\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=d746q7fggbreh6cirn0osmutllupmvds\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:5:\"asdfs\";}', '', '::1', 1502914038, 0.024755, '1', 400),
(57, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"34\";s:13:\"Postman-Token\";s:36:\"ff4d2b5f-ad93-4030-ee2f-7b1aa35602f9\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=d746q7fggbreh6cirn0osmutllupmvds\";s:34:\"{\n	user:\"user\",\n	password:\"asdf\"\n}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502914054, 0.0490921, '1', 400);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES
(58, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"29\";s:13:\"Postman-Token\";s:36:\"bdba7435-1906-aeff-a842-3c7fb48dfb33\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=d746q7fggbreh6cirn0osmutllupmvds\";s:29:\"{user:\"user\",password:\"asdf\"}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502914078, 0.427737, '1', 400),
(59, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"46\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:8:\"username\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502914128, 0.33524, '1', 400),
(60, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"24\";s:13:\"Postman-Token\";s:36:\"bd0097ff-53ac-d18e-0936-bcdb570f158e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=d746q7fggbreh6cirn0osmutllupmvds\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:5:\"asdfs\";}', '', '::1', 1502914556, 0.339149, '1', 400),
(61, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"24\";s:13:\"Postman-Token\";s:36:\"4cb3fdf4-f4d7-8506-6778-3261463e5623\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=69t7i48b20342jj8asbg3s100q18c3a3\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:5:\"asdfs\";}', '', '::1', 1502914657, 0.0849209, '1', 400),
(62, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"24\";s:13:\"Postman-Token\";s:36:\"fbb50da1-8d71-3cc0-d316-a54bd41fbc1b\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=69t7i48b20342jj8asbg3s100q18c3a3\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:5:\"asdfs\";}', '', '::1', 1502914668, 0.0396161, '1', 400),
(63, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"24\";s:13:\"Postman-Token\";s:36:\"829e4ea8-4c99-d04f-b3b3-a3341a340646\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=69t7i48b20342jj8asbg3s100q18c3a3\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:5:\"asdfs\";}', '', '::1', 1502914898, 0.388961, '1', 400),
(64, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"23\";s:13:\"Postman-Token\";s:36:\"b18f908a-a4d5-ec70-b635-37d2c22ea155\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=e4i1rpbd69he9t2sgfcp24dh9j45p2d1\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502914906, 0.078557, '1', 200),
(65, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"23\";s:13:\"Postman-Token\";s:36:\"1f09db6f-293b-ae35-3cca-4108a1f9425b\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=e4i1rpbd69he9t2sgfcp24dh9j45p2d1\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502914931, 0.058516, '1', 200),
(66, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"29\";s:13:\"Postman-Token\";s:36:\"94ed579c-8566-c49c-fa34-93a1514f16b3\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=e4i1rpbd69he9t2sgfcp24dh9j45p2d1\";s:29:\"{user:\"user\",password:\"asdf\"}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502914937, 0.0561512, '1', 400),
(67, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"29\";s:13:\"Postman-Token\";s:36:\"e4c84a90-0b30-82a9-e6c4-65af0ff34507\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=e4i1rpbd69he9t2sgfcp24dh9j45p2d1\";s:29:\"{user:\"user\",password:\"asdf\"}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502915055, 0.051331, '1', 400),
(68, 'api/login', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"29\";s:13:\"Postman-Token\";s:36:\"6092d370-f789-61c1-ae80-631c0b2694a5\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=e4i1rpbd69he9t2sgfcp24dh9j45p2d1\";s:29:\"{user:\'user\',password:\'asdf\'}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1502915082, 0.0230129, '1', 400),
(69, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"29\";s:13:\"Postman-Token\";s:36:\"1e077f8b-1cf9-5fcd-5bdc-f2622758a921\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=e4i1rpbd69he9t2sgfcp24dh9j45p2d1\";}', '', '::1', 1502915101, 0.214603, '1', 400),
(70, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"8dc2870a-cb61-6fc8-b233-72a9e2af1e2d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=e4i1rpbd69he9t2sgfcp24dh9j45p2d1\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502915122, 0.059525, '1', 200),
(71, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"46\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:8:\"username\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502915144, 0.0414279, '1', 400),
(72, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"46\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:8:\"username\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502915174, 0.406124, '1', 400),
(73, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"46\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:8:\"username\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502915227, 0.395058, '1', 0),
(74, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"42\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502915428, 0.622439, '1', 200),
(75, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"42\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1502915566, 0.234322, '1', 200),
(76, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"43\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:5:\"asdfd\";}', '', '::1', 1502915580, 0.057503, '1', 400),
(77, 'api/login', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"38\";s:6:\"Accept\";s:33:\"application/json, text/plain, */*\";s:6:\"Origin\";s:21:\"http://localhost:8100\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"content-type\";s:16:\"application/json\";s:3:\"DNT\";s:1:\"1\";s:7:\"Referer\";s:76:\"http://localhost:8100/?ionicplatform=android&http://localhost:8100/ionic-lab\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:0:\"\";}', '', '::1', 1502915588, 0.020875, '1', 400),
(78, 'api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"aee999da-017a-7e8c-6a2c-5bd660a544c7\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503085623, 0.521863, '1', 200),
(79, 'Api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"dbcf425b-ea88-4b61-494b-bf6dbe3c8639\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=pigj3sdfvek0j0qod8c2ck9dt2fqf522\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503087497, 0.209433, '1', 200),
(80, 'apilogin', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"44479e39-bd37-7f72-8d55-ef572264700d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=feipd5jbu5hinrpt9pcvcinv6vlee57g\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503087609, 0.239983, '1', 200),
(81, 'apilogin', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"8e9f09ab-7cf8-e34f-770e-163985ebe23c\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=feipd5jbu5hinrpt9pcvcinv6vlee57g\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503087658, 0.142563, '1', 200),
(82, 'api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"939c2ad3-f431-4832-f30a-6ed5ff07da41\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=feipd5jbu5hinrpt9pcvcinv6vlee57g\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503087777, 0.140837, '1', 200),
(83, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"9553a63f-e7e1-ef79-43b8-05c42f9d0554\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503105918, 0.800858, '1', 200),
(84, 'Api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"4064ac48-5868-8ddb-b270-ca0524ae5758\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=1def0ausdnnmqcj5bds08o4tg4uodngm\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503105990, 0.217565, '1', 200),
(85, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"0fde4088-1455-c3b4-e45f-9802634a60d8\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503171710, 0.791087, '1', 0),
(86, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"652e08f5-163f-9e15-0bbf-ac7179e04c47\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503171742, 0.438111, '1', 0),
(87, 'Api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"c7c208a4-c5f6-b28b-b7f4-df7ce1933a58\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503171803, 0.128017, '1', 0),
(88, 'Api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"a8178e1a-e478-e646-2aca-423a274d2e3a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503171823, 0.255006, '1', 200),
(89, 'Api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"755ae5e5-b98a-878b-dc3e-eee8f023859c\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503171842, 0.18491, '1', 200),
(90, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"f39547bb-0e24-127a-5691-8af768424578\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503174774, NULL, '1', 0),
(91, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"240cf6d4-e1ce-6bb4-4d19-aaa110bd40ec\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503174806, NULL, '1', 0),
(92, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"4e85677f-8ac3-24e8-7315-12b597152ec4\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503174838, NULL, '1', 0),
(93, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"e867e172-3e71-e61e-c9c4-c9497c59ed44\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503174885, NULL, '1', 0),
(94, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"4f7bdd87-ee73-a527-07d1-411295617045\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503174921, NULL, '1', 0),
(95, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"97d7082a-e8c6-c2a0-9253-f5ba569c283d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503174950, NULL, '1', 0),
(96, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"b70e89d2-2b0a-0ab2-8da9-0dc8a9625063\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175031, NULL, '1', 0),
(97, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"8903383a-94be-837b-64df-eb34b3b6bd82\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175440, 2.70611, '1', 200),
(98, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"48f3382b-1b0c-946c-bfa1-182f47ac9d95\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175470, NULL, '1', 0),
(99, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"8fdcf413-d33c-34fa-baa2-e0a408dd1759\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175490, 0.161073, '1', 200),
(100, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"01288c9e-3fb8-c18a-e996-369c9986da9d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175599, NULL, '1', 0),
(101, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"bc132a25-6258-a7b0-f8a7-69ed8e06429f\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175619, 0.124432, '1', 200),
(102, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"b78317f1-9a5c-4c70-abe8-76315fbc9ffa\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175791, 0.167446, '1', 200),
(103, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"747af1fa-9c90-0456-8776-62ca4a67d4dd\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175920, 0.136267, '1', 200),
(104, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"4e029bb8-2f66-b3f8-1688-76324e565aa2\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:15:\"sdadasdasdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175938, 0.199608, '1', 200),
(105, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"1d442a7d-5504-dd5a-67b9-c074ae08c3dd\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:15:\"sdadasdasdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503175955, NULL, '1', 0),
(106, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"4a49b45f-d1ab-c941-1c09-2604a7303d23\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:15:\"sdadasdasdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176012, NULL, '1', 0),
(107, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"b3188050-ec98-11d1-4058-b239e71eb449\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:15:\"sdadasdasdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176206, NULL, '1', 0),
(108, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"75058bac-de15-3ffe-205b-78c7c7749e47\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:15:\"sdadasdasdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176219, NULL, '1', 0),
(109, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"123ab1d2-10a5-29e7-f3c5-47942ef0504c\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:15:\"sdadasdasdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176257, NULL, '1', 0),
(110, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"8940efb1-1b3e-c386-bf06-ae55fc82ee1a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176278, 0.0943038, '1', 200),
(111, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"ee246b5f-a302-fb9f-091a-fd8842d2357c\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176302, 0.099236, '1', 401),
(112, 'Api/cita', 'post', 'a:13:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"6436309f-17ec-7c9c-2835-88e06f7013f1\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176350, 0.089627, '1', 401),
(113, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"5ff71f6b-8ea8-366e-21b8-6115adea7eb9\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:8:\"asdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=qt1p5j3hfvs95n4mk9devbrd3cjield4\";}', '', '::1', 1503176355, 0.697037, '1', 401),
(114, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"13458af8-b27b-c9c3-9750-a5e223c88ccd\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:8:\"asdasdas\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=8doomtsr7v09t2lnmdk9t7o6kr8lfuqt\";}', '', '::1', 1503176398, 0.0670791, '1', 401),
(115, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"17c2b587-7358-e201-e73e-8489d73a6269\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"8K4kAWYYyI9sS7bOmWU4UgbG3Kn0FLcKLsWXsOql\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=8doomtsr7v09t2lnmdk9t7o6kr8lfuqt\";}', '', '::1', 1503176477, NULL, '1', 0),
(116, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"88c81c9f-cca8-782f-03ef-877176ad31b1\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"8K4kAWYYyI9sS7bOmWU4UgbG3Kn0FLcKLsWXsOql\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=8doomtsr7v09t2lnmdk9t7o6kr8lfuqt\";}', '', '::1', 1503176533, 0.108156, '1', 401),
(117, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"19d126e4-36b0-b3b0-8bbb-559ce980df45\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"8K4kAWYYyI9sS7bOmWU4UgbG3Kn0FLcKLsWXsOql\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=8doomtsr7v09t2lnmdk9t7o6kr8lfuqt\";}', '', '::1', 1503176588, 0.142555, '1', 200),
(118, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"afad6f08-d13f-7883-715a-4e10309a5ad8\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"8K4kAWYYyI9sS7bOmWU4UgbG3Kn0FLcKLsWXsOql\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=8doomtsr7v09t2lnmdk9t7o6kr8lfuqt\";}', '', '::1', 1503176624, 0.056433, '1', 401);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES
(119, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"6b77f273-618a-be7d-18b8-bff8e1f98e77\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"8K4kAWYYyI9sS7bOmWU4UgbG3Kn0FLcKLsWXsOql\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=8doomtsr7v09t2lnmdk9t7o6kr8lfuqt\";}', '', '::1', 1503176665, 0.139113, '1', 200),
(120, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"69e00cdc-04df-4044-26b2-6939801553b0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503303473, 0.812497, '0', 403),
(121, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"42eec9a4-dee1-6d84-91ec-19b4bd34048d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503303483, 0.073817, '0', 403),
(122, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"1defaa15-d681-74da-c8df-af05a2240253\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503303512, 0.174029, '0', 403),
(123, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"fa3d609c-2b8f-7c5d-535d-da8dd8684241\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503303516, 0.13854, '0', 403),
(124, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"3e7403b3-4f3c-8f1d-a1f8-961778ff150d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503303523, 0.0587361, '0', 403),
(125, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"0d6a0010-4792-194d-b1f6-2fcafb096b13\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503303529, 0.0673299, '0', 403),
(126, 'Api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"70bdc148-619e-19fe-2877-49f395076ef0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:33:\"{\"user\":\"user\",\"password\":\"asdf\"}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1503303760, 0.136412, '1', 400),
(127, 'Api/login', 'post', 'a:15:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"32c51846-5f48-d203-1090-b959a8b89499\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:33:\"{\"user\":\"user\",\"password\":\"asdf\"}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1503303789, 0.107371, '1', 400),
(128, 'Api/login', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"33\";s:13:\"Postman-Token\";s:36:\"4b648d5a-6abf-1ab8-5c05-93610e8e98b6\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:4:\"user\";s:4:\"user\";s:8:\"password\";s:4:\"asdf\";}', '', '::1', 1503303800, 0.694605, '1', 200),
(129, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:1:\"0\";s:13:\"Postman-Token\";s:36:\"8d5826bc-4b38-1027-b76b-1429626e4c91\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=m9tolmh0qsjlvtb15oomq17nfnn38iku\";}', '', '::1', 1503303827, 0.175929, '1', 400),
(130, 'Api/cita', 'post', 'a:14:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"39\";s:13:\"Postman-Token\";s:36:\"54f2f4bf-1c47-8b9e-0430-a1ffe874663f\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=m9tolmh0qsjlvtb15oomq17nfnn38iku\";}', '', '::1', 1503308970, 0.176156, '1', 400),
(131, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"43\";s:13:\"Postman-Token\";s:36:\"6d6b40f0-c148-7ba3-0d84-72fd596c6bd7\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=037vtutpnjk0k78sgulfn1r92le9bs8t\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:0:\"\";}', '', '::1', 1503308991, 0.282844, '1', 400),
(132, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"14\";s:13:\"Postman-Token\";s:36:\"ab4fb3d2-f590-77c5-47bd-be05669274fc\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=037vtutpnjk0k78sgulfn1r92le9bs8t\";s:5:\"fecha\";s:0:\"\";s:6:\"asunto\";s:0:\"\";}', '', '::1', 1503309061, 0.199354, '1', 400),
(133, 'Api/cita', 'post', 'a:17:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"6d87f244-eaee-86fa-6cb5-7dc2b7357003\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=037vtutpnjk0k78sgulfn1r92le9bs8t\";s:49:\"{\n\"fecha\":\"2017-08-23_10:00\",\n\"asunto\":\"dasdas\"\n}\";s:0:\"\";i:0;s:0:\"\";i:1;s:0:\"\";}', '', '::1', 1503309104, 0.111264, '1', 400),
(134, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"316e01c6-af45-ffec-588c-8e61011cfe52\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=037vtutpnjk0k78sgulfn1r92le9bs8t\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503309112, NULL, '1', 0),
(135, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"250cfb66-8051-7687-6c39-80c83c3616b4\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=037vtutpnjk0k78sgulfn1r92le9bs8t\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503309246, NULL, '1', 0),
(136, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"161faff8-547e-78f9-6ee1-bef445e50a0a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=037vtutpnjk0k78sgulfn1r92le9bs8t\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503309418, 0.138882, '1', 0),
(137, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"255c8bdb-8b54-5448-41c0-eaa9c8ddd9fb\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=ub78i0oa798u9ctkoss29pmppq5j1l5i\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503309495, 0.042454, '1', 0),
(138, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"db34bc85-28b3-5ef9-9fc4-6b3f7358c725\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=ub78i0oa798u9ctkoss29pmppq5j1l5i\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503309583, 0.093859, '1', 400),
(139, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"7eab8179-b48d-a53a-c077-0d15b92827f0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=ub78i0oa798u9ctkoss29pmppq5j1l5i\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503309793, 0.12183, '1', 400),
(140, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"02f71c97-0f6c-f39a-4c1c-e7e0bbb91637\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=lfmbuk4tqcejmi0kr3sudt6h6sin2gqs\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503309846, 0.127073, '1', 400),
(141, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"262c698b-0332-e78b-c909-a6c00dc5c3d0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=lfmbuk4tqcejmi0kr3sudt6h6sin2gqs\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503310060, 0.07342, '1', 400),
(142, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"f445a3b4-3d2f-edc1-e305-cbc8ff53affc\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=lfmbuk4tqcejmi0kr3sudt6h6sin2gqs\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503310124, 0.0674231, '1', 400),
(143, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"0e70d930-80e3-aa13-482c-ed968b732004\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=4u6724ulbd8dv5kq7mc7s2ohh34iegj7\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503310160, 0.139202, '1', 400),
(144, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"cff29a21-3d19-eb6c-cec5-b828971cf09e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=4u6724ulbd8dv5kq7mc7s2ohh34iegj7\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503310250, 0.06407, '1', 400),
(145, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"6909de46-57b8-a1b3-a2e4-3e9bdb0fd04a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=4u6724ulbd8dv5kq7mc7s2ohh34iegj7\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503310316, 0.169329, '1', 400),
(146, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"359a7d4a-be19-de8e-9a51-f37130d47162\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=4u6724ulbd8dv5kq7mc7s2ohh34iegj7\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503310880, 0.215345, '1', 0),
(147, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"e7aaf564-3ac9-6828-cce0-49d5703d3e47\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=oft0aisjm69odqpi5tj679t6oorh0kcu\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311053, 0.127274, '1', 0),
(148, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"5d7f66c3-32c2-358e-a06c-406df0e14da4\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=oft0aisjm69odqpi5tj679t6oorh0kcu\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311071, NULL, '1', 0),
(149, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"2209288f-19e6-548d-ef57-0ea232c702ca\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=oft0aisjm69odqpi5tj679t6oorh0kcu\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311114, NULL, '1', 0),
(150, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"2475a516-d688-f6f4-2569-c0c3e9758ad3\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=oft0aisjm69odqpi5tj679t6oorh0kcu\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311175, NULL, '1', 0),
(151, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"0449fe3d-d7ab-fd35-65ff-a47131f98078\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=oft0aisjm69odqpi5tj679t6oorh0kcu\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311240, NULL, '1', 0),
(152, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"7aa6deaf-e5e5-5546-1b16-a3572872ff74\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311252, NULL, '1', 0),
(153, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"b546516f-657c-90c4-5627-5f8a655c4fed\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311341, NULL, '1', 0),
(154, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"23a7e098-b742-68e2-be95-83cfcdb65abb\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311437, NULL, '1', 0),
(155, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"5eddfc19-ef3c-66cd-fddf-d8504ccece44\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311500, 0.170105, '1', 201),
(156, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"1669c588-c68e-fe3c-2a74-fc852ef6e082\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311508, 0.216445, '1', 201),
(157, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"bf233f30-1cbf-be3b-454f-215c33d7fc50\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311513, 0.158621, '1', 201),
(158, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"8499dcd9-78c1-e8fa-2228-7ee67d623e8d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311514, 0.149093, '1', 201),
(159, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"c0fa2d9f-3756-b2c7-a06b-26d1b2082e40\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=b32aoekt9fktff38ruicdpvjo9le08il\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311654, 0.304152, '1', 201),
(160, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"0e6a3a4a-24f1-62ee-a4b4-40d8a62e76d7\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311657, 0.180473, '1', 201),
(161, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"aa4d87fd-7138-0a18-b60b-5b7adddf5803\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311661, 0.184996, '1', 201),
(162, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"ac934d05-fbb2-9c49-2b0c-3b095e78c196\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311665, 0.197283, '1', 201),
(163, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"49\";s:13:\"Postman-Token\";s:36:\"e77d392f-d2a6-ca8f-fe66-0e7adab79f17\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:16:\"2017-08-23 10:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311745, 0.126689, '1', 400),
(164, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"a137fce6-c16d-1eff-c0e6-7a2c4f44d400\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311779, 0.104036, '1', 400),
(165, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"3f9af11d-922d-e97a-d407-eb3d2c4701c5\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311840, 0.122301, '1', 400),
(166, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"dd6caf37-32ce-9409-ff4d-598339257d2d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311907, 0.0976219, '1', 400),
(167, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"374da193-6d5d-1d69-4051-bc2a7a5ed733\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503311940, 0.104257, '1', 400),
(168, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"6e9b1779-9205-4e23-fe06-df5f979e687f\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h31p1d67rmu5nvci2uid84fnkfhkbqvl\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312006, 0.081934, '1', 400),
(169, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"8a5f5df7-4917-bd7f-df4c-365d1701f677\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=167kt05nfrdpqsnvrvgkqsrc4fa1va43\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312162, 0.16133, '1', 201),
(170, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"19f6a49d-d7df-cc48-94bf-fca36389d6ce\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=167kt05nfrdpqsnvrvgkqsrc4fa1va43\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312385, 0.160374, '1', 201),
(171, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"4a27f083-8ee8-79a8-e23e-d1b8b9447661\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=ulakbna17vu30uqcp9uf1eibkcg5tam8\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312411, 0.064085, '1', 0),
(172, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"49a962df-4a73-058d-fdab-373b4d24c65f\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=ulakbna17vu30uqcp9uf1eibkcg5tam8\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312418, 0.146869, '1', 201),
(173, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"5842565b-ce27-a673-7f19-ce3b2c0ca11e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=ulakbna17vu30uqcp9uf1eibkcg5tam8\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312431, 0.192564, '1', 201);
INSERT INTO `logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES
(174, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"fdad342e-0384-08c0-c16c-71eb55c27ebe\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=ulakbna17vu30uqcp9uf1eibkcg5tam8\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312825, 0.185356, '1', 201),
(175, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"d7b437da-3972-4776-69e1-8d721c4704c7\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312855, 0.190982, '1', 201),
(176, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"f9b74299-51e8-289b-7116-d3f2712e798b\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312967, 0.180504, '1', 201),
(177, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"c69587aa-1ee2-0002-09f2-baed0d6f0d12\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503312992, 0.121789, '1', 201),
(178, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"4c186cac-09b3-1ad8-96b9-553134f4a60d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313001, 0.134377, '1', 201),
(179, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"b0712c3e-4bcf-26b6-9bdc-046913bdb321\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313036, 0.15333, '1', 201),
(180, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"06a1d9fc-8492-3879-287c-0c764e1b6f43\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313039, 0.29853, '1', 201),
(181, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"71af7efa-3e1d-dd26-8cfb-54734dba32b1\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313048, 0.179357, '1', 201),
(182, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"7843f805-7f13-36cb-b9be-1a866032c734\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313051, 0.228668, '1', 201),
(183, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"9c78cb39-b34a-94b7-a028-a7ab234ede64\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313112, 0.235869, '1', 201),
(184, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"57de1aa8-6868-ff46-973f-e65544b451d9\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=h647fl1qd0bscfml4jfmg6ol54ao61f9\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313202, 0.052206, '1', 0),
(185, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"5ee630bf-5b3d-b1dc-59b4-124b69657fb0\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313214, 0.064014, '1', 0),
(186, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"697c4051-311c-e397-be80-759c3330a567\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313224, 0.140297, '1', 201),
(187, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"18521395-9acb-b117-9cf4-0cc0847dc689\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313278, 0.130557, '1', 201),
(188, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"06421dbb-6c4b-e752-8c41-150ec7ebf75a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313289, 0.146479, '1', 201),
(189, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"babaf677-eb2f-dfc9-c64f-e8f108ac0cff\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313339, 0.143081, '1', 201),
(190, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"7e3c453d-f593-407c-928e-05e1ee8386a5\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313415, 0.175312, '1', 201),
(191, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"05654bbc-080f-723e-5001-7172ca6c714c\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313442, 0.0991809, '1', 201),
(192, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"7cdcb335-7fe3-b7ee-9b97-73cb222d56c4\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=noftg5q8dlcb2vnqvngemtajpui6mro3\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313534, 0.115343, '1', 201),
(193, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"c6c232ee-b798-edae-4084-0703c73dc66e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313538, 0.133848, '1', 201),
(194, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"e6d872ab-cc5d-e84c-bf93-ca7b212f453d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313561, 0.278322, '1', 201),
(195, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"eceb2486-3fce-8662-fff5-bbbd540d1733\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313565, 0.234139, '1', 201),
(196, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"8f742f21-635a-ce50-4515-90868559bc4e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313672, 0.134601, '1', 201),
(197, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"88eaa845-857d-701b-176b-9d2e79db3d70\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313675, 0.145925, '1', 201),
(198, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"d3e04b1b-211c-e579-9f14-33f8a3260337\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313707, 0.191725, '1', 201),
(199, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"bac90f9f-0dde-2449-daac-4646a14d6c14\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313709, 0.266824, '1', 201),
(200, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"d69ecbcc-6ed1-affa-e3a8-478ae98e2808\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313713, 0.076793, '1', 201),
(201, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"95e45bcb-33bc-2bfd-8f33-5a6d15ec3a18\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313753, 0.0856721, '1', 0),
(202, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"c22eb30f-bba3-ca8b-e85e-d0334359756b\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313825, 0.0642459, '1', 0),
(203, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"6ac5dca5-a527-ab28-ed2c-07933c52783c\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=92n4encvprd6q6voicfp4it21ceaalu0\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313974, 0.15146, '1', 201),
(204, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"1993b8f2-2ade-a455-032e-293c78100306\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=a76h13hac7bc4etk44jtupkc2dibqu22\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503313978, 0.151837, '1', 201),
(205, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"9f14db16-43a1-bddf-4731-fb713ebc15df\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=a76h13hac7bc4etk44jtupkc2dibqu22\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503314029, 0.169866, '1', 201),
(206, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"79dcde2f-3621-8a40-fa59-7f0737614e4e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=a76h13hac7bc4etk44jtupkc2dibqu22\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503314032, 0.0741649, '1', 201),
(207, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"bb4a28e8-836c-b7e9-a214-581a7737128e\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=a76h13hac7bc4etk44jtupkc2dibqu22\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503314046, 0.147693, '1', 201),
(208, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"7bda39c6-ac6e-c075-a76b-43913fc8c26d\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=a76h13hac7bc4etk44jtupkc2dibqu22\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503314077, 0.103231, '1', 400),
(209, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"9e2d56ee-0a3a-e9eb-69b4-6554986b5e7a\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=a76h13hac7bc4etk44jtupkc2dibqu22\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503314079, 0.15413, '1', 400),
(210, 'Api/cita', 'post', 'a:16:{s:4:\"Host\";s:9:\"localhost\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"48\";s:13:\"Postman-Token\";s:36:\"3314de8d-06cc-a4c4-f542-335f2aaa9259\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:6:\"Origin\";s:51:\"chrome-extension://fhbjgbiflinjbdggehcddcbncdddomop\";s:10:\"User-Agent\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36\";s:9:\"X-Api-Key\";s:40:\"p7iRCgdDwAvtviVvh2oylAmWm6ThXKYZMSzWeDNO\";s:12:\"Content-Type\";s:16:\"application/json\";s:6:\"Accept\";s:3:\"*/*\";s:3:\"DNT\";s:1:\"1\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:15:\"Accept-Language\";s:23:\"es-ES,es;q=0.8,en;q=0.6\";s:6:\"Cookie\";s:43:\"ci_session=a76h13hac7bc4etk44jtupkc2dibqu22\";s:5:\"fecha\";s:15:\"2017-08-23 9:00\";s:6:\"asunto\";s:6:\"dasdas\";}', '', '::1', 1503314081, 0.084975, '1', 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`) VALUES
(1, 'LG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

--
-- Volcado de datos para la tabla `pma__favorite`
--

INSERT INTO `pma__favorite` (`username`, `tables`) VALUES
('root', '[{\"db\":\"dimquality\",\"table\":\"categoriaproducto\"}]'),
('root', '[{\"db\":\"dimquality\",\"table\":\"categoriaproducto\"}]'),
('root', '[{\"db\":\"dimquality\",\"table\":\"categoriaproducto\"}]'),
('root', '[{\"db\":\"dimquality\",\"table\":\"categoriaproducto\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"dimquality\",\"table\":\"producto\"},{\"db\":\"dimquality\",\"table\":\"usuario\"},{\"db\":\"dimquality\",\"table\":\"admin\"},{\"db\":\"dimquality\",\"table\":\"productocarrito\"}]'),
('root', '[{\"db\":\"dimquality\",\"table\":\"producto\"},{\"db\":\"dimquality\",\"table\":\"usuario\"},{\"db\":\"dimquality\",\"table\":\"admin\"},{\"db\":\"dimquality\",\"table\":\"productocarrito\"}]'),
('root', '[{\"db\":\"dimquality\",\"table\":\"producto\"},{\"db\":\"dimquality\",\"table\":\"usuario\"},{\"db\":\"dimquality\",\"table\":\"admin\"},{\"db\":\"dimquality\",\"table\":\"productocarrito\"}]'),
('root', '[{\"db\":\"dimquality\",\"table\":\"producto\"},{\"db\":\"dimquality\",\"table\":\"usuario\"},{\"db\":\"dimquality\",\"table\":\"admin\"},{\"db\":\"dimquality\",\"table\":\"productocarrito\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2017-06-06 02:01:55', '{\"collation_connection\":\"utf8mb4_unicode_ci\"}'),
('root', '2017-06-06 02:01:55', '{\"collation_connection\":\"utf8mb4_unicode_ci\"}'),
('root', '2017-06-06 02:01:55', '{\"collation_connection\":\"utf8mb4_unicode_ci\"}'),
('root', '2017-06-06 02:01:55', '{\"collation_connection\":\"utf8mb4_unicode_ci\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `imagen` varchar(60) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `costo` decimal(8,2) NOT NULL,
  `pvp` decimal(8,2) NOT NULL,
  `descripcion` text,
  `estado` int(11) NOT NULL,
  `stock` int(4) NOT NULL,
  `destacado` int(2) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `marca`, `categoria`, `codigo`, `imagen`, `modelo`, `costo`, `pvp`, `descripcion`, `estado`, `stock`, `destacado`, `fechaCreacion`) VALUES
(1, 'refrigeradora', 'lg', '', '000486', '/8dsd/dd', 'lgwsdw', '240.00', '248.20', NULL, 1, 5, 0, '2017-07-11'),
(2, 'MacBook', 'Mac', 'laptops&Notebooks', 'orem ipsum ', '', ' amet', '602.00', '650.00', 'Intel Core 2 Duo processor,1GB memory, larger hard drives, 1GB memory, larger hard drives', 0, 5, 1, '2017-07-11'),
(3, 'Licuadora', 'oster', 'components', 'dwd', 'dde', 'dede', '30.00', '45.00', '700-watt peak power\r\nMess-free spout\r\n3 cup chopping bowl', 1, 5, 1, '2017-07-11'),
(4, 'Batidora', 'oster', 'ddededede', 'de', '', 'oster', '78.00', '85.00', '4 qt. stainless steel bowl\r\n6 speeds & QuickBurst button\r\nBowl Rest™ mixer stabilizer\r\nDoubles as a hand mixer', 1, 8, 1, '2017-07-11'),
(7, 'dell latitude E5450', 'Dell', 'laptops', 'ddde', '', 'latitude', '740.00', '749.99', 'Intel Core i3-5010U Processor (3M Cache, 2.10 GHz), 4GB DDR3L 1600MHz', 1, 9, 1, '2017-06-01'),
(8, 'dwdw', 'dwdw', 'dwdw', '565', '50e40-tabla.jpg', 'dwdwdwdw', '56.00', '6565.00', 'dwdw', 1, 56, 1, '2017-07-11'),
(9, 'dede', 'q', 'q', '8', 'a0397-tabla.jpg', 'qw', '5.00', '5.00', 'wdw``', 1, 548, 1, NULL),
(10, 'qq', 'q', 'q', '4', '926b9-tabla.jpg', 'e', '8.00', '8.00', 'dwd', 1, 8, 0, '2017-07-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productocarrito`
--

CREATE TABLE `productocarrito` (
  `producto` int(11) NOT NULL,
  `cantidad` int(4) NOT NULL,
  `fecha_insert` datetime NOT NULL,
  `carrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productocarrito`
--

INSERT INTO `productocarrito` (`producto`, `cantidad`, `fecha_insert`, `carrito`) VALUES
(1, 1, '2017-07-19 08:21:25', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurarcontraseña`
--

CREATE TABLE `restaurarcontraseña` (
  `id` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `token` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico`
--

CREATE TABLE `tecnico` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tecnico`
--

INSERT INTO `tecnico` (`id`, `nombre`, `correo`) VALUES
(1, 'tecnico1', 't1@dq.com'),
(2, 'tecnico2', 't2@dq.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL,
  `fechaCompra` datetime NOT NULL,
  `fechaPago` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `estado` int(11) NOT NULL,
  `FormaPago` int(11) NOT NULL,
  `NombreFactura` char(100) NOT NULL,
  `CedulaFactura` char(10) NOT NULL,
  `DireccionFactura` char(100) NOT NULL,
  `EntregaDomicilio` tinyint(1) NOT NULL,
  `NombreEntrega` int(100) NOT NULL,
  `DireccionEntrega` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id`, `fechaCompra`, `fechaPago`, `fechaEntrega`, `usuario`, `total`, `estado`, `FormaPago`, `NombreFactura`, `CedulaFactura`, `DireccionFactura`, `EntregaDomicilio`, `NombreEntrega`, `DireccionEntrega`) VALUES
(500, '2017-06-19 00:00:00', '0000-00-00 00:00:00', NULL, 5, '248.20', 0, 0, '', '', '', 0, 0, 0),
(501, '2017-07-18 23:05:38', NULL, NULL, 2, '2297.70', 0, 0, 'nombress apellido', '0987654321', 'dasdasdasdas', 0, 0, 0),
(502, '2017-07-18 23:07:54', NULL, NULL, 2, '2297.70', 0, 0, 'nombress apellido', '0987654321', 'dasdasdasdas', 0, 0, 0),
(503, '2017-07-18 23:09:16', NULL, NULL, 2, '2297.70', 0, 0, 'nombress apellido', '0987654321', 'dasdasdasdas', 0, 0, 0),
(504, '2017-07-19 20:20:33', NULL, NULL, 1, '248.20', 0, 0, 'nombres apellidos', '0987654321', 'dasdasdasdas', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `user` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cedula` varchar(13) NOT NULL,
  `ciudad` varchar(60) DEFAULT NULL,
  `provincia` varchar(60) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `carrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `user`, `password`, `nombre`, `apellido`, `email`, `cedula`, `ciudad`, `provincia`, `direccion`, `telefono`, `carrito`) VALUES
(1, 'user', '912ec803b2ce49e4a541068d495ab570', 'nombres', 'apellidos', 'user@ejemplo.com', '0987654321', NULL, NULL, 'dasdasdasdas', '0998226076', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apikeys`
--
ALTER TABLE `apikeys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadoproducto`
--
ALTER TABLE `estadoproducto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estado` (`estado`);

--
-- Indices de la tabla `estadotransaccion`
--
ALTER TABLE `estadotransaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `itemtransaccion`
--
ALTER TABLE `itemtransaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `restaurarcontraseña`
--
ALTER TABLE `restaurarcontraseña`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apikeys`
--
ALTER TABLE `apikeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadoproducto`
--
ALTER TABLE `estadoproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estadotransaccion`
--
ALTER TABLE `estadotransaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `itemtransaccion`
--
ALTER TABLE `itemtransaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `restaurarcontraseña`
--
ALTER TABLE `restaurarcontraseña`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

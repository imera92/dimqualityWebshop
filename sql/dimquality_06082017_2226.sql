-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2017 a las 05:25:34
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

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
(3, 0, '0.00'),
(4, 0, '0.00'),
(5, 0, '0.00');

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
  `fecha` datetime NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id`, `usuario`, `tecnico`, `fecha`, `asunto`, `estado`) VALUES
(1, 'wjvelez', 1, '2017-07-20 10:00:00', 'qwerty', 0),
(2, 'wjvelez', 1, '2017-07-17 12:00:00', 'qwaszx', 0);

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
  `disponible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horariotecnico`
--

INSERT INTO `horariotecnico` (`id`, `tecnico`, `horaInicio`, `horaFin`, `disponible`) VALUES
(1, 1, '10:00:00', '11:00:00', 0),
(2, 1, '12:00:00', '13:00:00', 0),
(3, 2, '09:00:00', '10:00:00', 1),
(4, 2, '10:00:00', '11:00:00', 1);

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
(11, 1, 504, 1, '248.20'),
(12, 44, 505, 1, '873.91'),
(13, 44, 506, 1, '873.91');

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
-- Estructura de tabla para la tabla `ofertasubasta`
--

CREATE TABLE `ofertasubasta` (
  `id` int(11) NOT NULL,
  `subasta` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('root', '[{"db":"dimquality","table":"categoriaproducto"}]'),
('root', '[{"db":"dimquality","table":"categoriaproducto"}]'),
('root', '[{"db":"dimquality","table":"categoriaproducto"}]'),
('root', '[{"db":"dimquality","table":"categoriaproducto"}]');

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
('root', '[{"db":"dimquality","table":"producto"},{"db":"dimquality","table":"usuario"},{"db":"dimquality","table":"admin"},{"db":"dimquality","table":"productocarrito"}]'),
('root', '[{"db":"dimquality","table":"producto"},{"db":"dimquality","table":"usuario"},{"db":"dimquality","table":"admin"},{"db":"dimquality","table":"productocarrito"}]'),
('root', '[{"db":"dimquality","table":"producto"},{"db":"dimquality","table":"usuario"},{"db":"dimquality","table":"admin"},{"db":"dimquality","table":"productocarrito"}]'),
('root', '[{"db":"dimquality","table":"producto"},{"db":"dimquality","table":"usuario"},{"db":"dimquality","table":"admin"},{"db":"dimquality","table":"productocarrito"}]');

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
('root', '2017-06-06 02:01:55', '{"collation_connection":"utf8mb4_unicode_ci"}'),
('root', '2017-06-06 02:01:55', '{"collation_connection":"utf8mb4_unicode_ci"}'),
('root', '2017-06-06 02:01:55', '{"collation_connection":"utf8mb4_unicode_ci"}'),
('root', '2017-06-06 02:01:55', '{"collation_connection":"utf8mb4_unicode_ci"}');

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
(11, 'Lavadora Digital 16 Kg. Turbo Drum Blanca / Tapa d', 'LG', 'LAVADORAS', 'LG-WF-SL1632EK', 'default.png', '', '584.85', '623.84', '', 1, 0, NULL, NULL),
(12, 'Lavadora Digital 16 Kg. Turbo Drum Plata / Tapa de', 'LG', 'LAVADORAS', 'LG-WF-S1634EK', 'default.png', '', '660.47', '704.50', '', 1, 1, NULL, NULL),
(13, 'SECADORA DE ROPA A GAS DE 19Kg', 'LG', 'SECADORAS DE ROPA', 'LG-DLG1002W', 'default.png', '', '559.64', '596.95', '', 1, 0, NULL, NULL),
(14, 'SECADORA DE ROPA A GAS DE 21Kg - BLANCA - CONVERTI', 'LG', 'SECADORAS DE ROPA', 'LG-DT21WS', 'default.png', '', '567.20', '605.01', '', 1, 0, NULL, NULL),
(15, 'REFRIG. DE  13,5 PIES NF / DOS PUERTAS / SMART INV', 'LG', 'REFRIGERADORAS', 'LG-GT32WPP', 'default.png', '', '661.73', '705.85', '', 1, 1, NULL, NULL),
(16, 'REFRIG. DE  15 PIES NF / DOS PUERTAS / DIAGNOSTICO', 'LG', 'REFRIGERADORAS', 'LG-GT40WGP', 'default.png', '', '772.65', '824.16', '', 1, 1, NULL, NULL),
(17, 'Refrig S&S 23 pies Titanium Moving Ice Maker - LED', 'LG', 'REFRIGERADORAS', 'LG-GS65MPP1', 'default.png', '', '1.00', '1.00', '', 1, 0, NULL, NULL),
(18, 'Refrig S&S 23 pies Titanium con Disp. de agua y hi', 'LG', 'REFRIGERADORAS', 'LG-GS65SPP1', 'default.png', '', '1.00', '1.00', '', 1, 1, NULL, NULL),
(19, '0', 'LG', 'REFRIGERADORAS', 'AIRES ACONDICIONADOS ', 'default.png', '', '0.00', '0.00', '', 1, 0, NULL, NULL),
(20, 'A/C SPLIT 12.000 BTU BASICO', 'LG', 'REFRIGERADORAS', 'LG-SP122CE', 'default.png', '', '622.66', '664.17', '', 1, 1, NULL, NULL),
(21, 'A/C SPLIT 18.000 BTU ECONO INVERTER', 'LG', 'REFRIGERADORAS', 'LG-VM182CS', 'default.png', '', '988.19', '1.00', '', 1, 1, NULL, NULL),
(22, 'A/C SPLIT 12.000 BTU ECONO INVERTER', 'LG', 'REFRIGERADORAS', 'LG-VM122C6', 'default.png', '', '748.70', '798.62', '', 1, 1, NULL, NULL),
(23, 'A/C SPLIT 18.000 BTU ECONO INVERTER', 'LG', 'REFRIGERADORAS', 'LG-VM182C6', 'default.png', '', '962.98', '1.00', '', 1, 1, NULL, NULL),
(24, 'A/C SPLIT 24.000 BTU ECONO INVERTER', 'LG', 'REFRIGERADORAS', 'LG-VM242C6', 'default.png', '', '1.00', '1.00', '', 1, 1, NULL, NULL),
(25, 'TUBERIA PARA DE AC VR122CL', 'LG', 'REFRIGERADORAS', 'LG-SQ060905D01', 'default.png', '', '63.02', '67.22', '', 1, 1, NULL, NULL),
(26, 'MICRO. 1,1pies PANTALLA LED / TOUCH / SILVER MENU ', 'LG', 'MICROONDAS', 'LG-MS1140S', 'default.png', '', '181.50', '193.60', '', 1, 0, NULL, NULL),
(27, 'MICRO. 1,1pies PANTALLA LED / TOUCH / BLANCO MENU ', 'LG', 'MICROONDAS', 'LG-MS1142GWA', 'default.png', '', '165.12', '176.13', '', 1, 0, NULL, NULL),
(28, 'EQ. SONIDO 3.000 / DUAL USB / ECUALIZADOR LATINO /', 'LG', 'AUDIO', 'LG-CM4350', 'default.png', '', '257.13', '274.27', '', 1, 0, NULL, NULL),
(29, 'EQ. SONIDO 5.000 / DUAL USB / ECUALIZADOR LATINO /', 'LG', 'AUDIO', 'LG-CM4450', 'default.png', '', '269.73', '287.72', '', 1, 0, NULL, NULL),
(30, 'EQ. SONIDO 5.000 / AUTO DJ / DUAL USB / ECUALIZADO', 'LG', 'AUDIO', 'LG-CM4460', 'default.png', '', '282.34', '301.16', '', 1, 1, NULL, NULL),
(31, 'EQ. SONIDO 8.000 / DUAL USB / ECUALIZADOR LATINO /', 'LG', 'AUDIO', 'LG-CM4550', 'default.png', '', '321.41', '342.84', '', 1, 0, NULL, NULL),
(32, 'EQ. SONIDO 8.000 / DUAL USB / ECUALIZADOR LATINO /', 'LG', 'AUDIO', 'LG-CM4560', 'default.png', '', '326.45', '348.22', '', 1, 0, NULL, NULL),
(33, 'EQ. SONIDO 11.000 / X BOOM  BLUETOOTH/ DUAL USB / ', 'LG', 'AUDIO', 'LG-CM4750', 'default.png', '', '414.69', '442.33', '', 1, 0, NULL, NULL),
(34, 'EQ. SONIDO 12.000 / DUAL USB / ECUALIZADOR LATINO ', 'LG', 'AUDIO', 'LG-CM5760', 'default.png', '', '439.89', '469.22', '', 1, 1, NULL, NULL),
(35, 'PARLANTE AMPLIFICADO 3.500W / BLUETOOTH / DOBLE US', 'LG', 'AUDIO', 'LG-OM5540', 'default.png', '', '414.69', '442.33', '', 1, 1, NULL, NULL),
(36, 'PARLANTE AMPLIFICADO 4.800W / BLUETOOTH + NFC / DO', 'LG', 'AUDIO', 'LG-OM5541', 'default.png', '', '485.27', '517.62', '', 1, 1, NULL, NULL),
(37, '0', 'LG', 'AUDIO', 'TELEVISORES ', 'default.png', '', '0.00', '0.00', '', 1, 0, NULL, NULL),
(38, 'DVD / USB / MP3', 'LG', 'AUDIO', 'LG-DP132', 'default.png', '', '52.94', '56.47', '', 1, 1, NULL, NULL),
(39, 'DVD / GRABA A USB / ESCANEO PROGRESIVO /  DivX / K', 'LG', 'AUDIO', 'LG-DP547', 'default.png', '', '57.98', '61.85', '', 1, 1, NULL, NULL),
(40, 'GAFAS 3D', 'LG', 'AUDIO', 'LG-AG-F316', 'default.png', '', '5.04', '5.38', '', 1, 1, NULL, NULL),
(41, 'CONTRO REMOTO PARA PANTALLAS SMART SERIE LA', 'LG', 'AUDIO', 'LG-ANMR400', 'default.png', '', '23.95', '25.54', '', 1, 0, NULL, NULL),
(42, 'CONTRO REMOTO PARA PANTALLAS SMART - CONTROL DE VO', 'LG', 'AUDIO', 'LG-ANMR600', 'default.png', '', '36.55', '38.99', '', 1, 1, NULL, NULL),
(43, 'TELEVISOR LED 32"  HD SMART TV / 2 HDMI / USB', 'LG', 'AUDIO', 'LG-32LH600B', 'default.png', '', '513.00', '547.20', '', 1, 1, NULL, NULL),
(44, 'TELEVISOR LED 42" SMART TV / FULL HD / MODO FUTBOL', 'LG', 'AUDIO', 'LG-42LB5800', 'default.png', '', '819.29', '873.91', '', 1, 1, NULL, NULL),
(45, 'TELEVISOR LED 42" SMART SHARE / MAGIC REMOTE / PAN', 'LG', 'AUDIO', 'LG-42LF5850', 'default.png', '', '819.29', '873.91', '', 1, 0, NULL, NULL),
(46, 'TELEVISOR LED 43" SMART TV / FULL HD', 'LG', 'AUDIO', 'LG-43LH6000', 'default.png', '', '831.89', '887.35', '', 1, 1, NULL, NULL),
(47, 'TELEVISOR LED DE 47" FULL HD / 3 HDMI / SENSOR INT', 'LG', 'AUDIO', 'LG-47LS4600', 'default.png', '', '983.15', '1.00', '', 1, 0, NULL, NULL),
(48, 'TELEVISOR LED 47" SMART TV / FULL HD / MODO FUTBOL', 'LG', 'AUDIO', 'LG-47LB5800', 'default.png', '', '1.00', '1.00', '', 1, 1, NULL, NULL),
(49, 'TELEVISOR LED 49" SMART TV / FULL HD - LOCAL', 'LG', 'AUDIO', 'LG-49LH6000', 'default.png', '', '1.00', '1.00', '', 1, 0, NULL, NULL),
(50, 'TELEVISOR LED 49" 4K SMART TV / ULTRA HD / TRIPLE ', 'LG', 'AUDIO', 'LG-49UB7000', 'default.png', '', '1.00', '1.00', '', 1, 1, NULL, NULL),
(51, 'TELEVISOR LED 55" SMART TV / FULL HD - LOCAL', 'LG', 'AUDIO', 'LG-55LH6000', 'default.png', '', '1.00', '1.00', '', 1, 0, NULL, NULL),
(52, 'TABLET  7" BLANCA - WIFI - PANTALLA FULL HD - MEM.', 'LG', 'TABLETS', 'LG-LGV400.AMIAWN', 'default.png', '', '248.31', '264.86', '', 1, 0, NULL, NULL),
(53, 'TABLET  8,3" NEGRO  - WIFI - Procesador Quad Core ', 'LG', 'TABLETS', 'LG-LGV480.AMIABK', 'default.png', '', '274.78', '293.09', '', 1, 1, NULL, NULL),
(54, 'TABLET  8" BLANCA - WIFI-LTE 4G - Procesador Quad ', 'LG', 'TABLETS', 'LG-LGV490W', 'default.png', '', '436.11', '465.19', '', 1, 0, NULL, NULL),
(55, 'TABLET  8" NEGRA - WIFI -LTE 4G Procesador Quad Co', 'LG', 'TABLETS', 'LG-LGV490B', 'default.png', '', '436.11', '465.19', '', 1, 1, NULL, NULL),
(56, 'TABLET  10" NEGRO - WIFI - PANTALLA FULL HD - MEM.', 'LG', 'TABLETS', 'LG-LGV700.AMIABK', 'default.png', '', '397.04', '423.51', '', 1, 1, NULL, NULL),
(57, 'TABLET  10" BLANCA - WIFI - PANTALLA FULL HD - MEM', 'LG', 'TABLETS', 'LG-LGV700.AMIAWH', 'default.png', '', '397.04', '423.51', '', 1, 1, NULL, NULL);

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
-- Estructura de tabla para la tabla `subasta`
--

CREATE TABLE `subasta` (
  `id` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `producto` int(11) NOT NULL,
  `precioBase` decimal(8,2) NOT NULL,
  `estado` int(1) NOT NULL
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
(504, '2017-07-19 20:20:33', NULL, NULL, 1, '248.20', 0, 0, 'nombres apellidos', '0987654321', 'dasdasdasdas', 0, 0, 0),
(505, '2017-08-02 16:09:58', NULL, NULL, 1, '873.91', 0, 0, 'nombres apellidos', '0987654321', 'dasdasdasdas', 0, 0, 0),
(506, '2017-08-02 16:30:12', NULL, NULL, 1, '873.91', 0, 0, 'MONICA 888', 'AAAAAAAAAA', 'PROSPERINA KM 30.5', 0, 0, 0);

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
(1, 'user', 'e10adc3949ba59abbe56e057f20f883e', 'nombres', 'apellidos', 'user@ejemplo.com', '0987654321', NULL, NULL, 'dasdasdasdas', '0998226076', 3);

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `ofertasubasta`
--
ALTER TABLE `ofertasubasta`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `subasta`
--
ALTER TABLE `subasta`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `categoriaproducto`
--
ALTER TABLE `categoriaproducto`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ofertasubasta`
--
ALTER TABLE `ofertasubasta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT de la tabla `restaurarcontraseña`
--
ALTER TABLE `restaurarcontraseña`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `subasta`
--
ALTER TABLE `subasta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

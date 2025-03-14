--
-- Base de datos: `tiendaFito`
--
CREATE DATABASE IF NOT EXISTS `tiendaFito` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `tiendaFito`;

-- --------------------------------------------------------


-- Tabla categoría

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(30) COLLATE utf8_bin NOT NULL,
  `descripcion_categoria` text COLLATE utf8_bin DEFAULT NULL -- Cambio por VARCHAR¿?
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `nombre_producto` varchar(60) COLLATE utf8_bin NOT NULL,
  `descripcion_producto` text COLLATE utf8_bin NOT NULL,
  `precio_producto` float NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_proveedor` int(10) UNSIGNED NOT NULL,
  `imagen_producto` LONGBLOB
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nombre_cliente` varchar(60) COLLATE utf8_bin NOT NULL,
  `direccion_cliente` varchar(60) COLLATE utf8_bin NOT NULL,
  `telefono_cliente` varchar(15) COLLATE utf8_bin NOT NULL,
  `correo_cliente` varchar(40) COLLATE utf8_bin NOT NULL,
  `dni_cliente` varchar(14) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `cantidad_pedido` int(5) UNSIGNED NOT NULL,
  `fecha_pedido` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `id_proveedor` int(10) UNSIGNED NOT NULL,
  `nombre_proveedor` varchar(60) COLLATE utf8_bin NOT NULL,
  `direccion_proveedor` varchar(60) COLLATE utf8_bin NOT NULL,
  `telefono_proveedor` varchar(15) COLLATE utf8_bin NOT NULL,
  `correo_proveedor` varchar(40) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Estructura de la tabla `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8_bin NOT NULL,
  `email_usuario` varchar(255) COLLATE utf8_bin NOT NULL,
  `password_usuario` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_rol` int(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Estructura de la tabla `rol`
--
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id_rol` int(10) UNSIGNED NOT NULL,
  `nombre_rol` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;


--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  MODIFY `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT; 

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  MODIFY `id_pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  MODIFY `id_proveedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  MODIFY `id_rol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Inserciones de datos para las tablas existentes

-- Datos para la tabla `categoria`
INSERT INTO `categoria` (`nombre_categoria`, `descripcion_categoria`) VALUES
('Fertilizantes', 'Productos para enriquecer el suelo'),
('Semillas', 'Material de siembra de alta calidad'),
('Pesticidas', 'Productos para el control de plagas'),
('Herbicidas', 'Productos para controlar malezas'),
('Fungicidas', 'Productos para controlar hongos');

-- Datos para la tabla `proveedor`
INSERT INTO `proveedor` (`nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor`, `correo_proveedor`) VALUES
('AgroFito S.A.', 'Calle Campo 123', '123456789', 'info@agrofito.com'),
('Semillas Premium', 'Avenida Siembra 456', '987654321', 'contacto@semillaspremium.com'),
('Control Plagas S.L.', 'Boulevard Verde 789', '555666777', 'ventas@controlplagas.com'),
('Herbicidas Plus', 'Calle Hierba 321', '222333444', 'info@herbicidasplus.com'),
('Fungicidas Max', 'Avenida Hongos 654', '999888777', 'contacto@fungicidasmax.com');

-- Datos para la tabla `producto`
INSERT INTO `producto` (`nombre_producto`, `descripcion_producto`, `precio_producto`, `id_categoria`, `id_proveedor`) VALUES
('Fertilizante Orgánico', 'Mejora la fertilidad del suelo', 15.50, 1, 1),
('Semillas de Trigo', 'Semillas de alta calidad para trigo', 25.00, 2, 2),
('Insecticida Natural', 'Controla plagas de manera natural', 30.75, 3, 3),
('Fertilizante Químico', 'Aporta nutrientes esenciales', 20.00, 1, 1),
('Semillas de Maíz', 'Semillas mejoradas para maíz', 18.00, 2, 2),
('Herbicida Total', 'Elimina todas las malezas', 22.00, 4, 4),
('Fungicida Potente', 'Protege contra hongos', 28.50, 5, 5),
('Fertilizante Líquido', 'Fácil aplicación', 19.75, 1, 1),
('Semillas de Girasol', 'Resistentes y productivas', 27.00, 2, 2),
('Pesticida Orgánico', 'Sin químicos dañinos', 32.00, 3, 3);

-- Datos para la tabla `cliente`
INSERT INTO `cliente` (`nombre_cliente`, `direccion_cliente`, `telefono_cliente`, `correo_cliente`, `dni_cliente`) VALUES
('Juan Pérez', 'Calle Sol 123', '111222333', 'juan.perez@email.com', 'A12345678'),
('María López', 'Avenida Luna 456', '444555666', 'maria.lopez@email.com', 'B98765432'),
('Carlos García', 'Paseo Estrella 789', '777888999', 'carlos.garcia@email.com', 'C11223344'),
('Ana Martínez', 'Calle Río 101', '999000111', 'ana.martinez@email.com', 'D22334455'),
('Luis Fernández', 'Avenida Mar 202', '888777666', 'luis.fernandez@email.com', 'E33445566');

-- Datos para la tabla `pedido`
-- Modificarlo con id_producto multicampo y cantidad_pedido suma total de la cantidad de productos o de cada uno que sea igual se suma para luego sumarlos todos
INSERT INTO `pedido` (`id_producto`, `id_cliente`, `cantidad_pedido`, `fecha_pedido`) VALUES
(1, 1, 10, '2025-01-16 12:30:00'),
(2, 2, 15, '2025-01-16 12:35:00'),
(3, 3, 5, '2025-01-16 12:40:00'),
(4, 4, 7, '2025-01-16 12:45:00'),
(5, 5, 12, '2025-01-16 12:50:00'),
(6, 1, 8, '2025-01-16 12:55:00'),
(7, 2, 6, '2025-01-16 13:00:00'),
(8, 3, 9, '2025-01-16 13:05:00'),
(9, 4, 14, '2025-01-16 13:10:00'),
(10, 5, 3, '2025-01-16 13:15:00');

-- Datos para la tabla `usuario`
INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `email_usuario`, `password_usuario`, `id_rol`) VALUES
(1, 'JesusL', 'jesus03@gmail.com', 'betis123', 1),
(2, 'Mireya', 'mireya04@gmail.com', 'campillo123', 2);

--  Datos para la tabla `rol` 
INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Admin'),
(2, 'Cliente');

COMMIT;
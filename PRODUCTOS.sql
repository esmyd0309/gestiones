-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gestion
CREATE DATABASE IF NOT EXISTS `gestion` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gestion`;

-- Volcando estructura para tabla gestion.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) unsigned NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio` float(18,2) DEFAULT NULL,
  `cantidad` varchar(10) DEFAULT NULL,
  `etiqueta` varchar(150) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_categorias` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla gestion.productos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `cantidad`, `etiqueta`, `imagen`) VALUES
	(1, 1, 'Parrillada', NULL, 18.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC8zMGJiYzZhNi01NmQxLTRmNTItYTY2Ni0wN2ExMWEzNDhmZjUuanBlZw=='),
	(2, 1, 'PORCION ARROZ CON MENESTRA FREJOL\r\n', NULL, 3.50, NULL, NULL, 'aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC82MTYwMmY0My0wMzNiLTRjYzctYjkwYy1hZDE4Yjg5NDI1ZDcucG5n'),
	(3, 1, 'CHAUFI BRASA PERSONAL', NULL, 4.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC8yMzAzOTZiOS1jNjQ1LTQwNjMtYTYwYi04YTFiNzVkZTIwOWIuanBlZw=='),
	(4, 1, 'PRESA DE POLLO CON ARROZ Y PAPAS', NULL, 4.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9hMjUyMjVjZC1hOTY5LTQ2NWEtYmZhNi1jYWRiMjFjMzhmMzUuanBlZw=='),
	(5, 1, 'Chuzo cuencano', NULL, 5.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC81MWI2ODIzYS1hZGJhLTQ0NDUtYWE4YS03M2M5MzMzYmI1NDUuanBlZw=='),
	(6, 1, 'Carne asada', NULL, 6.00, NULL, NULL, 'aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9iNzgxYTA0My0yMDFjLTQxZGUtOWU4MS1kMzNjODAxNWQ0MTEuanBlZw'),
	(7, 1, 'Chuleta asada', NULL, 6.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9iODc5NzM4Yi1kZmRiLTQ3MTYtODI0Ny02MTc3ZjNmODc3YjUuanBlZw=='),
	(8, 1, 'Filete de pollo', NULL, 7.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC82ZThkYTYzNS1iZTBiLTQxYTEtODcwMi05ZTc5MTRiMWE2YTIuanBlZw=='),
	(9, 1, 'Costillas BBQ', NULL, 7.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC83ODYzZTgxZS1iMjQxLTQwZTctYWM0Ny1iODAxNDZlMWVkZGEuanBlZw=='),
	(10, 2, 'Fiora-Vanti', NULL, 0.80, NULL, NULL, ''),
	(11, 2, 'Inca kola', NULL, 0.80, NULL, NULL, ''),
	(12, 2, 'Agua', NULL, 1.00, NULL, NULL, ''),
	(13, 2, 'Coca-Cola 300mm', NULL, 1.00, NULL, NULL, ''),
	(14, 2, 'Fuze Tea personal', NULL, 1.00, NULL, NULL, ''),
	(15, 2, 'Fanta Naranja', NULL, 1.25, NULL, NULL, ''),
	(16, 2, 'Sprite\r\n', NULL, 1.25, NULL, NULL, ''),
	(17, 2, 'Jugo natural vaso', NULL, 1.50, NULL, NULL, ''),
	(18, 2, 'Naranja', NULL, 1.50, NULL, NULL, ''),
	(19, 2, 'Cola 1 litro', NULL, 2.00, NULL, NULL, ''),
	(20, 2, 'Fuze Tea 1.5 litros\r\n', NULL, 2.00, NULL, NULL, ''),
	(21, 3, 'Porción de chifles', NULL, 1.50, NULL, NULL, ''),
	(22, 3, 'Combo 12 Alitas + Papas + Gaseosa', NULL, 14.99, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9hNWE0NzNlMC1mZWUxLTQwNDYtYTBiNy03MzJmOWM5YzY4ZWMuanBlZw=='),
	(23, 3, 'Porción de arroz', NULL, 2.00, NULL, NULL, ''),
	(24, 3, 'Porción de papas fritas', NULL, 2.50, NULL, NULL, ''),
	(25, 3, 'Porción de papas chauchas', NULL, 2.50, NULL, NULL, ''),
	(26, 3, 'Chuzo solo', NULL, 2.50, NULL, NULL, ''),
	(27, 3, 'Porción de moro de lentejas', NULL, 3.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC85NzljNWU3NC02NzAwLTQwNzMtYmE0YS1lNWU4MWIzMTc1ZDMuanBlZw=='),
	(28, 3, 'Porción Moro Cubano', NULL, 3.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC8zYzNiZjM1YS0xMmU4LTQ0MjktOTI3Zi1kNWUxNTkxYjYyZTYuanBlZw=='),
	(29, 3, 'Arroz con menestra porción', NULL, 3.00, NULL, NULL, ''),
	(30, 3, 'PORCION ARROZ CON MENESTRA FREJOL', NULL, 3.50, NULL, NULL, 'aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC82MTYwMmY0My0wMzNiLTRjYzctYjkwYy1hZDE4Yjg5NDI1ZDcucG5n'),
	(31, 3, 'CHAUFI BRASA PERSONAL', NULL, 4.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC8yMzAzOTZiOS1jNjQ1LTQwNjMtYTYwYi04YTFiNzVkZTIwOWIuanBlZw=='),
	(32, 3, 'NUEVO! Lomito Saltado Peruano', NULL, 5.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC84YTU2OGMwMy02YWU2LTQxZDYtYmRlMy0zYmEyNzI4NDAxOWYuanBlZw=='),
	(33, 4, 'POLLO ENTERO A LA BRASA CON PAPAS', NULL, 15.00, NULL, NULL, 'https://d1ralsognjng37.cloudfront.net/b921aeb1-2f87-4810-8436-29c12a689747.jpeg'),
	(34, 4, 'PRESA DE POLLO CON PAPAS FRITAS\r\n', NULL, 3.00, NULL, NULL, 'aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC8xNTM3YzQwZC05ZGNmLTRhYmQtYmViMC01NGQyZDIxMzU1MWUucG5n'),
	(35, 4, 'PORCION ARROZ CON MENESTRA FREJOL', NULL, 3.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC82MTYwMmY0My0wMzNiLTRjYzctYjkwYy1hZDE4Yjg5NDI1ZDcucG5n'),
	(36, 4, 'CHAUFI BRASA PERSONAL', NULL, 4.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC8yMzAzOTZiOS1jNjQ1LTQwNjMtYTYwYi04YTFiNzVkZTIwOWIuanBlZw=='),
	(37, 4, 'PRESA DE POLLO CON ARROZ Y PAPAS', NULL, 4.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9hMjUyMjVjZC1hOTY5LTQ2NWEtYmZhNi1jYWRiMjFjMzhmMzUuanBlZw=='),
	(38, 4, 'NUEVO! Seco de pollo', NULL, 4.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9mYzE5NjcwZi1jN2ZhLTRiNDctYmZhNS02MjQ0NTIzMTUzNWQuanBlZw=='),
	(39, 4, '1/4 POLLO BRASA PIERNA', NULL, 5.00, NULL, NULL, 'https://d1ralsognjng37.cloudfront.net/890c7e1c-77b8-48c5-9f14-9e39ab63696b.png'),
	(40, 4, 'NUEVO! Presitas de Pollo Honey Murstard + Chaufa + papas fritas\r\n', NULL, 5.50, NULL, NULL, 'aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9hM2ViNzYxMi1hM2M2LTRiZmItOGUzMi1lMTQzNmUxYmZmOGUuanBlZw'),
	(41, 4, 'NUEVO! Lomito Saltado Peruano', NULL, 5.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC84YTU2OGMwMy02YWU2LTQxZDYtYmRlMy0zYmEyNzI4NDAxOWYuanBlZw=='),
	(42, 4, '1/4 POLLO BRASA PECHUGA', NULL, 6.00, NULL, NULL, 'https://d1ralsognjng37.cloudfront.net/ab862af8-474e-4bc3-afc4-7634e424b32a.jpeg'),
	(43, 4, '1/4 CHAUFI BRASA PIERNA', NULL, 6.50, NULL, NULL, 'https://d1ralsognjng37.cloudfront.net/efa3a3b8-6e46-4179-92c4-ed1da398ceb6.jpeg'),
	(44, 4, '1/2 POLLO A LA BRASA CON PAPAS', NULL, 8.00, NULL, NULL, 'https://d1ralsognjng37.cloudfront.net/8b7560d4-9a8d-4704-87f8-c5fce41b9775.png'),
	(45, 5, 'Presa de pollo + papas', NULL, 2.50, NULL, NULL, ''),
	(46, 5, 'Carne asada porción', NULL, 4.00, NULL, NULL, ''),
	(47, 5, 'Chuzo cuencano porción', NULL, 4.00, NULL, NULL, ''),
	(48, 5, 'Filete de pollo porción', NULL, 4.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64==='),
	(49, 5, 'Chuleta asada porción', NULL, 4.50, NULL, NULL, ''),
	(50, 5, 'Filete de pollo porción', NULL, 4.50, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9iNDZlNWFkNS0zNGY5LTRkMWUtODBmZS1kNWJlYjEzNjQyMmMuanBlZw=='),
	(51, 5, 'Costillas bbq porción', NULL, 5.00, NULL, NULL, ''),
	(52, 6, '1/2 POLLO + CHAUFA\r\n', NULL, 11.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC8xNDdkZjA4ZS02OWRjLTQyMTMtYjhiMy0xNTViMjRmZDFhYjkuanBlZw=='),
	(53, 6, 'Costilla BBQ / 1 libra', NULL, 15.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC9lNGQ5ZDU5Yy0wMTkwLTQ5NzItOTBkMi1mMjYzM2U1MWY2NDQuanBlZw=='),
	(54, 6, 'POLLO ENTERO CON CHAUFA FAMILIAR + GASEOSA', NULL, 20.00, NULL, NULL, 'https://cn-geo1.uber.com/image-proc/resize/eats/format=webp/width=550/height=440/quality=70/srcb64=aHR0cHM6Ly9kMXJhbHNvZ25qbmczNy5jbG91ZGZyb250Lm5ldC84MzEzMzY5Ny0xMjcxLTQyNTgtYTI3OS0zZWZlZWYwZGM1YWQuanBlZw==');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

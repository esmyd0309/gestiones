-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para gestion
CREATE DATABASE IF NOT EXISTS `gestion` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gestion`;

-- Volcando estructura para tabla gestion.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cargos_nombre_cargo_unique` (`nombre_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.cargos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` (`id`, `nombre_cargo`, `created_at`, `updated_at`) VALUES
	(1, 'supervisor', '2019-08-14 16:32:52', '2019-08-14 16:32:52'),
	(2, 'PROGRAMADOR', '2019-08-23 14:43:04', '2019-08-23 14:43:04'),
	(3, 'ASESOR COMERCIAL', '2019-08-24 11:18:07', '2019-08-24 11:18:07'),
	(4, 'AGENTE', '2019-08-24 11:18:14', '2019-08-24 11:18:14'),
	(5, 'DIGITADOR', '2019-08-24 11:18:21', '2019-08-24 11:18:21'),
	(6, 'CONTADOR', '2019-08-24 11:18:32', '2019-08-24 11:18:32');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `users_id` varchar(50) DEFAULT NULL,
  `comentario` varchar(600) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla gestion.comentarios: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` (`id`, `titulo`, `users_id`, `comentario`, `created_at`, `updated_at`) VALUES
	(6, 'pruebas de comentarios  titulo', 'unuevo', 'pruebas de comentarios  pruebas de comentarios pruebas de comentarios', '2021-02-27 12:34:53', '2021-02-27 12:34:53'),
	(7, 'pruebas de comentarios  titulo', 'aadministrador', 'jfrdfggh gtufcg fvg fryfrtfvffcb ncfy', '2021-02-27 12:52:23', '2021-02-27 12:52:23'),
	(8, 'nuevo comentario de prueba', 'gosorio', 'pruebas de comentarios para la gestion', '2021-02-27 13:31:45', '2021-02-27 13:31:45'),
	(9, 'pruebas de comentario usuario normal', 'unuevo', 'pruebas de comentarios y su gestion', '2021-02-27 13:34:28', '2021-02-27 13:34:28');
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.departamentos
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_departamento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_departamento` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departamentos_nombre_departamento_unique` (`nombre_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.departamentos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` (`id`, `nombre_departamento`, `descripcion_departamento`, `created_at`, `updated_at`) VALUES
	(1, 'Ventas', NULL, '2019-08-14 16:32:32', '2019-08-14 16:32:32'),
	(2, 'COBRANZA', NULL, '2019-08-23 14:42:47', '2019-08-23 14:42:47'),
	(3, 'OPERACIONES', NULL, '2019-08-24 11:17:25', '2019-08-24 11:17:25'),
	(4, 'SISTEMAS', NULL, '2019-08-24 11:17:40', '2019-08-24 11:17:40'),
	(5, 'ADMINISTRATIVO', NULL, '2019-08-24 11:17:49', '2019-08-24 11:17:49');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.departamento_empresas
CREATE TABLE IF NOT EXISTS `departamento_empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(10) unsigned NOT NULL,
  `departamento_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departamento_empresas_empresa_id_foreign` (`empresa_id`),
  KEY `departamento_empresas_departamento_id_foreign` (`departamento_id`),
  CONSTRAINT `departamento_empresas_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `departamento_empresas_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.departamento_empresas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `departamento_empresas` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamento_empresas` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.generos
CREATE TABLE IF NOT EXISTS `generos` (
  `id` int(10) unsigned NOT NULL,
  `nombre_genero` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abreviatura` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.generos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` (`id`, `nombre_genero`, `abreviatura`) VALUES
	(1, 'Masculino', 'M'),
	(2, 'Femenino', 'F');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.permissions: ~44 rows (aproximadamente)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Mostrar usuarios', 'users.index', NULL, '2019-08-13 01:06:25', '2019-08-13 01:06:25'),
	(2, 'Crear un usuario', 'users.create', NULL, '2019-08-13 01:06:39', '2019-08-13 01:06:39'),
	(3, 'Mostrar empresas', 'empresas.index', NULL, '2019-08-13 01:08:53', '2019-08-13 01:08:53'),
	(4, 'Crear empresas', 'empresas.create', NULL, '2019-08-13 01:09:12', '2019-08-13 01:09:12'),
	(5, 'Editar usuario', 'users.edit', NULL, '2019-08-13 23:50:33', '2019-08-13 23:50:33'),
	(6, 'Guardar usuario', 'users.store', NULL, '2019-08-13 23:50:44', '2019-08-13 23:50:44'),
	(7, 'Ver usuario', 'users.show', NULL, '2019-08-13 23:51:07', '2019-08-13 23:51:07'),
	(8, 'Actualizar usuario', 'users.update', NULL, '2019-08-13 23:51:29', '2019-08-13 23:51:29'),
	(9, 'Eliminar usuario', 'users.destroy', NULL, '2019-08-13 23:51:39', '2019-08-13 23:51:39'),
	(10, 'Mostrar roles', 'roles.index', NULL, '2019-08-13 23:51:55', '2019-08-13 23:51:55'),
	(11, 'Crear roles', 'roles.create', NULL, '2019-08-13 23:52:02', '2019-08-13 23:52:02'),
	(12, 'Guardar roles', 'roles.store', NULL, '2019-08-13 23:52:13', '2019-08-13 23:52:13'),
	(13, 'Ver rol', 'roles.show', NULL, '2019-08-13 23:52:22', '2019-08-13 23:52:22'),
	(14, 'Editar rol', 'roles.edit', NULL, '2019-08-13 23:52:31', '2019-08-13 23:52:31'),
	(15, 'Actualizar rol', 'roles.update', NULL, '2019-08-13 23:52:46', '2019-08-13 23:52:46'),
	(16, 'Eliminar rol', 'roles.destroy', NULL, '2019-08-13 23:52:59', '2019-08-13 23:52:59'),
	(17, 'Mostrar todos los permisos', 'permissions.index', NULL, '2019-08-13 23:53:14', '2019-08-13 23:53:14'),
	(18, 'Crear nuevo permiso', 'permissions.create', NULL, '2019-08-13 23:53:26', '2019-08-13 23:53:26'),
	(19, 'Ver un permiso', 'permissions.show', NULL, '2019-08-13 23:54:01', '2019-08-13 23:54:01'),
	(20, 'Guardar un permiso', 'permissions.store', NULL, '2019-08-13 23:54:23', '2019-08-13 23:54:23'),
	(21, 'Editar un permiso', 'permissions.edit', NULL, '2019-08-13 23:54:36', '2019-08-13 23:54:36'),
	(22, 'Actualizar permiso', 'permissions.update', NULL, '2019-08-13 23:54:50', '2019-08-13 23:54:50'),
	(23, 'Eliminar permiso', 'permissions.destroy', NULL, '2019-08-13 23:55:04', '2019-08-13 23:55:04'),
	(45, 'Eliminar comentarios', 'comentarios.destroy', NULL, NULL, NULL),
	(46, 'Ver comentarios', 'comentarios.show', NULL, NULL, NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.permission_role: ~53 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(15, 2, 7, '2019-09-19 18:24:37', '2019-09-19 18:24:37'),
	(16, 3, 7, '2019-09-19 18:24:37', '2019-09-19 18:24:37'),
	(17, 4, 7, '2019-09-19 18:24:37', '2019-09-19 18:24:37'),
	(18, 5, 7, '2019-09-19 18:24:37', '2019-09-19 18:24:37'),
	(19, 6, 7, '2019-09-19 18:24:37', '2019-09-19 18:24:37'),
	(20, 7, 7, '2019-09-19 18:24:37', '2019-09-19 18:24:37'),
	(21, 8, 7, '2019-09-19 18:24:37', '2019-09-19 18:24:37'),
	(22, 1, 7, '2019-09-19 18:26:06', '2019-09-19 18:26:06'),
	(45, 1, 13, '2020-03-05 16:14:37', '2020-03-05 16:14:37'),
	(46, 7, 13, '2020-03-05 16:14:37', '2020-03-05 16:14:37');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.permission_user
CREATE TABLE IF NOT EXISTS `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.permission_user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.roles: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `special`) VALUES
	(1, 'Admin', 'admin.admin', 'Usuario administrador', NULL, '2019-08-13 01:07:19', 'all-access'),
	(7, 'usuarios', 'users.index', NULL, '2019-09-19 18:24:37', '2019-09-19 18:24:37', NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.role_user: ~257 rows (aproximadamente)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, NULL),
	(14, 2, 3165, '2019-08-26 03:31:18', '2019-08-26 03:31:18'),
	(15, 1, 3328, '2019-08-26 17:29:29', '2019-08-26 17:29:29'),
	(17, 3, 3335, '2019-08-28 02:41:17', '2019-08-28 02:41:17'),
	(19, 3, 3338, '2019-08-28 16:58:50', '2019-08-28 16:58:50'),
	(22, 4, 3340, '2019-08-31 01:07:57', '2019-08-31 01:07:57'),
	(23, 4, 3339, '2019-08-31 01:08:18', '2019-08-31 01:08:18'),
	(26, 3, 3342, '2019-09-02 19:31:12', '2019-09-02 19:31:12'),
	(27, 4, 3343, '2019-09-06 18:28:07', '2019-09-06 18:28:07'),
	(30, 2, 927, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(31, 2, 944, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(32, 2, 1047, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(33, 2, 1362, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(34, 2, 2912, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(35, 2, 2949, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(36, 2, 2952, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(37, 2, 3009, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(38, 2, 3012, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(39, 2, 3020, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(40, 2, 3026, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(41, 2, 3027, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(42, 2, 3067, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(43, 2, 3068, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(44, 2, 3071, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(45, 2, 3072, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(46, 2, 3073, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(47, 2, 3086, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(48, 2, 3089, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(49, 2, 3096, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(50, 2, 3112, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(51, 2, 3123, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(52, 2, 3134, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(53, 2, 3152, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(54, 2, 3159, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(55, 2, 3165, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(57, 2, 3178, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(58, 2, 3180, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(59, 2, 3183, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(60, 2, 3192, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(61, 2, 3203, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(62, 2, 3228, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(63, 2, 3289, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(64, 2, 3296, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(65, 2, 3319, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(66, 2, 3320, '2019-09-17 22:29:29', '2019-09-17 22:29:29'),
	(93, 7, 3331, '2019-09-19 18:24:51', '2019-09-19 18:24:51'),
	(94, 6, 1281, '2019-09-23 20:21:23', '2019-09-23 20:21:23'),
	(97, 6, 1051, '2019-10-01 03:31:20', '2019-10-01 03:31:20'),
	(99, 6, 1070, '2019-10-01 03:31:22', '2019-10-01 03:31:22'),
	(100, 6, 1105, '2019-10-01 03:31:23', '2019-10-01 03:31:23'),
	(102, 6, 1142, '2019-10-01 03:31:25', '2019-10-01 03:31:25'),
	(104, 6, 3352, '2019-10-01 03:31:27', '2019-10-01 03:31:27'),
	(108, 6, 1283, '2019-10-01 03:31:32', '2019-10-01 03:31:32'),
	(109, 6, 3353, '2019-10-01 03:31:33', '2019-10-01 03:31:33'),
	(112, 6, 3348, '2019-10-01 03:31:36', '2019-10-01 03:31:36'),
	(114, 6, 1401, '2019-10-01 03:31:38', '2019-10-01 03:31:38'),
	(115, 6, 3345, '2019-10-01 03:31:39', '2019-10-01 03:31:39'),
	(117, 6, 3349, '2019-10-01 03:31:41', '2019-10-01 03:31:41'),
	(122, 3, 3356, '2019-10-02 20:15:25', '2019-10-02 20:15:25'),
	(123, 6, 1370, NULL, NULL),
	(124, 6, 1371, NULL, NULL),
	(125, 6, 1372, NULL, NULL),
	(126, 6, 1373, NULL, NULL),
	(127, 6, 1374, NULL, NULL),
	(128, 6, 1375, NULL, NULL),
	(129, 6, 1376, NULL, NULL),
	(130, 6, 1377, NULL, NULL),
	(131, 6, 1378, NULL, NULL),
	(132, 6, 1379, NULL, NULL),
	(133, 6, 1380, NULL, NULL),
	(134, 6, 1381, NULL, NULL),
	(135, 6, 1382, NULL, NULL),
	(136, 6, 1383, NULL, NULL),
	(137, 6, 1384, NULL, NULL),
	(138, 6, 1385, NULL, NULL),
	(139, 6, 1386, NULL, NULL),
	(140, 6, 1387, NULL, NULL),
	(141, 6, 1388, NULL, NULL),
	(142, 6, 1389, NULL, NULL),
	(143, 6, 1390, NULL, NULL),
	(144, 6, 1391, NULL, NULL),
	(145, 6, 1392, NULL, NULL),
	(146, 6, 1393, NULL, NULL),
	(154, 6, 1488, NULL, NULL),
	(155, 6, 1489, NULL, NULL),
	(156, 6, 1490, NULL, NULL),
	(157, 6, 1491, NULL, NULL),
	(158, 6, 1492, NULL, NULL),
	(159, 6, 1493, NULL, NULL),
	(160, 6, 1494, NULL, NULL),
	(161, 6, 1495, NULL, NULL),
	(162, 6, 1496, NULL, NULL),
	(163, 6, 1497, NULL, NULL),
	(164, 6, 1498, NULL, NULL),
	(169, 8, 3337, '2019-10-05 21:11:40', '2019-10-05 21:11:40'),
	(170, 8, 1437, '2019-10-14 16:41:50', '2019-10-14 16:41:50'),
	(171, 7, 1437, '2019-10-14 16:41:50', '2019-10-14 16:41:50'),
	(172, 4, 1437, '2019-10-14 16:41:50', '2019-10-14 16:41:50'),
	(173, 3, 1437, '2019-10-14 16:41:50', '2019-10-14 16:41:50'),
	(174, 6, 3372, '2019-10-14 20:12:55', '2019-10-14 20:12:55'),
	(175, 6, 3371, '2019-10-14 20:13:15', '2019-10-14 20:13:15'),
	(176, 6, 3370, '2019-10-14 20:13:29', '2019-10-14 20:13:29'),
	(177, 6, 3360, '2019-10-15 22:06:03', '2019-10-15 22:06:03'),
	(178, 6, 1370, NULL, NULL),
	(179, 6, 1371, NULL, NULL),
	(180, 6, 1372, NULL, NULL),
	(181, 6, 1373, NULL, NULL),
	(182, 6, 1374, NULL, NULL),
	(183, 6, 1375, NULL, NULL),
	(184, 6, 1376, NULL, NULL),
	(185, 6, 1377, NULL, NULL),
	(186, 6, 1378, NULL, NULL),
	(187, 6, 1379, NULL, NULL),
	(188, 6, 1380, NULL, NULL),
	(189, 6, 1381, NULL, NULL),
	(190, 6, 1382, NULL, NULL),
	(191, 6, 1383, NULL, NULL),
	(192, 6, 1384, NULL, NULL),
	(193, 6, 1385, NULL, NULL),
	(194, 6, 1386, NULL, NULL),
	(195, 6, 1387, NULL, NULL),
	(196, 6, 1388, NULL, NULL),
	(197, 6, 1389, NULL, NULL),
	(198, 6, 1390, NULL, NULL),
	(199, 6, 1391, NULL, NULL),
	(200, 6, 1392, NULL, NULL),
	(201, 6, 1393, NULL, NULL),
	(209, 6, 3374, '2019-10-16 23:52:05', '2019-10-16 23:52:05'),
	(210, 6, 3373, '2019-10-16 23:52:22', '2019-10-16 23:52:22'),
	(211, 6, 3368, '2019-10-16 23:59:25', '2019-10-16 23:59:25'),
	(212, 8, 3342, '2019-10-17 18:05:11', '2019-10-17 18:05:11'),
	(213, 6, 3337, '2019-10-22 23:07:33', '2019-10-22 23:07:33'),
	(217, 2, 3369, '2019-10-23 21:27:51', '2019-10-23 21:27:51'),
	(220, 8, 3336, '2019-10-25 02:41:02', '2019-10-25 02:41:02'),
	(221, 6, 3336, '2019-10-25 02:41:02', '2019-10-25 02:41:02'),
	(222, 1, 3380, '2019-10-30 21:06:22', '2019-10-30 21:06:22'),
	(223, 8, 1281, '2019-11-07 17:51:42', '2019-11-07 17:51:42'),
	(224, 4, 1281, '2019-11-07 17:51:42', '2019-11-07 17:51:42'),
	(225, 8, 3385, '2019-11-08 22:53:15', '2019-11-08 22:53:15'),
	(226, 4, 3385, '2019-11-08 22:53:15', '2019-11-08 22:53:15'),
	(228, 2, 3381, '2019-11-09 00:55:16', '2019-11-09 00:55:16'),
	(229, 6, 3176, '2019-11-09 00:55:52', '2019-11-09 00:55:52'),
	(230, 8, 3274, '2019-11-13 19:05:41', '2019-11-13 19:05:41'),
	(231, 6, 3274, '2019-11-13 19:05:41', '2019-11-13 19:05:41'),
	(232, 4, 3274, '2019-11-13 19:05:41', '2019-11-13 19:05:41'),
	(233, 3, 3274, '2019-11-13 19:05:41', '2019-11-13 19:05:41'),
	(234, 2, 3274, '2019-11-13 19:05:41', '2019-11-13 19:05:41'),
	(235, 2, 3382, '2019-11-14 20:01:19', '2019-11-14 20:01:19'),
	(236, 2, 3358, '2019-11-14 20:02:24', '2019-11-14 20:02:24'),
	(237, 2, 3379, '2019-11-14 20:02:47', '2019-11-14 20:02:47'),
	(238, 2, 3375, '2019-11-14 20:07:39', '2019-11-14 20:07:39'),
	(239, 2, 2941, '2019-11-14 20:18:39', '2019-11-14 20:18:39'),
	(240, 2, 2922, '2019-11-14 20:19:49', '2019-11-14 20:19:49'),
	(242, 6, 3387, '2019-11-15 21:03:57', '2019-11-15 21:03:57'),
	(243, 6, 3388, '2019-11-15 21:04:11', '2019-11-15 21:04:11'),
	(244, 6, 3389, '2019-11-15 21:04:27', '2019-11-15 21:04:27'),
	(245, 6, 3390, '2019-11-15 21:04:43', '2019-11-15 21:04:43'),
	(246, 6, 3391, '2019-11-15 21:04:54', '2019-11-15 21:04:54'),
	(247, 2, 1500, '2019-11-16 20:05:28', '2019-11-16 20:05:28'),
	(248, 2, 3357, '2019-11-19 22:24:25', '2019-11-19 22:24:25'),
	(249, 2, 3147, '2019-11-20 19:42:16', '2019-11-20 19:42:16'),
	(250, 2, 3376, '2019-11-20 19:52:28', '2019-11-20 19:52:28'),
	(251, 6, 3392, '2019-11-20 20:04:48', '2019-11-20 20:04:48'),
	(252, 2, 3377, '2019-11-21 17:09:26', '2019-11-21 17:09:26'),
	(253, 9, 3394, '2019-11-28 21:39:20', '2019-11-28 21:39:20'),
	(254, 10, 3394, '2019-11-28 21:46:29', '2019-11-28 21:46:29'),
	(255, 6, 3395, '2019-12-02 21:36:23', '2019-12-02 21:36:23'),
	(256, 6, 3396, '2019-12-02 21:42:50', '2019-12-02 21:42:50'),
	(257, 6, 3394, '2019-12-05 19:12:55', '2019-12-05 19:12:55'),
	(258, 6, 3397, '2019-12-05 20:56:45', '2019-12-05 20:56:45'),
	(259, 6, 3399, '2019-12-06 19:59:04', '2019-12-06 19:59:04'),
	(260, 2, 3401, '2019-12-10 16:32:40', '2019-12-10 16:32:40'),
	(261, 2, 3400, '2019-12-10 19:14:42', '2019-12-10 19:14:42'),
	(262, 2, 3383, '2019-12-10 19:15:19', '2019-12-10 19:15:19'),
	(263, 4, 3404, '2019-12-16 19:50:06', '2019-12-16 19:50:06'),
	(267, 6, 3407, '2019-12-16 23:27:33', '2019-12-16 23:27:33'),
	(268, 4, 3037, '2019-12-19 18:15:53', '2019-12-19 18:15:53'),
	(269, 2, 3037, '2019-12-19 18:15:53', '2019-12-19 18:15:53'),
	(270, 6, 3411, '2020-01-08 21:29:20', '2020-01-08 21:29:20'),
	(271, 2, 3398, '2020-01-10 17:47:50', '2020-01-10 17:47:50'),
	(273, 2, 3412, '2020-01-16 16:38:15', '2020-01-16 16:38:15'),
	(274, 2, 1066, '2020-01-17 17:55:39', '2020-01-17 17:55:39'),
	(275, 2, 1209, '2020-01-17 17:58:22', '2020-01-17 17:58:22'),
	(278, 8, 3343, '2020-01-18 01:02:53', '2020-01-18 01:02:53'),
	(279, 6, 3343, '2020-01-18 01:02:53', '2020-01-18 01:02:53'),
	(280, 2, 3343, '2020-01-18 01:02:53', '2020-01-18 01:02:53'),
	(281, 6, 3413, '2020-01-18 19:51:12', '2020-01-18 19:51:12'),
	(282, 2, 3207, '2020-01-29 16:47:36', '2020-01-29 16:47:36'),
	(283, 12, 3154, '2020-02-01 20:43:22', '2020-02-01 20:43:22'),
	(284, 12, 1031, '2020-02-01 20:43:48', '2020-02-01 20:43:48'),
	(285, 11, 1031, '2020-02-01 20:43:48', '2020-02-01 20:43:48'),
	(286, 4, 1031, '2020-02-01 20:43:48', '2020-02-01 20:43:48'),
	(287, 12, 3341, '2020-02-01 20:44:09', '2020-02-01 20:44:09'),
	(290, 6, 3417, '2020-02-04 00:04:49', '2020-02-04 00:04:49'),
	(291, 2, 3393, '2020-02-04 17:52:31', '2020-02-04 17:52:31'),
	(292, 2, 3416, '2020-02-04 17:52:49', '2020-02-04 17:52:49'),
	(293, 2, 3415, '2020-02-04 17:53:01', '2020-02-04 17:53:01'),
	(294, 2, 3342, '2020-02-04 19:18:51', '2020-02-04 19:18:51'),
	(295, 2, 1287, '2020-02-04 21:29:56', '2020-02-04 21:29:56'),
	(296, 2, 1299, '2020-02-04 21:30:30', '2020-02-04 21:30:30'),
	(297, 2, 3344, '2020-02-04 21:32:01', '2020-02-04 21:32:01'),
	(298, 2, 869, '2020-02-04 21:32:25', '2020-02-04 21:32:25'),
	(299, 2, 3351, '2020-02-04 21:33:16', '2020-02-04 21:33:16'),
	(300, 2, 1254, '2020-02-04 21:33:42', '2020-02-04 21:33:42'),
	(301, 2, 1226, '2020-02-04 21:47:52', '2020-02-04 21:47:52'),
	(302, 2, 3386, '2020-02-04 21:48:59', '2020-02-04 21:48:59'),
	(303, 2, 1518, '2020-02-04 21:49:27', '2020-02-04 21:49:27'),
	(304, 2, 3346, '2020-02-04 21:49:47', '2020-02-04 21:49:47'),
	(305, 2, 1277, '2020-02-04 21:50:12', '2020-02-04 21:50:12'),
	(306, 2, 1130, '2020-02-04 21:50:37', '2020-02-04 21:50:37'),
	(307, 2, 1511, '2020-02-04 21:53:06', '2020-02-04 21:53:06'),
	(308, 2, 1177, '2020-02-04 21:53:49', '2020-02-04 21:53:49'),
	(309, 6, 1287, '2020-02-04 21:55:39', '2020-02-04 21:55:39'),
	(310, 6, 1299, '2020-02-04 21:56:20', '2020-02-04 21:56:20'),
	(311, 6, 3344, '2020-02-04 21:56:39', '2020-02-04 21:56:39'),
	(312, 6, 869, '2020-02-04 21:56:57', '2020-02-04 21:56:57'),
	(313, 6, 3351, '2020-02-04 21:57:14', '2020-02-04 21:57:14'),
	(314, 6, 1254, '2020-02-04 21:57:35', '2020-02-04 21:57:35'),
	(315, 6, 3369, '2020-02-04 21:58:06', '2020-02-04 21:58:06'),
	(316, 6, 1226, '2020-02-04 21:58:25', '2020-02-04 21:58:25'),
	(317, 6, 3386, '2020-02-04 21:59:28', '2020-02-04 21:59:28'),
	(318, 6, 1518, '2020-02-04 21:59:47', '2020-02-04 21:59:47'),
	(319, 6, 3346, '2020-02-04 22:00:05', '2020-02-04 22:00:05'),
	(320, 6, 1277, '2020-02-04 22:00:24', '2020-02-04 22:00:24'),
	(321, 6, 1130, '2020-02-04 22:00:43', '2020-02-04 22:00:43'),
	(322, 6, 3381, '2020-02-04 22:01:00', '2020-02-04 22:01:00'),
	(323, 6, 1511, '2020-02-04 22:01:26', '2020-02-04 22:01:26'),
	(324, 6, 1177, '2020-02-04 22:01:48', '2020-02-04 22:01:48'),
	(325, 2, 3353, '2020-02-04 22:02:13', '2020-02-04 22:02:13'),
	(326, 2, 3399, '2020-02-04 22:02:39', '2020-02-04 22:02:39'),
	(327, 2, 3349, '2020-02-04 22:03:05', '2020-02-04 22:03:05'),
	(328, 2, 3417, '2020-02-04 22:03:27', '2020-02-04 22:03:27'),
	(329, 2, 3397, '2020-02-04 22:04:00', '2020-02-04 22:04:00'),
	(330, 12, 3343, '2020-02-04 23:52:39', '2020-02-04 23:52:39'),
	(331, 2, 3418, '2020-02-05 00:34:50', '2020-02-05 00:34:50'),
	(332, 6, 3207, '2020-02-05 17:00:51', '2020-02-05 17:00:51'),
	(333, 12, 3091, '2020-02-06 18:58:25', '2020-02-06 18:58:25'),
	(334, 2, 3091, '2020-02-06 18:58:25', '2020-02-06 18:58:25'),
	(335, 2, 1105, '2020-02-08 00:40:43', '2020-02-08 00:40:43'),
	(336, 6, 3419, '2020-02-10 19:27:04', '2020-02-10 19:27:04'),
	(337, 6, 3420, '2020-02-10 21:16:02', '2020-02-10 21:16:02'),
	(340, 2, 3410, '2020-02-13 22:09:32', '2020-02-13 22:09:32'),
	(341, 9, 1178, '2020-03-03 16:24:27', '2020-03-03 16:24:27'),
	(344, 6, 3424, '2020-03-03 20:01:30', '2020-03-03 20:01:30'),
	(345, 6, 3425, '2020-03-03 20:04:02', '2020-03-03 20:04:02'),
	(346, 2, 3378, '2020-03-04 22:52:00', '2020-03-04 22:52:00'),
	(347, 2, 3409, '2020-03-04 22:52:36', '2020-03-04 22:52:36'),
	(348, 2, 3421, '2020-03-04 22:52:59', '2020-03-04 22:52:59'),
	(349, 2, 3426, '2020-03-04 22:55:33', '2020-03-04 22:55:33'),
	(350, 13, 1185, '2020-03-05 16:15:05', '2020-03-05 16:15:05'),
	(351, 2, 3402, '2020-03-05 17:27:36', '2020-03-05 17:27:36'),
	(353, 3, 1281, '2020-03-10 17:49:23', '2020-03-10 17:49:23'),
	(354, 12, 1281, '2020-03-10 17:50:21', '2020-03-10 17:50:21'),
	(356, 11, 1281, '2020-03-10 17:51:44', '2020-03-10 17:51:44'),
	(NULL, 2, 3328, '2021-02-27 11:00:13', '2021-02-27 11:00:13'),
	(NULL, 1, 3331, '2021-02-27 11:32:19', '2021-02-27 11:32:19'),
	(NULL, 1, 3332, '2021-02-27 12:44:48', '2021-02-27 12:44:48'),
	(NULL, 1, 4, '2021-02-27 12:53:01', '2021-02-27 12:53:01'),
	(NULL, 7, 2, '2021-02-27 13:32:49', '2021-02-27 13:32:49');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Volcando estructura para tabla gestion.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido_paterno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido_materno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `celular` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_civil` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `fecha_nacimiento` date DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discapacidad` tinyint(1) DEFAULT '0',
  `comentario` text COLLATE utf8mb4_unicode_ci,
  `enabled` tinyint(1) DEFAULT NULL,
  `perfil_actualizado` tinyint(1) DEFAULT NULL,
  `usuario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero_id` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3333 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestion.users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `cedula`, `nombre1`, `nombre2`, `apellido_paterno`, `apellido_materno`, `direccion`, `celular`, `telefono`, `estado_civil`, `foto`, `fecha_nacimiento`, `email`, `discapacidad`, `comentario`, `enabled`, `perfil_actualizado`, `usuario`, `password`, `genero_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, '1200828463', 'GREGORIO', 'ENRIQUE', 'OSORIO', 'ANDRADES', 'GARZOTA', '0999218183', '04000000', 'Soltero', 'fotocarnet.png', '2019-08-26', 'gregorioenrique14@gmail.com', 0, NULL, 1, 1, 'gosorio', '$2y$12$1dcaJtEaBPQuAHrs42.rEugsQG8M.3xXwhSd5QFlQsxa8rfoFLCtS', 1, NULL, '2019-08-26 17:29:10', '2019-08-31 18:09:42'),
	(2, '0924293988', 'usuario', 'nuevo', 'nuevo', 'usuario', NULL, NULL, NULL, NULL, 'user.png', NULL, 'usuarionuevo@gmail.com', 0, NULL, 1, 0, 'unuevo', '$2y$10$bZKdQm.y0CheZ4ZvfKE/B.t9ySgd4iVu7PiwNLV3EftDXJOa2f4Hu', 1, NULL, '2021-02-27 11:13:00', '2021-02-27 13:32:49'),
	(3, '0924293985', 'usuario', 'nuevo', 'nuevo', 'usuario', NULL, NULL, NULL, 'Soltero', 'user.png', NULL, 'usuarionuevo@gmail.com', 0, NULL, 1, 0, 'unuevou', '$2y$10$N0u8q.ADv6Ff9O9oFV7rfOKToULHWAAA/03Y813rRg5LYHcKjUaF.', 1, NULL, '2021-02-27 11:13:56', '2021-02-27 11:32:19'),
	(4, '0924293989', 'Administrador', 'Administrador', 'Administrador', 'Administrador', NULL, NULL, NULL, NULL, 'user.png', NULL, 'Administrado@prueba.com', 0, NULL, 1, 0, 'aadministrador', '$2y$10$9drC8s/8KJqutRPyBIxqe.deN39vQK9wbxXKakV1HsF3bS0AqDNti', 1, NULL, '2021-02-27 12:44:41', '2021-02-27 12:44:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

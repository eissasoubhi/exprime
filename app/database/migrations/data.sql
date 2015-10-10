-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.6.12-log - MySQL Community Server (GPL)
-- Serveur OS:                   Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour exprime2
CREATE DATABASE IF NOT EXISTS `exprime2` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `exprime2`;

-- Export de données de la table exprime2.article: ~0 rows (environ)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Export de données de la table exprime2.bug_sugg: ~0 rows (environ)
/*!40000 ALTER TABLE `bug_sugg` DISABLE KEYS */;
/*!40000 ALTER TABLE `bug_sugg` ENABLE KEYS */;

-- Export de données de la table exprime2.bug_sugg_comment: ~0 rows (environ)
/*!40000 ALTER TABLE `bug_sugg_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `bug_sugg_comment` ENABLE KEYS */;

-- Export de données de la table exprime2.comment: ~0 rows (environ)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Export de données de la table exprime2.error: ~16 rows (environ)
/*!40000 ALTER TABLE `error` DISABLE KEYS */;
INSERT INTO `error` (`id`, `type`, `fatal`, `msg`, `file`, `code`, `line`, `url`, `created_at`, `updated_at`) VALUES
	(1, 'php', 0, 'Undefined variable: picture_keywords (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\picture\\edit.blade.php)', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\storage\\views\\fd17ac251247c73612e2e41d5d342953', '0', 41, 'http://localhost:8000/admin/picture/{picture}/edit', '2015-02-13 19:58:50', '2015-02-13 19:58:50'),
	(2, 'php', 1, 'Call to undefined method Illuminate\\Database\\Eloquent\\Collection::sync()', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\controllers\\backend\\PictureController.php', '1', 219, 'http://localhost:8000/admin/picture/{picture}', '2015-02-13 20:54:43', '2015-02-13 20:54:43'),
	(3, 'mysql', 0, 'SQLSTATE[42S22]: Column not found: 1054 Unknown column \'picture.keyword_id\' in \'where clause\' (SQL: select * from `picture` where `picture`.`keyword_id` = 1) (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\keyword\\index.blade.php)', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Connection.php', '0', 625, 'http://localhost:8000/admin/keyword', '2015-02-13 21:00:51', '2015-02-13 21:00:51'),
	(4, 'php', 0, 'Undefined variable: article (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\keyword\\edit.blade.php)', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\storage\\views\\1f13d9a3192f834053695aad79039a54', '0', 4, 'http://localhost:8000/admin/keyword/{keyword}/edit', '2015-02-13 21:03:28', '2015-02-13 21:03:28'),
	(5, 'php', 0, 'Undefined variable: Keyword', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\controllers\\backend\\KeywordController.php', '0', 95, 'http://localhost:8000/admin/keyword/{keyword}', '2015-02-14 22:03:42', '2015-02-14 22:03:42'),
	(6, 'php', 1, 'Class \'Photos\' not found', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\storage\\views\\bc9f65345ecb20d2be934481f3af7292', '1', 3, 'http://localhost:8000/admin/picture', '2015-02-15 20:52:44', '2015-02-15 20:52:44'),
	(7, 'php', 0, 'Undefined variable: pictures_count (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\partials\\top_menu.blade.php) (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\partials\\top_menu.blade.php) (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\partials\\top_menu.blade.php)', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\storage\\views\\bc9f65345ecb20d2be934481f3af7292', '0', 3, 'http://localhost:8000/admin', '2015-02-15 21:06:45', '2015-02-15 21:06:45'),
	(8, 'php', 0, 'Undefined variable: bugs_count (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\partials\\top_menu.blade.php) (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\partials\\top_menu.blade.php) (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\partials\\top_menu.blade.php)', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\storage\\views\\bc9f65345ecb20d2be934481f3af7292', '0', 6, 'http://localhost:8000/admin', '2015-02-15 21:07:24', '2015-02-15 21:07:24'),
	(9, 'php', 1, 'Call to undefined method Illuminate\\Mail\\Mailer::all()', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\vendor\\laravel\\framework\\src\\Illuminate\\Support\\Facades\\Facade.php', '1', 205, 'http://localhost:8000/admin', '2015-02-15 21:12:06', '2015-02-15 21:12:06'),
	(10, 'php', 0, 'Undefined variable: title (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\layouts\\main.blade.php) (View: C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\views\\backend\\layouts\\main.blade.php)', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\storage\\views\\ee5fb4f33d907ab1ac7162805367b01c', '0', 6, 'http://localhost:8000/admin', '2015-02-15 21:22:29', '2015-02-15 21:22:29'),
	(11, 'php', 0, 'Undefined variable: name', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\controllers\\backend\\PictureController.php', '0', 315, 'http://localhost:8000/admin/picture/upload', '2015-02-17 14:16:36', '2015-02-17 14:16:36'),
	(12, 'php', 0, 'include(C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma/app/controllers/BaseController.php): failed to open stream: No such file or directory', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\vendor\\composer\\ClassLoader.php', '0', 382, 'http://localhost:8000', '2015-04-16 08:43:50', '2015-04-16 08:43:50'),
	(13, 'php', 0, 'Class frontend\\HomeController does not exist', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php', '-1', 504, 'http://localhost:8000', '2015-04-16 08:44:14', '2015-04-16 08:44:14'),
	(14, 'php', 0, 'View [frontend.user.index] not found.', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\vendor\\laravel\\framework\\src\\Illuminate\\View\\FileViewFinder.php', '0', 146, 'http://localhost:8000', '2015-04-16 08:54:21', '2015-04-16 08:54:21'),
	(15, 'php', 1, 'Cannot redeclare frontend\\HomeController::isLogin()', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\controllers\\frontend\\HomeController.php', '64', 24, 'http://localhost:8000/sign-up', '2015-04-16 18:27:39', '2015-04-16 18:27:39'),
	(16, 'php', 0, 'Trying to get property of non-object', 'C:\\Users\\Admin\\Documents\\myDataWork\\php_projects\\exprime.ma\\app\\controllers\\backend\\PictureController.php', '0', 110, 'http://localhost:8000/admin/picture/{picture}/edit', '2015-04-17 15:03:13', '2015-04-17 15:03:13');
/*!40000 ALTER TABLE `error` ENABLE KEYS */;

-- Export de données de la table exprime2.keyword: ~6 rows (environ)
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
INSERT INTO `keyword` (`id`, `keyword`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'k1888', 1, '0000-00-00 00:00:00', '2015-02-14 22:11:17'),
	(2, 'k2566', 1, '0000-00-00 00:00:00', '2015-02-14 22:11:28'),
	(4, 'k44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'k7', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, 'k755', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `keyword` ENABLE KEYS */;

-- Export de données de la table exprime2.keyword_picture: ~5 rows (environ)
/*!40000 ALTER TABLE `keyword_picture` DISABLE KEYS */;
INSERT INTO `keyword_picture` (`picture_id`, `keyword_id`, `created_at`, `updated_at`) VALUES
	(3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `keyword_picture` ENABLE KEYS */;

-- Export de données de la table exprime2.like: ~0 rows (environ)
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
/*!40000 ALTER TABLE `like` ENABLE KEYS */;

-- Export de données de la table exprime2.mail: ~0 rows (environ)
/*!40000 ALTER TABLE `mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail` ENABLE KEYS */;

-- Export de données de la table exprime2.migrations: ~0 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Export de données de la table exprime2.permission: ~0 rows (environ)
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

-- Export de données de la table exprime2.picture: ~50 rows (environ)
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` (`id`, `user_id`, `name`, `size`, `dimension`, `url_origin`, `url_with_txt`, `date_last_modif`, `validated`, `created_at`, `updated_at`) VALUES
	(3, 1, '1423656129_1.jpg', '145932', '550x309', '1423656129_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 12:02:10', '2015-02-11 12:02:10'),
	(5, 1, '1423660456_1.jpg', '141593', '550x314', '1423660456_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:17', '2015-02-11 13:14:17'),
	(7, 1, '1423660459_1.jpg', '194232', '550x343', '1423660459_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:20', '2015-02-11 13:14:20'),
	(8, 1, '1423660460_1.jpg', '88923', '550x412', '1423660460_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:22', '2015-02-11 13:14:22'),
	(9, 1, '1423660462_1.jpg', '57204', '550x289', '1423660462_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:24', '2015-02-11 13:14:24'),
	(10, 1, '1423660464_1.jpg', '113967', '550x412', '1423660464_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:26', '2015-02-11 13:14:26'),
	(11, 1, '1423660475_1.jpg', '161793', '550x309', '1423660475_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:36', '2015-02-11 13:14:36'),
	(14, 1, '1423660479_1.jpg', '197502', '550x412', '1423660479_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:40', '2015-02-11 13:14:40'),
	(15, 1, '1423660480_1.jpg', '234453', '550x309', '1423660480_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:41', '2015-02-11 13:14:41'),
	(16, 1, '1423660482_1.jpg', '184764', '550x412', '1423660482_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:42', '2015-02-11 13:14:42'),
	(17, 1, '1423660483_1.jpg', '158085', '550x412', '1423660483_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:44', '2015-02-11 13:14:44'),
	(18, 1, '1423660484_1.jpg', '183887', '550x343', '1423660484_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:45', '2015-02-11 13:14:45'),
	(19, 1, '1423660486_1.jpg', '167851', '550x309', '1423660486_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:46', '2015-02-11 13:14:46'),
	(20, 1, '1423660487_1.jpg', '146471', '550x343', '1423660487_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:48', '2015-02-11 13:14:48'),
	(21, 1, '1423660489_1.jpg', '213619', '550x412', '1423660489_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:49', '2015-02-11 13:14:49'),
	(22, 1, '1423660490_1.jpg', '101485', '550x343', '1423660490_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:51', '2015-02-11 13:14:51'),
	(23, 1, '1423660492_1.jpg', '218382', '550x412', '1423660492_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:53', '2015-02-11 13:14:53'),
	(24, 1, '1423660494_1.jpg', '292685', '550x412', '1423660494_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:55', '2015-02-11 13:14:55'),
	(25, 1, '1423660496_1.jpg', '190427', '550x343', '1423660496_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:14:58', '2015-02-11 13:14:58'),
	(26, 1, '1423660499_1.jpg', '146587', '550x309', '1423660499_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:15:01', '2015-02-11 13:15:01'),
	(27, 1, '1423660502_1.jpg', '228784', '550x412', '1423660502_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-11 13:15:04', '2015-02-11 13:15:04'),
	(28, 1, '1424034860_1.jpg', '76821', '288x400', '1424034860_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-15 21:14:21', '2015-02-15 21:14:21'),
	(29, 1, '1424182591_1.jpg', '7386', '225x225', '1424182591_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:16:33', '2015-02-17 14:16:33'),
	(30, 1, '1424182606_1.jpg', '181119', '550x550', '1424182606_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:16:48', '2015-02-17 14:16:48'),
	(31, 1, '1424182611_1.jpg', '71809', '309x400', '1424182611_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:16:52', '2015-02-17 14:16:52'),
	(32, 1, '1424182614_1.jpg', '110926', '550x358', '1424182614_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:16:55', '2015-02-17 14:16:55'),
	(33, 1, '1424182616_1.jpg', '9255', '225x225', '1424182616_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:16:57', '2015-02-17 14:16:57'),
	(34, 1, '1424182624_1.jpg', '13234', '261x223', '1424182624_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:04', '2015-02-17 14:17:04'),
	(35, 1, '1424182628_1.jpg', '11701', '226x225', '1424182628_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:10', '2015-02-17 14:17:10'),
	(36, 1, '1424182634_1.jpg', '11687', '225x225', '1424182634_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:16', '2015-02-17 14:17:16'),
	(37, 1, '1424182637_1.jpg', '169516', '550x409', '1424182637_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:19', '2015-02-17 14:17:19'),
	(38, 1, '1424182640_1.jpg', '11863', '225x225', '1424182640_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:22', '2015-02-17 14:17:22'),
	(39, 1, '1424182645_1.jpg', '11211', '261x211', '1424182645_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:26', '2015-02-17 14:17:26'),
	(40, 1, '1424182659_1.jpg', '75498', '254x400', '1424182659_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:41', '2015-02-17 14:17:41'),
	(41, 1, '1424182663_1.jpg', '125691', '266x400', '1424182663_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:17:45', '2015-02-17 14:17:45'),
	(42, 1, '1424182683_1.jpg', '27949', '500x376', '1424182683_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:04', '2015-02-17 14:18:04'),
	(43, 1, '1424182686_1.jpg', '7386', '225x225', '1424182686_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:07', '2015-02-17 14:18:07'),
	(44, 1, '1424182708_1.jpg', '181119', '550x550', '1424182708_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:30', '2015-02-17 14:18:30'),
	(45, 1, '1424182716_1.jpg', '71809', '309x400', '1424182716_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:37', '2015-02-17 14:18:37'),
	(46, 1, '1424182719_1.jpg', '110926', '550x358', '1424182719_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:41', '2015-02-17 14:18:41'),
	(47, 1, '1424182723_1.jpg', '9255', '225x225', '1424182723_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:44', '2015-02-17 14:18:44'),
	(48, 1, '1424182732_1.jpg', '13234', '261x223', '1424182732_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:53', '2015-02-17 14:18:53'),
	(49, 1, '1424182738_1.jpg', '11701', '226x225', '1424182738_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:18:59', '2015-02-17 14:18:59'),
	(50, 1, '1424182745_1.jpg', '11687', '225x225', '1424182745_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:19:06', '2015-02-17 14:19:06'),
	(51, 1, '1424182748_1.jpg', '169516', '550x409', '1424182748_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:19:10', '2015-02-17 14:19:10'),
	(52, 1, '1424182752_1.jpg', '11863', '225x225', '1424182752_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:19:14', '2015-02-17 14:19:14'),
	(53, 1, '1424182755_1.jpg', '11211', '261x211', '1424182755_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:19:17', '2015-02-17 14:19:17'),
	(54, 1, '1424182777_1.jpg', '27949', '500x376', '1424182777_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:19:38', '2015-02-17 14:19:38'),
	(55, 1, '1424182784_1.jpg', '75498', '254x400', '1424182784_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:19:45', '2015-02-17 14:19:45'),
	(56, 1, '1424182787_1.jpg', '125691', '266x400', '1424182787_1.jpg', '', '0000-00-00 00:00:00', 1, '2015-02-17 14:19:51', '2015-02-17 14:19:51');
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;

-- Export de données de la table exprime2.picture_text: ~0 rows (environ)
/*!40000 ALTER TABLE `picture_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `picture_text` ENABLE KEYS */;

-- Export de données de la table exprime2.role: ~1 rows (environ)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '0000-00-00 00:00:00', '2015-02-12 22:28:13'),
	(2, 'editeur', '2015-02-12 22:28:39', '2015-02-12 22:28:39');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Export de données de la table exprime2.statistic: ~0 rows (environ)
/*!40000 ALTER TABLE `statistic` DISABLE KEYS */;
/*!40000 ALTER TABLE `statistic` ENABLE KEYS */;

-- Export de données de la table exprime2.user: ~7 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `login`, `password`, `email`, `last_sign_in`, `role_id`, `f_name`, `l_name`, `count_sign_in`, `country`, `city`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'log1', '$2y$10$bl.A7WB8QgUw7PZHA/YY3.kH5d/RNqsKQS0phRZQaVWu1PR041Sdi', '', '0000-00-00 00:00:00', 1, '', '', 0, '', '', 'lcdrIZmy2u7AO9p1APekJWiEH6nX28CeWx7S1V7f1wehf2DWiAeDZP9Sjt1E', '0000-00-00 00:00:00', '2015-04-17 11:31:00'),
	(4, 'log4444', '$2y$10$.RjdOabl6ov00aI/BcKXo.I4zNmqy7pS1Ep8arlla4V/du35ThkzK', 'eissa.soubhi@gmail.com', '0000-00-00 00:00:00', 2, '', '', 0, '', '', NULL, '0000-00-00 00:00:00', '2015-02-12 22:29:52'),
	(5, 'log3', '$2y$10$bl.A7WB8QgUw7PZHA/YY3.kH5d/RNqsKQS0phRZQaVWu1PR041Sdi', 'e2', '0000-00-00 00:00:00', 1, '', '', 0, '', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'log4ffff', '$2y$10$Sn12pc9WM/56R5Q1eKbMWOgzw5NvR.RSje3/ofHFjqVhEGBdkxOkq', 'secretariat@coursdeclic.com', '0000-00-00 00:00:00', 2, '', '', 0, '', '', NULL, '0000-00-00 00:00:00', '2015-02-12 22:30:06'),
	(7, 'log5', '$2y$10$bl.A7WB8QgUw7PZHA/YY3.kH5d/RNqsKQS0phRZQaVWu1PR041Sdi', 'e5', '0000-00-00 00:00:00', 1, '', '', 0, '', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 'log2', '$2y$10$bl.A7WB8QgUw7PZHA/YY3.kH5d/RNqsKQS0phRZQaVWu1PR041Sdi', 'contact@sypro.net', '0000-00-00 00:00:00', 2, '', '', 0, '', '', '78BIaJHv0ZTrDu1LYh6VmDl17xPjyy5beXfiiwrS5n95eIlFRN6JmskMh4gU', '0000-00-00 00:00:00', '2015-02-12 23:05:57'),
	(9, 'log7', '$2y$10$bl.A7WB8QgUw7PZHA/YY3.kH5d/RNqsKQS0phRZQaVWu1PR041Sdi', 'e7', '0000-00-00 00:00:00', 1, '', '', 0, '', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.7.27-0ubuntu0.16.04.1)
# Схема: technomatix
# Время создания: 2019-08-23 18:34:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-owner_id-expenses` (`owner_id`),
  KEY `fk-product_id-expenses` (`product_id`),
  CONSTRAINT `fk-owner_id-expenses` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-product_id-expenses` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;

INSERT INTO `expenses` (`id`, `owner_id`, `product_id`, `value`, `created_at`, `updated_at`)
VALUES
	(1,2,1,2500,1566584973,1566584973),
	(3,2,5,21499,1566585002,1566585002);

/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;

INSERT INTO `migration` (`version`, `apply_time`)
VALUES
	('m000000_000000_base',1566553812),
	('m130524_201442_init',1566553820),
	('m190124_110200_add_verification_token_column_to_user_table',1566553820),
	('m190823_072809_create_products_table',1566553820),
	('m190823_072857_create_profit_table',1566553821),
	('m190823_072913_create_expenses_table',1566553821),
	('m190823_072942_create_operations_history_table',1566576256);

/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы operations_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `operations_history`;

CREATE TABLE `operations_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `operation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-owner_id-operations_history` (`owner_id`),
  CONSTRAINT `fk-owner_id-operations_history` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `operations_history` WRITE;
/*!40000 ALTER TABLE `operations_history` DISABLE KEYS */;

INSERT INTO `operations_history` (`id`, `owner_id`, `model`, `model_id`, `operation`, `created_at`, `updated_at`)
VALUES
	(1,2,'backend\\models\\Products',5,'Added product',1566577171,1566577171),
	(2,1,'backend\\models\\Products',6,'Added product',1566579416,1566579416),
	(4,2,'backend\\models\\Expenses',2,'Added product',1566584976,1566584976),
	(5,2,'backend\\models\\Expenses',3,'Added product',1566585002,1566585002),
	(6,2,'backend\\models\\Profit',1,'Added profit',1566585026,1566585026);

/*!40000 ALTER TABLE `operations_history` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-owner_id-products` (`owner_id`),
  CONSTRAINT `fk-owner_id-products` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `owner_id`, `title`, `price`, `text`, `status`, `created_at`, `updated_at`)
VALUES
	(1,2,'AirPods',1500,'\r\nBluetooth\r\nБеспроводное подключение\r\nВес\r\nAirPods (каждый наушник): 4 г\r\nЗарядный футляр: 38 г\r\nРазмеры\r\nAirPods (каждый наушник): 16,5 x 18,0 x 40,5 мм\r\nЗарядный футляр: 44,3 x 21,3 x 53,5 мм\r\nВозможности подключения\r\nAirPods: Bluetooth\r\nЗарядный футляр: разъём Lightning\r\nУниверсальный доступ\r\nПоддержка Live-прослушивания7\r\nДатчики AirPods (в каждом наушнике):\r\nСдвоенные направленные микрофоны\r\nДвойные оптические сенсоры\r\nАкселерометр распознавания движения\r\nАкселерометр обнаружения голосовой активности\r\nПитание\r\nИспользование AirPods с подзарядкой в футляре: более 24 часов прослушивания аудио,3 до 18 часов в режиме разговора8\r\nИспользование AirPods без подзарядки (с полным зарядом): до 5 часов прослушивания аудио,1 до 3 часов в режиме разговора2\r\n15 минут зарядки в футляре обеспечивают до 3 часов прослушивания аудио4 или до 2 часов в режиме разговора5',10,1566555007,1566555007),
	(5,2,'iPhone 8 plus',21600,'iPhone 8 Plus — новое поколение iPhone. Передняя и задняя панели выполнены из самого прочного стекла, когда-либо созданного для iPhone, а рамка — из алюминия, применяемого в аэрокосмической отрасли. iPhone 8 Plus заряжается без проводов. Защищён от воды и пыли. Оснащён дисплеем Retina HD 5,5 дюйма с технологией True Tone. И двойной камерой 12 Мп с улучшенным режимом «Портрет» и новой функцией портретного освещения. Всё это работает на A11 Bionic — самом мощном и умном процессоре iPhone. И ещё iPhone 8 и iPhone 8 Plus поддерживают дополненную реальность в играх и приложениях. iPhone 8 Plus — никогда ещё интеллект не был в такой прекрасной форме',10,1566577171,1566577171),
	(6,1,'Apple MacBook Pro Retina 13\" 256GB Silver (MPXU2) 2017',56499,'MacBook Pro 13 Обладатель 2-ядерного процессора Core i5 с тактовой частотой 2 ГГц / 4.1 ГГц Turbo. Скорость чтения SSD накопителей до 3.2 ГБ/с. Так же одним из самых ярких моментов является дисплей Ретина, что делает экран самым ярким и насыщенным среди его предшественников. Множество возможностей предоставляется своему владельцу как при использовании в домашней обстановке, так и на работе. Вес 1.37 кг, поэтому его можно брать с собой в командировки, путешествия, деловые поездки. Запаса автономной работы без заряда хватит на 9 часов работы. Электронную начинку надежно бережет от повреждений алюминиевый корпус',10,1566579416,1566579416);

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы profit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profit`;

CREATE TABLE `profit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-owner_id-profit` (`owner_id`),
  KEY `fk-product_id-profit` (`product_id`),
  CONSTRAINT `fk-owner_id-profit` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-product_id-profit` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `profit` WRITE;
/*!40000 ALTER TABLE `profit` DISABLE KEYS */;

INSERT INTO `profit` (`id`, `owner_id`, `product_id`, `value`, `created_at`, `updated_at`)
VALUES
	(1,2,5,21499,1566585026,1566585026);

/*!40000 ALTER TABLE `profit` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`, `verification_token`)
VALUES
	(1,'aplear','zx0QZLYUesnUyK45u7a1y--hc-2IUn8D','$2y$13$e581Npah900.4TlceC0O/.3mqyP.2Oygz2.DTwI3KzgtKEIozFuxm',NULL,'aplear@gmail.com','administrator',10,1566553930,1566553930,''),
	(2,'toha','rkHDnQbXiEpqgA9qTduEEQi3-Oh_tWYn','$2y$13$1TX4EMRBHqGeo0SqFfjJ.evdoFUuIhBT9Kv9NtbvcJDww2rHNbAgi',NULL,'toha@gmail.com','manager',10,1566554269,1566554269,NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

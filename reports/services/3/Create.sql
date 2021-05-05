# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: csdeml.ugatu.su (MySQL 5.5.5-10.3.14-MariaDB)
# Схема: sts07-14263
# Время создания: 2021-05-03 07:41:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы telescops
# ------------------------------------------------------------
USE `sts07-14263`;
DROP TABLE IF EXISTS `telescops`;

CREATE TABLE `telescops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(86) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Focus` int(11) NOT NULL,
  `Diameter` int(11) NOT NULL,
  `Weight` float NOT NULL DEFAULT 0,
  `Price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `telescops` WRITE;
/*!40000 ALTER TABLE `telescops` DISABLE KEYS */;

INSERT INTO `telescops` (`id`, `Name`, `Focus`, `Diameter`, `Weight`, `Price`)
VALUES
	(2,'Солнечный телескоп CORONADO SolarMax III 90 Double Stack, с блок. фильтром 30 мм (OTA)',800,90,10,1056990),
	(3,'Телескоп Levenhuk Skyline BASE 50T',600,50,2.4,7000),
	(4,'Телескоп Konus Konuspace-4 50/600 AZ, настольный',600,50,1.28,6390),
	(5,'Телескоп Sky-Watcher BK 607AZ2',700,60,4.12,13990),
	(6,'Телескоп Levenhuk Skyline Travel 50',360,50,2.3,7990),
	(7,'Телескоп Levenhuk Skyline Travel 80',400,80,3.87,19900),
	(8,'Телескоп Konus Konustart-700B 60/700 AZ',700,60,2.4,14990),
	(9,'Телескоп Sky-Watcher BK MAK102 AZ-EQ AVANT на треноге Star Adventurer',1300,102,15,46990),
	(10,'Телескоп Bresser National Geographic 76/700 EQ',233,700,8.6,26990),
	(11,'Телескоп Konus Konustart-900B 60/900 EQ',900,60,7.3,26790),
	(12,'Телескоп Konus Konuspace-6 60/800 AZ',800,60,4.5,10790),
	(13,'Телескоп Levenhuk Skyline PRO 80 MAK',1000,80,1.3,27990),
	(14,'Телескоп Sky-Watcher BK MAK90EQ1',1250,90,8.1,35990),
	(15,'Телескоп Levenhuk Skyline Travel Sun 50',360,50,6.4,8990),
	(16,'Телескоп Bresser Junior Space Explorer 45/600 AZ',600,45,4.9,8590),
	(17,'Телескоп Sky-Watcher Star Discovery MAK102 SynScan GOTO',1250,102,5.3,79990),
	(18,'Телескоп Konus Konuspace-7 60/900 EQ',900,60,11.2,17990),
	(19,'Телескоп Levenhuk Skyline PLUS 60T',700,60,6.2,16490),
	(20,'Телескоп Sky-Watcher MAK127 AZ-GTe SynScan GOTO',1500,127,11,86990),
	(21,'Телескоп Sky-Watcher BK 909EQ2',900,90,4.4,31790),
	(22,'Телескоп Bresser Quasar 80/900 EQ, с адаптером для смартфона',900,80,4.5,49990),
	(23,'Телескоп Levenhuk LabZZ T2',600,50,1.1,4590),
	(24,'Телескоп Bresser National Geographic 50/360 AZ',360,50,12.7,8990),
	(25,'Телескоп Levenhuk Skyline BASE 60T',700,60,12.6,10990),
	(26,'Телескоп Levenhuk Skyline Travel Sun 70',400,70,9.7,11890),
	(27,'Телескоп Bresser Junior 60/700 AZ1',700,60,11.3,16990),
	(28,'Труба оптическая Sky-Watcher BK MAK80SP OTA',1000,80,0.3,17590),
	(29,'Телескоп Levenhuk Skyline BASE 80T',500,80,6.2,18690),
	(30,'Телескоп Sky-Watcher BK 705AZ3',500,70,7.6,21490),
	(31,'Телескоп Bresser Classic 70/350 AZ',350,70,10.1,21990),
	(32,'Телескоп Sky-Watcher BK 709EQ2',900,70,7,23490),
	(33,'Труба оптическая Sky-Watcher BK MAK90SP OTA',1250,90,8.6,23490),
	(34,'Телескоп Sky-Watcher BK 804AZ3',400,80,7.3,28490),
	(35,'Телескоп Sky-Watcher BK MAK80EQ1',1000,80,4.5,28990),
	(36,'Телескоп Bresser National Geographic 114/900 AZ',675,900,1.3,29990),
	(37,'Телескоп Sky-Watcher BK 809AZ3',900,80,8.1,29990),
	(38,'Труба оптическая Sky-Watcher StarTravel BK 1206 OTA',600,120,6.4,38490),
	(39,'Телескоп Sky-Watcher BK 1025AZ3',500,102,4.9,41490),
	(40,'Телескоп Sky-Watcher Evostar 909 AZ PRONTO на треноге Star Adventurer',900,90,5.3,43490),
	(41,'Телескоп Bresser National Geographic 70/350 GOTO',350,70,11.2,45990),
	(42,'Телескоп Bresser National Geographic 90/900 EQ3',900,90,6.2,46990),
	(43,'Труба оптическая Bresser Messier AR-102L/1350 Hexafoc',1350,102,11,51490),
	(44,'Труба оптическая Sky-Watcher Evostar BK ED72 OTA',420,72,4.4,52790),
	(45,'Телескоп Sky-Watcher 70S AZ-GTe SynScan GOTO',700,70,4.5,54990),
	(46,'Телескоп Sky-Watcher MAK80 AZ-GTe SynScan GOTO',1000,80,1.1,54990),
	(47,'Телескоп Sky-Watcher 80S AZ-GTe SynScan GOTO',400,80,12.7,57990),
	(48,'Телескоп Sky-Watcher 102S AZ-GTe SynScan GOTO',500,102,12.6,62990),
	(49,'Телескоп солнечный Sky-Watcher SolarQuest',500,70,9.7,65990),
	(50,'Телескоп Sky-Watcher Star Discovery P130 SynScan GOTO',650,130,11.3,69990),
	(51,'Телескоп Sky-Watcher Star Discovery AC90 SynScan GOTO',900,90,0.3,69990),
	(52,'Телескоп Sky-Watcher BK MAK102AZGT SynScan GOTO',1300,102,6.2,69990),
	(53,'Телескоп Levenhuk Skyline PRO 127 MAK',1500,127,7.6,69990),
	(54,'Труба оптическая Sky-Watcher StarTravel BK 150750 OTA',750,150,10.1,84690),
	(55,'Телескоп Sky-Watcher BK 1201EQ3-2',1000,120,7,84990),
	(56,'Телескоп Sky-Watcher BK MAK127 AZGT SynScan GOTO',1500,127,4.1,92490),
	(57,'Телескоп Sky-Watcher BK 1201EQ5',1000,120,2.3,99990),
	(58,'Труба оптическая Sky-Watcher BK ED80 Steel OTAW',600,80,3.9,109990),
	(59,'Труба оптическая Explore Scientific AR127 Air-Spaced Doublet',825,127,7.6,114990),
	(60,'Телескоп Bresser Messier AR-102L/1350 EXOS-1/EQ4',1350,102,10.1,159990),
	(61,'Teles',200,50,6,10000);

/*!40000 ALTER TABLE `telescops` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

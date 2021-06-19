USE `sts07-14263`;

DROP TABLE `transport`;
CREATE TABLE `transport` (
`id` int(12) NOT NULL AUTO_INCREMENT,
`name` varchar(64) DEFAULT NULL,
`total` int(64) DEFAULT NULL,
`sold` int(64) DEFAULT NULL,
`free` int(64) DEFAULT NULL,
`booked` int(64) DEFAULT NULL,
`cost` int(64) DEFAULT NULL,
`cost1` int(64) DEFAULT NULL,
`cost2` int(64) DEFAULT NULL,
PRIMARY KEY (`id`)
)ENGINE=MyISAM;

DROP TABLE `passenger`;
CREATE TABLE `passenger` (
`id` int(12) unsigned NOT NULL AUTO_INCREMENT,
`lastname` varchar(64)  DEFAULT NULL,
`name` varchar(64)  DEFAULT NULL,
`distance` int(64)  DEFAULT NULL,
`lgota` int(64)  DEFAULT NULL,
`date` date NOT NULL DEFAULT '0000-00-00',
`cost` int(64)  DEFAULT NULL,
PRIMARY KEY (`id`)
)ENGINE=MyISAM;

INSERT INTO `transport` VALUES (1, 'Дети', '20','9','5','6','300','250','200');
INSERT INTO `transport` VALUES (2, 'Школьники', '30','15','10','5','350','300','250');
INSERT INTO `transport` VALUES (3, 'Взрослые', '60','40','4','16','400','350','300');
INSERT INTO `transport` VALUES (4, 'Пенсионеры', '30','10','14','6','350','300','250');
INSERT INTO `transport` VALUES (5, 'Участники ВОВ', '10','2','8','0','200','150','100');

INSERT INTO `passenger` VALUES (1,'Петров','Взрослые','9','10','2021-05-03','315');
INSERT INTO `passenger` VALUES (2,'Сидоров','Школьники','14','10','2021-05-02','270');
INSERT INTO `passenger` VALUES (3,'Иванов','Взрослые','6','0','2021-05-04','400');
INSERT INTO `passenger` VALUES (4,'Иванова','Школьники','6','5','2021-05-04','332');
INSERT INTO `passenger` VALUES (5,'Шишкина','Участники ВОВ','11','0','2021-05-05','150');
INSERT INTO `passenger` VALUES (6,'Башмакова','Дети','5','10','2021-05-01','270');
INSERT INTO `passenger` VALUES (7,'Васильева','Взрослые','18','0','2021-05-04','300');
INSERT INTO `passenger` VALUES (8,'Пестров','Пенсионеры','10','5','2021-05-04','285');
INSERT INTO `passenger` VALUES (9,'Куликов','Взрослые','15','0','2021-05-05','350');

/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.21-MariaDB : Database - resto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`resto` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `resto`;

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `NIP` varchar(6) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jabatan` varchar(10) NOT NULL,
  `kelamin` enum('P','W') NOT NULL,
  `masuk` date NOT NULL,
  `telepon` varchar(12) DEFAULT NULL,
  `alamat` text,
  `password` varchar(255) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`NIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `employees` */

insert  into `employees`(`NIP`,`nama`,`jabatan`,`kelamin`,`masuk`,`telepon`,`alamat`,`password`,`status`) values ('116001','Zah','MANAGER','P','2017-05-12','','asdasd','$2y$10$kfa8ACIldHiZw/PpsEWwxew0fIDanmAYgIqJHZL2zUVPv1t7BbAPa',1),('216001','Hamzah','KOKI','P','2017-04-10','084','','$2y$10$VE15SaUrvKSEVr9DllDwnOwTn8C4WGgVIW7q6hl.Kb6KwI2h7Tzsi',0),('217002','Fauzi','KOKI','P','2017-05-24','3333','dfsfsdf','$2y$10$ZOfbw485Q0A.oDdIy68Nw.wuCmw68udBnztOCP/hKWHvQVbgs96e2',1),('316001','Fauzi','PANTRY','P','2017-05-14','','','$2y$10$BJPLPWuRpugGfGeB0CalZuMYrVuMual10l41c8qphHFmfM4kfgo/y',1),('317002','Richo','PANTRY','P','2017-05-24','','','$2y$10$bwQA1jDnTM4fs9DCDKDLruwMaHgJM4wqjIyBrNjDdXQeuMMWORoBO',1),('416001','Andri','KASIR','P','2017-05-13',NULL,NULL,'$2y$10$kfa8ACIldHiZw/PpsEWwxew0fIDanmAYgIqJHZL2zUVPv1t7BbAPa',0),('417002','Andri','KASIR','P','2017-05-24',NULL,NULL,'$2y$10$.TRn7UUBuvAEngQYcFdvTerosgsoW3xpILvIwsy5/c8YIbt9XQQ7m',1),('517001','Azka','PRAMUSAJI','P','2017-05-24',NULL,NULL,'$2y$10$N2QDFVfqgZ0YVg5uTKQN2exwaaLWHk17vYPqG8SKv5pzE3Q1tdG9C',1);

/*Table structure for table `feedbacks` */

DROP TABLE IF EXISTS `feedbacks`;

CREATE TABLE `feedbacks` (
  `no_pemesanan` int(11) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` text,
  `konten` text,
  KEY `no_pemesanan` (`no_pemesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `feedbacks` */

insert  into `feedbacks`(`no_pemesanan`,`tanggal`,`perihal`,`konten`) values (5,'2017-05-22','Apapun','Nikmat Mantap Lezat'),(4,'2017-05-22','ssss','dsfsdfdsfsdfsdfs\r\n\r\nfghdfgdfgdfg'),(2,'2017-05-24','Makanan','Lezat'),(2,'2017-05-24','Makanan','Lezat'),(7,'2017-05-26','Makanan','lezat'),(2,'2017-05-26','mkanan','lezat');

/*Table structure for table `foods` */

DROP TABLE IF EXISTS `foods`;

CREATE TABLE `foods` (
  `no_hidangan` smallint(11) unsigned NOT NULL AUTO_INCREMENT,
  `NIP` varchar(6) DEFAULT NULL,
  `nama_hidangan` varchar(35) NOT NULL,
  `kode_tipe` varchar(3) NOT NULL,
  `harga` int(11) unsigned NOT NULL,
  `komposisi` text,
  `cara_buat` text,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `life_cycle` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no_hidangan`),
  KEY `foods_ibfk_1` (`NIP`),
  CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`NIP`) REFERENCES `employees` (`NIP`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `foods` */

insert  into `foods`(`no_hidangan`,`NIP`,`nama_hidangan`,`kode_tipe`,`harga`,`komposisi`,`cara_buat`,`status`,`life_cycle`,`created_at`,`updated_at`) values (4,'216001','Lasagna Daging Sapi','MAC',30000,'','',1,1,'2017-05-19 16:03:18','2017-05-26 23:52:30'),(5,'216001','Es Campur','APP',7500,'','',1,1,'2017-05-19 16:30:17','2017-05-20 09:11:04'),(6,'216001','Pudding','DES',10000,'','',1,1,'2017-05-19 16:44:49','2017-05-20 09:11:04'),(8,'216001','Jus Alpukat','SOF',69000,'','',1,1,'2017-05-19 17:18:10','2017-05-20 09:00:00'),(9,'216001','Ayam Rica - RIca','MAC',35000,'','',1,1,'2017-05-19 18:16:57','2017-05-26 23:53:49'),(10,'216001','Pisang Keju Susu Bakar Teflon','APP',10000,'','',1,1,'2017-05-19 18:30:45','2017-05-20 09:00:00'),(11,'216001','Bubur Sumsum Pelang','DES',7000,'','',1,1,'2017-05-19 18:38:40','2017-05-20 09:00:00'),(12,'216001','Es Blewah Puding Strwaberry','SOF',5000,'','',1,1,'2017-05-19 18:54:28','2017-05-20 09:00:00'),(13,'216001','Es Puding Gembira','SOF',7000,'','',1,1,'2017-05-19 19:00:04','2017-05-20 09:00:00'),(14,'216001','Puding Pepaya Susu','APP',5000,'','',1,1,'2017-05-19 19:07:35','2017-05-20 09:00:00'),(15,'216001','Ikan Gurame bakar','MAC',25000,'','',1,1,'2017-05-19 19:15:21','2017-05-20 09:00:00'),(16,'216001','Bubur Candil Warna - Wani','DES',6500,'','',1,1,'2017-05-19 19:24:04','2017-05-20 09:00:00'),(17,'216001','Nasi Goreng Spesial','MAC',20000,'','',1,1,'2017-05-19 20:56:19','2017-05-26 23:53:49'),(18,'216001','Mie Goreng Udang Spesial','MAC',20000,'','',1,1,'2017-05-19 20:59:39','2017-05-20 09:00:00'),(19,'216001','Mie Ayam Spesial','MAC',20000,'','',1,1,'2017-05-19 21:02:53','2017-05-26 23:53:49'),(20,'216001','Bakso','MAC',10000,'','',1,1,'2017-05-19 21:04:25','2017-05-26 22:13:58'),(21,'216001','Nasi Uduk Spesial','MAC',15000,'','',1,1,'2017-05-19 21:48:02','2017-05-26 23:53:49'),(22,'216001','Sate Ayam Spesial','MAC',25000,'','',1,1,'2017-05-19 21:53:26','2017-05-26 23:53:49'),(23,'216001','sasdasdasd','APP',222,'','',0,1,'2017-05-21 10:37:24','2017-05-21 10:37:24');

/*Table structure for table `ingredient_details` */

DROP TABLE IF EXISTS `ingredient_details`;

CREATE TABLE `ingredient_details` (
  `no_bahan` int(11) NOT NULL,
  `no_reg` int(10) unsigned NOT NULL,
  `tgl_beli` date DEFAULT NULL,
  `tgl_produksi` date DEFAULT NULL,
  `tgl_kadaluarsa` date DEFAULT NULL,
  `jumlah` smallint(5) unsigned DEFAULT '0',
  `keterangan` text,
  KEY `no_bahan` (`no_bahan`),
  CONSTRAINT `ingredient_details_ibfk_1` FOREIGN KEY (`no_bahan`) REFERENCES `ingredients` (`no_bahan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ingredient_details` */

insert  into `ingredient_details`(`no_bahan`,`no_reg`,`tgl_beli`,`tgl_produksi`,`tgl_kadaluarsa`,`jumlah`,`keterangan`) values (2,1,NULL,NULL,NULL,0,NULL),(3,1,NULL,NULL,NULL,0,NULL),(4,1,NULL,NULL,NULL,0,NULL),(5,1,NULL,NULL,NULL,0,NULL),(6,1,NULL,NULL,NULL,0,NULL),(7,1,NULL,NULL,NULL,0,NULL),(8,1,NULL,NULL,NULL,0,NULL),(9,1,NULL,NULL,NULL,0,NULL),(10,1,NULL,NULL,NULL,0,NULL),(11,1,NULL,NULL,NULL,0,NULL),(14,1,NULL,NULL,NULL,0,NULL),(15,1,NULL,NULL,NULL,0,NULL),(16,1,NULL,NULL,NULL,0,NULL),(18,1,NULL,NULL,NULL,0,NULL),(19,1,NULL,NULL,NULL,0,NULL),(20,1,NULL,NULL,NULL,0,NULL),(21,1,NULL,NULL,NULL,0,NULL),(22,1,NULL,NULL,NULL,0,NULL),(23,1,NULL,NULL,NULL,0,NULL),(24,1,NULL,NULL,NULL,0,NULL),(25,1,NULL,NULL,NULL,0,NULL),(26,1,NULL,NULL,NULL,0,NULL),(27,1,NULL,NULL,NULL,0,NULL),(28,1,NULL,NULL,NULL,0,NULL),(29,1,NULL,NULL,NULL,0,NULL),(30,1,NULL,NULL,NULL,0,NULL),(31,1,NULL,NULL,NULL,0,NULL),(32,1,NULL,NULL,NULL,0,NULL),(33,1,NULL,NULL,NULL,0,NULL),(34,1,NULL,NULL,NULL,0,NULL),(35,1,NULL,NULL,NULL,0,NULL),(36,1,NULL,NULL,NULL,0,NULL),(37,1,NULL,NULL,NULL,0,NULL),(38,1,NULL,NULL,NULL,0,NULL),(39,1,NULL,NULL,NULL,0,NULL),(40,1,NULL,NULL,NULL,0,NULL),(41,1,NULL,NULL,NULL,0,NULL),(42,1,NULL,NULL,NULL,0,NULL),(43,1,NULL,NULL,NULL,0,NULL),(44,1,NULL,NULL,NULL,0,NULL),(45,1,NULL,NULL,NULL,0,NULL),(46,1,NULL,NULL,NULL,0,NULL),(47,1,NULL,NULL,NULL,0,NULL),(48,1,NULL,NULL,NULL,0,NULL),(49,1,NULL,NULL,NULL,0,NULL),(50,1,NULL,NULL,NULL,0,NULL),(51,1,NULL,NULL,NULL,0,NULL),(52,1,NULL,NULL,NULL,0,NULL),(53,1,NULL,NULL,NULL,0,NULL),(54,1,NULL,NULL,NULL,0,NULL),(55,1,NULL,NULL,NULL,0,NULL),(56,1,NULL,NULL,NULL,0,NULL),(57,1,NULL,NULL,NULL,0,NULL),(58,1,NULL,NULL,NULL,0,NULL),(59,1,NULL,NULL,NULL,0,NULL),(60,1,NULL,NULL,NULL,0,NULL),(61,1,NULL,NULL,NULL,0,NULL),(62,1,NULL,NULL,NULL,0,NULL),(63,1,NULL,NULL,NULL,0,NULL),(64,1,NULL,NULL,NULL,0,NULL),(65,1,NULL,NULL,NULL,0,NULL),(66,1,NULL,NULL,NULL,0,NULL),(67,1,NULL,NULL,NULL,0,NULL),(68,1,NULL,NULL,NULL,0,NULL),(69,1,NULL,NULL,NULL,0,NULL),(70,1,NULL,NULL,NULL,0,NULL),(71,1,NULL,NULL,NULL,0,NULL),(72,1,NULL,NULL,NULL,0,NULL),(73,1,NULL,NULL,NULL,0,NULL),(74,1,NULL,NULL,NULL,0,NULL),(75,1,NULL,NULL,NULL,0,NULL),(76,1,NULL,NULL,NULL,0,NULL),(77,1,NULL,NULL,NULL,0,NULL),(78,1,NULL,NULL,NULL,0,NULL),(79,1,NULL,NULL,NULL,0,NULL),(1,1,'2017-05-02','2017-05-01','2017-06-07',6,'rak b');

/*Table structure for table `ingredients` */

DROP TABLE IF EXISTS `ingredients`;

CREATE TABLE `ingredients` (
  `no_bahan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bahan` varchar(35) NOT NULL,
  `keterangan` text,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`no_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

/*Data for the table `ingredients` */

insert  into `ingredients`(`no_bahan`,`nama_bahan`,`keterangan`,`status`) values (1,'Seledri','Ikat',1),(2,'Bawang Merah',NULL,1),(3,'Bawang Putih',NULL,1),(4,'Kecap',NULL,1),(5,'Garam',NULL,1),(6,'Mecin',NULL,1),(7,'Gula Merah',NULL,1),(8,'Gula Pasir',NULL,1),(9,'Tomat',NULL,1),(10,'Kentang',NULL,1),(11,'Bawang Bombai',NULL,1),(14,'Ikan Tuna',NULL,1),(15,'Daging Ayam',NULL,1),(16,'Daging Sapi',NULL,1),(18,'Cumi - cumi',NULL,1),(19,'Terasi',NULL,1),(20,'Jeruk Nipis',NULL,1),(21,'Salada',NULL,1),(22,'Jahe',NULL,1),(23,'Minyak Sayur',NULL,1),(24,'Mentega',NULL,1),(25,'Bunga Kol',NULL,1),(26,'Daging Kambing ',NULL,1),(27,'Timun',NULL,1),(28,'Mie ',NULL,1),(29,'Bihun ',NULL,1),(30,'Mie Spageti',NULL,1),(31,'Kopi',NULL,1),(32,'Teh Sariwangi',NULL,1),(33,'Buah Alpukat',NULL,1),(34,'Kepiting',NULL,1),(35,'Udang',NULL,1),(36,'Terigu',NULL,1),(37,'Keju Mozarella',NULL,1),(38,'Saus Tomat',NULL,1),(39,'Buah Semangka',NULL,1),(40,'Buah Nanas ',NULL,1),(41,'Buah Melon',NULL,1),(42,'Buah Pepaya ',NULL,1),(43,'Buah Anggur',NULL,1),(44,'Es Serut',NULL,1),(45,'Air',NULL,1),(46,'Sirup Vanila',NULL,1),(47,'Susu Kental Manis',NULL,1),(48,'Nutrijell',NULL,1),(49,'Ager Swallow',NULL,1),(50,'Susu Beruang Cair',NULL,1),(51,'ssss',NULL,1),(52,'Serai ',NULL,1),(53,'Daun Pandan ',NULL,1),(54,'Daun Jeruk',NULL,1),(55,'Cabai Merah ',NULL,1),(56,'Cabai Rawit Merah',NULL,1),(57,'Buah Pisang',NULL,1),(58,'Blue Band',NULL,1),(59,'Keju Batang',NULL,1),(60,'Mesis Seres',NULL,1),(61,'Tepung Pisang Goreng',NULL,1),(62,'Santan',NULL,1),(63,'Pasta Pandan',NULL,1),(64,'Pasta Ungu',NULL,1),(65,'Gong Puding Strawberry',NULL,1),(66,'Blewah',NULL,1),(67,'Pacar Cina',NULL,1),(68,'Biji Selasih',NULL,1),(69,'Sirup Cocopandan',NULL,1),(70,'Gong Puding Cocopandan',NULL,1),(71,'Gong Puding Vanila',NULL,1),(72,'Susu Cair',NULL,1),(73,'Gong Instan Puding Chocolate',NULL,1),(74,'Air Asam Jawa',NULL,1),(75,'Kecap Manis',NULL,1),(76,'Ikan Gurame',NULL,1),(77,'Tepung Ketan',NULL,1),(78,'Tepung Tapioka',NULL,1),(79,'Cikur',NULL,1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `no_pemesanan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `no_meja` tinyint(3) unsigned DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_bayar` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no_pemesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`no_pemesanan`,`no_meja`,`tanggal`,`status_bayar`) values (1,5,'2017-05-26',3),(2,5,'2017-05-26',1);

/*Table structure for table `recipes` */

DROP TABLE IF EXISTS `recipes`;

CREATE TABLE `recipes` (
  `no_hidangan` smallint(11) unsigned DEFAULT NULL,
  `no_bahan` int(11) DEFAULT NULL,
  `jumlah` smallint(5) unsigned DEFAULT NULL,
  `keterangan` text,
  KEY `no_bahan` (`no_bahan`),
  KEY `no_hidangan` (`no_hidangan`),
  CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`no_bahan`) REFERENCES `ingredients` (`no_bahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recipes_ibfk_3` FOREIGN KEY (`no_hidangan`) REFERENCES `foods` (`no_hidangan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=hebrew;

/*Data for the table `recipes` */

insert  into `recipes`(`no_hidangan`,`no_bahan`,`jumlah`,`keterangan`) values (4,37,2,'lembar'),(4,16,1,'Kilogram'),(4,2,4,'Buah'),(4,3,3,'Buah'),(4,11,5,'Buah'),(4,38,5,'Sendok Makan'),(5,39,100,'Gram'),(5,40,100,'Gram'),(5,41,100,'Gram'),(5,42,100,'Gram'),(5,43,100,'Gram'),(5,47,100,'Mili'),(5,46,5,'Sdm'),(5,44,500,'Gram'),(5,45,1,'Liter'),(6,48,1,'Bungkus'),(6,49,1,'Bungkus'),(6,47,1,'Kaleng'),(6,50,100,'cc'),(6,45,60,'Gram'),(8,33,1,'Buah'),(8,8,2,'Sdm'),(8,47,3,'Sdm'),(8,45,100,'Mili'),(9,15,1,'Ekor'),(9,52,2,'Batang'),(9,2,6,'Buah'),(9,3,7,'Buah'),(9,53,1,'Lembar'),(9,54,5,'Lembar'),(9,45,150,'ml'),(9,23,50,'ml'),(9,20,1,'Buah'),(9,22,4,'cm'),(9,55,12,'Buah'),(9,56,10,'Buah'),(10,57,5,'Buah'),(10,58,3,'Sdm'),(10,59,1,'Secukupnya'),(10,47,1,'Secukupnya'),(10,60,1,'Secukupnya'),(11,61,1,'Bungkus'),(11,62,400,'ml'),(11,5,1,'Sdm'),(11,53,2,'Lembar'),(11,63,1,'Secukupnya'),(11,64,1,'Secukupnya'),(12,65,1,'Bungkus'),(12,66,250,'Gram'),(12,67,4,'Sdm'),(12,68,4,'Sdm'),(12,69,1,'Secukupnya'),(13,70,1,'Bungkus'),(13,71,1,'Bungkus'),(13,45,200,'ml'),(13,72,100,'ml'),(13,68,1,'Sdm'),(14,73,1,'Bungkus'),(14,42,1,'Secukupnya'),(14,47,1,'Secukupnya'),(14,45,500,'ml'),(15,20,2,'Sendok Perasan'),(15,74,1,'Sdm'),(15,75,5,'Sdm'),(15,23,3,'Sdm'),(15,5,1,'Sdm'),(15,76,2,'Ekor'),(16,61,1,'Bungkus'),(16,77,100,'Gram'),(16,78,500,'Gram'),(16,5,1,'Secukupnya'),(16,45,125,'ml'),(16,62,350,'ml'),(16,8,200,'Gram'),(16,53,2,'Lembar'),(17,2,2,NULL),(17,3,2,NULL),(17,4,NULL,NULL),(17,5,NULL,NULL),(17,6,NULL,NULL),(17,15,NULL,NULL),(17,24,NULL,NULL),(17,23,NULL,NULL),(17,27,NULL,NULL),(17,16,NULL,NULL),(18,28,NULL,NULL),(18,2,NULL,NULL),(18,3,NULL,NULL),(18,4,NULL,NULL),(18,5,NULL,NULL),(18,6,NULL,NULL),(18,8,NULL,NULL),(18,35,NULL,NULL),(20,1,NULL,''),(20,2,NULL,''),(20,3,NULL,''),(20,4,NULL,''),(20,5,NULL,''),(20,6,NULL,''),(20,8,NULL,''),(20,16,NULL,''),(20,75,NULL,''),(20,55,NULL,''),(19,2,NULL,''),(19,3,NULL,''),(19,4,NULL,''),(19,5,NULL,''),(19,6,NULL,''),(19,1,NULL,''),(19,8,NULL,''),(19,15,NULL,''),(21,1,NULL,NULL),(21,2,NULL,NULL),(21,3,NULL,NULL),(21,4,NULL,NULL),(21,5,NULL,NULL),(21,6,NULL,NULL),(21,15,NULL,NULL),(21,16,NULL,NULL),(22,15,NULL,NULL),(22,4,NULL,NULL);

/*Table structure for table `shopping_details` */

DROP TABLE IF EXISTS `shopping_details`;

CREATE TABLE `shopping_details` (
  `no_detail` smallint(5) unsigned DEFAULT NULL,
  `no_report` smallint(5) unsigned DEFAULT NULL,
  `no_bahan` int(11) DEFAULT NULL,
  `satuan` varchar(15) DEFAULT '0',
  `jumlah` smallint(5) unsigned DEFAULT '0',
  `keterangan` varchar(30) DEFAULT NULL,
  KEY `no_bahan` (`no_bahan`),
  KEY `no_report` (`no_report`),
  CONSTRAINT `shopping_details_ibfk_1` FOREIGN KEY (`no_bahan`) REFERENCES `ingredients` (`no_bahan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `shopping_details_ibfk_2` FOREIGN KEY (`no_report`) REFERENCES `shopping_reports` (`no_report`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `shopping_details` */

insert  into `shopping_details`(`no_detail`,`no_report`,`no_bahan`,`satuan`,`jumlah`,`keterangan`) values (1,1,15,'14000',5,'Kilogram');

/*Table structure for table `shopping_reports` */

DROP TABLE IF EXISTS `shopping_reports`;

CREATE TABLE `shopping_reports` (
  `no_report` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `NIP` varchar(6) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `budget` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`no_report`),
  KEY `NIP` (`NIP`),
  CONSTRAINT `shopping_reports_ibfk_1` FOREIGN KEY (`NIP`) REFERENCES `employees` (`NIP`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `shopping_reports` */

insert  into `shopping_reports`(`no_report`,`NIP`,`tanggal`,`budget`,`status`,`updated_at`) values (1,'316001','2017-05-26',100000,2,'2017-05-27 00:03:26'),(2,'317002','2017-05-27',0,1,NULL);

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `no_transaksi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_pemesanan` int(11) unsigned NOT NULL,
  `no_hidangan` smallint(11) unsigned DEFAULT NULL,
  `jml_item` smallint(6) NOT NULL DEFAULT '1',
  `catatan` text,
  `status_buat` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`no_transaksi`),
  KEY `no_pemesanan` (`no_pemesanan`),
  KEY `no_hidangan` (`no_hidangan`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`no_hidangan`) REFERENCES `foods` (`no_hidangan`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`no_pemesanan`) REFERENCES `orders` (`no_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `transactions` */

insert  into `transactions`(`no_transaksi`,`no_pemesanan`,`no_hidangan`,`jml_item`,`catatan`,`status_buat`) values (1,1,5,4,'es batu jngn terlalu bnyk',3),(2,2,6,1,NULL,0);

/*Table structure for table `view_jum_bayar` */

DROP TABLE IF EXISTS `view_jum_bayar`;

/*!50001 DROP VIEW IF EXISTS `view_jum_bayar` */;
/*!50001 DROP TABLE IF EXISTS `view_jum_bayar` */;

/*!50001 CREATE TABLE  `view_jum_bayar`(
 `no_pemesanan` int(11) unsigned ,
 `total` decimal(38,0) 
)*/;

/*Table structure for table `view_jum_belanja` */

DROP TABLE IF EXISTS `view_jum_belanja`;

/*!50001 DROP VIEW IF EXISTS `view_jum_belanja` */;
/*!50001 DROP TABLE IF EXISTS `view_jum_belanja` */;

/*!50001 CREATE TABLE  `view_jum_belanja`(
 `no_report` smallint(5) unsigned ,
 `belanja` double 
)*/;

/*Table structure for table `view_jum_kadaluarsa` */

DROP TABLE IF EXISTS `view_jum_kadaluarsa`;

/*!50001 DROP VIEW IF EXISTS `view_jum_kadaluarsa` */;
/*!50001 DROP TABLE IF EXISTS `view_jum_kadaluarsa` */;

/*!50001 CREATE TABLE  `view_jum_kadaluarsa`(
 `no_bahan` int(11) ,
 `jumlah` smallint(5) unsigned 
)*/;

/*Table structure for table `view_jum_total` */

DROP TABLE IF EXISTS `view_jum_total`;

/*!50001 DROP VIEW IF EXISTS `view_jum_total` */;
/*!50001 DROP TABLE IF EXISTS `view_jum_total` */;

/*!50001 CREATE TABLE  `view_jum_total`(
 `no_pemesanan` int(11) unsigned ,
 `total` decimal(38,0) 
)*/;

/*Table structure for table `view_jumlah_bahan` */

DROP TABLE IF EXISTS `view_jumlah_bahan`;

/*!50001 DROP VIEW IF EXISTS `view_jumlah_bahan` */;
/*!50001 DROP TABLE IF EXISTS `view_jumlah_bahan` */;

/*!50001 CREATE TABLE  `view_jumlah_bahan`(
 `no_bahan` int(11) ,
 `jumlah` decimal(27,0) ,
 `kadaluarsa` date ,
 `jum` smallint(5) unsigned 
)*/;

/*Table structure for table `view_pemasukan_harian` */

DROP TABLE IF EXISTS `view_pemasukan_harian`;

/*!50001 DROP VIEW IF EXISTS `view_pemasukan_harian` */;
/*!50001 DROP TABLE IF EXISTS `view_pemasukan_harian` */;

/*!50001 CREATE TABLE  `view_pemasukan_harian`(
 `tanggal` date ,
 `total` decimal(60,0) 
)*/;

/*Table structure for table `view_tgl_kadaluarsa` */

DROP TABLE IF EXISTS `view_tgl_kadaluarsa`;

/*!50001 DROP VIEW IF EXISTS `view_tgl_kadaluarsa` */;
/*!50001 DROP TABLE IF EXISTS `view_tgl_kadaluarsa` */;

/*!50001 CREATE TABLE  `view_tgl_kadaluarsa`(
 `no_bahan` int(11) ,
 `kadaluarsa` date 
)*/;

/*View structure for view view_jum_bayar */

/*!50001 DROP TABLE IF EXISTS `view_jum_bayar` */;
/*!50001 DROP VIEW IF EXISTS `view_jum_bayar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jum_bayar` AS (select `a`.`no_pemesanan` AS `no_pemesanan`,sum((`a`.`jml_item` * `b`.`harga`)) AS `total` from (`transactions` `a` join `foods` `b` on((`a`.`no_hidangan` = `b`.`no_hidangan`))) group by `a`.`no_pemesanan`) */;

/*View structure for view view_jum_belanja */

/*!50001 DROP TABLE IF EXISTS `view_jum_belanja` */;
/*!50001 DROP VIEW IF EXISTS `view_jum_belanja` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jum_belanja` AS (select `shopping_details`.`no_report` AS `no_report`,sum((`shopping_details`.`satuan` * `shopping_details`.`jumlah`)) AS `belanja` from `shopping_details` group by `shopping_details`.`no_report`) */;

/*View structure for view view_jum_kadaluarsa */

/*!50001 DROP TABLE IF EXISTS `view_jum_kadaluarsa` */;
/*!50001 DROP VIEW IF EXISTS `view_jum_kadaluarsa` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jum_kadaluarsa` AS (select `ingredient_details`.`no_bahan` AS `no_bahan`,`ingredient_details`.`jumlah` AS `jumlah` from `ingredient_details` where `ingredient_details`.`tgl_kadaluarsa` in (select min(`ingredient_details`.`tgl_kadaluarsa`) AS `tgl_kadaluarsa` from `ingredient_details` group by `ingredient_details`.`no_bahan`) group by `ingredient_details`.`no_bahan`) */;

/*View structure for view view_jum_total */

/*!50001 DROP TABLE IF EXISTS `view_jum_total` */;
/*!50001 DROP VIEW IF EXISTS `view_jum_total` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jum_total` AS (select `a`.`no_pemesanan` AS `no_pemesanan`,sum((`b`.`harga` * `a`.`jml_item`)) AS `total` from (`transactions` `a` join `foods` `b`) where (`a`.`no_hidangan` = `b`.`no_hidangan`) group by `a`.`no_pemesanan`) */;

/*View structure for view view_jumlah_bahan */

/*!50001 DROP TABLE IF EXISTS `view_jumlah_bahan` */;
/*!50001 DROP VIEW IF EXISTS `view_jumlah_bahan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jumlah_bahan` AS (select `a`.`no_bahan` AS `no_bahan`,sum(`a`.`jumlah`) AS `jumlah`,`b`.`kadaluarsa` AS `kadaluarsa`,`c`.`jumlah` AS `jum` from ((`ingredient_details` `a` left join `view_tgl_kadaluarsa` `b` on((`a`.`no_bahan` = `b`.`no_bahan`))) left join `view_jum_kadaluarsa` `c` on((`a`.`no_bahan` = `c`.`no_bahan`))) group by `a`.`no_bahan`) */;

/*View structure for view view_pemasukan_harian */

/*!50001 DROP TABLE IF EXISTS `view_pemasukan_harian` */;
/*!50001 DROP VIEW IF EXISTS `view_pemasukan_harian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pemasukan_harian` AS (select `a`.`tanggal` AS `tanggal`,sum(`b`.`total`) AS `total` from (`orders` `a` join `view_jum_total` `b`) where (`a`.`no_pemesanan` = `b`.`no_pemesanan`) group by `a`.`tanggal`) */;

/*View structure for view view_tgl_kadaluarsa */

/*!50001 DROP TABLE IF EXISTS `view_tgl_kadaluarsa` */;
/*!50001 DROP VIEW IF EXISTS `view_tgl_kadaluarsa` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tgl_kadaluarsa` AS (select `ingredient_details`.`no_bahan` AS `no_bahan`,min(`ingredient_details`.`tgl_kadaluarsa`) AS `kadaluarsa` from `ingredient_details` where ((`ingredient_details`.`tgl_kadaluarsa` <> '0000-00-00') and (`ingredient_details`.`tgl_kadaluarsa` is not null)) group by `ingredient_details`.`no_bahan`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 10.1.26-MariaDB : Database - apgt1743_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`apgt1743_test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `apgt1743_test`;

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`ID`,`Keterangan`) values 
(1,'Miskonsepsi'),
(2,'Tidak Paham Konsep'),
(3,'Eror'),
(4,'Paham');

/*Table structure for table `kombinasi` */

DROP TABLE IF EXISTS `kombinasi`;

CREATE TABLE `kombinasi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDKategori` int(11) NOT NULL,
  `Jawaban` enum('Benar','Salah') DEFAULT NULL,
  `RatingJawaban` enum('Yakin','Tidak') DEFAULT NULL,
  `Alasan` enum('Benar','Salah') DEFAULT NULL,
  `RatingAlasan` enum('Yakin','Tidak') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `kombinasi` */

insert  into `kombinasi`(`ID`,`IDKategori`,`Jawaban`,`RatingJawaban`,`Alasan`,`RatingAlasan`) values 
(1,1,'Benar','Yakin','Salah','Yakin'),
(2,1,'Benar','Tidak','Salah','Yakin'),
(3,1,'Salah','Yakin','Salah','Yakin'),
(4,1,'Salah','Tidak','Salah','Yakin'),
(5,2,'Benar','Yakin','Benar','Tidak'),
(6,2,'Benar','Yakin','Salah','Tidak'),
(7,2,'Benar','Tidak','Benar','Yakin'),
(8,2,'Benar','Tidak','Benar','Tidak'),
(9,2,'Benar','Tidak','Salah','Tidak'),
(10,2,'Salah','Yakin','Benar','Tidak'),
(11,2,'Salah','Yakin','Salah','Tidak'),
(12,2,'Salah','Tidak','Benar','Tidak'),
(13,2,'Salah','Tidak','Salah','Tidak'),
(14,3,'Salah','Yakin','Benar','Yakin'),
(15,3,'Salah','Tidak','Benar','Yakin'),
(16,4,'Benar','Yakin','Benar','Yakin');

/*Table structure for table `soal` */

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Soal` longtext NOT NULL,
  `Jawaban` int(11) NOT NULL COMMENT 'Urutan pada soal_pilihan',
  `JawabanAlasan` int(11) NOT NULL,
  `TypePembahasan` enum('1','2') DEFAULT NULL,
  `Pembahasan` text,
  `CreatedBy` varchar(20) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

/*Table structure for table `soal_alasan` */

DROP TABLE IF EXISTS `soal_alasan`;

CREATE TABLE `soal_alasan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDSoal` int(11) NOT NULL,
  `Urutan` int(11) DEFAULT NULL,
  `Keterangan` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `soal_alasan` */

/*Table structure for table `soal_pilihan` */

DROP TABLE IF EXISTS `soal_pilihan`;

CREATE TABLE `soal_pilihan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDSoal` int(11) NOT NULL,
  `Urutan` int(11) NOT NULL,
  `Keterangan` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `soal_pilihan` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(255) DEFAULT NULL,
  `Sebagai` enum('siswa','guru') DEFAULT 'siswa',
  `NIS` varchar(20) DEFAULT NULL COMMENT 'Hanya untuk siswa',
  `Kelas` int(11) DEFAULT NULL COMMENT 'Hanya untuk siswa',
  `Sekolah` varchar(255) DEFAULT NULL COMMENT 'Hanya untuk siswa',
  `Username` varchar(100) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`ID`,`Nama`,`Sebagai`,`NIS`,`Kelas`,`Sekolah`,`Username`,`Email`,`Password`,`CreatedAt`) values 
(1,'Siswanto','siswa','123213',3,'SMANDUK','sis123','sis@mail.com','e10adc3949ba59abbe56e057f20f883e','2019-03-07 00:00:00'),
(2,'Nandang','guru','',0,'','ndang','n@mail.com','4297f44b13955235245b2497399d7a93','2019-03-07 23:01:08');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

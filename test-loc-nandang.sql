/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 10.1.30-MariaDB : Database - learning
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`learning` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `learning`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(200) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Status` enum('0','1') DEFAULT NULL COMMENT '0 = tidak bisa di hapus',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`ID`,`Username`,`Password`,`Status`) values 
(1,'admin','f6fdffe48c908deb0f4c3bd36c032e72','1');

/*Table structure for table `biodata` */

DROP TABLE IF EXISTS `biodata`;

CREATE TABLE `biodata` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Biodata` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `biodata` */

insert  into `biodata`(`ID`,`Biodata`) values 
(1,'<p class=\"MsoNormalCxSpFirst\" style=\"text-align:justify;line-height:150%\"><span style=\"font-size:12.0pt;mso-bidi-font-size:11.0pt;line-height:150%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-ansi-language:EN-US\" lang=\"EN-US\">Rizki Annisa,\nS.Pd, lahir di Tegal pada tanggal 22 juni 1995, merupakan mahasiswa\npascasarjana pendidikan fisika di Universitas Negeri Semarang. Pengembang\nmemulai pendidikan di SD Negeri Bersole 01, SMP Negeri 02 Adiwerna, SMA Negeri\n03 Slawi, dan meraih gelar sarjana di Universitas Negeri semarang tahun 2017. </span></p><p class=\"MsoNormalCxSpFirst\" style=\"text-align:justify;line-height:150%\"><span style=\"font-size:12.0pt;mso-bidi-font-size:11.0pt;line-height:150%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-ansi-language:EN-US\" lang=\"EN-US\">Pengembang\nterlibat aktif dalam organisasi </span><span style=\"font-size:12.0pt;\nline-height:150%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-ansi-language:EN-ID\" lang=\"EN-ID\">intra\nkampus yaitu GERHANA (Gerakan Mahasiswa Anti Narkoba) periode tahun 2013-2016.<span style=\"mso-spacerun:yes\">&nbsp; </span>Seminar yang pernah diikuti sebagai pemakalah\nyaitu Seminar Nasional Sains &amp; Pendidikan Sains XI 2018 dan Seminar\nNasional Mahasiswa Fisika ke-5 2018. Pengembang juga memiliki hak cipta berupa buku\nmodul \"Alat Praktikum Indeks Bias Zat Cair Menggunakan Lampu Bohlam\"\ntahun 2018 dan hak cipta buku “Tamasya Ke Pulau Bintang” tahun 2018. Jurnal\nyang pernah dipublikasikan diantaranya: Pengembangan Media Pembelajaran Berupa\nBuku Cerita Fisika untuk Materi Energi dan Daya Listrik di sekolah Menengah\nPertama (<i style=\"mso-bidi-font-style:normal\">Unnes Physics Education Journal</i>,\n2017), Peningkatan Daya Ingat dan Hasil Belajar Siswa dengan <i style=\"mso-bidi-font-style:normal\">Mind Mapping Method</i> pada Materi Listrik\nDinamis (Jurnal Pendidikan Teori dan Praktik, 2018), dan <i style=\"mso-bidi-font-style:\nnormal\">Light Bulb Substitute Lens for Measuring Liquid Bias Index\n(International Journal of Active Learning</i>, 2019).</span></p>\n\n<p class=\"MsoNormal\"><span style=\"mso-ansi-language:EN-US\" lang=\"EN-US\">&nbsp;</span></p>\n\n<p class=\"MsoNormal\"><span style=\"mso-ansi-language:EN-US\" lang=\"EN-US\">&nbsp;</span></p>\n\n');

/*Table structure for table `indikator` */

DROP TABLE IF EXISTS `indikator`;

CREATE TABLE `indikator` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Indikator` varchar(200) DEFAULT NULL,
  `CreatedBy` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `indikator` */

insert  into `indikator`(`ID`,`Indikator`,`CreatedBy`) values 
(1,'Indikator 1','3'),
(18,'Indikator 2','3'),
(19,'Indikator 3','3'),
(20,'Indikator 4','3'),
(21,'Indikator 5','3'),
(22,'Indikator 6','3'),
(23,'Indikator 7','3'),
(24,'Indikator 8','3'),
(25,'Indikator 9','3'),
(26,'Indikator 10','3'),
(27,'Indikator 11','3'),
(28,'Indikator 12','3');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`ID`,`Keterangan`) values 
(1,'Paham'),
(2,'Tidak Paham'),
(3,'Miskonsepsi');

/*Table structure for table `kombinasi` */

DROP TABLE IF EXISTS `kombinasi`;

CREATE TABLE `kombinasi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDKategori` int(11) NOT NULL,
  `Jawaban` enum('Benar','Salah') DEFAULT NULL,
  `RatingJawaban` enum('Tinggi','Rendah') DEFAULT NULL,
  `Alasan` enum('Benar','Salah') DEFAULT NULL,
  `RatingAlasan` enum('Tinggi','Rendah') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `kombinasi` */

insert  into `kombinasi`(`ID`,`IDKategori`,`Jawaban`,`RatingJawaban`,`Alasan`,`RatingAlasan`) values 
(1,1,'Benar','Tinggi','Benar','Tinggi'),
(2,2,'Benar','Rendah','Benar','Rendah'),
(3,2,'Benar','Tinggi','Benar','Rendah'),
(4,2,'Benar','Rendah','Benar','Tinggi'),
(5,2,'Benar','Rendah','Salah','Rendah'),
(6,2,'Salah','Rendah','Benar','Rendah'),
(7,2,'Salah','Rendah','Salah','Rendah'),
(8,2,'Benar','Tinggi','Salah','Rendah'),
(9,2,'Salah','Rendah','Benar','Tinggi'),
(10,3,'Benar','Rendah','Salah','Tinggi'),
(11,3,'Benar','Tinggi','Salah','Tinggi'),
(12,3,'Salah','Tinggi','Benar','Rendah'),
(13,3,'Salah','Tinggi','Benar','Tinggi'),
(14,3,'Salah','Tinggi','Salah','Rendah'),
(15,3,'Salah','Rendah','Salah','Tinggi'),
(16,3,'Salah','Tinggi','Salah','Tinggi');

/*Table structure for table `pembahasan` */

DROP TABLE IF EXISTS `pembahasan`;

CREATE TABLE `pembahasan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDIndikator` int(11) NOT NULL,
  `Type` int(11) NOT NULL COMMENT '1 = Text, 2 = PDF, 3 = Link Youtube',
  `Penjelasan` longtext,
  `File` varchar(200) DEFAULT NULL,
  `FileDesc` varchar(200) DEFAULT NULL,
  `Link` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `pembahasan` */

insert  into `pembahasan`(`ID`,`IDIndikator`,`Type`,`Penjelasan`,`File`,`FileDesc`,`Link`) values 
(1,1,3,NULL,'','','https://youtu.be/Iw8drIv2N9E'),
(2,19,3,NULL,'','','https://youtu.be/P5hJzS0OWoI'),
(3,28,3,NULL,'','','https://youtu.be/P5hJzS0OWoI'),
(4,27,3,NULL,'','','https://youtu.be/P5hJzS0OWoI'),
(5,26,3,NULL,'','','https://youtu.be/P5hJzS0OWoI'),
(8,25,1,'<p><strong>Hukum gravitasi Newton</strong>&nbsp;adalah kesimpulan Newton bahwa gaya tarik gravitasi yang bekerja antara dua benda sebanding dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak kedua benda. Gravitasi bumi merupakan salah satu ciri bumi, yaitu benda-benda ditarik ke arah pusat bumi. Gaya tarik bumi terhadap benda-benda ini dinamakan gaya gravitasi bumi.<br>Besar gaya tarik-menarik ini berbanding lurus dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak antara keduanya.</p><p><img src=\"https://sumberbelajar.belajar.kemdikbud.go.id/file_storage/t2016/k42_66/media/rumus_besar_gaya_tarik.jpg\" width=\"101\" height=\"40\"></p><p>Dimana:<br>F = gaya tarik gravitasi (N)<br>m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">1</span>, m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">2</span>&nbsp;= massa masing-masing benda (kg)<br>r = jarak antara kedua benda (m)<br>G = konstanta gravitasi umum (6,673 x 10<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">–11</span>Nm<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>/kg<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>)</p>','','',NULL),
(9,24,1,'<p><strong>Hukum gravitasi Newton</strong>&nbsp;adalah kesimpulan Newton bahwa gaya tarik gravitasi yang bekerja antara dua benda sebanding dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak kedua benda. Gravitasi bumi merupakan salah satu ciri bumi, yaitu benda-benda ditarik ke arah pusat bumi. Gaya tarik bumi terhadap benda-benda ini dinamakan gaya gravitasi bumi.<br>Besar gaya tarik-menarik ini berbanding lurus dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak antara keduanya.</p><p><img src=\"https://sumberbelajar.belajar.kemdikbud.go.id/file_storage/t2016/k42_66/media/rumus_besar_gaya_tarik.jpg\" width=\"101\" height=\"40\"></p><p>Dimana:<br>F = gaya tarik gravitasi (N)<br>m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">1</span>, m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">2</span>&nbsp;= massa masing-masing benda (kg)<br>r = jarak antara kedua benda (m)<br>G = konstanta gravitasi umum (6,673 x 10<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">–11</span>Nm<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>/kg<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>)</p>','','',NULL),
(10,23,1,'<p><strong>Hukum gravitasi Newton</strong>&nbsp;adalah kesimpulan Newton bahwa gaya tarik gravitasi yang bekerja antara dua benda sebanding dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak kedua benda. Gravitasi bumi merupakan salah satu ciri bumi, yaitu benda-benda ditarik ke arah pusat bumi. Gaya tarik bumi terhadap benda-benda ini dinamakan gaya gravitasi bumi.<br>Besar gaya tarik-menarik ini berbanding lurus dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak antara keduanya.</p><p><img src=\"https://sumberbelajar.belajar.kemdikbud.go.id/file_storage/t2016/k42_66/media/rumus_besar_gaya_tarik.jpg\" width=\"101\" height=\"40\"></p><p>Dimana:<br>F = gaya tarik gravitasi (N)<br>m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">1</span>, m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">2</span>&nbsp;= massa masing-masing benda (kg)<br>r = jarak antara kedua benda (m)<br>G = konstanta gravitasi umum (6,673 x 10<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">–11</span>Nm<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>/kg<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>)</p>','','',NULL),
(11,22,1,'<p><strong>Hukum gravitasi Newton</strong>&nbsp;adalah kesimpulan Newton bahwa gaya tarik gravitasi yang bekerja antara dua benda sebanding dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak kedua benda. Gravitasi bumi merupakan salah satu ciri bumi, yaitu benda-benda ditarik ke arah pusat bumi. Gaya tarik bumi terhadap benda-benda ini dinamakan gaya gravitasi bumi.<br>Besar gaya tarik-menarik ini berbanding lurus dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak antara keduanya.</p><p><img src=\"https://sumberbelajar.belajar.kemdikbud.go.id/file_storage/t2016/k42_66/media/rumus_besar_gaya_tarik.jpg\" width=\"101\" height=\"40\"></p><p>Dimana:<br>F = gaya tarik gravitasi (N)<br>m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">1</span>, m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">2</span>&nbsp;= massa masing-masing benda (kg)<br>r = jarak antara kedua benda (m)<br>G = konstanta gravitasi umum (6,673 x 10<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">–11</span>Nm<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>/kg<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>)</p>','','',NULL),
(12,21,1,'<p><strong>Hukum gravitasi Newton</strong>&nbsp;adalah kesimpulan Newton bahwa gaya tarik gravitasi yang bekerja antara dua benda sebanding dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak kedua benda. Gravitasi bumi merupakan salah satu ciri bumi, yaitu benda-benda ditarik ke arah pusat bumi. Gaya tarik bumi terhadap benda-benda ini dinamakan gaya gravitasi bumi.<br>Besar gaya tarik-menarik ini berbanding lurus dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak antara keduanya.</p><p><img src=\"https://sumberbelajar.belajar.kemdikbud.go.id/file_storage/t2016/k42_66/media/rumus_besar_gaya_tarik.jpg\" width=\"101\" height=\"40\"></p><p>Dimana:<br>F = gaya tarik gravitasi (N)<br>m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">1</span>, m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">2</span>&nbsp;= massa masing-masing benda (kg)<br>r = jarak antara kedua benda (m)<br>G = konstanta gravitasi umum (6,673 x 10<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">–11</span>Nm<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>/kg<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>)</p>','','',NULL),
(13,20,1,'<p><strong>Hukum gravitasi Newton</strong>&nbsp;adalah kesimpulan Newton bahwa gaya tarik gravitasi yang bekerja antara dua benda sebanding dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak kedua benda. Gravitasi bumi merupakan salah satu ciri bumi, yaitu benda-benda ditarik ke arah pusat bumi. Gaya tarik bumi terhadap benda-benda ini dinamakan gaya gravitasi bumi.<br>Besar gaya tarik-menarik ini berbanding lurus dengan massa masing-masing benda dan berbanding terbalik dengan kuadrat jarak antara keduanya.</p><p><img src=\"https://sumberbelajar.belajar.kemdikbud.go.id/file_storage/t2016/k42_66/media/rumus_besar_gaya_tarik.jpg\" width=\"101\" height=\"40\"></p><p>Dimana:<br>F = gaya tarik gravitasi (N)<br>m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">1</span>, m<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; bottom: -0.25em;\">2</span>&nbsp;= massa masing-masing benda (kg)<br>r = jarak antara kedua benda (m)<br>G = konstanta gravitasi umum (6,673 x 10<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">–11</span>Nm<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>/kg<span style=\"position: relative; font-size: 10.5px; line-height: 0; vertical-align: baseline; top: -0.5em;\">2</span>)</p>','','',NULL),
(14,18,3,NULL,'','','https://youtu.be/LJeG188j_co');

/*Table structure for table `pembahasan_type` */

DROP TABLE IF EXISTS `pembahasan_type`;

CREATE TABLE `pembahasan_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pembahasan_type` */

insert  into `pembahasan_type`(`ID`,`Keterangan`) values 
(1,'Penjelasan'),
(2,'File PDF'),
(3,'Youtube');

/*Table structure for table `rekap3` */

DROP TABLE IF EXISTS `rekap3`;

CREATE TABLE `rekap3` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `IDGelombang` int(11) NOT NULL,
  `IDSoal` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Hasil` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rekap3` */

/*Table structure for table `sekolah` */

DROP TABLE IF EXISTS `sekolah`;

CREATE TABLE `sekolah` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Alamat` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `sekolah` */

insert  into `sekolah`(`ID`,`Name`,`Alamat`) values 
(1,'SMA N 3 Slawi',NULL),
(2,'SMA N 1 Dukuh waru',NULL),
(3,'SMA N 1 Slawi',NULL);

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDST` int(11) DEFAULT NULL,
  `Nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `setting` */

insert  into `setting`(`ID`,`IDST`,`Nilai`) values 
(1,1,10),
(2,2,5),
(3,3,1);

/*Table structure for table `setting_aturan` */

DROP TABLE IF EXISTS `setting_aturan`;

CREATE TABLE `setting_aturan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Deskripsi` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `setting_aturan` */

insert  into `setting_aturan`(`ID`,`Deskripsi`) values 
(1,'<p>test ok mantu</p>');

/*Table structure for table `setting_gelombang` */

DROP TABLE IF EXISTS `setting_gelombang`;

CREATE TABLE `setting_gelombang` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(200) NOT NULL,
  `Nilai` int(11) NOT NULL,
  `Status` enum('0','1') DEFAULT NULL COMMENT '0 = Non aktif, 1 = Aktif',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `setting_gelombang` */

insert  into `setting_gelombang`(`ID`,`Nama`,`Nilai`,`Status`) values 
(1,'Gelombang 1',12,'1'),
(2,'Gelombang 2',3,'0'),
(3,'Gelombang 3',22,'0');

/*Table structure for table `setting_tipe` */

DROP TABLE IF EXISTS `setting_tipe`;

CREATE TABLE `setting_tipe` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `setting_tipe` */

insert  into `setting_tipe`(`ID`,`Keterangan`) values 
(1,'Jumlah Soal Untuk Murid'),
(2,'Waktu Pengerjaan'),
(3,'Button Remidial');

/*Table structure for table `soal` */

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDIndikator` int(11) DEFAULT NULL,
  `Soal` longtext NOT NULL,
  `Jawaban` int(11) NOT NULL COMMENT 'Urutan pada soal_pilihan',
  `JawabanAlasan` int(11) NOT NULL,
  `TypePembahasan` enum('1','2') DEFAULT NULL,
  `Pembahasan` text,
  `TypeSoal` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 = Soal utama, 2 = Soal Cadangan',
  `CreatedBy` varchar(20) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `LastUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

insert  into `soal`(`ID`,`IDIndikator`,`Soal`,`Jawaban`,`JawabanAlasan`,`TypePembahasan`,`Pembahasan`,`TypeSoal`,`CreatedBy`,`CreatedAt`,`LastUpdated`) values 
(1,22,'<span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Jika\ngaya gravitasi antara Bulan dan Bumi diberhentikan, pernyataan terbaik yang\nmenjelaskan gerak Bulan adalah. . . .</span><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',3,3,'1','','1','3','2019-08-23 22:42:16','2019-08-24 19:43:03'),
(2,23,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Seorang astronot melayang di dalam pesawat angkasa\nyang sedang mengintari bumi, penyebab peristiwa tersebut karena. . . .</span><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',3,4,'1','','1','3','2019-08-23 22:47:09','2019-08-24 19:53:02'),
(3,1,'<p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><img src=\"http://localhost:8080/learning/assets/images/body.PNG\" style=\"width: 716px;\"><span style=\"text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><br></span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">Besar\ngaya gravitasi antara dua buah benda yang saling berinteraksi adalah….</span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";=\"\" mso-bidi-font-family:\"times=\"\" roman\";mso-bidi-theme-font:minor-bidi\"=\"\"><o:p></o:p></span></p>',3,1,'1','','1','3','2019-08-23 23:12:22','2019-09-21 10:25:49'),
(4,18,'<p><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Tetapan\ngravitasi G memiliki satuan-satuan dasar SI yaitu . . . .</span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',2,2,'1','','1','3','2019-08-23 23:41:34',NULL),
(5,19,'<span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Sebuah\nbenda bermassa 10 kg berada di permukaan bumi akan di pindahkan ke planet Mars,\nmaka besaran yang tidak mengalami perubahan adalah . . . .</span><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\nmso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',4,3,'1','','1','3','2019-08-23 23:46:36',NULL),
(6,20,'<span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Massa\nplanet merkurius </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan venus masing-masing\nyaitu </span><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">3,28 x\n10<sup>23 </sup></span><sup style=\"text-align: justify; text-indent: -0.25in;\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi;mso-ansi-language:EN-US\"> </span></sup><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Kg dan 4,87 x 10<sup>24</sup>\nKg. Kedua planet tersebut berjarak R. Berapa gaya gravitasi antara planet\nmerkurius dan venus? (G= 6,67 x 10<sup>-11</sup> Nm<sup>2</sup>/Kg<sup>2</sup>).\n. . .</span><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;\nline-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',3,4,'1','','1','3','2019-08-23 23:51:53','2019-08-23 23:53:52'),
(7,21,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Dua benda identik terpisah pada jarak 10 cm. Apabila\nkedua benda mengalami gaya tarik-menarik sebesar 6,003 </span><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">x 10<sup>-20  </sup>N, massa kedua benda t</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">ersebut </span><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">adalah. . . .</span><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"> </span><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">(G= 6,67 x 10<sup>-11</sup> Nm<sup>2</sup>/kg<sup>2</sup>).\n. . .</span><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',5,1,'1','','1','3','2019-08-24 19:31:38','2019-08-24 19:35:53'),
(8,24,'<p><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">Perhatikan\ngambar di bawah ini!</span></p><p><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><br></span><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt; text-align: justify;\">Massa planet A sekitar 9 kali massa planet B\ndan jarak antar pusat planet A ke planet B adalah R. Suatu benda uji bermassa m\nyang berada pada jarak r dari pusat planet A dan pada garis lurus yang\nmenghubungkan kedua planet memiliki gaya gravitasi nol. Jarak r tersebut adalah\n. . . . R.</span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;line-height:115%\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;line-height:115%\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";mso-bidi-font-family:\"times=\"\" roman\";=\"\" mso-bidi-theme-font:minor-bidi\"=\"\"><o:p></o:p></span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;line-height:115%\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";mso-bidi-font-family:\"times=\"\" roman\";=\"\" mso-bidi-theme-font:minor-bidi\"=\"\"><o:p></o:p></span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";=\"\" mso-bidi-font-family:\"times=\"\" roman\";mso-bidi-theme-font:minor-bidi\"=\"\"><o:p></o:p></span></p>',5,4,'1','','1','3','2019-08-24 20:00:09','2019-08-24 20:06:45'),
(9,25,'<p><b style=\"text-align: justify;\"><span lang=\"EN-US\" style=\"font-size:14.0pt;\nline-height:115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";mso-bidi-font-family:=\"\" \"times=\"\" roman\";mso-bidi-theme-font:minor-bidi;mso-ansi-language:en-us\"=\"\">Pertanyaan\nnomor 9 dan 10 menggunakan ilustrasi berikut sebagai acuan.</span></b></p>\n\n<p class=\"MsoNormal\" style=\"text-align:justify;line-height:115%\"><span lang=\"EN-US\" style=\"font-size:14.0pt;line-height:115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";=\"\" mso-bidi-font-family:\"times=\"\" roman\";mso-bidi-theme-font:minor-bidi;=\"\" mso-ansi-language:en-us\"=\"\">Sebuah roket meluncur ke atas dari permukaan bumi\nmenuju Bulan. Roket tersebut naik sampai mencapai ketinggian yang sama dengan\njari-jari bumi dan kemudian kembali ke bawah ke arah permukaan bumi.</span></p><p class=\"MsoNormal\" style=\"text-align:justify;line-height:115%\"><span lang=\"EN-US\" style=\"font-size:14.0pt;line-height:115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";=\"\" mso-bidi-font-family:\"times=\"\" roman\";mso-bidi-theme-font:minor-bidi;=\"\" mso-ansi-language:en-us\"=\"\"><br></span><span style=\"font-size: 14pt; text-indent: -0.25in;\">Jika ada, gaya-gaya yang bekerja pada roket sementara\nroket bergerak naik adalah. . . .</span></p>',3,2,'1','','1','3','2019-08-24 20:11:56','2019-08-24 20:14:12'),
(10,26,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Percepatan roket pada puncak lintasannya adalah. . . .</span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',4,1,'1','','1','3','2019-08-24 20:17:27','2019-08-24 20:21:46'),
(11,27,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Berat sebuah roket di permukaan bumi 10.000 N. Jika\nroket berada pada ketinggian sama dengan jari-jari bumi di atas permukaan bumi,\nberatnya akan menjadi. . . . </span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',2,2,'1','','1','3','2019-08-24 20:30:38','2019-08-24 20:32:11'),
(12,28,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Perhatikan gambar berikut!</span></p><p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><br></span><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt; text-align: justify;\">Empat\nbuah satelit mengorbit pada bumi, urutan satelit yang memiliki gaya gravitasi\ndari terbesar sampai terkecil adalah. . . . </span></p><p class=\"MsoListParagraph\" style=\"margin-left:.25in;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>',3,2,'1','','1','3','2019-08-24 20:35:05','2019-08-24 20:36:31');

/*Table structure for table `soal_alasan` */

DROP TABLE IF EXISTS `soal_alasan`;

CREATE TABLE `soal_alasan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDSoal` int(11) NOT NULL,
  `Urutan` int(11) DEFAULT NULL,
  `Keterangan` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;

/*Data for the table `soal_alasan` */

insert  into `soal_alasan`(`ID`,`IDSoal`,`Urutan`,`Keterangan`) values 
(17,4,1,'<span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Tetapan\ngravitasi </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">adalah </span><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">hasil kali massa dibagi gaya dan\nkuadrat jarak</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:39.3pt;mso-add-space:auto;text-align:justify;text-indent:\n-21.3pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(18,4,2,'<p><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Tetapan\ngravitasi memiliki satuan Nm<sup>2</sup>/kg<sup>2</sup></span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:39.3pt;mso-add-space:auto;text-align:justify;text-indent:\n-21.3pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(19,4,3,'<p><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Tetapan\ngravitasi</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"> adalah</span><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"> hasil kali gaya dan jarak dibagi\nmassa kedua benda</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:39.3pt;mso-add-space:auto;text-align:justify;text-indent:\n-21.3pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(20,4,4,'<span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Tetapan\ngravitasi </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">adalah </span><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">hasil kali massa dibagi gaya dan\njarak</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:39.3pt;mso-add-space:auto;text-align:justify;text-indent:\n-21.3pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(21,5,1,'<p><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">Percepatan gravitasi di seluruh alam semesta bernilai\ntetap</span></p>'),
(22,5,2,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Berat suatu\nbenda tidak mempengaruhi percepatan gravitasi</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(23,5,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Massa suatu\nbenda tidak mempengaruhi percepatan gravitasi</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(24,5,4,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Massa dan\nberat suatu benda tidak mempengaruhi percepatan gravitasi</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(29,6,1,'<p style=\"text-align: left;\"><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan massa </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">kedua benda </span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan berbanding terbalik dengan jaraknya</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(30,6,2,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan hasil kali massa\n</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">kedua\nbenda </span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan berbanding terbalik dengan jaraknya</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(31,6,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan massa </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">kedua benda </span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan berbanding terbalik dengan kuadrat\njaraknya</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(32,6,4,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan hasil kali massa\n</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">kedua\nbenda </span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan berbanding terbalik dengan kuadrat\njaraknya</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(42,7,1,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan hasil kali massa</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"> kedua benda</span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"> dan berbanding terbalik dengan kuadrat\njaraknya</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(43,7,2,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan massa </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">kedua benda</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"> </span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan berbanding terbalik dengan kuadrat jaraknya</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(44,7,3,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan massa </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">kedua benda</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"> </span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan berbanding terbalik dengan jaraknya</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(45,7,4,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan hasil kali massa\n</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">kedua\nbenda</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"> </span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan berbanding terbalik dengan jaraknya</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(50,1,1,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Bulan berotasi\nkarena ada gaya intrinsik bulan itu sendiri</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(51,1,2,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Lintasan bulan\nberbentuk lingkaran diluar bumi sehingga tetap berotasi</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(52,1,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Bulan\nmengintari bumi karena adanya gaya gravitasi antara bulan dan bumi</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(53,1,4,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Bulan berotasi\ntidak ada pengaruh dari gaya gravitasi bumi</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span lang=\"EN-US\" style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(58,2,1,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Jarak antara bumi dan astronot yang jauh\nsehingga gaya gravitasi sama dengan nol</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(59,2,2,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Posisi bumi,\nastronot, dan bulan selalu berada dalam satu garis </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">sehingga gaya\ngravitasinya saling meniadakan</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(60,2,3,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi berbanding terbalik dengan\nkuadrat jarak, gravitasi menjadi nol saat posisi astronot semakin menjauh</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span lang=\"EN-US\" style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(61,2,4,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Astronot melayang akibat ada gaya sentripetal\nyang berfungsi menahan pesawat dan astronot sehingga tidak terpental</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span lang=\"EN-US\" style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(71,8,1,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya gravitasi\npada benda C nol jika gaya gravitasi yang dialami benda A sama dengan gaya\ngravitasi yang dialami benda B</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(72,8,2,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya gravitasi\npada benda C nol jika gaya gravitasi yang dialami benda A tidak sama dengan\ngaya gravitasi yang dialami benda B</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(73,8,3,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya gravitasi\npada benda C nol jika gaya gravitasi yang dialami benda C akibat gaya tarik\nbenda A tidak sama dengan gaya gravitasi yang dialami benda C akibat gaya tarik\nbenda B</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(74,8,4,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya gravitasi\npada benda C nol jika gaya gravitasi yang dialami benda C akibat gaya tarik\nbenda A tidak sama dengan gaya gravitasi yang dialami benda C akibat gaya tarik\nbenda B</span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:40.5pt;mso-add-space:auto;text-align:justify;text-indent:\n-22.5pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(79,9,1,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi memiliki nilai tetap</span><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(80,9,2,'<span lang=\"EN-US\" style=\"font-size: 14pt; line-height: 107%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi selalu menuju pusat bumi</span>'),
(81,9,3,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Arah gaya gravitasi sesuai dengan arah benda\nbergerak, bisa ke atas bisa ke bawah</span><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(82,9,4,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Arah gaya gravitasi sesuai dengan arah benda\nbergerak, bisa ke atas bisa ke bawah</span><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:115%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(84,10,1,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Nol</span><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(85,10,2,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Nol</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(86,10,3,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Nol</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(87,10,4,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Nol</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(96,11,1,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\">Berat dan massa roket akan tetap meskipun jarak\nberubah</span></p><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(97,11,2,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\">Berat roket berbanding terbalik dengan kuadrat\njarak</span><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(98,11,3,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\">Berat roket berbanding terbalik dengan jarak</span><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(99,11,4,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\">Berat roket berbanding lurus dengan kuadrat jarak</span><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(101,12,1,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi akan tetap meskipun jarak berubah</span><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(102,12,2,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi berbanding terbalik dengan\nkuadrat jarak</span></p><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(103,12,3,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi berbanding terbalik dengan\nkuadrat jarak</span></p><p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(104,12,4,'<p class=\"MsoListParagraph\" style=\"margin-bottom:10.0pt;mso-add-space:auto;\ntext-align:justify;text-indent:-.25in;line-height:150%;mso-list:l0 level1 lfo1;\ntab-stops:85.05pt 141.75pt 198.45pt 255.15pt\"><!--[if !supportLists]--><span style=\"font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\">a)<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"EN-US\" style=\"font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi berbanding lurus dengan kuadrat\njarak</span><span style=\"font-size: 14pt; line-height: 150%; font-family: &quot;Times New Roman&quot;, serif;\"><o:p></o:p></span></p>'),
(121,3,1,'<p><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan hasil kali massa\ndan berbanding terbalik dengan kuadrat jaraknya</span></p><p><img src=\"http://localhost:8080/learning/assets/images/logo_payment1.png\" style=\"width: 716px;\"><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><br></span><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:39.3pt;mso-add-space:auto;text-align:justify;text-indent:\n-21.3pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:45.0pt 85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><o:p></o:p></span></p></p>'),
(122,3,2,'<p><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan hasil kali massa\ndan berbanding terbalik dengan jaraknya</span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:39.3pt;mso-add-space:auto;text-align:justify;text-indent:\n-21.3pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:45.0pt 85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"><o:p></o:p></span></p>'),
(123,3,3,'<p><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">Semua benda di\nalam akan menarik benda lain dengan gaya yang sebanding dengan hasil kuadrat\njarak dan berbanding terbalik dengan hasil kali kedua massa</span></p><p><img src=\"http://localhost:8080/learning/assets/images/body1.PNG\" style=\"width: 716px;\"><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><br></span></p><p><span style=\"text-align: justify; text-indent: -21.3pt; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><br></span></p><p class=\"MsoListParagraph\" style=\"margin-top:0in;margin-right:0in;margin-bottom:\n10.0pt;margin-left:39.3pt;mso-add-space:auto;text-align:justify;text-indent:\n-21.3pt;line-height:115%;mso-list:l0 level1 lfo1;tab-stops:45.0pt 85.05pt 141.75pt 198.45pt 255.15pt\"><span style=\"font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><o:p></o:p></span></p><p></p>');

/*Table structure for table `soal_pilihan` */

DROP TABLE IF EXISTS `soal_pilihan`;

CREATE TABLE `soal_pilihan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDSoal` int(11) NOT NULL,
  `Urutan` int(11) NOT NULL,
  `Keterangan` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

/*Data for the table `soal_pilihan` */

insert  into `soal_pilihan`(`ID`,`IDSoal`,`Urutan`,`Keterangan`) values 
(21,4,1,'<p><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">m</span><sup style=\"font-family: &quot;Times New Roman&quot;, serif;\">-3</sup><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\"> s</span><sup style=\"font-family: &quot;Times New Roman&quot;, serif;\">2</sup><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">\nkg</span><sup style=\"font-family: &quot;Times New Roman&quot;, serif;\">-1&nbsp; &nbsp; &nbsp;&nbsp;</sup></p>'),
(22,4,2,'<p><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">m</span><sup style=\"font-family: &quot;Times New Roman&quot;, serif;\">3</sup><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\"> s</span><sup style=\"font-family: &quot;Times New Roman&quot;, serif;\">-2</sup><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">\nkg</span><sup style=\"font-family: &quot;Times New Roman&quot;, serif;\">-1</sup><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">&nbsp; &nbsp;&nbsp;</span></p>'),
(23,4,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\"><span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;</span></span><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">m<sup>3</sup> s<sup>-2</sup></span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"> <o:p></o:p></span></p>'),
(24,4,4,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">m<sup>-3</sup> s<sup>-2</sup></span>'),
(25,4,5,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">m<sup>2</sup> s<sup>-2</sup>\nkg<sup>-1</sup></span>'),
(26,5,1,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Berat benda</span>'),
(27,5,2,'<p><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">Percepatan gravitasi</span></p>'),
(28,5,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Gaya gravitasi</span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(29,5,4,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Massa benda</span>'),
(30,5,5,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Massa dan berat benda&nbsp;</span>'),
(36,6,1,'<p><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">4,26 x 10</span><sup style=\"font-family: \"Times New Roman\", serif;\">24</sup><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">\nN</span><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">                      </span></p>'),
(37,6,2,'<p><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">13,32 x 10</span><sup style=\"font-family: \"Times New Roman\", serif;\">24</sup><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">\nN</span><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">                    </span></p>'),
(38,6,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">4,26 x 10<sup>16</sup> N</span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(39,6,4,'<p><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">0,87 x 10</span><sup style=\"font-family: \"Times New Roman\", serif;\">-8</sup><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\"> N </span></p>'),
(40,6,5,'<p><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">13,32 x 10</span><sup style=\"font-family: \"Times New Roman\", serif;\">16</sup><span style=\"font-family: \"Times New Roman\", serif; font-size: 14pt;\">\nN </span></p>'),
(56,7,1,'<p><span style=\"font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;=\"\" font-size:=\"\" 14pt;\"=\"\"><span style=\"font-size: 18.6667px;\">6 x 10</span><sup style=\"font-size: 14px;\">-12</sup><span style=\"font-size: 18.6667px;\">&nbsp;Kg</span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></p>'),
(57,7,2,'<p><span style=\"font-size:14.0pt;line-height:107%;\nfont-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">3 x 10<sup>-12</sup> Kg</span><br></p>'),
(58,7,3,'<p style=\"text-align: justify; text-indent: -30px; \"><span style=\"font-size: 18.6667px;\">m </span><span style=\"font-size: 18.6667px;\">3 x 10</span><sup style=\"font-size: 14px;\">-6</sup><span style=\"font-size: 18.6667px;\"> Kg</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\" times=\"\" new=\"\" roman\",\"serif\";mso-bidi-font-family:\"times=\"\" roman\";=\"\" mso-bidi-theme-font:minor-bidi\"=\"\"><o:p></o:p></span></p>'),
(59,7,4,'<p><span style=\"text-align: justify; text-indent: -30px; font-size: 18.6667px;\">9 x 10</span><sup style=\"font-size: 14px; text-align: justify; text-indent: -30px;\">-12</sup><span style=\"text-align: justify; text-indent: -30px; font-size: 18.6667px;\"> Kg</span><br></p>'),
(60,7,5,'<p><span style=\"text-align: justify; text-indent: -30px; font-size: 18.6667px;\">6 x 10</span><sup style=\"font-size: 14px; text-align: justify; text-indent: -30px;\">-6</sup><span style=\"text-align: justify; text-indent: -30px; font-size: 18.6667px;\"> Kg</span><br></p>'),
(66,1,1,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Bulan akan terus berotasi pada porosnya dan ia\nakan mengintari Bumi seperti biasanya</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(67,1,2,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Bulan akan berhenti berotasi pada porosnya dan\nia akan berhenti mengintari Bumi</span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(68,1,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Bulan akan terus berotasi pada porosnya tetapi\nia akan berhenti mengintari Bumi</span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(69,1,4,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Bulan akan berhenti berotasi tetapi ia akan mengintari\nBumi seperti biasanya</span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(70,1,5,'<p><span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: &quot;Times New Roman&quot;, serif;\">Gerak Bulan tidak dipengaruhi oleh gaya\ngravitasi Bumi</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:&quot;Times New Roman&quot;,&quot;serif&quot;;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(76,2,1,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya\ngravitasi bumi pada astronot sama dengan nol</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;\nline-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(77,2,2,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Jarak\nyang jauh sehingga tidak ada gaya yang menarik astronot di luar angkasa </span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(78,2,3,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya gravitasi bumi pada astronot</span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\"> </span><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">dan pesawat angkasa bertindak sebagai gaya\nsentripetal</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\n\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:\nminor-bidi\"><o:p></o:p></span></p>'),
(79,2,4,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya\ngravitasi bumi dan Archimedes saling meniadakan</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:\n14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(80,2,5,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Gaya\ngravitasi bumi dan bulan pada astronot di orbit itu saling meniadakan</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(96,8,1,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">1,3     </span>'),
(97,8,2,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">0,8   </span>'),
(98,8,3,'<span style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">1,1</span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(99,8,4,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">0,9</span>'),
(100,8,5,'<span style=\"font-size:14.0pt;line-height:107%;\nfont-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\nIN;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">0,75</span>'),
(106,9,1,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Hanya sebuah gaya gravitasi yang nilainya konstan yang\nbekerja ke arah bawah</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(107,9,2,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Hanya sebuah gaya gravitasi yang nilainya bertambah\ndan berarah ke bawah</span><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(108,9,3,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Hanya sebuah gaya gravitasi yang nilainya berkurang\ndan bekerja ke arah bawah</span><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;\nfont-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(109,9,4,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Tidak ada gaya yang bekerja pada roket</span><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(110,9,5,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Keduannya, gaya gravitasi tetap yang bekerja ke arah\nbawah dan gaya gravitasi yang nilainnya berkurang dan bekerja ke arah atas</span><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(116,10,1,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Percepatannya mempunyai nilai maksimum</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(117,10,2,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Sama dengan dua kali percepatan pada permukaan bumi</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(118,10,3,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Sama dengan setengah percepatan pada permukaan bumi</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(119,10,4,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Sama dengan seperempat percepatan pada permukaan bumi</span><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\"Times New Roman\",\"serif\";\nmso-bidi-font-family:\"Times New Roman\";mso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(120,10,5,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">Nol</span><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:\n115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\"Times New Roman\";\nmso-bidi-theme-font:minor-bidi\"><o:p></o:p></span></p>'),
(131,11,1,'<p><span style=\"font-family: &quot;Times New Roman&quot;, serif; font-size: 14pt;\">10.000 N</span></p>'),
(132,11,2,'<span lang=\"EN-US\" style=\"font-size:14.0pt;line-height:\n107%;font-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-ansi-language:EN-US;mso-fareast-language:\nEN-US;mso-bidi-language:AR-SA\">2.500 N</span>'),
(133,11,3,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 150%; font-family: \"Times New Roman\", serif;\">40.000\nN</span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:150%;mso-list:l0 level1 lfo1\"><span lang=\"EN-US\" style=\"font-size:14.0pt;\nline-height:150%;font-family:\"Times New Roman\",\"serif\";mso-ansi-language:EN-US\"><o:p></o:p></span></p>'),
(134,11,4,'<span lang=\"EN-US\" style=\"font-size:14.0pt;line-height:\n107%;font-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-ansi-language:EN-US;mso-fareast-language:\nEN-US;mso-bidi-language:AR-SA\">5.000 N</span>'),
(135,11,5,'<span lang=\"EN-US\" style=\"font-size:14.0pt;line-height:\n107%;font-family:\"Times New Roman\",\"serif\";mso-fareast-font-family:Calibri;\nmso-fareast-theme-font:minor-latin;mso-ansi-language:EN-US;mso-fareast-language:\nEN-US;mso-bidi-language:AR-SA\">20.000 N</span>'),
(141,12,1,'<span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">4, 3,\n2, 1</span><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level2 lfo1\"><span lang=\"EN-US\" style=\"font-size:14.0pt;\nline-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi;mso-ansi-language:EN-US\"><o:p></o:p></span></p>'),
(142,12,2,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">4, 2,\n3, 1</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level2 lfo1\"><span lang=\"EN-US\" style=\"font-size:14.0pt;\nline-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi;mso-ansi-language:EN-US\"><o:p></o:p></span></p>'),
(143,12,3,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">1, 2,\n3, 4</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level2 lfo1\"><span lang=\"EN-US\" style=\"font-size:14.0pt;\nline-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi;mso-ansi-language:EN-US\"><o:p></o:p></span></p>'),
(144,12,4,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">1, 2,\n3, 4</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level2 lfo1\"><span lang=\"EN-US\" style=\"font-size:14.0pt;\nline-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi;mso-ansi-language:EN-US\"><o:p></o:p></span></p>'),
(145,12,5,'<p><span lang=\"EN-US\" style=\"text-align: justify; text-indent: -22.5pt; font-size: 14pt; line-height: 115%; font-family: \"Times New Roman\", serif;\">2, 1,\n3, 4</span></p><p class=\"MsoListParagraph\" style=\"margin-left:40.5pt;mso-add-space:auto;\ntext-align:justify;text-indent:-22.5pt;line-height:115%;mso-list:l0 level2 lfo1\"><span lang=\"EN-US\" style=\"font-size:14.0pt;\nline-height:115%;font-family:\"Times New Roman\",\"serif\";mso-bidi-font-family:\n\"Times New Roman\";mso-bidi-theme-font:minor-bidi;mso-ansi-language:EN-US\"><o:p></o:p></span></p>'),
(167,3,1,'<p><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">Berbanding\nterbalik dengan massa masing-masing benda</span></p><p><img src=\"http://localhost:8080/learning/assets/images/pak_fredo.PNG\" style=\"width: 25%;\"><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\"><br></span></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";=\"\" mso-bidi-font-family:\"times=\"\" roman\";mso-bidi-theme-font:minor-bidi\"=\"\"><o:p></o:p></span></p>'),
(168,3,2,'<p><span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 115%; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">Berbanding\nterbalik dengan jarak kedua benda</span><img src=\"http://localhost:8080/learning/assets/images/Icon_PegiLagi.png\" style=\"width: 25%;\"></p><p class=\"MsoListParagraph\" style=\"text-align:justify;text-indent:-.25in;\nline-height:115%;mso-list:l0 level1 lfo1\"><span style=\"font-size:14.0pt;line-height:115%;font-family:\" times=\"\" new=\"\" roman\",\"serif\";=\"\" mso-bidi-font-family:\"times=\"\" roman\";mso-bidi-theme-font:minor-bidi\"=\"\"><o:p></o:p></span></p>'),
(169,3,3,'<p><img src=\"http://localhost:8080/learning/assets/images/logo_payment.png\" style=\"width: 25%;\"><span style=\"font-size:14.0pt;line-height:107%;\nfont-family:\" times=\"\" new=\"\" roman\",\"serif\";mso-fareast-font-family:calibri;=\"\" mso-fareast-theme-font:minor-latin;mso-bidi-theme-font:minor-bidi;mso-ansi-language:=\"\" in;mso-fareast-language:en-us;mso-bidi-language:ar-sa\"=\"\">Berbanding terbalik\ndengan kuadrat jarak kedua benda</span></p>'),
(170,3,4,'<span style=\"text-align: justify; text-indent: -0.25in; font-size: 14pt; line-height: 21.4667px; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">Berbanding lurus dengan kuadrat jarak kedua benda</span><p></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-align: justify; text-indent: -0.25in; line-height: 16.1px;\"><span style=\"font-size: 14pt; line-height: 21.4667px; font-family: \" times=\"\" new=\"\" roman\",=\"\" serif;\"=\"\">e</span><img src=\"http://localhost:8080/learning/assets/images/test.png\" style=\"width: 50%;\"></p>');

/*Table structure for table `testing` */

DROP TABLE IF EXISTS `testing`;

CREATE TABLE `testing` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDUser` int(11) NOT NULL,
  `IDGelombang` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `Score` int(11) DEFAULT NULL,
  `Type` enum('1','2') DEFAULT '1' COMMENT '1= soal, 2 = Remidial',
  `Status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = Belum Selesai, 1 = Sudah Selesai',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `testing` */

insert  into `testing`(`ID`,`IDUser`,`IDGelombang`,`DateTime`,`Token`,`Score`,`Type`,`Status`) values 
(1,10,1,'2019-08-24 22:12:58','9ad4c0a8caab63bba7cedb691ed1921a',NULL,'1','0'),
(2,11,1,'2019-08-24 22:14:45','a51de10323eae6f0f0de57cc899ac321',17,'1','1'),
(3,11,1,'2019-08-24 22:19:04','a51de10323eae6f0f0de57cc899ac321',40,'2','1'),
(4,12,1,'2019-08-25 10:55:52','430c46caa7a4fd5e137d71e21725f1d4',25,'1','1'),
(5,12,1,'2019-08-25 10:59:33','430c46caa7a4fd5e137d71e21725f1d4',67,'2','1'),
(6,13,1,'2019-09-21 10:22:01','b7c341c39756ed67bc72c1bd825a2b16',NULL,'1','0'),
(7,1,1,'2019-10-01 22:30:00','44ba5b7af5b9051df26278a5f35b8435',8,'1','1');

/*Table structure for table `testing_details` */

DROP TABLE IF EXISTS `testing_details`;

CREATE TABLE `testing_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDTest` int(11) NOT NULL,
  `IDSoal` int(11) DEFAULT NULL,
  `Jawaban` int(11) DEFAULT NULL,
  `Jawaban_K` int(11) DEFAULT NULL,
  `Alasan` int(11) DEFAULT NULL,
  `Alasan_K` int(11) DEFAULT NULL,
  `IDKategori` int(11) DEFAULT NULL,
  `IDKombinasi` int(11) DEFAULT NULL,
  `Status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 = Blm jawab, 1 = Sudah dijwab',
  `UpdatedAt` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

/*Data for the table `testing_details` */

insert  into `testing_details`(`ID`,`IDTest`,`IDSoal`,`Jawaban`,`Jawaban_K`,`Alasan`,`Alasan_K`,`IDKategori`,`IDKombinasi`,`Status`,`UpdatedAt`) values 
(1,1,3,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(2,1,4,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(3,1,5,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(4,1,6,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(5,1,7,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(6,2,3,3,4,1,4,1,1,'1',NULL),
(7,2,4,2,2,2,4,2,4,'1',NULL),
(8,2,5,4,4,4,4,3,11,'1',NULL),
(9,2,6,3,2,4,4,2,4,'1',NULL),
(10,2,7,1,4,3,1,3,14,'1',NULL),
(11,2,1,1,2,3,2,2,6,'1',NULL),
(12,2,2,1,4,3,4,3,16,'1',NULL),
(13,2,8,5,2,2,2,2,5,'1',NULL),
(14,2,9,2,4,2,4,3,13,'1',NULL),
(15,2,10,5,4,4,1,3,14,'1',NULL),
(16,2,11,2,4,2,4,1,1,'1',NULL),
(17,2,12,5,2,2,4,2,9,'1',NULL),
(18,3,4,1,4,2,4,3,13,'1',NULL),
(19,3,5,4,4,3,4,1,1,'1',NULL),
(20,3,6,1,2,4,3,2,9,'1',NULL),
(21,3,7,5,3,1,3,1,1,'1',NULL),
(22,3,1,3,4,3,4,1,1,'1',NULL),
(23,3,2,3,4,4,4,1,1,'1',NULL),
(24,3,8,5,4,2,4,3,11,'1',NULL),
(25,3,9,1,4,2,4,3,13,'1',NULL),
(26,3,10,1,4,2,3,3,16,'1',NULL),
(27,3,12,1,4,2,4,3,13,'1',NULL),
(28,4,3,5,4,1,4,3,13,'1',NULL),
(29,4,4,4,1,2,4,2,9,'1',NULL),
(30,4,5,4,4,3,4,1,1,'1',NULL),
(31,4,6,3,4,4,4,1,1,'1',NULL),
(32,4,7,3,3,2,4,3,16,'1',NULL),
(33,4,1,5,4,3,4,3,13,'1',NULL),
(34,4,2,2,4,3,4,3,16,'1',NULL),
(35,4,8,4,2,3,2,2,7,'1',NULL),
(36,4,9,2,4,2,4,3,13,'1',NULL),
(37,4,10,5,3,3,2,3,14,'1',NULL),
(38,4,11,2,4,2,4,1,1,'1',NULL),
(39,4,12,4,4,2,4,3,13,'1',NULL),
(40,5,3,3,4,1,4,1,1,'1',NULL),
(41,5,4,2,4,2,4,1,1,'1',NULL),
(42,5,7,5,4,1,4,1,1,'1',NULL),
(43,5,1,3,4,3,4,1,1,'1',NULL),
(44,5,2,3,4,4,4,1,1,'1',NULL),
(45,5,8,5,4,4,4,1,1,'1',NULL),
(46,5,9,1,4,2,4,3,13,'1',NULL),
(47,5,10,4,4,3,4,3,11,'1',NULL),
(48,5,12,2,4,3,4,3,16,'1',NULL),
(49,6,3,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(50,6,4,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(51,6,5,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(52,6,6,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(53,6,7,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(54,6,1,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(55,6,2,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(56,6,8,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(57,6,9,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(58,6,10,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(59,6,11,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(60,6,12,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL),
(61,7,3,2,3,1,3,3,13,'1',NULL),
(62,7,4,2,3,2,3,1,1,'1',NULL),
(63,7,5,3,4,1,4,3,16,'1',NULL),
(64,7,6,1,4,3,4,3,16,'1',NULL),
(65,7,7,3,4,1,4,3,13,'1',NULL),
(66,7,1,1,4,2,4,3,16,'1',NULL),
(67,7,2,3,4,2,4,3,11,'1',NULL),
(68,7,8,5,4,1,4,3,11,'1',NULL),
(69,7,9,3,4,4,4,3,11,'1',NULL),
(70,7,10,4,4,4,4,3,11,'1',NULL),
(71,7,11,1,4,3,4,3,16,'1',NULL),
(72,7,12,1,4,4,4,3,16,'1',NULL);

/*Table structure for table `timer` */

DROP TABLE IF EXISTS `timer`;

CREATE TABLE `timer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDTest` int(11) NOT NULL,
  `Time` time DEFAULT NULL,
  `Status` enum('0','1') DEFAULT '0' COMMENT '0 = masih jalan, 1 = stop',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `timer` */

insert  into `timer`(`ID`,`IDTest`,`Time`,`Status`) values 
(1,1,'00:04:15','0'),
(2,2,'00:01:37','0'),
(3,3,'00:02:02','0'),
(4,4,'00:01:48','0'),
(5,5,'00:01:55','0'),
(6,6,'00:02:26','0'),
(7,7,'00:02:58','0');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(255) DEFAULT NULL,
  `Sebagai` enum('siswa','guru') DEFAULT 'siswa',
  `NIS` varchar(20) DEFAULT NULL COMMENT 'Hanya untuk siswa',
  `Kelas` int(11) DEFAULT NULL COMMENT 'Hanya untuk siswa',
  `Sekolah` int(11) DEFAULT NULL COMMENT 'Hanya untuk siswa',
  `Username` varchar(100) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`ID`,`Nama`,`Sebagai`,`NIS`,`Kelas`,`Sekolah`,`Username`,`Email`,`Password`,`CreatedAt`) values 
(1,'Siswanto','siswa','123213',3,1,'sis123','sis@mail.com','839c46a5d1272dd54e20a4d06acac519','2019-03-07 00:00:00'),
(3,'rizki annisa','guru','',0,0,'rizkiannisa22','rizkiannisa22@gmail.com','52aacb62888103695cbb7055683e4029','2019-03-11 23:57:15'),
(7,'Rizki Annisa','siswa','0403517015',10,1,'Rizki123','Rizki123@gmail.com','9592638716b04b52fe6e041429822a79','2019-08-07 02:16:08'),
(8,'Rizki syahdani','siswa','34671823',11,1,'Rizkisyahdani','rizkisyahdani@gmail.com','6589fcf7d34996b9d1baac2cda0d250d','2019-08-20 12:04:02'),
(9,'Rizki baru','siswa','04025',10,2,'Rizkibaru','rizkibaru@gmail.com','2c3a3f6493755c33c36e41f74d3300d2','2019-08-21 09:05:02'),
(10,'Siswa 1','siswa','000001',10,1,'Siswa1','Siswa1@gmail.com','013f0f67779f3b1686c604db150d12ea','2019-08-21 18:49:03'),
(11,'Siswa 2','siswa','000002',10,1,'Siswa2','Siswa2@gmail.com','331633a246a4e1ceefc9539a71fcd124','2019-08-21 19:10:25'),
(12,'Siswa 3','siswa','000003',10,1,'Siswa3','Siswa3@gmail.com','4297f44b13955235245b2497399d7a93','2019-08-25 10:51:36'),
(13,'nandang','siswa','1212',3,2,'ndang','n@m.com','4297f44b13955235245b2497399d7a93','2019-09-21 10:21:44');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- phpMyAdmin SQL Dump
-- version 4.3.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2016 at 08:30 AM
-- Server version: 5.6.22
-- PHP Version: 5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `si_kantin`
--

-- --------------------------------------------------------

--
-- Table structure for table `kantin`
--

CREATE TABLE IF NOT EXISTS `kantin` (
  `ID_KANTIN` int(5) NOT NULL,
  `NAMA_KANTIN` varchar(50) NOT NULL,
  `NO_STAND` int(5) NOT NULL,
  `max_pesan` int(11) NOT NULL,
  `max_pesan_default` int(5) NOT NULL,
  `STATUS_KANTIN` int(5) NOT NULL,
  `NO_TELP` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kantin`
--

INSERT INTO `kantin` (`ID_KANTIN`, `NAMA_KANTIN`, `NO_STAND`, `max_pesan`, `max_pesan_default`, `STATUS_KANTIN`, `NO_TELP`) VALUES
(1, 'Sego kuli', 2, 29, 30, 1, '085123793567'),
(2, 'Soto Babat', 5, 20, 20, 1, '123907456389'),
(3, 'kantin mbah', 1, 9, 9, 0, '081257804678'),
(4, 'Stasiun Coklat', 3, 25, 25, 1, '089234785903'),
(5, 'Sego Kuli a', 10, 20, 20, 0, '08573467892'),
(6, 'ulul', 1, 20, 20, 100, '098123456');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE IF NOT EXISTS `laporan` (
  `ID_LAPORAN` int(5) NOT NULL,
  `ID_MENU` int(5) NOT NULL,
  `TGL` date NOT NULL,
  `JUMLAH` int(10) NOT NULL,
  `HARGA` int(10) NOT NULL,
  `ID_KANTIN` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`ID_LAPORAN`, `ID_MENU`, `TGL`, `JUMLAH`, `HARGA`, `ID_KANTIN`) VALUES
(2, 2, '2016-02-16', 2, 10000, 1),
(3, 3, '2016-02-16', 3, 4000, 2),
(4, 1, '2016-02-17', 3, 5000, 1),
(5, 3, '2016-02-17', 3, 4000, 2),
(6, 4, '2016-02-17', 2, 4500, 1),
(7, 2, '2016-02-17', 2, 10000, 1),
(8, 5, '2016-02-17', 1, 5000, 2),
(9, 3, '2016-02-19', 1, 4000, 2),
(10, 2, '2016-02-19', 1, 10000, 1),
(11, 5, '2016-02-22', 1, 5000, 2),
(12, 4, '2016-03-04', 1, 4500, 1),
(13, 1, '2016-03-04', 1, 5000, 1),
(14, 3, '2016-03-07', 1, 4000, 2),
(15, 1, '2016-03-08', 1, 5000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `ID_MENU` int(5) NOT NULL,
  `NAMA_MENU` varchar(40) NOT NULL,
  `JENIS` varchar(10) NOT NULL,
  `HARGA` int(10) NOT NULL,
  `ID_KANTIN` int(5) NOT NULL,
  `GAMBAR` varchar(40) NOT NULL,
  `STATUS_MENU` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID_MENU`, `NAMA_MENU`, `JENIS`, `HARGA`, `ID_KANTIN`, `GAMBAR`, `STATUS_MENU`) VALUES
(1, 'Bakso Mambu', 'Makanan', 5000, 1, '6220160410070416.jpg', 0),
(2, 'Bakso Meneh', 'Makanan', 10000, 1, '6220160406063930.jpg', 0),
(3, 'Soto Mbabat Suket', 'Makanan', 4000, 2, 'indexb.jpeg', 1),
(4, 'Sego Kuli', 'Makanan', 4500, 1, 'indexc.jpeg', 1),
(5, 'Pangsit Ayam', 'Makanan', 20, 2, 'panng.jpg', 1),
(8, '', 'Makanan', 0, 0, '2320160225210211.jpg', 1),
(9, 'mba menu', 'Minuman', 80000, 3, '2220160228134704.jpg', 1),
(12, 'mik', 'Makanan', 900, 1, '2220160229163154.jpeg', 0),
(13, 'menu 2', 'Makanan', 90000, 3, '2220160229164408.jpg', 1),
(14, 'Nasi Jagung', 'Makanan', 4500, 4, '2520160302110426.png', 1),
(15, 'Es Sukoco', 'Minuman', 3500, 4, '2520160302112504.jpg', 1),
(16, 'Es Coklat', 'Minuman', 3500, 4, '2520160302112745.jpg', 1),
(17, 'Es Kapwochina', 'Minuman', 2500, 4, '', 1),
(18, 'Susu''', 'Makanan', 2000, 4, '', 1),
(19, 'tes upload', 'Makanan', 3000, 4, '', 1),
(20, 'Pinguin Saus Kutub Utara', 'Makanan', 500000, 4, '6120160304121827.jpg', 1),
(21, 'Kopi', 'Minuman', 90000, 4, '2520160302115014.jpg', 1),
(22, 'yaoming face', 'Makanan', 1000, 4, '2520160302114923.jpg', 1),
(23, 'Mus', 'Makanan', 200, 4, '', 0),
(24, 'tes tsmba', 'Minuman', 20000, 5, '6220160304090547.jpg', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `menu_utama`
--
CREATE TABLE IF NOT EXISTS `menu_utama` (
`ID_MENU` int(5)
,`NAMA_MENU` varchar(40)
,`JENIS` varchar(10)
,`HARGA` int(10)
,`GAMBAR` varchar(40)
,`ID_KANTIN` int(5)
,`NAMA_KANTIN` varchar(50)
,`NO_STAND` int(5)
,`max_pesan` int(11)
,`STATUS_KANTIN` int(5)
,`STATUS_MENU` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_sistem`
--

CREATE TABLE IF NOT EXISTS `pengaturan_sistem` (
  `ID` int(5) NOT NULL,
  `WAKTU1` varchar(20) NOT NULL,
  `WAKTU2` varchar(20) NOT NULL,
  `JUMLAH_STAND` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan_sistem`
--

INSERT INTO `pengaturan_sistem` (`ID`, `WAKTU1`, `WAKTU2`, `JUMLAH_STAND`) VALUES
(1, '10:00:00', '10:30:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
  `ID` int(5) NOT NULL,
  `ID_USER` int(5) NOT NULL,
  `PESANAN` text NOT NULL,
  `TGL` date NOT NULL,
  `STATUS` int(5) NOT NULL,
  `TOTAL_BAYAR` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`ID`, `ID_USER`, `PESANAN`, `TGL`, `STATUS`, `TOTAL_BAYAR`) VALUES
(1, 7, '2#3', '2016-02-16', 1, 14000),
(2, 7, '1', '2016-02-17', 1, 5000),
(3, 7, '3#4', '2016-02-17', 1, 8500),
(4, 7, '3#2#1', '2016-02-17', 1, 19000),
(5, 7, '3#2#1#5#4', '2016-02-17', 1, 28500),
(6, 6, '3#2', '2016-02-19', 1, 14000),
(7, 3, '5', '2016-02-19', 1, 5000),
(8, 10, '3', '2016-02-22', 100, 4000),
(9, 20, '3#2', '2016-02-26', 100, 14000),
(10, 21, '3#2', '2016-02-26', 100, 14000),
(11, 3, '2', '2016-02-27', 100, 10000),
(12, 9, '9#5', '2016-02-29', 100, 85000),
(13, 25, '1#2', '2016-03-01', 100, 15000),
(14, 5, '3#5', '2016-03-02', 100, 9000),
(18, 14, '1#2', '2016-03-03', 100, 15000),
(22, 21, '4#1', '2016-03-04', 1, 9500),
(23, 11, '4#2', '2016-03-04', 100, 14500),
(24, 10, '14#5', '2016-03-04', 100, 9500),
(26, 7, '3', '2016-03-07', 1, 4000),
(28, 7, '1', '2016-03-08', 1, 5000),
(29, 7, '4', '2016-04-10', 100, 4500);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(10) unsigned NOT NULL,
  `STATUS` int(5) NOT NULL,
  `ID_LEVEL` int(5) NOT NULL,
  `USERNAME` varchar(40) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `STATUS_PESAN` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `STATUS`, `ID_LEVEL`, `USERNAME`, `PASSWORD`, `STATUS_PESAN`) VALUES
(1, 1, 1, 'admin', '202cb962ac59075b964b07152d234b70', 1),
(2, 1, 2, 'admin_kantin', 'a1c4bbc92827b47ba68a0664044755e2', 1),
(3, 1, 3, '139940676070', 'a7ed5648fe7dd2662601e5f2da328515', 1),
(5, 1, 3, '139940676071', '4af95a4f87b5cdcaa2f9d910ceabe45f', 1),
(6, 100, 3, 'a', '0cc175b9c0f1b6a831c399e269772661', 0),
(7, 0, 3, 'b', '92eb5ffee6ae2fec3ad71c777531578f', 1),
(8, 1, 3, 'c', '4a8a08f09d37b73795649038408b5f33', 1),
(9, 1, 3, 'd', '8277e0910d750195b448797616e091ad', 1),
(10, 0, 3, '139860668070', '6ab817917b2d6c7740095f3b601c3805', 1),
(11, 0, 3, 'e', 'e1671797c52e15f763380b45e841ec32', 1),
(13, 1, 3, '139920674070', '2c10697a5a1b01e818b2abd07e953cfc', 0),
(14, 0, 3, 'v', '9e3669d19b675bd57058fd4664205d2a', 1),
(16, 1, 1, 'admin2', '202cb962ac59075b964b07152d234b70', 1),
(18, 1, 3, '1', 'c4ca4238a0b923820dcc509a6f75849b', 0),
(19, 1, 3, '2', 'c81e728d9d4c2f636f067f89cc14862c', 0),
(20, 0, 3, 'mbah', '31cdf5f58157843a1276d26d85ef6cee', 1),
(21, 1, 3, 'ulul', '123', 0),
(22, 1, 3, 'huda', '0075a4e7a2e71083262da135ecdbdd14', 0),
(23, 1, 3, '123456', 'e10adc3949ba59abbe56e057f20f883e', 0),
(24, 1, 3, '78910', 'dfdc20cbab482c8d159f42d3250d1f7c', 0),
(25, 0, 3, '12567', '81e4fe932e45bbbc10cfce7ffb67162e', 1),
(26, 1, 3, 'cobak', 'eb89b4f59172b71b71ffe6a8acd17212', 0),
(27, 1, 3, 'import', '93473a7344419b15c4219cc2b6c64c6f', 0),
(28, 1, 3, 'ihir', '23f554670d58f594a958ad3941aa42a5', 0),
(30, 1, 3, 'DINAS PENDIDIKAN', '82409a75b8fafb53e1bb26356ccf7b0c', 0),
(31, 1, 3, 'SMK NEGERI 4 MALANG', '05847df29ea4bb345dcccb93bbbc80ea', 0),
(32, 1, 3, 'Jl. Tanimbar 22 Malang 65117Telp. ( 0341', '0a8f7e1e712bd56785530e9c560c7eba', 0),
(34, 1, 3, '160930695073', 'c659fbc0052a4ee5be9cbec9cc919789', 0),
(35, 1, 3, '160940696073', 'a5297330ec4b69b3ccec435233c57cb2', 0),
(36, 1, 3, '160950697073', 'e6c12c8d6a68efde874e5bcfdaea50d6', 0),
(37, 1, 3, '160960698073', 'c61789a1b6e48e4cedb6371c03bd6f1f', 0),
(38, 1, 3, '160970699073', '7c709a68463054e5017eb2d1c2502dab', 0),
(39, 1, 3, '160980700073', '733a3fbea59521dfdc732dec7854bc1d', 0),
(40, 1, 3, '160990701073', '5d7682cccd8b6dff5995a80fadde2cb1', 0),
(41, 1, 3, '161000702073', 'db445389a5d9c27cdfe7df693354f9cb', 0),
(42, 1, 3, '161010703073', '5b754481f5a87236e9f3ef47a2b75bed', 0),
(43, 1, 3, '161020704073', 'ddf5022ec9f02091235965026c45743d', 0),
(44, 1, 3, '161030705073', '357f0edf5b975ba58e3946cc21f76d9c', 0),
(45, 1, 3, '161040706073', '2269a84e3a77e7aa6b50be2ab6774254', 0),
(46, 1, 3, '161050707073', '3c251f098abd1d8766a1ebe1a31c0d7a', 0),
(47, 1, 3, '161060708073', '5f3462d0161d18205354f9c2e57ad4c3', 0),
(48, 1, 3, '161070709073', 'd7162849bf470beb90a54648ddf9ea81', 0),
(49, 1, 3, '161080710073', 'ee4c5f5d8185118b0e9b864f0ffb7bf6', 0),
(50, 1, 3, '161090711073', 'b044ca03f5ff3ed56285fc9b97d1b2b2', 0),
(51, 1, 3, '161100712073', '590d8cbeecc958893f0a951e6604ca85', 0),
(52, 1, 3, '161110713073', '93f0f52b64790f7bf2efc1108e026e08', 0),
(53, 1, 3, '161120714073', '9d6420a6056893a56797ee0b337ae466', 0),
(54, 1, 3, '161130715073', 'f9be769d0633dceb47c4e3071a2bbcfc', 0),
(55, 1, 3, '161140716073', '905d206e111bb563ea2ff05f6fc0f350', 0),
(56, 1, 3, '161150717073', 'f9f9fea97533816a7186395ff4622d91', 0),
(57, 1, 3, '161160718073', '3facb968498b3595b50ce3ebeb17bebb', 0),
(58, 1, 3, '161170719073', '53ccd6f2f0c4a984d1040d709803fd64', 0),
(59, 1, 3, '161180720073', '4c30693d17a6e2bc64f2bd6262fee18c', 0),
(60, 1, 3, '161190721073', '285a237e151710e5f9c486c822ad6bf2', 0),
(61, 1, 3, '161200722073', 'f2622a600c9b690b7c9dda7b6625e1b0', 0),
(62, 1, 3, '161210723073', '81f0e87d47e907b75352d9fba27e5ff9', 0),
(63, 1, 3, '161220724073', 'ab43cbfa1f88f9868a81566264722211', 0),
(64, 1, 3, '161230725073', '25cb0d648a0adc9b837f90e9c3600adb', 0),
(65, 1, 3, '161240726073', '60de8284d7125e28b600f9f479e65704', 0),
(66, 1, 3, '161250727073', 'e0619f4853f490a5b1cf6fe4e93422ed', 0),
(67, 1, 3, 'robbi i', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `ID_LEVEL` int(5) NOT NULL,
  `LEVEL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`ID_LEVEL`, `LEVEL`) VALUES
(1, 'Admin'),
(2, 'Petugas Kantin'),
(3, 'Siswa');

-- --------------------------------------------------------

--
-- Table structure for table `user_nama`
--

CREATE TABLE IF NOT EXISTS `user_nama` (
  `ID_USER` int(10) NOT NULL,
  `NAMA` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_nama`
--

INSERT INTO `user_nama` (`ID_USER`, `NAMA`) VALUES
(5, 'Nuzulul Huda'),
(14, 'ved'),
(0, 'ALVIN RAYHAN MAHARDHIKA'),
(0, 'AMARA BITTAQWA'),
(0, 'ANDHIKA RIZKY SYAH PUTRA'),
(0, 'ARDHANI PRATAMA MAYSANDI'),
(0, 'ARIQ MALYA PUTRA'),
(0, 'ARYA PRIMA PUTRA'),
(0, 'AYA SOPHIA RESTU WIDAYAT'),
(0, 'BILLY LUNMISAY'),
(0, 'DEVITA MALINDA SARI'),
(0, 'ENTRESSA ALIF WINDAR YOGA'),
(0, 'ERWIN ERDIANSYAH'),
(0, 'FEBRILIANTI NURHIDAYAH'),
(0, 'ISA MAULANA'),
(0, 'KHADIJAH'),
(0, 'LELIANA SURYA LUTFIA'),
(0, 'M. ULIL ABROR HASAN'),
(0, 'MARITA FELIYANA PERBOYO'),
(0, 'MUCHAMMAD AINNUR FADIL'),
(0, 'MUHAMMAD ERWIN SULTHONI'),
(0, 'MUHAMMAD FIRZAN LAW PEACE'),
(0, 'NABILLA LAILA ALI'),
(0, 'NATHANIEL JONATHAN FERREL D.L.'),
(0, 'NAWANG BAYU AJI'),
(0, 'NIMAS LAILATUL HASANAH'),
(0, 'NURIL AULIA'),
(0, 'RINGGI ALFANI SUGANDA'),
(0, 'RIZKY NUR HAKIMAH'),
(0, 'ROSA NOOR WAHYUNINGTYAS'),
(0, 'SALSABILLA AULIA RAHMA'),
(0, 'SHOLAHUR ROBBANI'),
(0, 'SULTONUL JIBAL AL IKHSAN'),
(0, 'TOBY NUGROHO WIBISONO'),
(0, 'VIRGIE SEFTIVANI'),
(21, 'Nuzulul Huda'),
(34, 'ALVIN RAYHAN MAHARDHIKA'),
(35, 'AMARA BITTAQWA'),
(36, 'ANDHIKA RIZKY SYAH PUTRA'),
(37, 'ARDHANI PRATAMA MAYSANDI'),
(38, 'ARIQ MALYA PUTRA'),
(39, 'ARYA PRIMA PUTRA'),
(40, 'AYA SOPHIA RESTU WIDAYAT'),
(41, 'BILLY LUNMISAY'),
(42, 'DEVITA MALINDA SARI'),
(43, 'ENTRESSA ALIF WINDAR YOGA'),
(44, 'ERWIN ERDIANSYAH'),
(45, 'FEBRILIANTI NURHIDAYAH'),
(46, 'ISA MAULANA'),
(47, 'KHADIJAH'),
(48, 'LELIANA SURYA LUTFIA'),
(49, 'M. ULIL ABROR HASAN'),
(50, 'MARITA FELIYANA PERBOYO'),
(51, 'MUCHAMMAD AINNUR FADIL'),
(52, 'MUHAMMAD ERWIN SULTHONI'),
(53, 'MUHAMMAD FIRZAN LAW PEACE'),
(54, 'NABILLA LAILA ALI'),
(55, 'NATHANIEL JONATHAN FERREL D.L.'),
(56, 'NAWANG BAYU AJI'),
(57, 'NIMAS LAILATUL HASANAH'),
(58, 'NURIL AULIA'),
(59, 'RINGGI ALFANI SUGANDA'),
(60, 'RIZKY NUR HAKIMAH'),
(61, 'ROSA NOOR WAHYUNINGTYAS'),
(62, 'SALSABILLA AULIA RAHMA'),
(63, 'SHOLAHUR ROBBANI'),
(64, 'SULTONUL JIBAL AL IKHSAN'),
(65, 'TOBY NUGROHO WIBISONO'),
(66, 'VIRGIE SEFTIVANI'),
(7, 'anggap saja bee');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_laporan`
--
CREATE TABLE IF NOT EXISTS `view_laporan` (
`TGL` date
,`JUMLAH` int(10)
,`ID_MENU` int(5)
,`NAMA_MENU` varchar(40)
,`JENIS` varchar(10)
,`HARGA` int(10)
,`ID_KANTIN` int(5)
,`NAMA_KANTIN` varchar(50)
,`NO_STAND` int(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pesanan`
--
CREATE TABLE IF NOT EXISTS `view_pesanan` (
`ID_USER` int(10) unsigned
,`user_status` int(5)
,`ID_LEVEL` int(5)
,`USERNAME` varchar(40)
,`STATUS_PESAN` int(11)
,`ID` int(5)
,`PESANAN` text
,`TGL` date
,`STATUS` int(5)
,`TOTAL_BAYAR` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_users`
--
CREATE TABLE IF NOT EXISTS `view_users` (
`USERNAME` varchar(40)
,`STATUS` int(5)
,`ID_LEVEL` int(5)
,`STATUS_PESAN` int(11)
,`ID_USER` int(10) unsigned
,`NAMA` varchar(40)
);

-- --------------------------------------------------------

--
-- Structure for view `menu_utama`
--
DROP TABLE IF EXISTS `menu_utama`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu_utama` AS select `menu`.`ID_MENU` AS `ID_MENU`,`menu`.`NAMA_MENU` AS `NAMA_MENU`,`menu`.`JENIS` AS `JENIS`,`menu`.`HARGA` AS `HARGA`,`menu`.`GAMBAR` AS `GAMBAR`,`kantin`.`ID_KANTIN` AS `ID_KANTIN`,`kantin`.`NAMA_KANTIN` AS `NAMA_KANTIN`,`kantin`.`NO_STAND` AS `NO_STAND`,`kantin`.`max_pesan` AS `max_pesan`,`kantin`.`STATUS_KANTIN` AS `STATUS_KANTIN`,`menu`.`STATUS_MENU` AS `STATUS_MENU` from (`menu` join `kantin`) where (`menu`.`ID_KANTIN` = `kantin`.`ID_KANTIN`);

-- --------------------------------------------------------

--
-- Structure for view `view_laporan`
--
DROP TABLE IF EXISTS `view_laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_laporan` AS select `laporan`.`TGL` AS `TGL`,`laporan`.`JUMLAH` AS `JUMLAH`,`menu`.`ID_MENU` AS `ID_MENU`,`menu`.`NAMA_MENU` AS `NAMA_MENU`,`menu`.`JENIS` AS `JENIS`,`menu`.`HARGA` AS `HARGA`,`kantin`.`ID_KANTIN` AS `ID_KANTIN`,`kantin`.`NAMA_KANTIN` AS `NAMA_KANTIN`,`kantin`.`NO_STAND` AS `NO_STAND` from ((`laporan` join `kantin`) join `menu`) where ((`menu`.`ID_MENU` = `laporan`.`ID_MENU`) and (`menu`.`ID_KANTIN` = `kantin`.`ID_KANTIN`));

-- --------------------------------------------------------

--
-- Structure for view `view_pesanan`
--
DROP TABLE IF EXISTS `view_pesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pesanan` AS select `user`.`ID_USER` AS `ID_USER`,`user`.`STATUS` AS `user_status`,`user`.`ID_LEVEL` AS `ID_LEVEL`,`user`.`USERNAME` AS `USERNAME`,`user`.`STATUS_PESAN` AS `STATUS_PESAN`,`pesanan`.`ID` AS `ID`,`pesanan`.`PESANAN` AS `PESANAN`,`pesanan`.`TGL` AS `TGL`,`pesanan`.`STATUS` AS `STATUS`,`pesanan`.`TOTAL_BAYAR` AS `TOTAL_BAYAR` from (`user` join `pesanan`) where (`user`.`ID_USER` = `pesanan`.`ID_USER`);

-- --------------------------------------------------------

--
-- Structure for view `view_users`
--
DROP TABLE IF EXISTS `view_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users` AS select `user`.`USERNAME` AS `USERNAME`,`user`.`STATUS` AS `STATUS`,`user`.`ID_LEVEL` AS `ID_LEVEL`,`user`.`STATUS_PESAN` AS `STATUS_PESAN`,`user`.`ID_USER` AS `ID_USER`,`user_nama`.`NAMA` AS `NAMA` from (`user` join `user_nama`) where (`user`.`ID_USER` = `user_nama`.`ID_USER`);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kantin`
--
ALTER TABLE `kantin`
  ADD PRIMARY KEY (`ID_KANTIN`), ADD UNIQUE KEY `NAMA_KANTIN` (`NAMA_KANTIN`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID_MENU`);

--
-- Indexes for table `pengaturan_sistem`
--
ALTER TABLE `pengaturan_sistem`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`), ADD UNIQUE KEY `ID_USER` (`ID_USER`), ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kantin`
--
ALTER TABLE `kantin`
  MODIFY `ID_KANTIN` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `ID_LAPORAN` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID_MENU` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pengaturan_sistem`
--
ALTER TABLE `pengaturan_sistem`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

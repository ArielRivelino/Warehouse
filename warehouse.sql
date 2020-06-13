-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for warehouse
DROP DATABASE IF EXISTS `warehouse`;
CREATE DATABASE IF NOT EXISTS `warehouse` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `warehouse`;

-- Dumping structure for table warehouse.master_barang
DROP TABLE IF EXISTS `master_barang`;
CREATE TABLE IF NOT EXISTS `master_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `item_name` varchar(258) NOT NULL,
  `stock` int(11) NOT NULL,
  `blok` char(1) NOT NULL,
  `code` char(1) NOT NULL,
  `line` char(2) NOT NULL,
  `column` char(2) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_jenis` (`id_jenis`),
  KEY `id_satuan` (`id_satuan`),
  CONSTRAINT `FK_master_barang_master_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `master_jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_master_barang_master_satuan` FOREIGN KEY (`id_satuan`) REFERENCES `master_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.master_barang: ~4 rows (approximately)
/*!40000 ALTER TABLE `master_barang` DISABLE KEYS */;
INSERT INTO `master_barang` (`id_barang`, `id_jenis`, `id_satuan`, `item_name`, `stock`, `blok`, `code`, `line`, `column`, `status`) VALUES
	(1, 1, 2, 'Kertas', 100, 'c', 'c', 'c', 'c', 1),
	(2, 1, 1, 'PC Desktop Asus', 20, 'A', 'A', 'A1', 'A1', 1),
	(3, 2, 1, 'EXCAVA 200', 100, 'D', 'D', 'D', 'D', 1),
	(4, 2, 1, 'TELEHANDLER', 200, 'D', 'D', 'D2', 'D2', 1),
	(5, 3, 2, 'Sapu', 100, 'S', 'S', 'S', 'S', 1);
/*!40000 ALTER TABLE `master_barang` ENABLE KEYS */;

-- Dumping structure for table warehouse.master_jenis
DROP TABLE IF EXISTS `master_jenis`;
CREATE TABLE IF NOT EXISTS `master_jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(258) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.master_jenis: ~3 rows (approximately)
/*!40000 ALTER TABLE `master_jenis` DISABLE KEYS */;
INSERT INTO `master_jenis` (`id_jenis`, `type`) VALUES
	(1, 'IT'),
	(2, 'Alat Berat'),
	(3, 'Umum');
/*!40000 ALTER TABLE `master_jenis` ENABLE KEYS */;

-- Dumping structure for table warehouse.master_satuan
DROP TABLE IF EXISTS `master_satuan`;
CREATE TABLE IF NOT EXISTS `master_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `satuan` varchar(258) NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.master_satuan: ~2 rows (approximately)
/*!40000 ALTER TABLE `master_satuan` DISABLE KEYS */;
INSERT INTO `master_satuan` (`id_satuan`, `satuan`) VALUES
	(1, 'Unit'),
	(2, 'Pcs');
/*!40000 ALTER TABLE `master_satuan` ENABLE KEYS */;

-- Dumping structure for table warehouse.t_access
DROP TABLE IF EXISTS `t_access`;
CREATE TABLE IF NOT EXISTS `t_access` (
  `id_access` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `aksi` varchar(258) NOT NULL,
  PRIMARY KEY (`id_access`),
  KEY `role_id` (`role_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `FK_t_access_t_menu` FOREIGN KEY (`menu_id`) REFERENCES `t_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_access_user_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.t_access: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_access` DISABLE KEYS */;
INSERT INTO `t_access` (`id_access`, `role_id`, `menu_id`, `aksi`) VALUES
	(4, 2, 5, '1,2,3'),
	(7, 2, 20, '1,2,3'),
	(8, 2, 21, '1,2,3'),
	(9, 3, 20, '1,3'),
	(10, 3, 21, '1,3'),
	(12, 4, 5, '1,2,3'),
	(13, 4, 6, '1,2,3'),
	(14, 4, 12, '1,2,3'),
	(15, 4, 13, '1,2,3'),
	(16, 4, 14, '1,2,3'),
	(17, 4, 15, '1,2,3'),
	(18, 4, 16, '1,2,3'),
	(19, 4, 17, '1,2,3'),
	(20, 4, 18, '1,2,3'),
	(21, 4, 19, '1,2,3'),
	(22, 4, 20, '1,2,3'),
	(23, 4, 21, '1,2,3');
/*!40000 ALTER TABLE `t_access` ENABLE KEYS */;

-- Dumping structure for table warehouse.t_menu
DROP TABLE IF EXISTS `t_menu`;
CREATE TABLE IF NOT EXISTS `t_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(258) NOT NULL,
  `url` varchar(258) NOT NULL,
  `status` int(1) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.t_menu: ~7 rows (approximately)
/*!40000 ALTER TABLE `t_menu` DISABLE KEYS */;
INSERT INTO `t_menu` (`menu_id`, `menu_name`, `url`, `status`, `type`) VALUES
	(1, 'Master', 'fa-cog', 1, 0),
	(2, 'Permintaan', 'fa-cog', 1, 0),
	(3, 'Laporan', 'fa-file', 1, 0),
	(4, 'Setting', 'fa-wrench', 1, 0),
	(5, 'Master Barang', 'barang', 1, 1),
	(6, 'Master User', 'user', 1, 1),
	(12, 'Barang', 'Barang', 1, 3),
	(13, 'Permintaan Stok', 'Permintaan', 1, 3),
	(14, 'Permintaan Barang Baru', 'Permintaan', 1, 3),
	(15, 'Jenis', 'Jenis', 1, 4),
	(16, 'Satuan', 'Satuan', 1, 4),
	(17, 'Menu', 'Menu', 1, 4),
	(18, 'User Role', 'User_role', 1, 4),
	(19, 'User Access', 'User_access', 1, 4),
	(20, 'Permintaan Stok', 'Permintaan/stok', 1, 2),
	(21, 'Permintaan Barang Baru', 'Permintaan/baru', 1, 2);
/*!40000 ALTER TABLE `t_menu` ENABLE KEYS */;

-- Dumping structure for table warehouse.t_request
DROP TABLE IF EXISTS `t_request`;
CREATE TABLE IF NOT EXISTS `t_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(258) NOT NULL,
  `request_type` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `information` text NOT NULL,
  `request_date` datetime NOT NULL,
  `approval_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `proof` varchar(258) NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `id_barang` (`id_barang`),
  KEY `nik` (`nik`),
  CONSTRAINT `FK_t_request_master_barang` FOREIGN KEY (`id_barang`) REFERENCES `master_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_t_request_user` FOREIGN KEY (`nik`) REFERENCES `user` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.t_request: ~1 rows (approximately)
/*!40000 ALTER TABLE `t_request` DISABLE KEYS */;
INSERT INTO `t_request` (`request_id`, `nik`, `request_type`, `id_barang`, `amount`, `information`, `request_date`, `approval_date`, `status`, `proof`) VALUES
	(1, '1234', 0, 3, 200, 'Ini Informasi untuk permintaan stok', '2020-06-13 15:13:23', '0000-00-00 00:00:00', 1, 'ini proof'),
	(2, '1234', 1, 5, 100, 'ini informasi untuk sapu baru', '2020-06-13 16:14:20', '0000-00-00 00:00:00', 1, 'ini proof untuk sapu');
/*!40000 ALTER TABLE `t_request` ENABLE KEYS */;

-- Dumping structure for table warehouse.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `nik` varchar(258) NOT NULL,
  `name` varchar(258) NOT NULL,
  `password` varchar(258) NOT NULL,
  `staff` varchar(258) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(258) NOT NULL,
  PRIMARY KEY (`nik`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `FK_user_user_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`nik`, `name`, `password`, `staff`, `role_id`, `email`) VALUES
	('1234', 'Saya Gudang', '1234', 'Gudang', 3, 'satuduatigaempat@gmail.com'),
	('4321', 'Saya Kepala', '4321', 'Kepala', 3, 'sayakepala@gmail.com'),
	('admin', 'Admin Keren', 'admin', 'Administrator', 4, 'admin@warehouse.com');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table warehouse.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(258) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.user_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`role_id`, `role`) VALUES
	(2, 'Staff Gudang'),
	(3, 'Kepala Cabang'),
	(4, 'Admin Web');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.master_barang: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_barang` DISABLE KEYS */;
INSERT INTO `master_barang` (`id_barang`, `id_jenis`, `id_satuan`, `item_name`, `stock`, `blok`, `code`, `line`, `column`, `status`) VALUES
	(1, 1, 2, 'Kertas', 100, 'c', 'c', 'c', 'c', 0);
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
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `aksi` varchar(258) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.t_access: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_access` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.t_menu: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_menu` DISABLE KEYS */;
INSERT INTO `t_menu` (`menu_id`, `menu_name`, `url`, `status`, `type`) VALUES
	(1, 'Master', 'fa-cog', 1, 0),
	(2, 'Permintaan', 'fa-cog', 1, 0),
	(3, 'Laporan', 'fa-file', 1, 0),
	(4, 'Setting', 'fa-wrench', 1, 0),
	(5, 'Master Barang', 'barang', 1, 1),
	(6, 'Master User', 'user', 1, 1),
	(7, 'Permintaan Stok', 'permintaan_stok', 1, 2);
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
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.t_request: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_request` DISABLE KEYS */;
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
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table warehouse.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(258) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warehouse.user_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

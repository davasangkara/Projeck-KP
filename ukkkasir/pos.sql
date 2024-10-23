-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pos
CREATE DATABASE IF NOT EXISTS `pos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pos`;

-- Dumping structure for table pos.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_barang` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `unit_id` int unsigned NOT NULL,
  `stok` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barang(fk)kategori` (`id_kategori`),
  KEY `barang(fk)unit` (`unit_id`),
  CONSTRAINT `barang(fk)kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  CONSTRAINT `barang(fk)unit` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.barang: ~6 rows (approximately)
INSERT INTO `barang` (`id`, `id_barang`, `id_kategori`, `nama_barang`, `merk`, `harga_beli`, `harga_jual`, `unit_id`, `stok`) VALUES
	(7, 'BR002', 14, 'Serena Monde', 'arta boga', '2000', '2500', 1, '976'),
	(8, 'BR003', 15, 'Teh Pucuk 350ml', 'Mayora', '2500', '3000', 1, '988'),
	(9, 'BR004', 15, 'Javana 350ML', 'Mayora', '2600', '3000', 4, '376'),
	(12, '', 14, 'Bebelac', '11', '11', '11', 1, '1'),
	(13, '', 14, 'Ayam', '1111', '111', '111', 1, '111'),
	(14, 'BR001', 14, 'Bebek', '11', '11', '11', 1, '11');

-- Dumping structure for table pos.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.kategori: ~2 rows (approximately)
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tgl_input`) VALUES
	(14, 'Makanan', '28 January 2024, 12:44'),
	(15, 'Minuman', '28 January 2024, 12:44');

-- Dumping structure for table pos.login
CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `id_member` int NOT NULL,
  PRIMARY KEY (`id_login`),
  KEY `id_member` (`id_member`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.login: ~0 rows (approximately)
INSERT INTO `login` (`id_login`, `user`, `pass`, `id_member`) VALUES
	(1, 'admin12345', '21232f297a57a5a743894a0e4a801fc3', 1),
	(3, 'putra', '5e0c5a0bf82decdd43b2150b622c66c5', 3),
	(4, 'andra', '25d55ad283aa400af464c76d713c07ad', 5),
	(5, 'rangga', '25d55ad283aa400af464c76d713c07ad', 6);

-- Dumping structure for table pos.member
CREATE TABLE IF NOT EXISTS `member` (
  `id_member` int NOT NULL AUTO_INCREMENT,
  `nm_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `NIK` text NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.member: ~4 rows (approximately)
INSERT INTO `member` (`id_member`, `nm_member`, `alamat_member`, `telepon`, `email`, `gambar`, `NIK`) VALUES
	(1, 'Putri', 'Banten', '08888888888', 'Putri@gmail.com', '1706414630OIP.jpg', '32000000000000'),
	(3, 'Putra', 'Jakarta', '0897678990', 'putra@gmail.com', '1706415668joe.jpg.jpg', '126777'),
	(5, 'Andra', 'Bekasi', '0888999999', 'andra@gmail.com', '1706418213download (2).jpg', '222222'),
	(6, 'Rangga', 'Sumatra', '0875466666666', 'rangga@gmail.com', '1706420649download (2).jpg', '333333');

-- Dumping structure for table pos.nota
CREATE TABLE IF NOT EXISTS `nota` (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  `periode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.nota: ~0 rows (approximately)
INSERT INTO `nota` (`id_nota`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`, `periode`) VALUES
	(4, 'BR004', 6, '24', '72000', '28 January 2024, 12:49', '01-2024'),
	(5, 'BR001', 6, '24', '120000', '28 January 2024, 12:49', '01-2024'),
	(6, 'BR003', 6, '12', '36000', '28 January 2024, 12:50', '01-2024'),
	(7, 'BR002', 6, '24', '60000', '28 January 2024, 12:50', '01-2024'),
	(8, 'BR004', 1, '100', '300000', '6 October 2024, 23:12', '10-2024');

-- Dumping structure for table pos.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) NOT NULL,
  `id_member` int NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `id_member` (`id_member`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.penjualan: ~1 rows (approximately)
INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`) VALUES
	(7, 'BR004', 1, '100', '300000', '6 October 2024, 23:12');

-- Dumping structure for table pos.toko
CREATE TABLE IF NOT EXISTS `toko` (
  `id_toko` int NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.toko: ~0 rows (approximately)
INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `tlp`, `nama_pemilik`) VALUES
	(1, 'CV Barokah Abadi', 'Bandung', '08888888888', 'Bapak Berkah');

-- Dumping structure for table pos.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `barang_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` float NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trxfkbarang_id` (`barang_id`),
  CONSTRAINT `trxfkbarang_id` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='catat semua transaksi\r\n';

-- Dumping data for table pos.transactions: ~3 rows (approximately)
INSERT INTO `transactions` (`id`, `barang_id`, `qty`, `price`, `type`, `transaction_date`) VALUES
	(1, 12, 1, 11, 'IN', '2024-10-06 23:43:49'),
	(2, 13, 111, 111, 'IN', '2024-10-06 23:44:38'),
	(3, 14, 11, 11, 'OUT', '2024-10-06 23:45:05');

-- Dumping structure for table pos.units
CREATE TABLE IF NOT EXISTS `units` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='master units, unit name and desc';

-- Dumping data for table pos.units: ~0 rows (approximately)
INSERT INTO `units` (`id`, `name`, `description`) VALUES
	(1, 'pcs', 'unit satuan per-pcs'),
	(2, 'L', 'unit satuan liter'),
	(3, 'kg', 'unit satuan kilogram'),
	(4, 'box', 'unit satuan kotak'),
	(5, 'lusin', 'unit satuan lusin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
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
  `id_kategori` int NOT NULL,
  `nama_barang` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `unit_id` int unsigned NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang(fk)kategori` (`id_kategori`),
  KEY `barang(fk)unit` (`unit_id`),
  CONSTRAINT `barang(fk)kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  CONSTRAINT `barang(fk)unit` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.barang: ~3 rows (approximately)
INSERT INTO `barang` (`id`, `id_kategori`, `nama_barang`, `merk`, `unit_id`, `type`) VALUES
	(15, 20, 'Potato Chips', 'Lays', 1, 'Ukuran Besar'),
	(16, 20, 'Chips Ahoy', 'Ahoy', 1, 'Ukuran Sedang'),
	(19, 22, 'Android', 'Xiaomi', 1, 'Redmi Note 10');

-- Dumping structure for table pos.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `status` bigint DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.kategori: ~1 rows (approximately)
INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tgl_input`, `status`) VALUES
	(20, 'Makanan', '30 October 2024, 7:18', 1),
	(21, 'Minuman', '30 October 2024, 16:59', NULL),
	(22, 'Elektronik dan Komunikasi', '31 October 2024, 14:36', NULL);

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

-- Dumping data for table pos.login: ~4 rows (approximately)
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
  `barang_id` int NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_member` int NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL,
  `periode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.nota: ~6 rows (approximately)
INSERT INTO `nota` (`id_nota`, `barang_id`, `nama_barang`, `id_member`, `jumlah`, `total`, `tanggal_input`, `periode`) VALUES
	(16, 19, 'Android', 1, '1', '1350000', '1 November 2024, 8:37', '11-2024'),
	(17, 19, 'Android', 1, '1', '1350000', '1 November 2024, 8:37', '11-2024'),
	(18, 19, 'Android', 1, '3', '4650000', '1 November 2024, 8:58', '11-2024'),
	(19, 19, 'Android', 1, '3', '4650000', '1 November 2024, 8:58', '11-2024'),
	(20, 19, 'Android', 1, '1', '1550000', '1 November 2024, 9:00', '11-2024'),
	(21, 19, 'Android', 1, '1', '1550000', '1 November 2024, 9:00', '11-2024');

-- Dumping structure for table pos.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `barang_id` int NOT NULL,
  `id_member` int NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL DEFAULT (0),
  `tanggal_input` varchar(255) NOT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `id_member` (`id_member`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.penjualan: ~1 rows (approximately)

-- Dumping structure for table pos.stok_transactions
CREATE TABLE IF NOT EXISTS `stok_transactions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('IN','OUT') NOT NULL,
  `harga_beli` int DEFAULT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL,
  `barang_id` int NOT NULL,
  `transaction_date` timestamp NULL DEFAULT (now()),
  PRIMARY KEY (`id`),
  KEY `barang_id(fk)barang` (`barang_id`),
  CONSTRAINT `barang_id(fk)barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tabel stock barang';

-- Dumping data for table pos.stok_transactions: ~4 rows (approximately)
INSERT INTO `stok_transactions` (`id`, `type`, `harga_beli`, `harga_jual`, `stok`, `barang_id`, `transaction_date`) VALUES
	(2, 'IN', 25000, 27000, 20, 15, '2024-10-30 12:11:29'),
	(3, 'IN', 1200000, 1250000, 1, 19, '2024-11-01 01:17:24'),
	(4, 'IN', 1300000, 1350000, 10, 19, '2024-11-01 01:31:41'),
	(5, 'OUT', NULL, 1350000, 1, 19, '2024-11-01 01:56:12'),
	(6, 'IN', 1500000, 1550000, 2, 19, '2024-11-01 01:58:23'),
	(7, 'OUT', NULL, 4650000, 3, 19, '2024-11-01 01:59:08'),
	(8, 'OUT', NULL, 4650000, 3, 19, '2024-11-01 01:59:20'),
	(9, 'OUT', NULL, 1550000, 1, 19, '2024-11-01 02:00:55'),
	(10, 'OUT', NULL, 1550000, 1, 19, '2024-11-01 02:01:14');

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

-- Dumping structure for table pos.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('IN','OUT') NOT NULL,
  `harga_beli` bigint NOT NULL DEFAULT (0),
  `harga_jual` bigint NOT NULL DEFAULT (0),
  `stok` int NOT NULL,
  `barang_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi(fk)barang` (`barang_id`),
  CONSTRAINT `transaksi(fk)barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tabel transaksi nyatat stok dari barang';

-- Dumping data for table pos.transaksi: ~1 rows (approximately)
INSERT INTO `transaksi` (`id`, `type`, `harga_beli`, `harga_jual`, `stok`, `barang_id`) VALUES
	(1, 'IN', 25000, 27000, 20, 15),
	(4, 'IN', 1500000, 1550000, 3, 19);

-- Dumping structure for table pos.units
CREATE TABLE IF NOT EXISTS `units` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='master units, unit name and desc';

-- Dumping data for table pos.units: ~4 rows (approximately)
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

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.16-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk db_persediaan
CREATE DATABASE IF NOT EXISTS `db_persediaan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_persediaan`;

-- membuang struktur untuk table db_persediaan.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `kd_brg` int(3) NOT NULL AUTO_INCREMENT,
  `nm_brg` varchar(50) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`kd_brg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_persediaan.barang: ~0 rows (lebih kurang)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- membuang struktur untuk table db_persediaan.barang_klr
CREATE TABLE IF NOT EXISTS `barang_klr` (
  `no_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `nip` int(3) DEFAULT NULL,
  `jml_keluar` int(3) NOT NULL,
  `wkt_keluar` time NOT NULL,
  `tgl_keluar` date NOT NULL,
  PRIMARY KEY (`no_keluar`),
  KEY `FK__staf` (`nip`),
  CONSTRAINT `FK__staf` FOREIGN KEY (`nip`) REFERENCES `staf` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_persediaan.barang_klr: ~0 rows (lebih kurang)
DELETE FROM `barang_klr`;
/*!40000 ALTER TABLE `barang_klr` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang_klr` ENABLE KEYS */;

-- membuang struktur untuk table db_persediaan.isi_sp
CREATE TABLE IF NOT EXISTS `isi_sp` (
  `kd_brg` int(3) DEFAULT NULL,
  `no_sp` int(5) DEFAULT NULL,
  `jml_psn` int(2) DEFAULT NULL,
  KEY `kd_brg` (`kd_brg`),
  KEY `FK_buat_sp_surat_pesan` (`no_sp`),
  CONSTRAINT `FK__barang` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`),
  CONSTRAINT `FK_buat_sp_surat_pesan` FOREIGN KEY (`no_sp`) REFERENCES `surat_pesan` (`no_sp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_persediaan.isi_sp: ~0 rows (lebih kurang)
DELETE FROM `isi_sp`;
/*!40000 ALTER TABLE `isi_sp` DISABLE KEYS */;
/*!40000 ALTER TABLE `isi_sp` ENABLE KEYS */;

-- membuang struktur untuk table db_persediaan.staf
CREATE TABLE IF NOT EXISTS `staf` (
  `nip` int(3) NOT NULL AUTO_INCREMENT,
  `nm_staf` varchar(50) NOT NULL,
  `telp_staf` varchar(15) DEFAULT NULL,
  `almt_staf` varchar(100) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_persediaan.staf: ~0 rows (lebih kurang)
DELETE FROM `staf`;
/*!40000 ALTER TABLE `staf` DISABLE KEYS */;
/*!40000 ALTER TABLE `staf` ENABLE KEYS */;

-- membuang struktur untuk table db_persediaan.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `kd_supplier` int(3) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(50) DEFAULT NULL,
  `almt_supplier` varchar(100) DEFAULT NULL,
  `telp_supplier` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kd_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_persediaan.supplier: ~0 rows (lebih kurang)
DELETE FROM `supplier`;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- membuang struktur untuk table db_persediaan.surat_pesan
CREATE TABLE IF NOT EXISTS `surat_pesan` (
  `no_sp` int(5) NOT NULL AUTO_INCREMENT,
  `kd_supplier` int(3) DEFAULT NULL,
  `tgl_sp` date DEFAULT NULL,
  PRIMARY KEY (`no_sp`),
  KEY `FK_surat_pesan_supplier` (`kd_supplier`),
  CONSTRAINT `FK_surat_pesan_supplier` FOREIGN KEY (`kd_supplier`) REFERENCES `supplier` (`kd_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_persediaan.surat_pesan: ~0 rows (lebih kurang)
DELETE FROM `surat_pesan`;
/*!40000 ALTER TABLE `surat_pesan` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_pesan` ENABLE KEYS */;

-- membuang struktur untuk table db_persediaan.ttb
CREATE TABLE IF NOT EXISTS `ttb` (
  `no_ttb` int(5) NOT NULL AUTO_INCREMENT,
  `no_sp` int(5) DEFAULT NULL,
  `tgl_ttb` date DEFAULT NULL,
  `total_jml` int(2) DEFAULT NULL,
  `total_hrg` int(8) DEFAULT NULL,
  PRIMARY KEY (`no_ttb`),
  KEY `FK_ttb_surat_pesan` (`no_sp`),
  CONSTRAINT `FK_ttb_surat_pesan` FOREIGN KEY (`no_sp`) REFERENCES `surat_pesan` (`no_sp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel db_persediaan.ttb: ~0 rows (lebih kurang)
DELETE FROM `ttb`;
/*!40000 ALTER TABLE `ttb` DISABLE KEYS */;
/*!40000 ALTER TABLE `ttb` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

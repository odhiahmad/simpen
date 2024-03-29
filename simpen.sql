/*
 Navicat Premium Data Transfer

 Source Server         : Odhi DB
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:3306
 Source Schema         : simpen

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 21/05/2022 14:57:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for d_bagian
-- ----------------------------
DROP TABLE IF EXISTS `d_bagian`;
CREATE TABLE `d_bagian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `direksi` varchar(50) DEFAULT NULL,
  `bagian` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_bagian
-- ----------------------------
BEGIN;
INSERT INTO `d_bagian` VALUES (2, 'Enjiniring', 'Agus Cahyono', 'Manager Bagian Enjinering');
INSERT INTO `d_bagian` VALUES (3, 'Keu SDM & Adm', 'Khairul', 'Manajer Bagian Keu, SDM & Adm');
INSERT INTO `d_bagian` VALUES (4, 'Operasi & Pemeliharaan', 'Anton Gordon Sitohang', 'Manajer Bagian Operasi dan Pemeliharaan');
COMMIT;

-- ----------------------------
-- Table structure for d_cara_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `d_cara_pembayaran`;
CREATE TABLE `d_cara_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_cara_pembayaran
-- ----------------------------
BEGIN;
INSERT INTO `d_cara_pembayaran` VALUES (1, 'sistem bulanan');
INSERT INTO `d_cara_pembayaran` VALUES (2, 'sistem termin');
INSERT INTO `d_cara_pembayaran` VALUES (3, 'pembayaran secara sekaligus');
COMMIT;

-- ----------------------------
-- Table structure for d_coo
-- ----------------------------
DROP TABLE IF EXISTS `d_coo`;
CREATE TABLE `d_coo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_coo
-- ----------------------------
BEGIN;
INSERT INTO `d_coo` VALUES (1, 'Certificate Of Manufacture (COM) dari');
INSERT INTO `d_coo` VALUES (2, 'Certificate Of Original (COO) dari');
INSERT INTO `d_coo` VALUES (3, 'Surat Asal Usul Barang dari');
INSERT INTO `d_coo` VALUES (4, 'Certificate Declaration of Compliance(CDOC)');
INSERT INTO `d_coo` VALUES (5, 'Tidak ada');
COMMIT;

-- ----------------------------
-- Table structure for d_direksi
-- ----------------------------
DROP TABLE IF EXISTS `d_direksi`;
CREATE TABLE `d_direksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bagian` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `bagian` varchar(50) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_direksi
-- ----------------------------
BEGIN;
INSERT INTO `d_direksi` VALUES (1, 4, 'Anton Gordon Sitohang', 'Manajer Bagian Operasi dan Pemeliharaan', '2020-10-22 21:03:39', '2020-10-22 20:49:24');
INSERT INTO `d_direksi` VALUES (2, 3, 'Khairul', 'Manajer Bagian Keu, SDM & ADM', '2020-10-22 21:04:43', '2020-10-22 20:50:52');
INSERT INTO `d_direksi` VALUES (3, 2, 'Agus Cahyono', 'Manajer Bagian Enjiniring', '2020-10-22 21:04:19', '2020-10-22 20:52:25');
COMMIT;

-- ----------------------------
-- Table structure for d_fungsi_pembangkit
-- ----------------------------
DROP TABLE IF EXISTS `d_fungsi_pembangkit`;
CREATE TABLE `d_fungsi_pembangkit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_fungsi_pembangkit
-- ----------------------------
BEGIN;
INSERT INTO `d_fungsi_pembangkit` VALUES (1, 'Pembangkit');
INSERT INTO `d_fungsi_pembangkit` VALUES (2, 'Sarana');
COMMIT;

-- ----------------------------
-- Table structure for d_jabatan_pengawas
-- ----------------------------
DROP TABLE IF EXISTS `d_jabatan_pengawas`;
CREATE TABLE `d_jabatan_pengawas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_jabatan_pengawas
-- ----------------------------
BEGIN;
INSERT INTO `d_jabatan_pengawas` VALUES (1, 'Manager ULPLTG/MG Duri');
INSERT INTO `d_jabatan_pengawas` VALUES (2, 'Manager ULPLTG Teluk Lembu');
INSERT INTO `d_jabatan_pengawas` VALUES (3, 'Manager ULPLTA Koto Panjang');
INSERT INTO `d_jabatan_pengawas` VALUES (4, 'Supv. Rendal Pemeliharaan');
INSERT INTO `d_jabatan_pengawas` VALUES (5, 'Supv. Rendal Operasi');
INSERT INTO `d_jabatan_pengawas` VALUES (6, 'Supv. Energi Primer');
INSERT INTO `d_jabatan_pengawas` VALUES (7, 'Supv. Rendal Op dan Har dan TE ');
INSERT INTO `d_jabatan_pengawas` VALUES (8, 'Pejabat Pelaksana K3 dan Keamanan');
INSERT INTO `d_jabatan_pengawas` VALUES (9, 'Pejabat Pelaksana Lingkungan');
INSERT INTO `d_jabatan_pengawas` VALUES (10, 'Supv. Logistik');
COMMIT;

-- ----------------------------
-- Table structure for d_jenis
-- ----------------------------
DROP TABLE IF EXISTS `d_jenis`;
CREATE TABLE `d_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_jenis
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for d_masa_berlaku
-- ----------------------------
DROP TABLE IF EXISTS `d_masa_berlaku`;
CREATE TABLE `d_masa_berlaku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_masa_berlaku
-- ----------------------------
BEGIN;
INSERT INTO `d_masa_berlaku` VALUES (1, '120');
COMMIT;

-- ----------------------------
-- Table structure for d_masa_garansi
-- ----------------------------
DROP TABLE IF EXISTS `d_masa_garansi`;
CREATE TABLE `d_masa_garansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_masa_garansi
-- ----------------------------
BEGIN;
INSERT INTO `d_masa_garansi` VALUES (1, '0');
INSERT INTO `d_masa_garansi` VALUES (2, '3 (tiga) bulan');
INSERT INTO `d_masa_garansi` VALUES (3, '6 (enam) bulan');
INSERT INTO `d_masa_garansi` VALUES (4, '9 (sembilan) bulan');
INSERT INTO `d_masa_garansi` VALUES (5, '12 (dua belas) bulan');
COMMIT;

-- ----------------------------
-- Table structure for d_metode_pengadaan
-- ----------------------------
DROP TABLE IF EXISTS `d_metode_pengadaan`;
CREATE TABLE `d_metode_pengadaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_induk` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_metode_pengadaan
-- ----------------------------
BEGIN;
INSERT INTO `d_metode_pengadaan` VALUES (1, 0, 'PJ');
INSERT INTO `d_metode_pengadaan` VALUES (2, 0, 'SPK');
INSERT INTO `d_metode_pengadaan` VALUES (3, 0, 'SPBJ');
INSERT INTO `d_metode_pengadaan` VALUES (4, 2, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (5, 2, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (6, 2, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (7, 2, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (8, 3, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (9, 3, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (10, 3, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (11, 3, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (12, 1, 'Tender Terbuka');
INSERT INTO `d_metode_pengadaan` VALUES (13, 1, 'Tender Terbatas');
INSERT INTO `d_metode_pengadaan` VALUES (14, 1, 'Penunjukan Langsung');
INSERT INTO `d_metode_pengadaan` VALUES (15, 12, '1 Tahap 1 Sampul');
INSERT INTO `d_metode_pengadaan` VALUES (16, 12, '1 Tahap 2 Sampul');
INSERT INTO `d_metode_pengadaan` VALUES (17, 12, '2 Tahap 2 Sampul');
INSERT INTO `d_metode_pengadaan` VALUES (18, 13, '1 Tahap 1 Sampul');
INSERT INTO `d_metode_pengadaan` VALUES (19, 13, '1 Tahap 2 Sampul');
INSERT INTO `d_metode_pengadaan` VALUES (20, 14, 'Darurat');
INSERT INTO `d_metode_pengadaan` VALUES (21, 14, 'Normal');
INSERT INTO `d_metode_pengadaan` VALUES (22, 15, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (23, 15, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (24, 15, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (25, 15, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (26, 16, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (27, 16, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (28, 16, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (29, 16, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (30, 17, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (31, 17, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (32, 17, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (33, 17, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (34, 18, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (35, 18, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (36, 18, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (37, 18, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (38, 19, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (39, 19, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (40, 19, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (41, 19, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (42, 20, 'DPT');
INSERT INTO `d_metode_pengadaan` VALUES (43, 20, 'Tanpa DPT');
INSERT INTO `d_metode_pengadaan` VALUES (44, 21, 'DPT');
INSERT INTO `d_metode_pengadaan` VALUES (45, 21, 'Tanpa DPT');
INSERT INTO `d_metode_pengadaan` VALUES (46, 42, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (47, 42, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (48, 42, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (49, 42, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (50, 43, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (51, 43, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (52, 43, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (53, 43, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (54, 44, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (55, 44, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (56, 44, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (57, 44, 'Jasa Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (58, 45, 'Barang');
INSERT INTO `d_metode_pengadaan` VALUES (59, 45, 'Konstruksi');
INSERT INTO `d_metode_pengadaan` VALUES (60, 45, 'Jasa Lainnya');
INSERT INTO `d_metode_pengadaan` VALUES (61, 45, 'Jasa Konstruksi');
COMMIT;

-- ----------------------------
-- Table structure for d_mp1
-- ----------------------------
DROP TABLE IF EXISTS `d_mp1`;
CREATE TABLE `d_mp1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mp` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_mp1
-- ----------------------------
BEGIN;
INSERT INTO `d_mp1` VALUES (1, 1, 'Tender Terbuka');
INSERT INTO `d_mp1` VALUES (2, 1, 'Tender Terbatas');
INSERT INTO `d_mp1` VALUES (3, 1, 'Penunjukan Langsung');
INSERT INTO `d_mp1` VALUES (4, 2, 'Barang');
INSERT INTO `d_mp1` VALUES (5, 2, 'Konstruksi');
INSERT INTO `d_mp1` VALUES (6, 2, 'Jasa Lainnya');
INSERT INTO `d_mp1` VALUES (7, 2, 'Jasa Konstruksi');
INSERT INTO `d_mp1` VALUES (8, 3, 'Barang');
INSERT INTO `d_mp1` VALUES (9, 3, 'Konstruksi');
INSERT INTO `d_mp1` VALUES (10, 3, 'Jasa Lainnya');
INSERT INTO `d_mp1` VALUES (11, 3, 'Jasa Konstruksi');
COMMIT;

-- ----------------------------
-- Table structure for d_mp2
-- ----------------------------
DROP TABLE IF EXISTS `d_mp2`;
CREATE TABLE `d_mp2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mp` int(11) DEFAULT NULL,
  `id_mp_a` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_mp2
-- ----------------------------
BEGIN;
INSERT INTO `d_mp2` VALUES (1, 1, 1, '1 Tahap 1 Sampul');
INSERT INTO `d_mp2` VALUES (2, 1, 1, '1 Tahap 2 Sampul');
INSERT INTO `d_mp2` VALUES (3, 1, 1, '2 Tahap 2 Sampul');
INSERT INTO `d_mp2` VALUES (4, 1, 2, '1 Tahap 1 Sampul');
INSERT INTO `d_mp2` VALUES (5, 1, 2, '1 Tahap 2 Sampul');
INSERT INTO `d_mp2` VALUES (6, 1, 3, 'Darurat');
INSERT INTO `d_mp2` VALUES (7, 1, 3, 'Normal');
COMMIT;

-- ----------------------------
-- Table structure for d_mp3
-- ----------------------------
DROP TABLE IF EXISTS `d_mp3`;
CREATE TABLE `d_mp3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mp` int(11) DEFAULT NULL,
  `id_mp_a` int(11) DEFAULT NULL,
  `id_mp_a_a` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_mp3
-- ----------------------------
BEGIN;
INSERT INTO `d_mp3` VALUES (1, 1, 3, 6, 'DPT');
INSERT INTO `d_mp3` VALUES (2, 1, 3, 6, 'Tanpa DPT');
INSERT INTO `d_mp3` VALUES (3, 1, 3, 7, 'DPT');
INSERT INTO `d_mp3` VALUES (4, 1, 3, 7, 'Tanpa DPT');
COMMIT;

-- ----------------------------
-- Table structure for d_mp4
-- ----------------------------
DROP TABLE IF EXISTS `d_mp4`;
CREATE TABLE `d_mp4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mp` int(11) DEFAULT NULL,
  `id_mp_a` int(11) DEFAULT NULL,
  `id_mp_a_a` int(11) DEFAULT NULL,
  `id_mp_a_a_a` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_mp4
-- ----------------------------
BEGIN;
INSERT INTO `d_mp4` VALUES (1, 1, 3, 6, 1, 'Barang');
INSERT INTO `d_mp4` VALUES (2, 1, 3, 6, 1, 'Konstruksi');
INSERT INTO `d_mp4` VALUES (3, 1, 3, 6, 1, 'Jasa Lainnya');
INSERT INTO `d_mp4` VALUES (4, 1, 3, 6, 1, 'Jasa Konstruksi');
INSERT INTO `d_mp4` VALUES (5, 1, 3, 6, 2, 'Barang');
INSERT INTO `d_mp4` VALUES (6, 1, 3, 6, 2, 'Konstruksi');
INSERT INTO `d_mp4` VALUES (7, 1, 3, 6, 2, 'Jasa Lainnya');
INSERT INTO `d_mp4` VALUES (8, 1, 3, 6, 2, 'Jasa Konstruksi');
INSERT INTO `d_mp4` VALUES (9, 1, 3, 7, 3, 'Barang');
INSERT INTO `d_mp4` VALUES (10, 1, 3, 7, 3, 'Konstruksi');
INSERT INTO `d_mp4` VALUES (11, 1, 3, 7, 3, 'Jasa Lainnya');
INSERT INTO `d_mp4` VALUES (12, 1, 3, 7, 3, 'Jasa Konstruksi');
INSERT INTO `d_mp4` VALUES (13, 1, 3, 7, 4, 'Barang');
INSERT INTO `d_mp4` VALUES (14, 1, 3, 7, 4, 'Konstruksi');
INSERT INTO `d_mp4` VALUES (15, 1, 3, 7, 4, 'Jasa Lainnya');
INSERT INTO `d_mp4` VALUES (16, 1, 3, 7, 4, 'Jasa Konstruksi');
COMMIT;

-- ----------------------------
-- Table structure for d_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `d_pekerjaan`;
CREATE TABLE `d_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `vol_pekerjaan` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_pekerjaan
-- ----------------------------
BEGIN;
INSERT INTO `d_pekerjaan` VALUES (1, 'Tes', 23, 'cm', '2020-12-10 06:06:13', '2020-12-10 06:06:13');
COMMIT;

-- ----------------------------
-- Table structure for d_penerbit_coo
-- ----------------------------
DROP TABLE IF EXISTS `d_penerbit_coo`;
CREATE TABLE `d_penerbit_coo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_penerbit_coo
-- ----------------------------
BEGIN;
INSERT INTO `d_penerbit_coo` VALUES (1, 'Agen Tunggal');
INSERT INTO `d_penerbit_coo` VALUES (2, 'Distributor');
INSERT INTO `d_penerbit_coo` VALUES (3, 'Toko');
INSERT INTO `d_penerbit_coo` VALUES (4, 'Pabrikan');
COMMIT;

-- ----------------------------
-- Table structure for d_penerbit_garansi
-- ----------------------------
DROP TABLE IF EXISTS `d_penerbit_garansi`;
CREATE TABLE `d_penerbit_garansi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_penerbit_garansi
-- ----------------------------
BEGIN;
INSERT INTO `d_penerbit_garansi` VALUES (1, 'Produsen/perakit');
INSERT INTO `d_penerbit_garansi` VALUES (2, 'Agen Tunggal');
INSERT INTO `d_penerbit_garansi` VALUES (3, 'Distributor');
INSERT INTO `d_penerbit_garansi` VALUES (4, 'Supplier/Vendor');
INSERT INTO `d_penerbit_garansi` VALUES (5, 'Toko');
INSERT INTO `d_penerbit_garansi` VALUES (6, 'Tidak Ada');
COMMIT;

-- ----------------------------
-- Table structure for d_pengawas
-- ----------------------------
DROP TABLE IF EXISTS `d_pengawas`;
CREATE TABLE `d_pengawas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_pengawas
-- ----------------------------
BEGIN;
INSERT INTO `d_pengawas` VALUES (1, 'Mohammad Dhaniel');
INSERT INTO `d_pengawas` VALUES (2, 'Andi Okta Riansyah');
INSERT INTO `d_pengawas` VALUES (3, 'Taufik Abdul Muhammad');
INSERT INTO `d_pengawas` VALUES (4, 'Zulfikar Rambe');
INSERT INTO `d_pengawas` VALUES (5, 'Ridwan Saputra');
INSERT INTO `d_pengawas` VALUES (6, 'Cecep Sofhan Munawar');
COMMIT;

-- ----------------------------
-- Table structure for d_perjanjian_kontrak
-- ----------------------------
DROP TABLE IF EXISTS `d_perjanjian_kontrak`;
CREATE TABLE `d_perjanjian_kontrak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metode` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_perjanjian_kontrak
-- ----------------------------
BEGIN;
INSERT INTO `d_perjanjian_kontrak` VALUES (1, 'spk', 'Harga Borongan (Lumpsum)');
INSERT INTO `d_perjanjian_kontrak` VALUES (2, 'spk', 'Harga Satuan (Unit Price)');
INSERT INTO `d_perjanjian_kontrak` VALUES (3, 'spk', 'Gabungan Harga Borongan (Lumpsum) & Harga Satuan (');
INSERT INTO `d_perjanjian_kontrak` VALUES (4, 'spk', 'Terima Jadi (Turn Key)');
INSERT INTO `d_perjanjian_kontrak` VALUES (5, 'spk', 'Kesepakatan Harga Satuan (KHS)');
COMMIT;

-- ----------------------------
-- Table structure for d_pic_pelaksana
-- ----------------------------
DROP TABLE IF EXISTS `d_pic_pelaksana`;
CREATE TABLE `d_pic_pelaksana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metode` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_pic_pelaksana
-- ----------------------------
BEGIN;
INSERT INTO `d_pic_pelaksana` VALUES (1, 'spk', 'Alfi Satria ');
INSERT INTO `d_pic_pelaksana` VALUES (2, 'spk', 'Kidung Sadewa');
INSERT INTO `d_pic_pelaksana` VALUES (3, 'spk', 'Odi Agung Putra');
INSERT INTO `d_pic_pelaksana` VALUES (4, 'spk', 'Adiwal');
INSERT INTO `d_pic_pelaksana` VALUES (5, 'pj', 'Wira Asrani Sidabutar');
INSERT INTO `d_pic_pelaksana` VALUES (6, 'pj', 'Rahmad Al Hidayat Putra ');
INSERT INTO `d_pic_pelaksana` VALUES (7, 'pj', 'Rudy');
INSERT INTO `d_pic_pelaksana` VALUES (8, 'pj', 'Tunggul Yohannes');
COMMIT;

-- ----------------------------
-- Table structure for d_pos_anggaran
-- ----------------------------
DROP TABLE IF EXISTS `d_pos_anggaran`;
CREATE TABLE `d_pos_anggaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_pos_anggaran
-- ----------------------------
BEGIN;
INSERT INTO `d_pos_anggaran` VALUES (1, 'Anggaran Operasi Pos 53.1');
INSERT INTO `d_pos_anggaran` VALUES (2, 'Anggaran Operasi Pos 53.2');
INSERT INTO `d_pos_anggaran` VALUES (3, 'Anggaran Operasi Pos 54');
INSERT INTO `d_pos_anggaran` VALUES (4, 'Emergency');
INSERT INTO `d_pos_anggaran` VALUES (5, 'Anggaran Investasi');
COMMIT;

-- ----------------------------
-- Table structure for d_role
-- ----------------------------
DROP TABLE IF EXISTS `d_role`;
CREATE TABLE `d_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_role
-- ----------------------------
BEGIN;
INSERT INTO `d_role` VALUES (1, 'Direksi');
INSERT INTO `d_role` VALUES (2, 'Pengawas');
INSERT INTO `d_role` VALUES (3, 'Tim Mutu');
INSERT INTO `d_role` VALUES (4, 'Logistik');
INSERT INTO `d_role` VALUES (5, 'Keuangan');
COMMIT;

-- ----------------------------
-- Table structure for d_sistem_denda
-- ----------------------------
DROP TABLE IF EXISTS `d_sistem_denda`;
CREATE TABLE `d_sistem_denda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_sistem_denda
-- ----------------------------
BEGIN;
INSERT INTO `d_sistem_denda` VALUES (1, 'Total nilai Surat Perintah Kerja');
INSERT INTO `d_sistem_denda` VALUES (2, 'Bagian nilai Surat Perintah Kerja');
COMMIT;

-- ----------------------------
-- Table structure for d_status
-- ----------------------------
DROP TABLE IF EXISTS `d_status`;
CREATE TABLE `d_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_status
-- ----------------------------
BEGIN;
INSERT INTO `d_status` VALUES (1, 'PROSES');
INSERT INTO `d_status` VALUES (2, 'DRAFT');
INSERT INTO `d_status` VALUES (3, 'TTD KONTRAK');
INSERT INTO `d_status` VALUES (4, 'TERKONTRAK');
INSERT INTO `d_status` VALUES (5, 'BACKLOG');
INSERT INTO `d_status` VALUES (6, 'DIBATALKAN');
COMMIT;

-- ----------------------------
-- Table structure for d_sub_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `d_sub_pekerjaan`;
CREATE TABLE `d_sub_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pekerjaan` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_sub_pekerjaan
-- ----------------------------
BEGIN;
INSERT INTO `d_sub_pekerjaan` VALUES (1, 1, 'dsfdsfds', '2020-12-04 10:47:48', '2020-12-04 10:47:48');
INSERT INTO `d_sub_pekerjaan` VALUES (2, 1, 'Tesss', '2020-12-06 20:59:40', '2020-12-06 20:59:40');
INSERT INTO `d_sub_pekerjaan` VALUES (3, 1, 'dsfdsfds', '2020-12-06 21:01:31', '2020-12-06 21:01:31');
COMMIT;

-- ----------------------------
-- Table structure for d_sumber_dana
-- ----------------------------
DROP TABLE IF EXISTS `d_sumber_dana`;
CREATE TABLE `d_sumber_dana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_sumber_dana
-- ----------------------------
BEGIN;
INSERT INTO `d_sumber_dana` VALUES (1, 'Operasi');
COMMIT;

-- ----------------------------
-- Table structure for d_syarat_bidang_usaha
-- ----------------------------
DROP TABLE IF EXISTS `d_syarat_bidang_usaha`;
CREATE TABLE `d_syarat_bidang_usaha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_syarat_bidang_usaha
-- ----------------------------
BEGIN;
INSERT INTO `d_syarat_bidang_usaha` VALUES (1, 'Pemasokan barang semua bidang');
INSERT INTO `d_syarat_bidang_usaha` VALUES (2, 'Pemasokan barang Bidang Pertanian');
INSERT INTO `d_syarat_bidang_usaha` VALUES (3, 'Pemasokan barang Bidang Pertambangan Umum');
INSERT INTO `d_syarat_bidang_usaha` VALUES (4, 'Pemasokan barang Bidang Telematika');
INSERT INTO `d_syarat_bidang_usaha` VALUES (5, 'Pemasokan barang Bidang Perhubungan');
INSERT INTO `d_syarat_bidang_usaha` VALUES (6, 'Pemasokan barang Bidang Lain-lainnya');
COMMIT;

-- ----------------------------
-- Table structure for d_tempat_penyerahan_lokasi
-- ----------------------------
DROP TABLE IF EXISTS `d_tempat_penyerahan_lokasi`;
CREATE TABLE `d_tempat_penyerahan_lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metode` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_tempat_penyerahan_lokasi
-- ----------------------------
BEGIN;
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (1, 'spk', 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', 'Jl. Tanjung Datuk No. 74, Pesisir, Kec. Lima Puluh, Kota Pekanbaru, Riau 28155');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (2, 'spk', 'Gudang PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', 'Jl. Tanjung Datuk No. 74, Pesisir, Kec. Lima Puluh, Kota Pekanbaru, Riau 28155');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (3, 'spk', 'ULPLTG/MG Duri', 'Jl. Sungai Kulim, Desa Balai Pungut, Kec. Pinggir, Kab. Bengkalis 28784');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (4, 'spk', 'ULPLTG Teluk Lembu', 'Jl. Tanjung Datuk No. 340, Kel. Tanjung RHU, Kec. Lima puluh, Kota Pekanbaru');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (5, 'spk', 'ULPLTA Koto Panjang', 'Jl. Raya Pekanbaru - Payakumbuh KM 80, Desa Merangin, Kab. Kampar 28463');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (6, 'spk', 'Kantor Unit Pelaksana, ULPLTG/MG Duri, ULPLTG Telu', '-');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (7, 'spk', 'ULPLTG/MG Duri, ULPLTG Teluk Lembu dan ULPLTA Koto', '-');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (9, 'pj', 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', 'Jl. Tanjung Datuk No. 74, Pesisir, Kec. Lima Puluh, Kota Pekanbaru, Riau 28155');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (10, 'pj', 'Gudang PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', 'Jl. Tanjung Datuk No. 74, Pesisir, Kec. Lima Puluh, Kota Pekanbaru, Riau 28155');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (11, 'pj', 'ULPLTG/MG Duri', 'Jl. Sungai Kulim, Desa Balai Pungut, Kec. Pinggir, Kab. Bengkalis 28784');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (12, 'pj', 'ULPLTG Teluk Lembu', 'Jl. Tanjung Datuk No. 340, Kel. Tanjung RHU, Kec. Lima puluh, Kota Pekanbaru');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (13, 'pj', 'ULPLTA Koto Panjang', 'Jl. Raya Pekanbaru - Payakumbuh KM 80, Desa Merangin, Kab. Kampar 28463');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (14, 'pj', 'Kantor Unit Pelaksana, ULPLTG/MG Duri, ULPLTG Telu', '-');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (15, 'pj', 'ULPLTG/MG Duri, ULPLTG Teluk Lembu dan ULPLTA Koto', '-');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (25, 'spbj', 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', 'Jl. Tanjung Datuk No. 74, Pesisir, Kec. Lima Puluh, Kota Pekanbaru, Riau 28155');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (26, 'spbj', 'Gudang PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', 'Jl. Tanjung Datuk No. 74, Pesisir, Kec. Lima Puluh, Kota Pekanbaru, Riau 28155');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (27, 'spbj', 'ULPLTG/MG Duri', 'Jl. Sungai Kulim, Desa Balai Pungut, Kec. Pinggir, Kab. Bengkalis 28784');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (28, 'spbj', 'ULPLTG Teluk Lembu', 'Jl. Tanjung Datuk No. 340, Kel. Tanjung RHU, Kec. Lima puluh, Kota Pekanbaru');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (29, 'spbj', 'ULPLTA Koto Panjang', 'Jl. Raya Pekanbaru - Payakumbuh KM 80, Desa Merangin, Kab. Kampar 28463');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (30, 'spbj', 'Kantor Unit Pelaksana, ULPLTG/MG Duri, ULPLTG Telu', '-');
INSERT INTO `d_tempat_penyerahan_lokasi` VALUES (31, 'spbj', 'ULPLTA KoULPLTG/MG Duri, ULPLTG Teluk Lembu dan UL', '-');
COMMIT;

-- ----------------------------
-- Table structure for d_vfmc
-- ----------------------------
DROP TABLE IF EXISTS `d_vfmc`;
CREATE TABLE `d_vfmc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metode` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of d_vfmc
-- ----------------------------
BEGIN;
INSERT INTO `d_vfmc` VALUES (1, 'spk', 'Tidak Ada');
INSERT INTO `d_vfmc` VALUES (2, 'spk', 'Khairul');
INSERT INTO `d_vfmc` VALUES (3, 'spk', 'Agus Cahyono');
INSERT INTO `d_vfmc` VALUES (4, 'pj', 'Tidak Ada');
INSERT INTO `d_vfmc` VALUES (5, 'pj', 'Budiman Sitorus');
INSERT INTO `d_vfmc` VALUES (6, 'pj', 'Zulkifli Shulham');
INSERT INTO `d_vfmc` VALUES (7, 'spbj', 'Tidak Ada');
INSERT INTO `d_vfmc` VALUES (8, 'spbj', 'Tidak Ada');
INSERT INTO `d_vfmc` VALUES (9, 'spbj', 'Tidak Ada');
COMMIT;

-- ----------------------------
-- Table structure for history_ubah_t_harga
-- ----------------------------
DROP TABLE IF EXISTS `history_ubah_t_harga`;
CREATE TABLE `history_ubah_t_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_database_harga` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `harga_dari` int(11) DEFAULT NULL,
  `harga_ke` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of history_ubah_t_harga
-- ----------------------------
BEGIN;
INSERT INTO `history_ubah_t_harga` VALUES (2, 6, 18, 3533333, 3500000, '2021-04-07 11:42:10', '2020-09-18 08:05:03');
INSERT INTO `history_ubah_t_harga` VALUES (3, 8, 19, 2000, 4000, '2021-04-07 11:42:12', '2020-09-18 18:37:57');
INSERT INTO `history_ubah_t_harga` VALUES (4, 25, 18, 34534, 34534, '2021-04-07 11:42:14', '2020-09-21 06:38:51');
INSERT INTO `history_ubah_t_harga` VALUES (5, 16, 19, 30000, 30000, '2021-04-07 11:42:16', '2020-09-21 06:41:05');
INSERT INTO `history_ubah_t_harga` VALUES (6, 16, 19, 30000, 30000, '2021-04-07 11:42:19', '2020-09-21 06:41:19');
INSERT INTO `history_ubah_t_harga` VALUES (7, 26, 18, 6000, 5000, '2021-04-07 11:42:22', '2020-09-21 12:14:50');
INSERT INTO `history_ubah_t_harga` VALUES (8, 28, 19, 4200, 4300, '2021-04-07 11:42:25', '2020-09-22 13:52:42');
INSERT INTO `history_ubah_t_harga` VALUES (9, 27, 19, 7000, 13200, '2021-04-07 11:42:27', '2020-09-23 09:34:14');
INSERT INTO `history_ubah_t_harga` VALUES (10, 29, 18, 34344, 34344, '2021-04-07 11:42:29', '2020-10-01 15:59:59');
INSERT INTO `history_ubah_t_harga` VALUES (11, 29, 18, 34344, 34344, '2021-04-07 11:42:31', '2020-10-01 16:00:06');
INSERT INTO `history_ubah_t_harga` VALUES (12, 29, 19, 34344, 34344, '2021-04-07 11:42:33', '2020-10-01 16:00:14');
INSERT INTO `history_ubah_t_harga` VALUES (13, 29, 18, 34344, 5000, '2021-04-07 11:42:35', '2020-10-01 16:00:20');
COMMIT;

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_type` varchar(50) DEFAULT NULL,
  `model_id` bigint(20) DEFAULT NULL,
  `collection_name` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `mime_type` varchar(50) DEFAULT NULL,
  `disk` varchar(50) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `manipulations` text,
  `custom_properties` text,
  `responsive_images` text,
  `order_column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of media
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pos_anggaran
-- ----------------------------
DROP TABLE IF EXISTS `pos_anggaran`;
CREATE TABLE `pos_anggaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pos_anggaran
-- ----------------------------
BEGIN;
INSERT INTO `pos_anggaran` VALUES (1, 'Anggaran Operasi Pos 53.1');
INSERT INTO `pos_anggaran` VALUES (2, 'Anggaran Operasi Pos 53.2');
INSERT INTO `pos_anggaran` VALUES (3, 'Anggaran Operasi Pos 54');
INSERT INTO `pos_anggaran` VALUES (4, 'Emergency');
INSERT INTO `pos_anggaran` VALUES (5, 'Anggaran Investasi');
COMMIT;

-- ----------------------------
-- Table structure for status_berakhir
-- ----------------------------
DROP TABLE IF EXISTS `status_berakhir`;
CREATE TABLE `status_berakhir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of status_berakhir
-- ----------------------------
BEGIN;
INSERT INTO `status_berakhir` VALUES (2, 'Sejak BA Terima Lokasi');
COMMIT;

-- ----------------------------
-- Table structure for sub_judul
-- ----------------------------
DROP TABLE IF EXISTS `sub_judul`;
CREATE TABLE `sub_judul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ips` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sub_judul
-- ----------------------------
BEGIN;
INSERT INTO `sub_judul` VALUES (4, 13, 'Tes Sub Judul', '2020-12-14 10:38:50', '2020-12-14 10:38:50');
COMMIT;

-- ----------------------------
-- Table structure for sub_sub_judul
-- ----------------------------
DROP TABLE IF EXISTS `sub_sub_judul`;
CREATE TABLE `sub_sub_judul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ips` int(11) DEFAULT NULL,
  `id_sub_judul` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sub_sub_judul
-- ----------------------------
BEGIN;
INSERT INTO `sub_sub_judul` VALUES (6, 4, 13, 'ewrewrew', '2020-12-15 12:12:08', '2020-12-15 12:12:08');
COMMIT;

-- ----------------------------
-- Table structure for t_harga
-- ----------------------------
DROP TABLE IF EXISTS `t_harga`;
CREATE TABLE `t_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) NOT NULL DEFAULT '',
  `satuan` varchar(255) NOT NULL DEFAULT '',
  `harga_satuan` int(11) NOT NULL,
  `spesifikasi` text NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT '',
  `sertifikat` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COMMENT='Tabel Database Harga';

-- ----------------------------
-- Records of t_harga
-- ----------------------------
BEGIN;
INSERT INTO `t_harga` VALUES (29, 'Where', 'Tidak Tahu', 5000, 'Tess', '396085034.PNG', '278110802.png', 1, '2020-10-01 23:00:20', '2020-10-01 16:00:20');
INSERT INTO `t_harga` VALUES (30, 'ddfg', 'dfgdfg', 32432432, 'dsfdf', '1337850232.PNG', 'dsfds', 1, '2021-01-29 09:35:00', '2021-01-29 09:35:00');
COMMIT;

-- ----------------------------
-- Table structure for t_pembayaran_pengadaan
-- ----------------------------
DROP TABLE IF EXISTS `t_pembayaran_pengadaan`;
CREATE TABLE `t_pembayaran_pengadaan` (
  `id` int(11) NOT NULL,
  `id_kontrak` int(11) DEFAULT NULL,
  `harga_penawaran` int(11) DEFAULT NULL,
  `harga_kontrak` int(11) DEFAULT NULL,
  `nilai_jaminan_garansi` int(11) DEFAULT NULL,
  `jangka_waktu_penyelesaian` int(11) DEFAULT NULL,
  `melampirkan_sertifikat_coo` int(11) DEFAULT NULL,
  `coo_asal_usul` varchar(50) DEFAULT NULL,
  `penerbit_coo` varchar(50) DEFAULT NULL,
  `melampirkan_sertifikat_garansi` int(11) DEFAULT NULL,
  `penerbit_sertifikasi_garansi` varchar(50) DEFAULT NULL,
  `melampirkan_msds` int(11) DEFAULT NULL,
  `sistem_denda` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_pembayaran_pengadaan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for t_pengadaan
-- ----------------------------
DROP TABLE IF EXISTS `t_pengadaan`;
CREATE TABLE `t_pengadaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_proses` varchar(50) NOT NULL DEFAULT '0',
  `no_proses_pengadaan` varchar(50) NOT NULL DEFAULT '0',
  `no_prk` varchar(50) DEFAULT NULL,
  `no_nota_dinas` varchar(50) DEFAULT NULL,
  `tgl_nota_dinas` date DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `tgl_diterima_panitia` date DEFAULT NULL,
  `bagian` varchar(255) DEFAULT NULL,
  `fungsi_pembangkit` varchar(255) DEFAULT NULL,
  `no_undang_pl` varchar(255) DEFAULT NULL,
  `lingkup_pekerjaan` varchar(255) DEFAULT NULL,
  `id_metode_pengadaan` int(11) DEFAULT NULL,
  `id_mp1` int(11) DEFAULT '0',
  `id_mp2` int(11) DEFAULT '0',
  `id_mp3` int(11) DEFAULT '0',
  `id_mp4` int(11) DEFAULT '0',
  `id_mp5` int(11) DEFAULT '0',
  `metode_pengadaan` varchar(255) DEFAULT NULL,
  `metode_pengadaan_detail` varchar(255) DEFAULT NULL,
  `rencana` varchar(255) DEFAULT NULL,
  `tempat_penyerahan` varchar(255) DEFAULT NULL,
  `masa_berlaku_surat` varchar(255) DEFAULT NULL,
  `cara_pembayaran` varchar(255) DEFAULT NULL,
  `jenis_perjanjian` varchar(255) DEFAULT NULL,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `masa_garansi` varchar(255) DEFAULT NULL,
  `syarat_bidang` varchar(255) DEFAULT NULL,
  `alamat_penyerahan` varchar(255) DEFAULT NULL,
  `jabatan_direksi` varchar(255) DEFAULT NULL,
  `vfmc` varchar(255) DEFAULT NULL,
  `vfmc2` varchar(255) DEFAULT NULL,
  `pengguna` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `pejabat_pelaksana` varchar(255) DEFAULT NULL,
  `direksi` varchar(255) DEFAULT NULL,
  `pengawas` varchar(255) DEFAULT NULL,
  `jabatan_pengawas` varchar(255) DEFAULT NULL,
  `ketua_tim` varchar(255) DEFAULT NULL,
  `pic_pelaksana` varchar(255) DEFAULT NULL,
  `hps` int(11) DEFAULT NULL,
  `kontrak` varchar(255) DEFAULT NULL,
  `proses` varchar(255) DEFAULT NULL,
  `rab` int(11) DEFAULT NULL,
  `nilai_kontrak` int(11) DEFAULT NULL,
  `sisa_anggaran` varchar(50) DEFAULT NULL,
  `pos_anggaran` varchar(50) DEFAULT NULL,
  `harga_penawaran` int(11) DEFAULT NULL,
  `harga_kontrak` int(11) DEFAULT NULL,
  `nilai_jaminan` int(11) DEFAULT NULL,
  `jangka_waktu` int(11) DEFAULT NULL,
  `jangka_waktu_hari` varchar(50) DEFAULT NULL,
  `jangka_waktu_tgl` date DEFAULT NULL,
  `coo` varchar(50) DEFAULT NULL,
  `melampirkan_sertifikat_coo` varchar(50) DEFAULT NULL,
  `penerbit_coo` varchar(50) DEFAULT NULL,
  `melampirkan_sertifikat` varchar(50) DEFAULT NULL,
  `penerbit_garansi` varchar(50) DEFAULT NULL,
  `melampirkan_msds` varchar(50) DEFAULT NULL,
  `sistem_denda` varchar(50) DEFAULT NULL,
  `masa_pemeliharaan` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_berakhir` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_keputusan_direksi` varchar(255) DEFAULT NULL,
  `tanggal_keputusan_direksi` date DEFAULT NULL,
  `no_perjanjian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_pengadaan
-- ----------------------------
BEGIN;
INSERT INTO `t_pengadaan` VALUES (31, '009', '0', '234', '0274', '2021-12-29', '2022-01-28', 'pengadaan material threeway valve ulpltg/mg duri', 6, 2022, '2022-01-27', 'Operasi & Pemeliharaan', 'Pembangkit', '009', 'pengadaan material threeway valve ulpltg/mg duri gg', NULL, 2, 4, NULL, NULL, NULL, 'SPK', NULL, NULL, 'ULPLTG Teluk Lembu', '120', 'pembayaran secara sekaligus', 'Harga Borongan (Lumpsum)', 'Operasi', '12 (dua belas) bulan', 'Pemasokan barang semua bidang', 'Jl. Tanjung Datuk No. 340, Kel. Tanjung RHU, Kec. Lima puluh, Kota Pekanbaru', 'Manajer Bagian Operasi dan Pemeliharaan', 'Khairul', 'Khairul', 'YUSKAR RADIANTO', '234234', 'YUWANA HANIF UTOMO', 'fdggdfgdg', 'Zulfikar Rambe dfdf', 'Manager ULPLTG/MG Duri', NULL, 'Odi Agung Putra', 298618370, '1779047421.pdf', '1707826739.pdf', 298618370, 27493933, '271.124.437,00', 'Anggaran Operasi Pos 53.2', 100000, 27493933, 1374697, 111, 'Sabtu', '2022-06-04', 'Certificate Of Manufacture (COM) dari', 'Ya', 'Pabrikan', 'Ya', 'Supplier/Vendor', 'Tidak', 'Total nilai Surat Perintah Kerja', NULL, 'TTD KONTRAK', '111', '2021-01-12 20:45:03', '2022-02-16 22:19:46', '4354355', '2022-02-16', NULL);
INSERT INTO `t_pengadaan` VALUES (32, '1', '123', '23', '1', '2021-01-13', '2021-01-15', 'Pengadaan PJ 1sds', 5, 2020, '2021-01-15', 'Enjiniring', 'Sarana', NULL, 'dfsdfsdfsdf', NULL, 1, 12, 16, 26, NULL, 'PJ', NULL, NULL, 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', '120', 'sistem bulanan', 'Harga Borongan (Lumpsum)', 'Operasi', '3 (tiga) bulan', 'Pemasokan barang semua bidang', NULL, 'Manajer Bagian Operasi dan Pemeliharaan', 'Budiman Sitorus', 'Tidak Ada', 'sdfdsfsd', '2342432', 'daddsfdsfdsf', NULL, 'Mohammad Dhaniel', 'Manager ULPLTG/MG Duri', NULL, 'Alfi Satria', 23, '2136072194.pdf', '1969376216.pdf', 23423222, 34, '23.423.188,00', 'Anggaran Operasi Pos 53.1', 2342423, 2307287, 115364, 123, NULL, NULL, 'Certificate Of Manufacture (COM) dari', NULL, 'Agen Tunggal', NULL, 'Produsen/perakit', NULL, 'Total nilai Surat Perintah Kerja', NULL, 'PROSES', '123', '2021-01-14 09:00:50', '2022-05-21 14:52:37', NULL, NULL, NULL);
INSERT INTO `t_pengadaan` VALUES (34, '234', '212', '23432', '234', '2021-02-16', '2021-02-17', 'sdfsdfs', 6, 2021, '2021-02-18', 'Enjiniring', 'Pembangkit', '234', 'dsfsd', NULL, 3, 8, NULL, NULL, NULL, 'SPBJ', NULL, NULL, 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', '120', 'sistem bulanan', 'Harga Borongan (Lumpsum)', 'Operasi', '6 (enam) bulan', 'Pemasokan barang semua bidang', NULL, 'Manajer Bagian Operasi dan Pemeliharaan', 'Tidak Ada', 'Tidak Ada', 'dfdsfsd', '234324', 'dsfdsfsdf', NULL, 'Mohammad Dhaniel', 'Manager ULPLTG/MG Duri', 'dsfdsfsdf', 'Alfi Satria', 2323, '467075300.pdf', '1882328392.pdf', 2342342, 232, '2.342.110,00', 'Anggaran Operasi Pos 53.1', 2342342, 2307207, 115360, 232, NULL, NULL, 'Certificate Of Original (COO) dari', NULL, 'Agen Tunggal', 'Ya', 'Produsen/perakit', NULL, 'Total nilai Surat Perintah Kerja', NULL, 'PROSES', '232', '2021-02-01 11:16:21', '2022-04-02 15:34:36', NULL, NULL, NULL);
INSERT INTO `t_pengadaan` VALUES (35, '1', '123', '23', '1', '2021-01-14', '2021-01-23', 'Pengadaan PJ dsfsdf', 5, 2020, '2021-01-22', 'Enjiniring', 'Sarana', NULL, 'dfsdfsdfsdf', NULL, 1, 12, 15, 22, NULL, 'PJ', NULL, NULL, 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', '120', 'sistem bulanan', 'Harga Borongan (Lumpsum)', 'Operasi', '0', 'Pemasokan barang semua bidang', NULL, 'Manajer Bagian Operasi dan Pemeliharaan', 'Budiman Sitorus', 'Tidak Ada', 'ghfghgfh', '2342432', 'daddsfdsfdsf', 'dsfsfsf', 'Asik dfd', 'Manager ULPLTG/MG Duri', NULL, 'Alfi Satria', 13233, '2136072194.pdf', '1969376216.pdf', 23423222, 23, '23.423.199,00', 'Anggaran Operasi Pos 53.1', 2342423, 2307287, 115364, 123, NULL, NULL, 'Certificate Of Manufacture (COM) dari', NULL, 'Agen Tunggal', NULL, 'Produsen/perakit', NULL, 'Total nilai Surat Perintah Kerja', NULL, 'PROSES', '123', '2021-01-14 09:00:50', '2022-05-21 14:53:19', NULL, NULL, NULL);
INSERT INTO `t_pengadaan` VALUES (36, '1', '23', '23', '1', '2021-01-13', '2021-01-15', 'Pengadaan PJ fsdfdsfs', 5, 2020, '2021-01-15', 'Enjiniring', 'Sarana', NULL, 'dfsdfsdfsdf', NULL, 1, 13, 18, 34, NULL, 'PJ', NULL, NULL, 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', '120', 'sistem bulanan', 'Harga Borongan (Lumpsum)', 'Operasi', '3 (tiga) bulan', 'Pemasokan barang semua bidang', NULL, 'Manajer Bagian Operasi dan Pemeliharaan', 'Budiman Sitorus', 'Tidak Ada', 'sdfdsfsd', '2342432', 'daddsfdsfdsf', 'sdfdsfsdf', 'Mohammad Dhaniel', 'Manager ULPLTG/MG Duri', NULL, 'Alfi Satria', 23, '2136072194.pdf', '1969376216.pdf', 23423222, 232323, '23.190.899,00', 'Anggaran Operasi Pos 53.1', 2342423, 2307287, 115364, 123, NULL, NULL, 'Certificate Of Manufacture (COM) dari', NULL, 'Agen Tunggal', NULL, 'Produsen/perakit', NULL, 'Total nilai Surat Perintah Kerja', NULL, 'PROSES', '123', '2021-01-14 09:00:50', '2022-05-21 14:53:38', NULL, NULL, NULL);
INSERT INTO `t_pengadaan` VALUES (37, '1', '34', '23', '1', '2021-01-13', '2021-01-15', 'Pengadaan PJ sfsdfsd', 5, 2020, '2021-01-15', 'Enjiniring', 'Sarana', NULL, 'dfsdfsdfsdf', NULL, 1, 13, 19, 38, NULL, 'PJ', NULL, NULL, 'Kantor PT PLN (Persero) Unit Pelaksana Pengendalian Pembangkitan Pekanbaru', '120', 'sistem bulanan', 'Harga Borongan (Lumpsum)', 'Operasi', '3 (tiga) bulan', 'Pemasokan barang semua bidang', NULL, 'Manajer Bagian Operasi dan Pemeliharaan', 'Budiman Sitorus', 'Tidak Ada', 'sdfdsfsd', '2342432', 'daddsfdsfdsf', 'sdfdsfsdf', 'Mohammad Dhaniel', 'Manager ULPLTG/MG Duri', NULL, 'Alfi Satria', 23, '2136072194.pdf', '1969376216.pdf', 23423222, 232323, '23.190.899,00', 'Anggaran Operasi Pos 53.1', 2342423, 2307287, 115364, 123, NULL, NULL, 'Certificate Of Manufacture (COM) dari', NULL, 'Agen Tunggal', NULL, 'Produsen/perakit', NULL, 'Total nilai Surat Perintah Kerja', NULL, 'PROSES', '123', '2021-01-14 09:00:50', '2022-05-21 14:52:06', NULL, NULL, NULL);
INSERT INTO `t_pengadaan` VALUES (38, '23', '0', '23', '234', '2021-03-23', '2021-03-18', 'sdfsfsf', NULL, NULL, '2021-03-18', NULL, 'Sarana', NULL, NULL, NULL, 3, 8, NULL, NULL, NULL, 'SPBJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdfdsfsd', NULL, NULL, 'fdgdfg', NULL, NULL, NULL, 'Rahmad Al Hidayat Putra', NULL, NULL, NULL, 3423, NULL, NULL, 'Anggaran Operasi Pos 53.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TERKONTRAK', NULL, '2021-03-20 11:41:52', '2021-03-20 11:41:52', NULL, NULL, NULL);
INSERT INTO `t_pengadaan` VALUES (39, '100', '0', '6', '123', '2022-01-26', '2022-01-28', 'PEMBUATAN GUDANG TELUK LEMBU', 5, 2022, '2022-01-28', 'Keu SDM & Adm', 'Sarana', '100', 'PEMBUATAN GUDANG TELUK LEMBU', NULL, 2, 5, NULL, NULL, NULL, 'SPK', NULL, NULL, 'ULPLTA Koto Panjang', '120', 'pembayaran secara sekaligus', 'Harga Borongan (Lumpsum)', 'Operasi', '6 (enam) bulan', 'Pemasokan barang semua bidang', 'Jl. Raya Pekanbaru - Payakumbuh KM 80, Desa Merangin, Kab. Kampar 28463', 'Manajer Bagian Operasi dan Pemeliharaan', NULL, NULL, 'YUSKAR RADIANTO', 'NIP PAK YUSKAR', 'YUWANA HANIF UTOMO', 'Tes', 'Cecep Sofhan Munawar', 'Manager ULPLTA Koto Panjang', NULL, 'Adiwal', 150000000, NULL, NULL, 150000000, 140000000, '10.000.000,00', 'Anggaran Operasi Pos 53.1', 170000000, 140000000, 8372500, 80, NULL, NULL, 'Surat Asal Usul Barang dari', 'Ya', 'Toko', 'Tidak', 'Produsen/perakit', 'Tidak', 'Total nilai Surat Perintah Kerja', NULL, 'TTD KONTRAK', 'Sejak BA Terima Lokasi', '2022-01-28 16:21:04', '2022-02-16 21:37:58', NULL, NULL, NULL);
INSERT INTO `t_pengadaan` VALUES (40, '3324', '0', 'fdsfsdf', '234234', '2022-02-22', '2022-02-23', 'dfsdfsdfsd', NULL, NULL, '2022-02-18', NULL, 'Pembangkit', NULL, NULL, NULL, 2, 5, NULL, NULL, NULL, 'SPK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdfdsfsd', NULL, NULL, NULL, NULL, NULL, NULL, 'Alfi Satria', NULL, NULL, NULL, 0, NULL, NULL, 'Anggaran Operasi Pos 53.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PROSES', NULL, '2022-02-19 18:48:55', '2022-02-19 18:48:55', NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for t_pengadaan_detail_pj
-- ----------------------------
DROP TABLE IF EXISTS `t_pengadaan_detail_pj`;
CREATE TABLE `t_pengadaan_detail_pj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengadaan` int(11) NOT NULL DEFAULT '0',
  `id_metode` int(11) NOT NULL DEFAULT '0',
  `pembukaan_penawaran_jumlah` int(11) DEFAULT NULL,
  `pembukaan_penawaran_tgl` date DEFAULT NULL,
  `pembukaan_penawaran_hari` varchar(50) DEFAULT NULL,
  `pembukaan_penawaran_nomor` varchar(50) DEFAULT NULL,
  `survey_harga_pasar_jumlah` int(11) DEFAULT NULL,
  `survey_harga_pasar_tgl` date DEFAULT NULL,
  `survey_harga_pasar_hari` varchar(255) DEFAULT NULL,
  `survey_harga_pasar_nomor` varchar(255) DEFAULT NULL,
  `hps_jumlah` int(11) DEFAULT NULL,
  `hps_tgl` date DEFAULT NULL,
  `hps_hari` varchar(255) DEFAULT NULL,
  `hps_nomor` varchar(255) DEFAULT NULL,
  `pengumuman_jumlah` int(11) DEFAULT NULL,
  `pengumuman_tgl` date DEFAULT NULL,
  `pengumuman_hari` varchar(255) DEFAULT NULL,
  `pengumuman_nomor` varchar(255) DEFAULT NULL,
  `undangan_aanwijzing_peserta_jumlah` int(11) DEFAULT NULL,
  `undangan_aanwijzing_peserta_tgl` date DEFAULT NULL,
  `undangan_aanwijzing_peserta_hari` varchar(255) DEFAULT NULL,
  `undangan_aanwijzing_peserta_nomor` varchar(255) DEFAULT NULL,
  `undangan_aanwijzing_direksi_pekerjaan_jumlah` int(11) DEFAULT NULL,
  `undangan_aanwijzing_direksi_pekerjaan_tgl` date DEFAULT NULL,
  `undangan_aanwijzing_direksi_pekerjaan_hari` varchar(255) DEFAULT NULL,
  `undangan_aanwijzing_direksi_pekerjaan_nomor` varchar(255) DEFAULT NULL,
  `aanwijzing_jumlah` int(11) DEFAULT NULL,
  `aanwijzing_tgl` date DEFAULT NULL,
  `aanwijzing_hari` varchar(255) DEFAULT NULL,
  `aanwijzing_nomor` varchar(255) DEFAULT NULL,
  `addendum_rks_jumlah` int(11) DEFAULT NULL,
  `addendum_rks_tgl` date DEFAULT NULL,
  `addendum_rks_hari` varchar(255) DEFAULT NULL,
  `addendum_rks_nomor` varchar(255) DEFAULT NULL,
  `pemasukan_dok_penawaran_jumlah` int(11) DEFAULT NULL,
  `pemasukan_dok_penawaran_jumlah_dari` int(11) DEFAULT NULL,
  `pemasukan_dok_penawaran_tgl_dari` date DEFAULT NULL,
  `pemasukan_dok_penawaran_tgl` date DEFAULT NULL,
  `pemasukan_dok_penawaran_hari` varchar(255) DEFAULT NULL,
  `pemasukan_dok_penawaran_hari_dari` varchar(255) DEFAULT NULL,
  `pemasukan_dok_penawaran_nomor` varchar(255) DEFAULT NULL,
  `pembukaan_penawaran_sampul_satu_jumlah` int(11) DEFAULT NULL,
  `pembukaan_penawaran_sampul_satu_tgl` date DEFAULT NULL,
  `pembukaan_penawaran_sampul_satu_hari` varchar(255) DEFAULT NULL,
  `pembukaan_penawaran_sampul_satu_nomor` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_satu_jumlah` int(11) DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_satu_tgl` date DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_satu_hari` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_satu_nomor` varchar(255) DEFAULT NULL,
  `pengumuman_hasil_evaluasi_sampul_satu_jumlah` int(11) DEFAULT NULL,
  `pengumuman_hasil_evaluasi_sampul_satu_tgl` date DEFAULT NULL,
  `pengumuman_hasil_evaluasi_sampul_satu_hari` varchar(255) DEFAULT NULL,
  `pengumuman_hasil_evaluasi_sampul_satu_nomor` varchar(255) DEFAULT NULL,
  `pembukaan_penawaran_sampul_dua_jumlah` int(11) DEFAULT NULL,
  `pembukaan_penawaran_sampul_dua_tgl` date DEFAULT NULL,
  `pembukaan_penawaran_sampul_dua_hari` varchar(255) DEFAULT NULL,
  `pembukaan_penawaran_sampul_dua_nomor` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_dua_jumlah` int(11) DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_dua_tgl` date DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_dua_hari` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_sampul_dua_nomor` varchar(255) DEFAULT NULL,
  `pembukaan_dok_penawaran_jumlah` int(11) DEFAULT NULL,
  `pembukaan_dok_penawaran_tgl` date DEFAULT NULL,
  `pembukaan_dok_penawaran_hari` varchar(255) DEFAULT NULL,
  `pembukaan_dok_penawaran_nomor` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_jumlah` int(11) DEFAULT NULL,
  `evaluasi_dok_penawaran_tgl` date DEFAULT NULL,
  `evaluasi_dok_penawaran_hari` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_nomor` varchar(255) DEFAULT NULL,
  `undangan_pembuktian_kualifikasi_jumlah` int(11) DEFAULT NULL,
  `undangan_pembuktian_kualifikasi_tgl` date DEFAULT NULL,
  `undangan_pembuktian_kualifikasi_hari` varchar(255) DEFAULT NULL,
  `undangan_pembuktian_kualifikasi_nomor` varchar(255) DEFAULT NULL,
  `pembuktian_kualifikasi_jumlah` int(11) DEFAULT NULL,
  `pembuktian_kualifikasi_tgl` date DEFAULT NULL,
  `pembuktian_kualifikasi_hari` varchar(255) DEFAULT NULL,
  `pembuktian_kualifikasi_nomor` varchar(255) DEFAULT NULL,
  `undangan_klarifikasi_dan_nego_penawaran_jumlah` int(11) DEFAULT NULL,
  `undangan_klarifikasi_dan_nego_penawaran_tgl` date DEFAULT NULL,
  `undangan_klarifikasi_dan_nego_penawaran_hari` varchar(255) DEFAULT NULL,
  `undangan_klarifikasi_dan_nego_penawaran_nomor` varchar(255) DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_jumlah` int(11) DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_tgl` date DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_hari` varchar(255) DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_nomor` varchar(255) DEFAULT NULL,
  `laporan_hasil_evaluasi_jumlah` int(11) DEFAULT NULL,
  `laporan_hasil_evaluasi_tgl` date DEFAULT NULL,
  `laporan_hasil_evaluasi_hari` varchar(255) DEFAULT NULL,
  `laporan_hasil_evaluasi_nomor` varchar(255) DEFAULT NULL,
  `nd_usulan_penetapan_calon_pemenang_jumlah` int(11) DEFAULT NULL,
  `nd_usulan_penetapan_calon_pemenang_tgl` date DEFAULT NULL,
  `nd_usulan_penetapan_calon_pemenang_hari` varchar(255) DEFAULT NULL,
  `nd_usulan_penetapan_calon_pemenang_nomor` varchar(255) DEFAULT NULL,
  `nd_penetapan_calon_pemenang_jumlah` int(11) DEFAULT NULL,
  `nd_penetapan_calon_pemenang_tgl` date DEFAULT NULL,
  `nd_penetapan_calon_pemenang_hari` varchar(255) DEFAULT NULL,
  `nd_penetapan_calon_pemenang_nomor` varchar(255) DEFAULT NULL,
  `pengumuman_calon_pemenang_jumlah` int(11) DEFAULT NULL,
  `pengumuman_calon_pemenang_tgl` date DEFAULT NULL,
  `pengumuman_calon_pemenang_hari` varchar(255) DEFAULT NULL,
  `pengumuman_calon_pemenang_nomor` varchar(255) DEFAULT NULL,
  `penunjukan_pemenang_jumlah` int(11) DEFAULT NULL,
  `penunjukan_pemenang_tgl` date DEFAULT NULL,
  `penunjukan_pemenang_hari` varchar(255) DEFAULT NULL,
  `penunjukan_pemenang_nomor` varchar(255) DEFAULT NULL,
  `skkp_jumlah` int(11) DEFAULT NULL,
  `skkp_tgl` date DEFAULT NULL,
  `skkp_hari` varchar(255) DEFAULT NULL,
  `skkp_nomor` varchar(255) DEFAULT NULL,
  `undangan_cda_jumlah` int(11) DEFAULT NULL,
  `undangan_cda_tgl` date DEFAULT NULL,
  `undangan_cda_hari` varchar(255) DEFAULT NULL,
  `undangan_cda_nomor` varchar(255) DEFAULT NULL,
  `cda_jumlah` int(11) DEFAULT NULL,
  `cda_tgl` date DEFAULT NULL,
  `cda_hari` varchar(255) DEFAULT NULL,
  `cda_nomor` varchar(255) DEFAULT NULL,
  `pj_jumlah` int(11) DEFAULT NULL,
  `pj_tgl` date DEFAULT NULL,
  `pj_hari` varchar(255) DEFAULT NULL,
  `pj_nomor` varchar(255) DEFAULT NULL,
  `spk_jumlah` int(11) DEFAULT NULL,
  `spk_tgl` date DEFAULT NULL,
  `spk_hari` varchar(255) DEFAULT NULL,
  `spk_nomor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rks_jumlah` int(255) DEFAULT NULL,
  `rks_tgl` date DEFAULT NULL,
  `rks_hari` varchar(255) DEFAULT NULL,
  `rks_nomor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_pengadaan_detail_pj
-- ----------------------------
BEGIN;
INSERT INTO `t_pengadaan_detail_pj` VALUES (23, 32, 0, NULL, NULL, NULL, NULL, 1, '2021-01-17', 'Minggu', '0123.BASVY-PL/DAN.02.07/210200/2020', 1, '2021-01-18', 'Senin', '0123.HPS-PL/DAN.02.07/210200/2020', 2, '2021-01-20', 'Rabu', '0123.PENGLLNG/DAN.07.01/210200/2020', NULL, NULL, NULL, NULL, 2, '2021-01-22', 'Jumat', '0123.UND/DAN.02.07/210200/2020', 1, '2021-01-23', 'Sabtu', '0123.BAANWZ/DAN.02.07/210200/2020', 1, '2021-01-24', 'Minggu', '0123.RKS/DAN.02.07/210200/2020', 1, 2, '2021-01-26', '2021-01-27', 'Rabu', 'Selasa', NULL, 1, '2021-01-28', 'Kamis', '0123.BAPPS1/DAN.02.07/210200/2020', 2, '2021-01-30', 'Sabtu', '0123.BAEPS1/DAN.02.07/210200/2020', 1, '2021-01-31', 'Minggu', '0123.PHES1/DAN.02.07/210200/2020', 1, '2021-02-01', 'Senin', '0123.BAPPS2/DAN.02.07/210200/2020', 1, '2021-02-02', 'Selasa', '0123.BAEPS2/DAN.02.07/210200/2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-02-03', 'Rabu', '0123.UNDPK/DAN.02.07/210200/2020', 1, '2021-02-04', 'Kamis', '0123.BAPK/DAN.02.07/210200/2020', 1, '2021-02-05', 'Jumat', '0123.UNDKTNH/DAN.02.07/210200/2020', 1, '2021-02-06', 'Sabtu', '0123.BAHKTNH/DAN.02.07/210200/2020', 1, '2021-02-07', 'Minggu', '0123.LHE/DAN.02.07/210200/2020', 1, '2021-02-08', 'Senin', '0123.NDUP/DAN.02.07/210200/2020', 1, '2021-02-09', 'Selasa', '0123.NDP/DAN.02.07/210200/2020', 1, '2021-02-10', 'Rabu', '0123.PENGHP/DAN.02.07/210200/2020', 1, '2021-02-11', 'Kamis', '0123.SPPBJ/DAN.02.07/210200/2020', 1, '2021-02-12', 'Jumat', '0123.K/DAN.02.07/210200/2020', 1, '2021-02-13', 'Sabtu', '0123.UNDCDA/DAN.02.07/210200/2020', 2, '2021-02-15', 'Senin', '0123.BACDA/DAN.02.07/210200/2020', NULL, NULL, NULL, '010.SPK/DAN.02.01/210200/2020', 1, '2021-02-16', 'Selasa', '0123.SPK/DAN.02.01/210200/2020', '2021-01-14 09:00:50', '2022-05-21 14:52:37', 1, '2021-01-16', 'Sabtu', '0123.RKS/DAN.01.06/210200/2020');
INSERT INTO `t_pengadaan_detail_pj` VALUES (24, 35, 0, 3, '2021-02-28', 'Minggu', '0123.BAPP1/DAN.02.07/210200/2020', 12, '2021-02-04', 'Kamis', '0123.BASVY-PL/DAN.02.07/210200/2020', 3, '2021-02-07', 'Minggu', '0123.HPS-PL/DAN.02.07/210200/2020', 2, '2021-02-09', 'Selasa', '0123.PENGLLNG/DAN.07.01/210200/2020', NULL, NULL, NULL, NULL, 3, '2021-02-12', 'Jumat', '0123.UND/DAN.02.07/210200/2020', 5, '2021-02-17', 'Rabu', '0123.BAANWZ/DAN.02.07/210200/2020', 2, '2021-02-19', 'Jumat', '0123.RKS/DAN.02.07/210200/2020', 3, 3, '2021-02-22', '2021-02-25', 'Kamis', 'Senin', NULL, 1, '2021-01-24', 'Minggu', '023.BAPPS1/DAN.02.07/210200/2020', 1, '2021-01-25', 'Senin', '023.BAEPS1/DAN.02.07/210200/2020', 1, '2021-01-27', 'Rabu', '023.PHES1/DAN.02.07/210200/2020', 1, '2021-01-28', 'Kamis', '023.BAPPS2/DAN.02.07/210200/2020', 1, '2021-01-29', 'Jumat', '023.BAEPS2/DAN.02.07/210200/2020', NULL, NULL, NULL, NULL, 1, '2021-03-01', 'Senin', '0123.BAEP1/DAN.02.07/210200/2020', 1, '2021-03-02', 'Selasa', '0123.UNDPK/DAN.02.07/210200/2020', 2, '2021-03-04', 'Kamis', '0123.BAPK/DAN.02.07/210200/2020', 3, '2021-03-07', 'Minggu', '0123.UNDKTNH/DAN.02.07/210200/2020', 3, '2021-03-10', 'Rabu', '0123.BAHKTNH/DAN.02.07/210200/2020', 3, '2021-03-13', 'Sabtu', '0123.LHE/DAN.02.07/210200/2020', 3, '2021-03-16', 'Selasa', '0123.NDUP/DAN.02.07/210200/2020', 3, '2021-03-19', 'Jumat', '0123.NDP/DAN.02.07/210200/2020', 3, '2021-03-22', 'Senin', '0123.PENGHP/DAN.02.07/210200/2020', 3, '2021-03-25', 'Kamis', '0123.SPPBJ/DAN.02.07/210200/2020', 3, '2021-03-28', 'Minggu', '0123.K/DAN.02.07/210200/2020', 3, '2021-03-31', 'Rabu', '0123.UNDCDA/DAN.02.07/210200/2020', 3, '2021-04-03', 'Sabtu', '0123.BACDA/DAN.02.07/210200/2020', NULL, NULL, NULL, NULL, 3, '2021-04-06', 'Selasa', '0123.SPK/DAN.02.07/210200/2020', '2021-01-14 09:00:50', '2022-05-21 14:53:19', 1, '2021-01-23', 'Sabtu', '0123.RKS/DAN.01.06/210200/2020');
INSERT INTO `t_pengadaan_detail_pj` VALUES (25, 36, 0, 1, '2021-01-27', 'Rabu', '023.BAPP1/DAN.02.07/210200/2020', 1, '2021-01-17', 'Minggu', '023.BASVY-PL/DAN.02.07/210200/2020', 1, '2021-01-18', 'Senin', '023.HPS-PL/DAN.02.07/210200/2020', 1, '2021-01-19', 'Selasa', '023.PENGLLNG/DAN.07.01/210200/2020', NULL, NULL, NULL, NULL, 2, '2021-01-21', 'Kamis', '023.UND/DAN.02.07/210200/2020', 1, '2021-01-22', 'Jumat', '023.BAANWZ/DAN.02.07/210200/2020', 1, '2021-01-23', 'Sabtu', '023.RKS/DAN.02.07/210200/2020', 1, 2, '2021-01-25', '2021-01-26', 'Selasa', 'Senin', NULL, 1, '2021-01-24', 'Minggu', '023.BAPPS1/DAN.02.07/210200/2020', 1, '2021-01-25', 'Senin', '023.BAEPS1/DAN.02.07/210200/2020', 1, '2021-01-27', 'Rabu', '023.PHES1/DAN.02.07/210200/2020', 1, '2021-01-28', 'Kamis', '023.BAPPS2/DAN.02.07/210200/2020', 1, '2021-01-29', 'Jumat', '023.BAEPS2/DAN.02.07/210200/2020', NULL, NULL, NULL, NULL, 2, '2021-01-29', 'Jumat', '023.BAEP1/DAN.02.07/210200/2020', 1, '2021-01-30', 'Sabtu', '023.UNDPK/DAN.02.07/210200/2020', 1, '2021-01-31', 'Minggu', '023.BAPK/DAN.02.07/210200/2020', 1, '2021-01-30', 'Sabtu', '023.UNDKTNH/DAN.02.07/210200/2020', 1, '2021-01-31', 'Minggu', '023.BAHKTNH/DAN.02.07/210200/2020', 1, '2021-02-01', 'Senin', '023.LHE/DAN.02.07/210200/2020', 1, '2021-02-02', 'Selasa', '023.NDUP/DAN.02.07/210200/2020', 1, '2021-02-03', 'Rabu', '023.NDP/DAN.02.07/210200/2020', 1, '2021-02-04', 'Kamis', '023.PENGHP/DAN.02.07/210200/2020', 1, '2021-02-05', 'Jumat', '023.SPPBJ/DAN.02.07/210200/2020', 1, '2021-02-06', 'Sabtu', '023.K/DAN.02.07/210200/2020', 1, '2021-02-07', 'Minggu', '023.UNDCDA/DAN.02.07/210200/2020', 1, '2021-02-08', 'Senin', '023.BACDA/DAN.02.07/210200/2020', NULL, NULL, NULL, '012.SPK/DAN.02.01/210200/2020', 1, '2021-02-09', 'Selasa', '023.SPK/DAN.02.01/210200/2020', '2021-01-14 09:00:50', '2022-05-21 14:53:38', 1, '2021-01-16', 'Sabtu', '023.RKS/DAN.01.06/210200/2020');
INSERT INTO `t_pengadaan_detail_pj` VALUES (26, 37, 0, NULL, NULL, NULL, NULL, 2, '2021-01-19', 'Selasa', '034.BASVY-PL/DAN.02.07/210200/2020', 2, '2021-01-21', 'Kamis', '034.HPS-PL/DAN.02.07/210200/2020', 2, '2021-01-23', 'Sabtu', '034.PENGLLNG/DAN.07.01/210200/2020', NULL, NULL, NULL, NULL, 2, '2021-01-25', 'Senin', '034.UND/DAN.02.07/210200/2020', 2, '2021-01-27', 'Rabu', '034.BAANWZ/DAN.02.07/210200/2020', 2, '2021-01-29', 'Jumat', '034.RKS/DAN.02.07/210200/2020', 3, 2, '2021-02-03', '2021-02-01', 'Senin', 'Rabu', NULL, 2, '2021-02-05', 'Jumat', '034.BAPPS1/DAN.02.07/210200/2020', 2, '2021-02-07', 'Minggu', '034.BAEPS1/DAN.02.07/210200/2020', 3, '2021-02-10', 'Rabu', '034.PHES1/DAN.02.07/210200/2020', 1, '2021-02-11', 'Kamis', '034.BAPPS2/DAN.02.07/210200/2020', 1, '2021-02-12', 'Jumat', '034.BAEPS2/DAN.02.07/210200/2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-01-30', 'Sabtu', '023.UNDPK/DAN.02.07/210200/2020', 1, '2021-01-31', 'Minggu', '023.BAPK/DAN.02.07/210200/2020', 1, '2021-02-13', 'Sabtu', '034.UNDKTNH/DAN.02.07/210200/2020', 1, '2021-02-14', 'Minggu', '034.BAHKTNH/DAN.02.07/210200/2020', 1, '2021-02-15', 'Senin', '034.LHE/DAN.02.07/210200/2020', 1, '2021-02-16', 'Selasa', '034.NDUP/DAN.02.07/210200/2020', 1, '2021-02-17', 'Rabu', '034.NDP/DAN.02.07/210200/2020', 1, '2021-02-18', 'Kamis', '034.PENGHP/DAN.02.07/210200/2020', 1, '2021-02-19', 'Jumat', '034.SPPBJ/DAN.02.07/210200/2020', 1, '2021-02-20', 'Sabtu', '034.K/DAN.02.07/210200/2020', 2, '2021-02-22', 'Senin', '034.UNDCDA/DAN.02.07/210200/2020', NULL, NULL, NULL, '034.SPK/DAN.02.01/210200/2020', NULL, NULL, NULL, NULL, 1, '2021-02-23', 'Selasa', '034.SPK/DAN.02.01/210200/2020', '2021-01-14 09:00:50', '2022-05-21 14:52:06', 2, '2021-01-17', 'Minggu', '034.RKS/DAN.01.06/210200/2020');
COMMIT;

-- ----------------------------
-- Table structure for t_pengadaan_detail_spbj
-- ----------------------------
DROP TABLE IF EXISTS `t_pengadaan_detail_spbj`;
CREATE TABLE `t_pengadaan_detail_spbj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengadaan` int(11) NOT NULL DEFAULT '0',
  `id_metode` int(11) NOT NULL DEFAULT '0',
  `rks_jumlah` int(11) DEFAULT NULL,
  `rks_tgl` date DEFAULT NULL,
  `rks_hari` varchar(255) DEFAULT NULL,
  `rks_nomor` varchar(255) DEFAULT NULL,
  `survey_harga_pasar_jumlah` int(11) DEFAULT NULL,
  `survey_harga_pasar_tgl` date DEFAULT NULL,
  `survey_harga_pasar_hari` varchar(255) DEFAULT NULL,
  `survey_harga_pasar_nomor` varchar(255) DEFAULT NULL,
  `hps_jumlah` int(11) DEFAULT NULL,
  `hps_tgl` date DEFAULT NULL,
  `hps_hari` varchar(255) DEFAULT NULL,
  `hps_nomor` varchar(255) DEFAULT NULL,
  `undangan_pengadaan_langsung_jumlah` int(11) DEFAULT NULL,
  `undangan_pengadaan_langsung_tgl` date DEFAULT NULL,
  `undangan_pengadaan_langsung_hari` varchar(255) DEFAULT NULL,
  `undangan_pengadaan_langsung_nomor` varchar(255) DEFAULT NULL,
  `pemasukan_dok_penawaran_jumlah_dari` int(11) DEFAULT NULL,
  `pemasukan_dok_penawaran_jumlah` int(11) DEFAULT NULL,
  `pemasukan_dok_penawaran_tgl_dari` date DEFAULT NULL,
  `pemasukan_dok_penawaran_tgl` date DEFAULT NULL,
  `pemasukan_dok_penawaran_hari_dari` varchar(255) DEFAULT NULL,
  `pemasukan_dok_penawaran_hari` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_jumlah` int(11) DEFAULT NULL,
  `evaluasi_dok_penawaran_tgl` date DEFAULT NULL,
  `evaluasi_dok_penawaran_hari` varchar(255) DEFAULT NULL,
  `evaluasi_dok_penawaran_nomor` varchar(255) DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_jumlah` int(11) DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_tgl` date DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_hari` varchar(255) DEFAULT NULL,
  `ba_hasil_klarifikasi_dan_nego_penawaran_nomor` varchar(255) DEFAULT NULL,
  `spbj_jumlah` int(11) DEFAULT NULL,
  `spbj_tgl` date DEFAULT NULL,
  `spbj_hari` varchar(255) DEFAULT NULL,
  `spbj_nomor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_pengadaan_detail_spbj
-- ----------------------------
BEGIN;
INSERT INTO `t_pengadaan_detail_spbj` VALUES (24, 34, 0, 3, '2021-02-21', 'Minggu', '0212.RKS/DAN.01.01/210200/2021', 2, '2021-02-23', 'Selasa', '0212.BASVY-PL/DAN.02.01/210200/2021', 1, '2021-02-24', 'Rabu', '0212.HPS-PL/DAN.02.01/210200/2021', 2, '2021-02-28', 'Jumat', '0212.UND-SP/DAN.02.01/210200/2021', 2, 4, '2021-03-24', '2021-02-28', 'Minggu', 'Selasa', 21, '2021-03-23', 'Rabu', '0212.BAEP-SP/DAN.02.01/210200/2021', 1, '2021-03-23', 'Selasa', '0212.BAHKTNH/DAN.02.01/210200/2021', 1, '2021-03-27', 'Sabtu', '0212.SPBJ/DAN.02.01/210200/2021', '2021-02-01 11:16:22', '2022-04-02 15:34:36');
INSERT INTO `t_pengadaan_detail_spbj` VALUES (25, 38, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-20 11:41:52', '2021-03-20 11:41:52');
COMMIT;

-- ----------------------------
-- Table structure for t_pengadaan_detail_spk
-- ----------------------------
DROP TABLE IF EXISTS `t_pengadaan_detail_spk`;
CREATE TABLE `t_pengadaan_detail_spk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengadaan` int(11) NOT NULL DEFAULT '0',
  `id_metode` int(11) NOT NULL DEFAULT '0',
  `no_proses_pengadaan` varchar(50) NOT NULL DEFAULT '0',
  `survei_harga_pasar_jumlah` int(11) DEFAULT NULL,
  `survei_harga_pasar_tgl` date DEFAULT NULL,
  `survei_harga_pasar_hari` varchar(255) DEFAULT NULL,
  `survei_harga_pasar_nomor` varchar(255) DEFAULT NULL,
  `hps_jumlah` int(11) DEFAULT NULL,
  `hps_tgl` date DEFAULT NULL,
  `hps_hari` varchar(255) DEFAULT NULL,
  `hps_nomor` varchar(255) DEFAULT NULL,
  `undangan_pengadaan_langsung_jumlah` int(11) DEFAULT NULL,
  `undangan_pengadaan_langsung_tgl` date DEFAULT NULL,
  `undangan_pengadaan_langsung_hari` varchar(255) DEFAULT NULL,
  `undangan_pengadaan_langsung_nomor` varchar(255) DEFAULT NULL,
  `pemasukan_dok_penawaran_jumlah_dari` int(11) DEFAULT NULL,
  `pemasukan_dok_penawaran_jumlah_sd` int(11) DEFAULT NULL,
  `pemasukan_dok_penawaran_tgl_dari` date DEFAULT NULL,
  `pemasukan_dok_penawaran_tgl_sd` date DEFAULT NULL,
  `pemasukan_dok_penawaran_hari_dari` varchar(255) DEFAULT NULL,
  `pemasukan_dok_penawaran_hari_sd` varchar(255) DEFAULT NULL,
  `evaluasi_dokumen_jumlah_dari` int(11) DEFAULT NULL,
  `evaluasi_dokumen_jumlah_sd` int(11) DEFAULT NULL,
  `evaluasi_dokumen_tgl_dari` date DEFAULT NULL,
  `evaluasi_dokumen_tgl_sd` date DEFAULT NULL,
  `evaluasi_dokumen_hari_dari` varchar(255) DEFAULT NULL,
  `evaluasi_dokumen_hari_sd` varchar(255) DEFAULT NULL,
  `evaluasi_dokumen_nomor` varchar(255) DEFAULT NULL,
  `ba_hasil_klarifikasi_jumlah` int(11) DEFAULT NULL,
  `ba_hasil_klarifikasi_tgl` date DEFAULT NULL,
  `ba_hasil_klarifikasi_hari` varchar(255) DEFAULT NULL,
  `ba_hasil_klarifikasi_nomor` varchar(255) DEFAULT NULL,
  `ba_hasil_pengadaan_jumlah` int(11) DEFAULT NULL,
  `ba_hasil_pengadaan_tgl` date DEFAULT NULL,
  `ba_hasil_pengadaan_hari` varchar(255) DEFAULT NULL,
  `ba_hasil_pengadaan_nomor` varchar(255) DEFAULT NULL,
  `nd_usulan_tetap_pemenang_jumlah` int(11) DEFAULT NULL,
  `nd_usulan_tetap_pemenang_tgl` date DEFAULT NULL,
  `nd_usulan_tetap_pemenang_hari` varchar(255) DEFAULT NULL,
  `nd_usulan_tetap_pemenang_nomor` varchar(255) DEFAULT NULL,
  `nd_penetapan_pemenang_jumlah` int(11) DEFAULT NULL,
  `nd_penetapan_pemenang_tgl` date DEFAULT NULL,
  `nd_penetapan_pemenang_hari` varchar(255) DEFAULT NULL,
  `nd_penetapan_pemenang_nomor` varchar(255) DEFAULT NULL,
  `spk_jumlah` int(11) DEFAULT NULL,
  `spk_tgl` date DEFAULT NULL,
  `spk_hari` varchar(255) DEFAULT NULL,
  `spk_nomor` varchar(255) DEFAULT NULL,
  `rks_jumlah` int(11) DEFAULT NULL,
  `rks_tgl` date DEFAULT NULL,
  `rks_hari` varchar(255) DEFAULT NULL,
  `rks_nomor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of t_pengadaan_detail_spk
-- ----------------------------
BEGIN;
INSERT INTO `t_pengadaan_detail_spk` VALUES (20, 31, 0, '0', 0, '2022-01-28', 'Jumat', '09.BASVY-PL/DAN.02.01/210200/2022', 0, '2022-01-28', 'Jumat', '09.HPS-PL/DAN.02.01/210200/2022', 0, '2022-01-28', 'Jumat', '09.UND-PL/DAN.02.01/210200/2024', 3, 3, '2022-01-31', '2022-02-03', 'Senin', 'Kamis', 1, 3, '2022-02-04', '2022-02-07', 'Jumat', 'Senin', '09.BAEP-PL/DAN.02.01/210200/2022', 1, '2022-02-08', 'Selasa', '09.BAHKTNH-PL/DAN.02.01/210200/2022', 1, '2022-02-09', 'Rabu', '09.BAHPL-PL/DAN.02.01/210200/2022', 1, '2022-02-10', 'Kamis', '09.NDUP-PL/DAN.02.01/210200/2022', 1, '2022-02-11', 'Jumat', '09.NDPP-PL/DAN.02.01/210200/2022', 3, '2022-02-14', 'Senin', '09.SPK/DAN.02.01/210200/2022', 1, '2022-01-28', 'Jumat', '09.RKS/DAN.01.01/210200/2022', '2021-01-12 20:45:03', '2022-02-16 22:19:46');
INSERT INTO `t_pengadaan_detail_spk` VALUES (21, 39, 0, '0', 0, '2022-01-28', 'Jumat', '0120.BASVY-PL/DAN.02.07/210200/2022', 0, '2022-01-28', 'Jumat', '0120.HPS-PL/DAN.02.07/210200/2022', 3, '2022-01-31', 'Senin', '0100.UND-PL/DAN.02.01/210200/2022', 3, 1, '2022-01-31', '2022-02-04', 'Senin', 'Jumat', 1, 1, '2022-02-05', '2022-02-06', 'Sabtu', 'Minggu', '0120.BAEP-PL/DAN.02.07/210200/2022', 1, '2022-02-07', 'Senin', '0120.BAHKTNH-PL/DAN.02.07/210200/2022', 1, '2022-02-08', 'Selasa', '0120.BAHPL-PL/DAN.02.07/210200/2022', 1, '2022-02-09', 'Rabu', '0120.NDUP-PL/DAN.02.07/210200/2022', 1, '2022-02-10', 'Kamis', '0120.NDPP-PL/DAN.02.07/210200/2022', 1, '2022-02-11', 'Jumat', '00120.SPK/DAN.02.07/210200/2022', 0, '2022-01-28', 'Jumat', '0120.RKS/DAN.01.06/210200/2022', '2022-01-28 16:21:04', '2022-02-16 21:37:58');
INSERT INTO `t_pengadaan_detail_spk` VALUES (22, 40, 0, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-19 18:48:55', '2022-02-19 18:48:55');
COMMIT;

-- ----------------------------
-- Table structure for t_pengadaan_sipil
-- ----------------------------
DROP TABLE IF EXISTS `t_pengadaan_sipil`;
CREATE TABLE `t_pengadaan_sipil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_pengadaan_sipil
-- ----------------------------
BEGIN;
INSERT INTO `t_pengadaan_sipil` VALUES (13, 'Tes', '2020-12-14 10:38:50', '2020-12-16 14:46:50');
INSERT INTO `t_pengadaan_sipil` VALUES (14, 'Tes', '2020-12-15 11:45:21', '2020-12-15 11:45:21');
COMMIT;

-- ----------------------------
-- Table structure for t_pengadaan_sipil_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `t_pengadaan_sipil_pekerjaan`;
CREATE TABLE `t_pengadaan_sipil_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ips` int(11) DEFAULT NULL,
  `nama_pekerjaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_pengadaan_sipil_pekerjaan
-- ----------------------------
BEGIN;
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (35, 13, 'Pekerjaan 1', '2020-12-14 10:38:50', '2020-12-14 10:38:50');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (36, 13, 'Pekerjaan 2', '2020-12-14 10:38:50', '2020-12-14 10:38:50');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (37, 14, 'dsfdsfds', '2020-12-15 11:45:21', '2020-12-15 11:45:21');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (38, 14, 'sfdsfdsf', '2020-12-15 11:45:21', '2020-12-15 11:45:21');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (39, 13, 'sdfsdfsd', '2020-12-16 14:17:57', '2020-12-16 14:17:57');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (40, 13, 'fsdfdsf', '2020-12-16 14:17:57', '2020-12-16 14:17:57');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (41, 13, 'fdgfdg', '2021-08-16 15:29:01', '2021-08-16 15:29:01');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (42, 13, 'dfgdfg', '2021-08-16 15:29:01', '2021-08-16 15:29:01');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (43, 13, 'fdgdfg', '2021-08-16 15:29:01', '2021-08-16 15:29:01');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (44, 13, 'fdgdfg', '2021-08-16 15:29:01', '2021-08-16 15:29:01');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (45, 13, 'dfgdfgdf', '2021-08-16 15:29:01', '2021-08-16 15:29:01');
INSERT INTO `t_pengadaan_sipil_pekerjaan` VALUES (46, 13, 'fdgfdgdf', '2021-08-16 15:29:01', '2021-08-16 15:29:01');
COMMIT;

-- ----------------------------
-- Table structure for t_pengadaan_sipil_sub_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `t_pengadaan_sipil_sub_pekerjaan`;
CREATE TABLE `t_pengadaan_sipil_sub_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ips` int(11) DEFAULT NULL,
  `id_pekerjaan` int(11) DEFAULT NULL,
  `id_ips_pekerjaan` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `vol` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_pengadaan_sipil_sub_pekerjaan
-- ----------------------------
BEGIN;
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (26, 13, 1, 35, 'Tes', 23, 324324, 7459452, '2020-12-15 11:46:01', '2020-12-15 11:46:01');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (27, 13, 1, 35, 'Tes', 23, 234234, 5387382, '2020-12-15 11:46:01', '2020-12-15 11:46:01');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (28, 13, 1, 35, 'Tes', 23, 32434, 745982, '2020-12-15 11:46:01', '2020-12-15 11:46:01');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (29, 13, 1, 36, 'Tes', 23, 34543, 794489, '2020-12-16 10:23:22', '2020-12-16 10:23:22');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (30, 13, 1, 36, 'Tes', 23, 345345, 7942935, '2020-12-16 10:23:22', '2020-12-16 10:23:22');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (31, 13, 1, 36, 'Tes', 23, 345345, 7942935, '2020-12-16 10:23:22', '2020-12-16 10:23:22');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (32, 13, 1, 36, 'Tes', 23, 34534, 794282, '2020-12-16 10:23:22', '2020-12-16 10:23:22');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (39, 13, 1, 40, 'Tes', 23, 23432432, 538945936, '2021-01-05 14:39:46', '2021-01-05 14:39:46');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (40, 13, 1, 40, 'Tes', 23, 23432, 538936, '2021-01-05 14:39:46', '2021-01-05 14:39:46');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (41, 14, 1, 37, 'Tes', 23, 324324, 7459452, '2021-01-05 14:41:21', '2021-01-05 14:41:21');
INSERT INTO `t_pengadaan_sipil_sub_pekerjaan` VALUES (42, 14, 1, 37, 'Tes', 23, 234324, 5389452, '2021-01-05 14:41:21', '2021-01-05 14:41:21');
COMMIT;

-- ----------------------------
-- Table structure for t_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `t_perusahaan`;
CREATE TABLE `t_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `pimpinan` varchar(50) DEFAULT NULL,
  `notaris` text,
  `alamat` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `kantor_cabang` varchar(255) DEFAULT NULL,
  `rekening` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `sebutan_jabatan` varchar(255) DEFAULT NULL,
  `bentuk_perusahaan` varchar(255) DEFAULT NULL,
  `telpon` varchar(255) DEFAULT NULL,
  `faksimili` varchar(255) DEFAULT NULL,
  `foto` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_perusahaan
-- ----------------------------
BEGIN;
INSERT INTO `t_perusahaan` VALUES (5, 'CV ANUGERAH ABADI', 'RIKHMAT HAMIDI HARAHAP', 'DIREKTUR BARU AJA', 'RUMBAI', 'BSI', 'RUMBAI', 'REK PAK RIKHMAT', 'NPWP PAK RIKHMAT', 'DIREKTUR JABATAN', 'PT BARU', 'HP PAK RIKHMAT', 'GA ADA', '[\"padangpanjangtimur.png\",\"photo_2020-11-25_10-40-28.png\"]', '2022-04-22 22:32:32', '2022-02-16 22:50:34');
INSERT INTO `t_perusahaan` VALUES (6, 'PT CAHAYA NUSANTARA MAKMUR', 'APRINALDI', 'DIREKTUR BARU', 'JL TANJUNG DATUK NO 74 PEKANBARU', 'BNI', 'KCU PEKANBARU', 'NO REKENING', 'NO NPWP', 'DIREKTUR JABATAN', 'PERSEROAN BARU', '082288779494', '-', '[\"logo.png\",\"logo padang panjang.png\"]', '2022-01-28 15:42:33', '2022-01-28 15:42:33');
INSERT INTO `t_perusahaan` VALUES (7, 'ewrewrew', 'erwrewr', 'ewrewrewr', 'ewrewrewr', 'ewrwerewr', 'werwerwe', 'erwer', '23422', 'dfdsfds', 'sdfsdf', '234234', '234324', '[\"7313.jpg\",\"padangpanjangtimur.png\"]', '2021-02-01 11:36:46', '2021-02-01 11:36:46');
INSERT INTO `t_perusahaan` VALUES (8, 'dfd', 'fdgfg', 'fdgdfg', 'dfgdfg', 'dfgfdgdfgdf', 'gdfgfdgdfg', 'dfgdfgdfg', 'dfgdfgd', 'gdfgfdgfdg', 'dfgdfgfd', 'dfgdfgdf', 'gdfgdfgdf', '[\"background Binar .jpg\"]', '2022-02-09 22:57:29', '2022-02-09 22:57:29');
INSERT INTO `t_perusahaan` VALUES (9, 'dsfsdfds', 'dsfdsfsdf', 'sdfsdfsd', 'fdsfsdfsf', 'fdsfdsfdsfds', 'fdsfdsfds', 'fsdfdsfsd', 'dsfdsfds', 'dsfsfs', 'dsfsdf', 'sdfsdfdsf', 'fsdfsdf', '[\"background Binar .jpg\"]', '2022-02-09 23:00:55', '2022-02-09 23:00:55');
INSERT INTO `t_perusahaan` VALUES (10, 'ddsfs', 'dsfsf', 'sfsfsfs', 'fsfs', 'fsfdsfsf', 'sdff', 'sdfsf', '34234', 'sdfsfs', 'fsffsf', '345435345', '34543', NULL, '2022-02-22 22:59:13', '2022-02-22 22:59:13');
COMMIT;

-- ----------------------------
-- Table structure for t_userakses
-- ----------------------------
DROP TABLE IF EXISTS `t_userakses`;
CREATE TABLE `t_userakses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengadaan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_userakses
-- ----------------------------
BEGIN;
INSERT INTO `t_userakses` VALUES (44, 31, 20, 'Pengawas', '2021-01-14 10:39:24', '2021-01-14 10:39:24');
INSERT INTO `t_userakses` VALUES (45, 31, 22, 'Pengawas', '2021-01-14 10:39:28', '2021-01-14 10:39:28');
INSERT INTO `t_userakses` VALUES (52, 31, 19, 'Pengawas', '2021-01-18 08:51:34', '2021-01-18 08:51:34');
INSERT INTO `t_userakses` VALUES (86, 32, 19, 'Pengawas', '2021-04-21 22:32:30', '2021-04-21 22:32:30');
INSERT INTO `t_userakses` VALUES (87, 32, 24, 'Pengawas', '2021-04-21 22:32:34', '2021-04-21 22:32:34');
INSERT INTO `t_userakses` VALUES (88, 32, 22, 'Pengawas', '2021-04-21 22:32:45', '2021-04-21 22:32:45');
INSERT INTO `t_userakses` VALUES (89, 32, 20, 'Pengawas', '2021-04-21 22:33:00', '2021-04-21 22:33:00');
INSERT INTO `t_userakses` VALUES (90, 32, 23, 'Direksi', '2021-06-08 10:00:13', '2021-06-08 10:00:13');
INSERT INTO `t_userakses` VALUES (91, 32, 21, 'Direksi', '2021-06-08 10:00:30', '2021-06-08 10:00:30');
INSERT INTO `t_userakses` VALUES (95, 31, 21, 'Direksi', '2021-06-08 10:18:58', '2021-06-08 10:18:58');
INSERT INTO `t_userakses` VALUES (96, 31, 23, 'Direksi', '2021-06-08 10:19:01', '2021-06-08 10:19:01');
INSERT INTO `t_userakses` VALUES (97, 31, 18, 'Direksi', '2021-06-08 10:19:02', '2021-06-08 10:19:02');
INSERT INTO `t_userakses` VALUES (109, 33, 23, 'Direksi', '2021-10-04 15:00:57', '2021-10-04 15:00:57');
INSERT INTO `t_userakses` VALUES (110, 33, 21, 'Direksi', '2021-10-04 15:01:04', '2021-10-04 15:01:04');
INSERT INTO `t_userakses` VALUES (111, 33, 18, 'Direksi', '2021-10-04 15:01:17', '2021-10-04 15:01:17');
INSERT INTO `t_userakses` VALUES (112, 33, 19, 'Pengawas', '2021-10-04 15:01:40', '2021-10-04 15:01:40');
INSERT INTO `t_userakses` VALUES (113, 33, 24, 'Pengawas', '2021-10-04 15:01:50', '2021-10-04 15:01:50');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `role_user` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'admin', 'Admin', '$2y$10$Hj.tbfkmMGGGudVAGG7/eO7/SnoaW/F.OAb/upA2p78Xla6IaDexS', 'Admin', 'Admin', 'Admin', '+6285272993360', '2021-01-12 22:12:40', '2020-10-13 21:03:58');
INSERT INTO `users` VALUES (18, 'dhaniel', 'M. Dhaniel', '$2y$10$Hj.tbfkmMGGGudVAGG7/eO7/SnoaW/F.OAb/upA2p78Xla6IaDexS', 'Direksi', 'Direksi', 'Direksi', '+6282384438950', '2021-06-10 09:03:22', '2020-11-17 12:15:33');
INSERT INTO `users` VALUES (19, 'wirman', 'Wirman Mitra', '$2y$10$mPrmOX5qM4nWIX.GJZ5pguz5ug7ZqxLZoc/nVsh/l9VkSQiuJkUDu', 'Pengawas', 'Pengawas', 'Pengawas', '+6282384438950', '2021-04-21 22:32:14', '2020-11-17 12:37:30');
INSERT INTO `users` VALUES (20, 'alben', 'Alben F Dilay', '$2y$10$32xHmSZOB/HhlmAONHW59uay2.Y9PbCH3xHA4jFooTCmnr2bAUeL2', 'Pengawas', 'Pengawas', 'Pengawas', '+6282384438950', '2021-04-21 22:32:12', '2020-11-17 12:38:14');
INSERT INTO `users` VALUES (21, 'anton', 'Anton Gordon Sitohang', '$2y$10$YYP7FRTQNiMeL0x/FY8G/.aOhrIkpMQHRG1U8831/TS3w9mrR5gw2', 'Direksi', 'Direksi', 'Direksi', '+6285272993360', '2021-01-12 22:14:00', '2020-11-17 12:38:33');
INSERT INTO `users` VALUES (22, 'dhani', 'Dhani Irwansyah', '$2y$10$tl65LhEEQkKfHqCOdWi3jeYX9igUMXMmIYu3mHY0Lp16aBBh6L2Qi', 'Pengawas', 'Pengawas', 'Pengawas', '+6282351355530', '2021-04-21 22:31:44', '2020-11-17 12:38:49');
INSERT INTO `users` VALUES (23, 'agus', 'Agus Cahyono', '$2y$10$xgWMD2SdVa8gPMnuRVamv.nd6Bgzk6JnEEuTkrEjmOaJzhOv6HsVC', 'Direksi', 'Direksi', 'Direksi', '+6285272993360', '2021-01-18 08:55:14', '2021-01-14 09:53:34');
INSERT INTO `users` VALUES (24, 'wahyu', 'Wahyu Mustapa', '$2y$10$PKWdHNQB5.5rK5Ohxhrp5.8PBydFTmMhdcjA5tvdxS6WKWa8uHgSu', 'Pengawas', 'Pengawas', 'Pengawas', '+6282351355530', '2021-04-21 22:31:39', '2020-11-17 12:40:41');
INSERT INTO `users` VALUES (25, '12313213213', 'Rizki', '$2y$10$osov6lPh2eV6rOx1tbL3P.WjP1YPpI5cv/XbqFH3Bz5XxLHnsWgJe', NULL, 'Pengawas', 'Tim Mutu', '+6285272993360', '2021-01-14 09:53:12', '2021-01-14 09:53:12');
INSERT INTO `users` VALUES (26, 'admingg', 'Rani GG', '$2y$10$bI3BbLnuyIRCBJPkUGWwGOCHJJ7jwdyFZHjeCyGJpLMfZFCpkvAFy', NULL, 'Tim Mutu', 'Tim Mutu', '085272993360', '2021-10-07 05:57:23', '2021-10-07 05:57:23');
INSERT INTO `users` VALUES (27, 'fajri', 'Fajri', '$2y$10$AdIy3aTPmpFg.G6zx73YLO4niVFpXuLjJb4fNMq9q/GpE9SpW7M4.', NULL, 'Pengawas', 'Tim Mutu', '085272993360', '2021-10-07 06:00:08', '2021-10-07 06:00:08');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

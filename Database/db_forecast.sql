/*
 Navicat Premium Data Transfer

 Source Server         : MySql
 Source Server Type    : MySQL
 Source Server Version : 100416
 Source Host           : localhost:3306
 Source Schema         : db_forecast

 Target Server Type    : MySQL
 Target Server Version : 100416
 File Encoding         : 65001

 Date: 09/06/2021 04:12:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_anggaran
-- ----------------------------
DROP TABLE IF EXISTS `tb_anggaran`;
CREATE TABLE `tb_anggaran`  (
  `id_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_bahan` int(11) NULL DEFAULT NULL,
  `id_rumah` int(11) NULL DEFAULT NULL,
  `jumlah` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_anggaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 109 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_anggaran
-- ----------------------------
INSERT INTO `tb_anggaran` VALUES (1, 1, 1, '242.8571');
INSERT INTO `tb_anggaran` VALUES (2, 2, 1, '0.042857');
INSERT INTO `tb_anggaran` VALUES (4, 3, 1, '0.042857');
INSERT INTO `tb_anggaran` VALUES (5, 4, 1, '0.071429');
INSERT INTO `tb_anggaran` VALUES (6, 5, 1, '0.5');
INSERT INTO `tb_anggaran` VALUES (7, 6, 1, '0.714286');
INSERT INTO `tb_anggaran` VALUES (8, 7, 1, '0.428571');
INSERT INTO `tb_anggaran` VALUES (12, 8, 1, '0.214286');
INSERT INTO `tb_anggaran` VALUES (13, 9, 1, '0.085714');
INSERT INTO `tb_anggaran` VALUES (14, 10, 1, '0.071429');
INSERT INTO `tb_anggaran` VALUES (15, 11, 1, '0.928571');
INSERT INTO `tb_anggaran` VALUES (16, 12, 1, '0.285714');
INSERT INTO `tb_anggaran` VALUES (17, 13, 1, '0.257143');
INSERT INTO `tb_anggaran` VALUES (18, 14, 1, '0.285714');
INSERT INTO `tb_anggaran` VALUES (19, 15, 1, '1');
INSERT INTO `tb_anggaran` VALUES (20, 16, 1, '0.071429');
INSERT INTO `tb_anggaran` VALUES (21, 17, 1, '1.057143');
INSERT INTO `tb_anggaran` VALUES (22, 18, 1, '1');
INSERT INTO `tb_anggaran` VALUES (23, 19, 1, '0.285714');
INSERT INTO `tb_anggaran` VALUES (24, 20, 1, '0.285714');
INSERT INTO `tb_anggaran` VALUES (25, 21, 1, '1');
INSERT INTO `tb_anggaran` VALUES (26, 22, 1, '0.714286');
INSERT INTO `tb_anggaran` VALUES (27, 23, 1, '0.2');
INSERT INTO `tb_anggaran` VALUES (28, 24, 1, '0.1');
INSERT INTO `tb_anggaran` VALUES (29, 25, 1, '0.142857');
INSERT INTO `tb_anggaran` VALUES (30, 26, 1, '0.1');
INSERT INTO `tb_anggaran` VALUES (31, 1, 2, '257.1428571');
INSERT INTO `tb_anggaran` VALUES (32, 2, 2, '0.057142857');
INSERT INTO `tb_anggaran` VALUES (33, 3, 2, '0.057142857');
INSERT INTO `tb_anggaran` VALUES (34, 4, 2, '0.857142857');
INSERT INTO `tb_anggaran` VALUES (35, 5, 2, '0.642857143');
INSERT INTO `tb_anggaran` VALUES (36, 6, 2, '0.857142857');
INSERT INTO `tb_anggaran` VALUES (37, 7, 2, '0.571428571');
INSERT INTO `tb_anggaran` VALUES (38, 8, 2, '0.285714286');
INSERT INTO `tb_anggaran` VALUES (39, 9, 2, '0.085714286');
INSERT INTO `tb_anggaran` VALUES (40, 10, 2, '0.071428571');
INSERT INTO `tb_anggaran` VALUES (41, 11, 2, '1');
INSERT INTO `tb_anggaran` VALUES (42, 12, 2, '0.357154286');
INSERT INTO `tb_anggaran` VALUES (43, 13, 2, '0.285714286');
INSERT INTO `tb_anggaran` VALUES (44, 14, 2, '0.357142857');
INSERT INTO `tb_anggaran` VALUES (45, 15, 2, '1.142857143');
INSERT INTO `tb_anggaran` VALUES (46, 16, 2, '0.071428571');
INSERT INTO `tb_anggaran` VALUES (47, 17, 2, '1.214285714');
INSERT INTO `tb_anggaran` VALUES (48, 18, 2, '1.071428571');
INSERT INTO `tb_anggaran` VALUES (49, 19, 2, '0.314285714');
INSERT INTO `tb_anggaran` VALUES (50, 20, 2, '0.314285714');
INSERT INTO `tb_anggaran` VALUES (51, 21, 2, '1.142857143');
INSERT INTO `tb_anggaran` VALUES (52, 22, 2, '0.785714286');
INSERT INTO `tb_anggaran` VALUES (53, 23, 2, '0.228571429');
INSERT INTO `tb_anggaran` VALUES (54, 24, 2, '0.142857143');
INSERT INTO `tb_anggaran` VALUES (55, 25, 2, '0.185714286');
INSERT INTO `tb_anggaran` VALUES (56, 26, 2, '0.142857143');
INSERT INTO `tb_anggaran` VALUES (57, 1, 3, '285.7142857');
INSERT INTO `tb_anggaran` VALUES (58, 2, 3, '0.064285714');
INSERT INTO `tb_anggaran` VALUES (59, 3, 3, '0.085714286');
INSERT INTO `tb_anggaran` VALUES (60, 4, 3, '1.114285714');
INSERT INTO `tb_anggaran` VALUES (61, 5, 3, '0.714285714');
INSERT INTO `tb_anggaran` VALUES (62, 6, 3, '1.057142857');
INSERT INTO `tb_anggaran` VALUES (63, 7, 3, '0.8');
INSERT INTO `tb_anggaran` VALUES (64, 8, 3, '0.4');
INSERT INTO `tb_anggaran` VALUES (65, 9, 3, '0.085714286');
INSERT INTO `tb_anggaran` VALUES (66, 10, 3, '0.071428571');
INSERT INTO `tb_anggaran` VALUES (67, 11, 3, '1.057142857');
INSERT INTO `tb_anggaran` VALUES (68, 12, 3, '0.428571429');
INSERT INTO `tb_anggaran` VALUES (69, 13, 3, '0.357142857');
INSERT INTO `tb_anggaran` VALUES (70, 14, 3, '0.428571429');
INSERT INTO `tb_anggaran` VALUES (71, 15, 3, '1.285714286');
INSERT INTO `tb_anggaran` VALUES (72, 16, 3, '0.078571429');
INSERT INTO `tb_anggaran` VALUES (73, 17, 3, '1.342857143');
INSERT INTO `tb_anggaran` VALUES (74, 18, 3, '1.142857143');
INSERT INTO `tb_anggaran` VALUES (75, 19, 3, '0.357142857');
INSERT INTO `tb_anggaran` VALUES (76, 20, 3, '0.371428571');
INSERT INTO `tb_anggaran` VALUES (77, 21, 3, '1.214285714');
INSERT INTO `tb_anggaran` VALUES (78, 22, 3, '0.857142857');
INSERT INTO `tb_anggaran` VALUES (79, 23, 3, '0.257142857');
INSERT INTO `tb_anggaran` VALUES (80, 24, 3, '0.171428571');
INSERT INTO `tb_anggaran` VALUES (81, 25, 3, '0.214285714');
INSERT INTO `tb_anggaran` VALUES (82, 26, 3, '0.171428571');
INSERT INTO `tb_anggaran` VALUES (83, 1, 4, '357.1428571');
INSERT INTO `tb_anggaran` VALUES (84, 2, 4, '0.071428571');
INSERT INTO `tb_anggaran` VALUES (85, 3, 4, '0.128571429');
INSERT INTO `tb_anggaran` VALUES (86, 4, 4, '1.285714286');
INSERT INTO `tb_anggaran` VALUES (87, 5, 4, '0.957142857');
INSERT INTO `tb_anggaran` VALUES (88, 6, 4, '1.214285714');
INSERT INTO `tb_anggaran` VALUES (89, 7, 4, '0.9');
INSERT INTO `tb_anggaran` VALUES (90, 8, 4, '0.428571429');
INSERT INTO `tb_anggaran` VALUES (91, 9, 4, '0.085714286');
INSERT INTO `tb_anggaran` VALUES (92, 10, 4, '0.071428571');
INSERT INTO `tb_anggaran` VALUES (93, 11, 4, '1.171428571');
INSERT INTO `tb_anggaran` VALUES (94, 12, 4, '0.571428571');
INSERT INTO `tb_anggaran` VALUES (95, 13, 4, '0.5');
INSERT INTO `tb_anggaran` VALUES (96, 14, 4, '0.571428571');
INSERT INTO `tb_anggaran` VALUES (97, 15, 4, '1.714285714');
INSERT INTO `tb_anggaran` VALUES (98, 16, 4, '0.085714286');
INSERT INTO `tb_anggaran` VALUES (99, 17, 4, '1.714285714');
INSERT INTO `tb_anggaran` VALUES (100, 18, 4, '1.285714286');
INSERT INTO `tb_anggaran` VALUES (101, 19, 4, '0.5');
INSERT INTO `tb_anggaran` VALUES (102, 20, 4, '0.428571429');
INSERT INTO `tb_anggaran` VALUES (103, 21, 4, '1.428571429');
INSERT INTO `tb_anggaran` VALUES (104, 22, 4, '1.071428571');
INSERT INTO `tb_anggaran` VALUES (105, 23, 4, '0.4');
INSERT INTO `tb_anggaran` VALUES (106, 24, 4, '0.257142857');
INSERT INTO `tb_anggaran` VALUES (107, 25, 4, '0.4');
INSERT INTO `tb_anggaran` VALUES (108, 26, 4, '0.257142857');

-- ----------------------------
-- Table structure for tb_bahan
-- ----------------------------
DROP TABLE IF EXISTS `tb_bahan`;
CREATE TABLE `tb_bahan`  (
  `id_bahan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bahan` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `satuan` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` int(128) NULL DEFAULT NULL,
  `stok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_bahan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_bahan
-- ----------------------------
INSERT INTO `tb_bahan` VALUES (1, 'BATA MERAH', 'PCS', 600, '8457.7142858');
INSERT INTO `tb_bahan` VALUES (2, 'BATU PONDASI', 'm³', 185000, '9999.885714286');
INSERT INTO `tb_bahan` VALUES (3, 'BENDRAT', 'ROLL', 350000, '9999.885714286');
INSERT INTO `tb_bahan` VALUES (4, 'BESI', 'PCS', 67000, '9994.285714286');
INSERT INTO `tb_bahan` VALUES (5, 'BUBUNGAN', 'm²', 70000, '9994.714285714');
INSERT INTO `tb_bahan` VALUES (6, 'KERAMIK', 'DUS', 65000, '9994.285714286');
INSERT INTO `tb_bahan` VALUES (7, 'KERAMIK DINDING KM 20X25 CM ', 'PCS', 75000, '9994.857142858');
INSERT INTO `tb_bahan` VALUES (8, 'KERAMIK LANTAI KM 20X20 ', 'PCS', 70000, '9999.428571428');
INSERT INTO `tb_bahan` VALUES (9, 'KUSEN JENDELA', 'PCS', 1080000, '9999.828571428');
INSERT INTO `tb_bahan` VALUES (10, 'KUSEN PINTU', 'PCS', 1900000, '9999.857142858');
INSERT INTO `tb_bahan` VALUES (11, 'LIST PLAFOND GYPSUM', 'm²', 17500, '9994');
INSERT INTO `tb_bahan` VALUES (12, 'LIST PLANK KAYU (25 TEBAL 2CM)', 'm²', 90000, '9999.285691428');
INSERT INTO `tb_bahan` VALUES (13, 'PAKU BETON', 'KG', 38000, '9999.428571428');
INSERT INTO `tb_bahan` VALUES (14, 'PAKU USUK', 'KG', 36000, '9999.285714286');
INSERT INTO `tb_bahan` VALUES (15, 'PAPAN KAYU', 'LEMBAR', 13000, '9993.714285714');
INSERT INTO `tb_bahan` VALUES (16, 'PASIR', 'm³', 1500000, '9999.857142858');
INSERT INTO `tb_bahan` VALUES (17, 'PENUTUP ATAP(GENTENG KERAMIK KIA)', 'm²', 90000, '9993.571428572');
INSERT INTO `tb_bahan` VALUES (18, 'PLAFOND GYPSUMBOARD T=9MM RANGKA KAYU', 'm²', 72500, '9993.857142858');
INSERT INTO `tb_bahan` VALUES (19, 'PLEASS', 'SAK', 10000, '9999.371428572');
INSERT INTO `tb_bahan` VALUES (20, 'PLIN KERAMIK 10X30CM ', 'PCS', 65000, '9999.371428572');
INSERT INTO `tb_bahan` VALUES (21, 'RANGKA ATAP (KUDA2, USUK, RENG KAYU KALIMANTAN)', 'm²', 143000, '9993.714285714');
INSERT INTO `tb_bahan` VALUES (22, 'SEMEN', 'SAK', 55000, '9994.428571428');
INSERT INTO `tb_bahan` VALUES (23, 'PIPA 3/4', 'PCS', 26000, '9999.542857142');
INSERT INTO `tb_bahan` VALUES (24, 'PIPA 1/2', 'PCS', 21000, '9999.714285714');
INSERT INTO `tb_bahan` VALUES (25, 'PIPA 3', 'PCS', 38000, '9999.628571428');
INSERT INTO `tb_bahan` VALUES (26, 'PIPA 4', 'PCS', 57000, '9999.714285714');

-- ----------------------------
-- Table structure for tb_pengerjaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengerjaan`;
CREATE TABLE `tb_pengerjaan`  (
  `id_pengerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_now` date NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengerjaan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pengerjaan
-- ----------------------------
INSERT INTO `tb_pengerjaan` VALUES (1, '12', '2021-06-09', 1);
INSERT INTO `tb_pengerjaan` VALUES (2, '12', '2021-06-08', 1);
INSERT INTO `tb_pengerjaan` VALUES (3, '11', '2021-06-08', 1);

-- ----------------------------
-- Table structure for tb_plan
-- ----------------------------
DROP TABLE IF EXISTS `tb_plan`;
CREATE TABLE `tb_plan`  (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_plan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_plan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_plan
-- ----------------------------
INSERT INTO `tb_plan` VALUES (1, 'Mentari Land 1');
INSERT INTO `tb_plan` VALUES (2, 'Mentari Land 2');

-- ----------------------------
-- Table structure for tb_rumah
-- ----------------------------
DROP TABLE IF EXISTS `tb_rumah`;
CREATE TABLE `tb_rumah`  (
  `id_rumah` int(11) NOT NULL AUTO_INCREMENT,
  `type_rumah` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_rumah`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_rumah
-- ----------------------------
INSERT INTO `tb_rumah` VALUES (1, '36');
INSERT INTO `tb_rumah` VALUES (2, '40');
INSERT INTO `tb_rumah` VALUES (3, '45');
INSERT INTO `tb_rumah` VALUES (4, '60');

-- ----------------------------
-- Table structure for tb_stok
-- ----------------------------
DROP TABLE IF EXISTS `tb_stok`;
CREATE TABLE `tb_stok`  (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `id_bahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_stok`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_stok
-- ----------------------------
INSERT INTO `tb_stok` VALUES (6, '1', '10', '2021-06-03');
INSERT INTO `tb_stok` VALUES (7, '1', '15', '2021-06-03');
INSERT INTO `tb_stok` VALUES (9, '1', '15', '2021-06-06');

-- ----------------------------
-- Table structure for tb_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NULL DEFAULT NULL,
  `nama_pembeli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_plan` int(11) NULL DEFAULT NULL,
  `biaya` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_rumah` int(11) NULL DEFAULT NULL,
  `date_created` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_transaksi
-- ----------------------------
INSERT INTO `tb_transaksi` VALUES (1, 1621769472, 'Juhriatul Wakhdiyah', '24', 1, '118000000', 3, '2018-12-15');
INSERT INTO `tb_transaksi` VALUES (2, 1621769472, 'Juhriatul Wakhdiyah', '25', 1, '118000000', 3, '2018-12-15');
INSERT INTO `tb_transaksi` VALUES (3, 1621769631, 'Ning Wasiati', '5', 1, '80000000', 2, '2019-03-11');
INSERT INTO `tb_transaksi` VALUES (4, 1621769695, 'Mujianto', '34', 1, '120000000', 3, '2019-05-04');
INSERT INTO `tb_transaksi` VALUES (5, 1621769695, 'Mujianto', '35', 1, '120000000', 3, '2019-05-04');
INSERT INTO `tb_transaksi` VALUES (6, 1621769734, 'Pralis Suyono', '3', 1, '85000000', 1, '2019-06-01');
INSERT INTO `tb_transaksi` VALUES (7, 1621769869, 'Asmad', '1,2', 1, '88000000', 1, '2020-02-29');
INSERT INTO `tb_transaksi` VALUES (8, 1621769918, 'Samsul Arifin', '16,17,18', 1, '180000000', 2, '2020-09-01');
INSERT INTO `tb_transaksi` VALUES (11, 1622747393, 'Bariq Firjatullah', '10', 2, '200000000', 2, '2021-06-03');
INSERT INTO `tb_transaksi` VALUES (12, 1622747393, 'Bungkring', '11', 2, '120000000', 3, '2021-06-03');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role_id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (1, 'admin', 'admin', '$2y$10$ZL8Cziy79vyIEazdelVbjeA7CP.L2hN2pKnzD3TxkuWbfC0BDrEEm', '2');
INSERT INTO `tb_user` VALUES (2, 'Super Admin', 'superadmin', '$2y$10$n35DSYQfL0sEoEKXbqCAOOrfpOlSFOnGv6saTnPHdx0RbPtlbBXCy', '1');

-- ----------------------------
-- Triggers structure for table tb_rumah
-- ----------------------------
DROP TRIGGER IF EXISTS `insert_penjualan`;
delimiter ;;
CREATE TRIGGER `insert_penjualan` AFTER INSERT ON `tb_rumah` FOR EACH ROW BEGIN
INSERT INTO tb_penjualan (id_rumah) VALUES (new.id_rumah);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tb_rumah
-- ----------------------------
DROP TRIGGER IF EXISTS `delete_rumah`;
delimiter ;;
CREATE TRIGGER `delete_rumah` AFTER DELETE ON `tb_rumah` FOR EACH ROW BEGIN
DELETE FROM tb_penjualan WHERE tb_penjualan.id_rumah = OLD.id_rumah;
DELETE FROM tb_anggaran WHERE tb_anggaran.id_rumah = OLD.id_rumah;
DELETE FROM tb_transaksi WHERE tb_transaksi.id_rumah = OLD.id_rumah;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tb_stok
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stok`;
delimiter ;;
CREATE TRIGGER `update_stok` AFTER INSERT ON `tb_stok` FOR EACH ROW BEGIN
UPDATE tb_bahan SET stok = stok + NEW.stok WHERE id_bahan = NEW.id_bahan;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tb_stok
-- ----------------------------
DROP TRIGGER IF EXISTS `replace_stok`;
delimiter ;;
CREATE TRIGGER `replace_stok` AFTER UPDATE ON `tb_stok` FOR EACH ROW BEGIN
UPDATE tb_bahan SET stok = stok - OLD.stok WHERE id_bahan = OLD.id_bahan;
UPDATE tb_bahan SET stok = stok + NEW.stok WHERE id_bahan = NEW.id_bahan;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;

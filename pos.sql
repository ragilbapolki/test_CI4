/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : 127.0.0.1:3306
 Source Schema         : pos

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 21/04/2023 20:02:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_activation_attempts
-- ----------------------------
DROP TABLE IF EXISTS `auth_activation_attempts`;
CREATE TABLE `auth_activation_attempts`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_activation_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for auth_groups
-- ----------------------------
DROP TABLE IF EXISTS `auth_groups`;
CREATE TABLE `auth_groups`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_groups
-- ----------------------------
INSERT INTO `auth_groups` VALUES (1, 'administrator', 'Administrator');

-- ----------------------------
-- Table structure for auth_groups_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_groups_permissions`;
CREATE TABLE `auth_groups_permissions`  (
  `group_id` int UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int UNSIGNED NOT NULL DEFAULT 0,
  INDEX `auth_groups_permissions_permission_id_foreign`(`permission_id` ASC) USING BTREE,
  INDEX `group_id_permission_id`(`group_id` ASC, `permission_id` ASC) USING BTREE,
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_groups_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for auth_groups_users
-- ----------------------------
DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE `auth_groups_users`  (
  `group_id` int UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int UNSIGNED NOT NULL DEFAULT 0,
  INDEX `auth_groups_users_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `group_id_user_id`(`group_id` ASC, `user_id` ASC) USING BTREE,
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_groups_users
-- ----------------------------
INSERT INTO `auth_groups_users` VALUES (1, 1);

-- ----------------------------
-- Table structure for auth_logins
-- ----------------------------
DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE `auth_logins`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_id` int UNSIGNED NULL DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `email`(`email` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_logins
-- ----------------------------
INSERT INTO `auth_logins` VALUES (1, '::1', 'ragil.bapolki.putra@gmail.com', NULL, '2023-04-15 01:07:33', 0);
INSERT INTO `auth_logins` VALUES (2, '::1', 'b1.bapolki@gmail.com', NULL, '2023-04-15 01:09:27', 0);
INSERT INTO `auth_logins` VALUES (3, '::1', 'b1.bapolki@gmail.com', 2, '2023-04-15 01:09:35', 1);
INSERT INTO `auth_logins` VALUES (4, '::1', 'r1.ragilbapolki@gmail.com', 3, '2023-04-15 01:27:18', 0);
INSERT INTO `auth_logins` VALUES (5, '::1', 'admin@gmail.com', 4, '2023-04-15 01:30:25', 1);
INSERT INTO `auth_logins` VALUES (6, '::1', 'bapolki', NULL, '2023-04-15 07:52:35', 0);
INSERT INTO `auth_logins` VALUES (7, '::1', 'admin@gmail.com', 4, '2023-04-15 07:52:44', 1);
INSERT INTO `auth_logins` VALUES (8, '::1', 'admin@gmail.com', 4, '2023-04-16 06:17:26', 1);
INSERT INTO `auth_logins` VALUES (9, '::1', 'admin@gmail.com', 4, '2023-04-17 07:51:29', 1);
INSERT INTO `auth_logins` VALUES (10, '::1', 'admin@gmail.com', 4, '2023-04-17 20:23:51', 1);
INSERT INTO `auth_logins` VALUES (11, '::1', 'admin@gmail.com', 4, '2023-04-18 07:34:22', 1);
INSERT INTO `auth_logins` VALUES (12, '::1', 'admin@gmail.com', 4, '2023-04-19 08:16:06', 1);
INSERT INTO `auth_logins` VALUES (13, '::1', 'admin@gmail.com', 4, '2023-04-19 10:53:53', 1);
INSERT INTO `auth_logins` VALUES (14, '::1', 'admin@gmail.com', 4, '2023-04-19 14:53:20', 1);
INSERT INTO `auth_logins` VALUES (15, '::1', 'admin@gmail.com', 4, '2023-04-20 03:56:56', 1);
INSERT INTO `auth_logins` VALUES (16, '::1', 'admin@gmail.com', 4, '2023-04-20 07:05:01', 1);
INSERT INTO `auth_logins` VALUES (17, '::1', 'admin@gmail.com', 4, '2023-04-20 07:23:51', 1);
INSERT INTO `auth_logins` VALUES (18, '::1', 'admin@gmail.com', 4, '2023-04-20 12:37:09', 1);
INSERT INTO `auth_logins` VALUES (19, '::1', 'admin@gmail.com', 4, '2023-04-20 13:00:13', 1);
INSERT INTO `auth_logins` VALUES (20, '::1', 'admin@gmail.com', 4, '2023-04-20 20:55:06', 1);
INSERT INTO `auth_logins` VALUES (21, '::1', 'admin@gmail.com', 4, '2023-04-20 20:56:11', 1);
INSERT INTO `auth_logins` VALUES (22, '::1', 'admin@gmail.com', 4, '2023-04-21 09:03:02', 1);
INSERT INTO `auth_logins` VALUES (23, '::1', 'admin', NULL, '2023-04-21 15:45:29', 0);
INSERT INTO `auth_logins` VALUES (24, '::1', 'admin', NULL, '2023-04-21 15:45:35', 0);
INSERT INTO `auth_logins` VALUES (25, '::1', 'admin@gmail.com', 4, '2023-04-21 15:45:45', 1);

-- ----------------------------
-- Table structure for auth_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_permissions`;
CREATE TABLE `auth_permissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for auth_reset_attempts
-- ----------------------------
DROP TABLE IF EXISTS `auth_reset_attempts`;
CREATE TABLE `auth_reset_attempts`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_reset_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for auth_tokens
-- ----------------------------
DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE `auth_tokens`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hashedValidator` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `auth_tokens_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `selector`(`selector` ASC) USING BTREE,
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for auth_users_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_users_permissions`;
CREATE TABLE `auth_users_permissions`  (
  `user_id` int UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int UNSIGNED NOT NULL DEFAULT 0,
  INDEX `auth_users_permissions_permission_id_foreign`(`permission_id` ASC) USING BTREE,
  INDEX `user_id_permission_id`(`user_id` ASC, `permission_id` ASC) USING BTREE,
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_users_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for m_category_products
-- ----------------------------
DROP TABLE IF EXISTS `m_category_products`;
CREATE TABLE `m_category_products`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_category_products
-- ----------------------------
INSERT INTO `m_category_products` VALUES (1, 'Kosmetik', 'KOS', 4, 0, 0, '2023-04-16 09:36:23', '2023-04-16 09:36:23', NULL, '-');
INSERT INTO `m_category_products` VALUES (2, 'Pembersih', 'PEM', 4, 0, 0, '2023-04-16 12:25:47', '2023-04-16 12:25:49', NULL, '-');
INSERT INTO `m_category_products` VALUES (4, 'bapolki', 'KCT0', 4, 4, 4, '2023-04-16 21:03:45', '2023-04-16 21:03:56', '2023-04-16 21:03:56', '-');
INSERT INTO `m_category_products` VALUES (5, 'Makanan ringan', 'MKNR', 4, 0, 0, '2023-04-17 07:58:05', '2023-04-17 07:58:05', NULL, '-');
INSERT INTO `m_category_products` VALUES (6, 'Minuman', 'min', 4, 0, 0, '2023-04-21 10:41:14', '2023-04-21 10:41:14', NULL, '-');
INSERT INTO `m_category_products` VALUES (7, 'Elektronik', 'Elek', 4, 0, 0, '2023-04-21 10:41:34', '2023-04-21 10:41:34', NULL, '-');
INSERT INTO `m_category_products` VALUES (8, 'Bahan Pokok', 'BP', 4, 0, 0, '2023-04-21 10:45:20', '2023-04-21 10:45:20', NULL, '-');

-- ----------------------------
-- Table structure for m_customer
-- ----------------------------
DROP TABLE IF EXISTS `m_customer`;
CREATE TABLE `m_customer`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `genre` int NULL DEFAULT NULL,
  `phone` bigint NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = REDUNDANT;

-- ----------------------------
-- Records of m_customer
-- ----------------------------
INSERT INTO `m_customer` VALUES (1, 'Bapolki', 'Jl. Benowo', 1, 8523116824, '-', 4, 4, 4, '2023-04-16 19:37:47', '2023-04-16 19:58:59', NULL);
INSERT INTO `m_customer` VALUES (2, 'bapolki', 'dasdsadddd', 1, 2147483647, '-', 4, 4, 4, '2023-04-16 21:05:11', '2023-04-16 21:05:21', '2023-04-16 21:05:21');
INSERT INTO `m_customer` VALUES (3, 'Budi', 'Surabaya', 1, 81230653314, '-', 4, 0, 0, '2023-04-20 09:13:09', '2023-04-20 09:13:09', NULL);
INSERT INTO `m_customer` VALUES (4, 'Zaenal', 'Jl. Pakal ', 1, 81230653314, '-', 4, 0, 0, '2023-04-21 10:39:46', '2023-04-21 10:39:46', NULL);
INSERT INTO `m_customer` VALUES (5, 'Fatimah', 'Jl. Gubeng', 2, 81230653314, '-', 4, 0, 0, '2023-04-21 10:40:05', '2023-04-21 10:40:05', NULL);

-- ----------------------------
-- Table structure for m_detail_products
-- ----------------------------
DROP TABLE IF EXISTS `m_detail_products`;
CREATE TABLE `m_detail_products`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `start_date` datetime NULL DEFAULT NULL,
  `end_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_detail_products
-- ----------------------------
INSERT INTO `m_detail_products` VALUES (1, '1', '1000', '200', 4, 0, '2023-04-16 13:59:10', '2023-04-16 13:59:13', NULL, '2023-04-16 13:59:24', NULL);
INSERT INTO `m_detail_products` VALUES (2, '1', '2800', '8000', 4, 0, '2023-04-16 15:01:32', '2023-04-16 15:01:32', NULL, '2023-04-16 15:01:32', NULL);
INSERT INTO `m_detail_products` VALUES (3, '3', '2800', '8000', 4, 4, '2023-04-16 15:11:38', '2023-04-16 15:12:35', NULL, '2023-04-16 15:11:38', '2023-04-16 15:13:21');
INSERT INTO `m_detail_products` VALUES (4, '3', '28000', '8000', 4, 4, '2023-04-16 15:12:35', '2023-04-16 15:13:01', NULL, '2023-04-16 15:12:35', '2023-04-16 15:13:23');
INSERT INTO `m_detail_products` VALUES (5, '3', '280000', '8000', 4, 4, '2023-04-16 15:13:01', '2023-04-16 15:13:30', NULL, '2023-04-16 15:13:01', '2023-04-16 15:13:30');
INSERT INTO `m_detail_products` VALUES (6, '3', '28000', '8000', 4, 0, '2023-04-16 15:13:30', '2023-04-16 15:13:30', NULL, '2023-04-16 15:13:30', NULL);
INSERT INTO `m_detail_products` VALUES (7, '6', '1000000', '8000', 4, 0, '2023-04-16 15:23:32', '2023-04-16 15:23:32', NULL, '2023-04-16 15:23:32', NULL);

-- ----------------------------
-- Table structure for m_products
-- ----------------------------
DROP TABLE IF EXISTS `m_products`;
CREATE TABLE `m_products`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `barcode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `unit_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `stock` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_products
-- ----------------------------
INSERT INTO `m_products` VALUES (1, 'sampo lifeboy', 'sampo lifeboy', '899199220696', '1000', 1, 1, 287, 1, 4, 0, '2023-04-15 19:51:48', '2023-04-20 09:32:28', NULL);
INSERT INTO `m_products` VALUES (3, 'Rinso Detergen', 'Rinso Detergen', '0712345678911', '1000', 1, 2, 7900, NULL, 4, 4, '2023-04-16 12:28:03', '2023-04-20 09:32:28', NULL);
INSERT INTO `m_products` VALUES (4, 'Buku', '-', 'DRk988818', '1000', 2, 2, 1800, 4, 4, 4, '2023-04-16 15:22:11', '2023-04-17 08:00:01', '2023-04-17 08:00:01');
INSERT INTO `m_products` VALUES (5, 'rrrr', '-', '414dsds', '1000', 2, 1, 8003, 4, 0, 4, '2023-04-16 15:22:49', '2023-04-16 15:23:14', '2023-04-16 15:23:14');
INSERT INTO `m_products` VALUES (6, 'Potato balado', 'Potato balado', '8991609119892', '1000', 1, 1, 7905, 4, 4, 0, '2023-04-16 15:23:32', '2023-04-20 09:30:38', NULL);
INSERT INTO `m_products` VALUES (7, 'Faical wash wardah', 'sabun cuci muka', '780198601838', '1000', 1, 1, 70, 4, 4, 0, '2023-04-17 07:56:52', '2023-04-20 09:22:04', NULL);
INSERT INTO `m_products` VALUES (8, 'Speaker Simbada', 'Speaker -', '8999777004163', '300000', 1, 7, 24, 4, 4, 0, '2023-04-21 10:42:43', '2023-04-21 11:01:05', NULL);
INSERT INTO `m_products` VALUES (9, 'Nivea Roll On', '-', '8999777004187', '21000', 1, 1, 339, 4, 4, 0, '2023-04-21 10:43:07', '2023-04-21 11:01:05', NULL);
INSERT INTO `m_products` VALUES (10, 'Cheetos', 'Snack jagung', '899977700465', '9000', 1, 5, 800, 4, 4, 0, '2023-04-21 10:44:34', '2023-04-21 10:57:09', NULL);
INSERT INTO `m_products` VALUES (11, 'Oreo Black Pink', 'Snack', '89916091687892', '10000', 1, 5, 341, 4, 4, 0, '2023-04-21 10:45:02', '2023-04-21 10:57:24', NULL);
INSERT INTO `m_products` VALUES (12, 'Gula Pasir', 'GP', '8999777004176', '18000', 2, 8, 0, 4, 4, 0, '2023-04-21 10:46:13', '2023-04-21 10:54:10', NULL);
INSERT INTO `m_products` VALUES (13, 'Tepung Terigu Cakra', 'TTP', '899973404163', '14000', 2, 8, 0, 4, 4, 0, '2023-04-21 10:46:40', '2023-04-21 10:53:31', NULL);
INSERT INTO `m_products` VALUES (14, 'Tepung Tapioka Rose', 'TTR', '89916329119892', '14000', 2, 8, 0, 4, 4, 0, '2023-04-21 10:47:09', '2023-04-21 10:53:57', NULL);

-- ----------------------------
-- Table structure for m_store
-- ----------------------------
DROP TABLE IF EXISTS `m_store`;
CREATE TABLE `m_store`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` bigint NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_store
-- ----------------------------
INSERT INTO `m_store` VALUES (3, 'Toko Suyono 1', 'Jl. Medan merdeka 1', 8523116824, '----', 4, 4, 0, '2023-04-17 08:19:07', '2023-04-17 08:29:51', NULL);
INSERT INTO `m_store` VALUES (4, 'Toko Tejo', 'Jl semarang no 5 malang', 81230653314, '-', 4, 4, 0, '2023-04-17 08:30:43', '2023-04-17 21:33:12', NULL);

-- ----------------------------
-- Table structure for m_supplier
-- ----------------------------
DROP TABLE IF EXISTS `m_supplier`;
CREATE TABLE `m_supplier`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` bigint NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_supplier
-- ----------------------------
INSERT INTO `m_supplier` VALUES (1, 'sutejo', 'Jl. Ngemplak', 8523116824, '-', 4, 0, 4, '2023-04-16 19:09:48', '2023-04-16 19:18:44', NULL);
INSERT INTO `m_supplier` VALUES (2, 'Juned', 'Jl. Sawo 32', 8523116824, '-', 4, 4, 0, '2023-04-16 19:11:10', '2023-04-16 19:18:23', NULL);
INSERT INTO `m_supplier` VALUES (3, 'Heri', 'Jl. Tulungagung 3, Gundih, Kota Surabaya, Jawa Tim', 835425355, '-', 4, 0, 0, '2023-04-17 08:43:03', '2023-04-17 08:43:03', NULL);
INSERT INTO `m_supplier` VALUES (4, 'Poniman', '-', 81230653314, '-', 4, 0, 0, '2023-04-21 10:57:47', '2023-04-21 10:57:47', NULL);

-- ----------------------------
-- Table structure for m_unit
-- ----------------------------
DROP TABLE IF EXISTS `m_unit`;
CREATE TABLE `m_unit`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_unit
-- ----------------------------
INSERT INTO `m_unit` VALUES (1, 'Pieces', 'PCS', 4, 0, 0, '2023-04-16 09:35:41', '2023-04-16 09:35:41', NULL, '-');
INSERT INTO `m_unit` VALUES (2, 'Kilogram', 'KG', 4, 0, 0, '2023-04-16 09:36:05', '2023-04-16 09:36:05', NULL, '-');
INSERT INTO `m_unit` VALUES (3, 'Liter', 'LT', 4, 0, 0, '2023-04-21 10:47:33', '2023-04-21 10:47:33', NULL, '-');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order` int NULL DEFAULT NULL,
  `parent_id` int NULL DEFAULT NULL,
  `modul_id` int NULL DEFAULT NULL,
  `token` int NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Master', '#', 'master', 1, 0, 0, 0, NULL, NULL, 1, 0, 0, '2023-04-15 15:01:12', '2023-04-15 15:01:12', NULL);
INSERT INTO `menus` VALUES (2, 'Products', '/products', 'products', 1, 1, 0, 0, NULL, NULL, 1, 0, 0, '2023-04-15 15:02:53', '2023-04-15 15:02:55', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1681536929, 1);

-- ----------------------------
-- Table structure for t_order
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `customer_id` int NULL DEFAULT NULL,
  `moneys` decimal(50, 0) NULL DEFAULT NULL,
  `total_payment` decimal(50, 0) NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `change` decimal(50, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_order
-- ----------------------------
INSERT INTO `t_order` VALUES (38, 'INV/2023/04/19/27', '2023-05-18', 1, 5000, 3000, 4, 0, '2023-05-18 09:56:56', '2023-05-18 09:56:56', 2000.00);
INSERT INTO `t_order` VALUES (39, 'INV/2023/04/19/39', '2023-04-27', 1, 10000, 5000, 4, 0, '2023-04-19 11:20:21', '2023-04-19 11:20:21', 5000.00);
INSERT INTO `t_order` VALUES (40, 'INV/2023/04/19/40', '2023-04-19', 1, 10000, 7000, 4, 0, '2023-04-19 11:22:18', '2023-04-19 11:22:18', 3000.00);
INSERT INTO `t_order` VALUES (41, 'INV/2023/04/19/41', '2023-04-19', 1, 10000, 8000, 4, 0, '2023-04-19 11:22:55', '2023-04-19 11:22:55', 2000.00);
INSERT INTO `t_order` VALUES (42, 'INV/2023/04/20/1', '2023-04-20', 3, 20000, 10000, 4, 0, '2023-04-20 09:17:37', '2023-04-20 09:17:37', 10000.00);
INSERT INTO `t_order` VALUES (43, 'INV/2023/04/20/1', '2023-04-20', 3, 20000, 10000, 4, 0, '2023-04-20 09:18:23', '2023-04-20 09:18:23', 10000.00);
INSERT INTO `t_order` VALUES (44, 'INV/2023/04/20/44', '2023-04-20', 1, 10000, 7000, 4, 0, '2023-04-20 09:20:02', '2023-04-20 09:20:02', 3000.00);
INSERT INTO `t_order` VALUES (45, 'INV/2023/04/20/45', '2023-04-20', 1, 10000, 5000, 4, 0, '2023-04-20 09:22:04', '2023-04-20 09:22:04', 5000.00);
INSERT INTO `t_order` VALUES (46, 'INV/2023/04/20/46', '2023-03-02', 1, 100000, 80000, 4, 0, '2023-03-02 09:26:09', '2023-03-02 09:26:09', 20000.00);
INSERT INTO `t_order` VALUES (47, 'INV/2023/04/20/47', '2023-04-20', 1, 20000, 15000, 4, 0, '2023-04-20 09:26:54', '2023-04-20 09:26:54', 5000.00);
INSERT INTO `t_order` VALUES (48, 'INV/2023/04/20/48', '2023-04-20', 1, 50000, 20000, 4, 0, '2023-04-20 09:27:57', '2023-04-20 09:27:57', 30000.00);
INSERT INTO `t_order` VALUES (49, 'INV/2023/04/20/49', '2023-04-20', 3, 100000, 75000, 4, 0, '2023-04-20 09:30:38', '2023-04-20 09:30:38', 25000.00);
INSERT INTO `t_order` VALUES (50, 'INV/2023/04/20/50', '2023-04-20', 3, 100000, 53000, 4, 0, '2023-04-20 09:32:28', '2023-04-20 09:32:28', 47000.00);
INSERT INTO `t_order` VALUES (51, 'INV/2023/04/21/1', '2023-04-21', 5, 400000, 321000, 4, 0, '2023-04-21 11:01:05', '2023-04-21 11:01:05', 79000.00);

-- ----------------------------
-- Table structure for t_order_detail
-- ----------------------------
DROP TABLE IF EXISTS `t_order_detail`;
CREATE TABLE `t_order_detail`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `price` decimal(50, 0) NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `deleted_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `total_price` decimal(50, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_order_detail
-- ----------------------------
INSERT INTO `t_order_detail` VALUES (10, 38, 3, 1000, 3, 4, 0, 0, '2023-05-18 09:56:56', '2023-05-18 09:56:56', NULL, 3000.00);
INSERT INTO `t_order_detail` VALUES (11, 39, 7, 1000, 5, 4, 0, 0, '2023-04-19 11:20:21', '2023-04-19 11:20:21', NULL, 5000.00);
INSERT INTO `t_order_detail` VALUES (12, 40, 1, 1000, 7, 4, 0, 0, '2023-04-19 11:22:18', '2023-04-19 11:22:18', NULL, 7000.00);
INSERT INTO `t_order_detail` VALUES (13, 41, 7, 1000, 8, 4, 0, 0, '2023-04-19 11:22:55', '2023-04-19 11:22:55', NULL, 8000.00);
INSERT INTO `t_order_detail` VALUES (14, 41, 3, 1000, 8, 4, 0, 0, '2023-04-19 11:22:55', '2023-04-19 11:22:55', NULL, 8000.00);
INSERT INTO `t_order_detail` VALUES (15, 42, 1, 1000, 4, 4, 0, 0, '2023-04-20 09:17:37', '2023-04-20 09:17:37', NULL, 4000.00);
INSERT INTO `t_order_detail` VALUES (16, 43, 1, 1000, 4, 4, 0, 0, '2023-04-20 09:18:23', '2023-04-20 09:18:23', NULL, 4000.00);
INSERT INTO `t_order_detail` VALUES (17, 43, 3, 1000, 6, 4, 0, 0, '2023-04-20 09:18:23', '2023-04-20 09:18:23', NULL, 6000.00);
INSERT INTO `t_order_detail` VALUES (18, 44, 1, 1000, 7, 4, 0, 0, '2023-04-20 09:20:02', '2023-04-20 09:20:02', NULL, 7000.00);
INSERT INTO `t_order_detail` VALUES (19, 45, 7, 1000, 5, 4, 0, 0, '2023-04-20 09:22:04', '2023-04-20 09:22:04', NULL, 5000.00);
INSERT INTO `t_order_detail` VALUES (20, 46, 3, 1000, 80, 4, 0, 0, '2023-03-02 09:26:09', '2023-03-02 09:26:09', NULL, 80000.00);
INSERT INTO `t_order_detail` VALUES (21, 47, 6, 1000, 15, 4, 0, 0, '2023-04-20 09:26:54', '2023-04-20 09:26:54', NULL, 15000.00);
INSERT INTO `t_order_detail` VALUES (22, 48, 6, 1000, 20, 4, 0, 0, '2023-04-20 09:27:57', '2023-04-20 09:27:57', NULL, 20000.00);
INSERT INTO `t_order_detail` VALUES (23, 49, 6, 1000, 75, 4, 0, 0, '2023-04-20 09:30:38', '2023-04-20 09:30:38', NULL, 75000.00);
INSERT INTO `t_order_detail` VALUES (24, 50, 3, 1000, 51, 4, 0, 0, '2023-04-20 09:32:28', '2023-04-20 09:32:28', NULL, 51000.00);
INSERT INTO `t_order_detail` VALUES (25, 50, 1, 1000, 2, 4, 0, 0, '2023-04-20 09:32:28', '2023-04-20 09:32:28', NULL, 2000.00);
INSERT INTO `t_order_detail` VALUES (26, 51, 8, 300000, 1, 4, 0, 0, '2023-04-21 11:01:05', '2023-04-21 11:01:05', NULL, 300000.00);
INSERT INTO `t_order_detail` VALUES (27, 51, 9, 21000, 1, 4, 0, 0, '2023-04-21 11:01:05', '2023-04-21 11:01:05', NULL, 21000.00);

-- ----------------------------
-- Table structure for t_price_products
-- ----------------------------
DROP TABLE IF EXISTS `t_price_products`;
CREATE TABLE `t_price_products`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date` datetime NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_price_products
-- ----------------------------
INSERT INTO `t_price_products` VALUES (3, '3', '30000', '2023-04-16 22:43:35', '-', 4, 0, '2023-04-16 22:43:35', '2023-04-16 22:43:35');
INSERT INTO `t_price_products` VALUES (4, '7', '31000', '2023-04-17 08:01:20', '-', 4, 0, '2023-04-17 08:01:20', '2023-04-17 08:01:20');
INSERT INTO `t_price_products` VALUES (5, '11', '10000', '2023-04-21 10:48:01', 'Harga Bulan april', 4, 0, '2023-04-21 10:48:01', '2023-04-21 10:48:01');
INSERT INTO `t_price_products` VALUES (6, '9', '21000', '2023-04-21 10:52:23', 'Periode April', 4, 0, '2023-04-21 10:52:23', '2023-04-21 10:52:23');
INSERT INTO `t_price_products` VALUES (7, '8', '300000', '2023-04-21 10:52:38', '-', 4, 0, '2023-04-21 10:52:38', '2023-04-21 10:52:38');
INSERT INTO `t_price_products` VALUES (8, '10', '9000', '2023-04-21 10:52:57', 'Periode April', 4, 0, '2023-04-21 10:52:57', '2023-04-21 10:52:57');
INSERT INTO `t_price_products` VALUES (9, '13', '14000', '2023-04-21 10:53:31', 'Periode April', 4, 0, '2023-04-21 10:53:31', '2023-04-21 10:53:31');
INSERT INTO `t_price_products` VALUES (10, '14', '14000', '2023-04-21 10:53:57', 'Periode April', 4, 0, '2023-04-21 10:53:57', '2023-04-21 10:53:57');
INSERT INTO `t_price_products` VALUES (11, '12', '18000', '2023-04-21 10:54:10', '-', 4, 0, '2023-04-21 10:54:10', '2023-04-21 10:54:10');

-- ----------------------------
-- Table structure for t_stock
-- ----------------------------
DROP TABLE IF EXISTS `t_stock`;
CREATE TABLE `t_stock`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date` datetime NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `type` int NULL DEFAULT NULL,
  `supplier_id` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_stock
-- ----------------------------
INSERT INTO `t_stock` VALUES (1, '4', '1000', '2023-04-16 23:29:46', '-', 4, 0, '2023-04-16 23:29:46', '2023-04-16 23:29:46', 1, 1);
INSERT INTO `t_stock` VALUES (2, '3', '3', '2023-04-16 23:32:10', '-', 4, 0, '2023-04-16 23:32:10', '2023-04-16 23:32:10', 2, 1);
INSERT INTO `t_stock` VALUES (3, '7', '50', '2023-04-17 08:01:54', '-', 4, 0, '2023-04-17 08:01:54', '2023-04-17 08:01:54', 1, 1);
INSERT INTO `t_stock` VALUES (4, '3', '40', '2023-04-17 09:03:33', '-', 4, 0, '2023-04-17 09:03:33', '2023-04-17 09:03:33', 1, 1);
INSERT INTO `t_stock` VALUES (5, '6', '40', '2023-04-17 09:04:49', '-', 4, 0, '2023-04-17 09:04:49', '2023-04-17 09:04:49', 1, 1);
INSERT INTO `t_stock` VALUES (6, '7', '25', '2023-04-17 09:05:59', '-', 4, 0, '2023-04-17 09:05:59', '2023-04-17 09:05:59', 1, 2);
INSERT INTO `t_stock` VALUES (7, '6', '25', '2023-04-17 09:16:17', 'Rusak', 4, 0, '2023-04-17 09:16:17', '2023-04-17 09:16:17', 2, 1);
INSERT INTO `t_stock` VALUES (8, '8', '25', '2023-04-21 10:56:39', '-', 4, 0, '2023-04-21 10:56:39', '2023-04-21 10:56:39', 1, 3);
INSERT INTO `t_stock` VALUES (9, '9', '340', '2023-04-21 10:56:56', '-', 4, 0, '2023-04-21 10:56:56', '2023-04-21 10:56:56', 1, 3);
INSERT INTO `t_stock` VALUES (10, '10', '800', '2023-04-21 10:57:09', '-', 4, 0, '2023-04-21 10:57:09', '2023-04-21 10:57:09', 1, 1);
INSERT INTO `t_stock` VALUES (11, '11', '341', '2023-04-21 10:57:24', '-', 4, 0, '2023-04-21 10:57:24', '2023-04-21 10:57:24', 1, 2);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reset_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `reset_at` datetime NULL DEFAULT NULL,
  `reset_expires` datetime NULL DEFAULT NULL,
  `activate_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE,
  UNIQUE INDEX `username`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'ragil.bapolki.putra@gmail.com', 'bapolki', '$2y$10$TyQryRNm.Zpw5THYaELaje.0g39JRYUOecBGq39kZmesSht3aSMVy', '62436dd2b780b7e0604b17de939b89eb', NULL, '2023-04-15 02:07:38', '25528e1a30dd6a311cede99fc22860c5', NULL, NULL, 0, 0, '2023-04-15 01:07:06', '2023-04-15 01:07:38', '2023-04-15 13:08:05');
INSERT INTO `users` VALUES (2, 'b1.bapolki@gmail.com', 'ragilbapolki', '$2y$10$yffx1GAlCrijXAlLOAW/hebkLokF6NaFdRzrS1P0d21csc93M/nny', NULL, NULL, NULL, 'c8163c08ef3f46f8c99c4385cd232a43', NULL, NULL, 1, 0, '2023-04-15 01:08:46', '2023-04-15 01:08:46', NULL);
INSERT INTO `users` VALUES (3, 'r1.ragilbapolki@gmail.com', 'ragilbapolkiputra', '$2y$10$dOHdDz1uXTdQYkyL9NmCg.mMqsCKhMEbysc0nMJ86GLqIDJDQGFoG', NULL, NULL, NULL, '8101b354448d411bca6a709cdc0862f0', NULL, NULL, 0, 0, '2023-04-15 01:22:29', '2023-04-15 01:22:29', NULL);
INSERT INTO `users` VALUES (4, 'admin@gmail.com', 'admin', '$2y$10$zTsgR/y6L4RQsUYVd5pYB.oDvw6fHK7bjzq64jtGskYwCiI9fqefy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-04-15 01:30:09', '2023-04-15 01:30:09', NULL);

-- ----------------------------
-- Function structure for sf_formatTanggal
-- ----------------------------
DROP FUNCTION IF EXISTS `sf_formatTanggal`;
delimiter ;;
CREATE FUNCTION `sf_formatTanggal`(tanggal DATE)
 RETURNS varchar(50) CHARSET utf8mb4
  DETERMINISTIC
BEGIN
  DECLARE varhasil varchar(255);

  SELECT CONCAT(
    CASE MONTH(tanggal) 
      WHEN 1 THEN 'Januari' 
      WHEN 2 THEN 'Februari' 
      WHEN 3 THEN 'Maret' 
      WHEN 4 THEN 'April' 
      WHEN 5 THEN 'Mei' 
      WHEN 6 THEN 'Juni' 
      WHEN 7 THEN 'Juli' 
      WHEN 8 THEN 'Agustus' 
      WHEN 9 THEN 'September'
      WHEN 10 THEN 'Oktober' 
      WHEN 11 THEN 'November' 
      WHEN 12 THEN 'Desember' 
    END
  ) INTO varhasil;

  RETURN varhasil;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50621
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 50621
 File Encoding         : 65001

 Date: 24/05/2023 13:35:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_activation_attempts
-- ----------------------------
DROP TABLE IF EXISTS `auth_activation_attempts`;
CREATE TABLE `auth_activation_attempts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_activation_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for auth_groups
-- ----------------------------
DROP TABLE IF EXISTS `auth_groups`;
CREATE TABLE `auth_groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_groups
-- ----------------------------
INSERT INTO `auth_groups` VALUES (1, 'administrator', 'Administrator');

-- ----------------------------
-- Table structure for auth_groups_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_groups_permissions`;
CREATE TABLE `auth_groups_permissions`  (
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  INDEX `auth_groups_permissions_permission_id_foreign`(`permission_id`) USING BTREE,
  INDEX `group_id_permission_id`(`group_id`, `permission_id`) USING BTREE,
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_groups_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for auth_groups_users
-- ----------------------------
DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE `auth_groups_users`  (
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  INDEX `auth_groups_users_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `group_id_user_id`(`group_id`, `user_id`) USING BTREE,
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_groups_users
-- ----------------------------
INSERT INTO `auth_groups_users` VALUES (1, 1);

-- ----------------------------
-- Table structure for auth_logins
-- ----------------------------
DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE `auth_logins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `email`(`email`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `auth_logins` VALUES (26, '::1', 'admin', NULL, '2023-05-22 19:21:13', 0);
INSERT INTO `auth_logins` VALUES (27, '::1', 'admin', NULL, '2023-05-22 19:21:18', 0);
INSERT INTO `auth_logins` VALUES (28, '::1', 'admin@gmail.com', 4, '2023-05-22 19:21:32', 1);
INSERT INTO `auth_logins` VALUES (29, '::1', 'admin@gmail.com', 4, '2023-05-23 05:22:49', 1);
INSERT INTO `auth_logins` VALUES (30, '::1', 'admin@gmail.com', 4, '2023-05-23 11:00:57', 1);
INSERT INTO `auth_logins` VALUES (31, '::1', 'admin@gmail.com', 4, '2023-05-24 04:40:21', 1);

-- ----------------------------
-- Table structure for auth_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_permissions`;
CREATE TABLE `auth_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for auth_reset_attempts
-- ----------------------------
DROP TABLE IF EXISTS `auth_reset_attempts`;
CREATE TABLE `auth_reset_attempts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_reset_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for auth_tokens
-- ----------------------------
DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE `auth_tokens`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hashedValidator` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `auth_tokens_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `selector`(`selector`) USING BTREE,
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for auth_users_permissions
-- ----------------------------
DROP TABLE IF EXISTS `auth_users_permissions`;
CREATE TABLE `auth_users_permissions`  (
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  INDEX `auth_users_permissions_permission_id_foreign`(`permission_id`) USING BTREE,
  INDEX `user_id_permission_id`(`user_id`, `permission_id`) USING BTREE,
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of auth_users_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for m_branch
-- ----------------------------
DROP TABLE IF EXISTS `m_branch`;
CREATE TABLE `m_branch`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_branch
-- ----------------------------
INSERT INTO `m_branch` VALUES (1, 'Surabaya', 'SBY', 4, 0, 0, '2023-05-22 21:34:39', '2023-05-22 21:34:39', NULL, '-');
INSERT INTO `m_branch` VALUES (2, 'Jakarta', 'JKT', 4, 0, 0, '2023-05-22 21:34:50', '2023-05-22 21:34:50', NULL, '-');
INSERT INTO `m_branch` VALUES (3, 'Bandung', 'BDG', 4, 4, 4, '2023-05-22 21:34:59', '2023-05-22 21:35:30', NULL, '--');
INSERT INTO `m_branch` VALUES (4, 'Ujung Pandang', 'UPG', 4, 0, 0, '2023-05-22 21:35:20', '2023-05-22 21:35:20', NULL, '-');

-- ----------------------------
-- Table structure for m_category
-- ----------------------------
DROP TABLE IF EXISTS `m_category`;
CREATE TABLE `m_category`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_category
-- ----------------------------
INSERT INTO `m_category` VALUES (2, 'internal audit findings, non conformity', 'IAFNC', 4, 0, 0, '2023-05-22 20:13:01', '2023-05-22 20:13:01', NULL, '-');
INSERT INTO `m_category` VALUES (3, 'oportunity for improvement', 'OI', 4, 0, 0, '2023-05-22 20:15:05', '2023-05-22 20:15:05', NULL, '-');
INSERT INTO `m_category` VALUES (4, 'non conformity', 'NC', 4, 0, 0, '2023-05-22 20:15:18', '2023-05-22 20:15:18', NULL, '-');
INSERT INTO `m_category` VALUES (5, 'non conformity, external complain', 'NCEC', 4, 0, 0, '2023-05-22 20:15:47', '2023-05-22 20:15:47', NULL, '-');
INSERT INTO `m_category` VALUES (6, 'internal audit findings, safety non compliance', 'IAFSNC', 4, 0, 0, '2023-05-22 20:16:24', '2023-05-22 20:16:24', NULL, '-');
INSERT INTO `m_category` VALUES (7, 'internal complain, kpi bsc monitoring', 'ICKPIBSC', 4, 0, 0, '2023-05-22 20:16:52', '2023-05-22 20:16:52', NULL, '-');
INSERT INTO `m_category` VALUES (8, 'safety non compliance, external complain', 'SNCEC', 4, 0, 0, '2023-05-22 20:17:22', '2023-05-22 20:17:22', NULL, '-');
INSERT INTO `m_category` VALUES (9, 'internal audit findings, oportunity for improvement', 'IAFOFI', 4, 0, 0, '2023-05-22 20:17:52', '2023-05-22 20:17:52', NULL, '-');
INSERT INTO `m_category` VALUES (10, 'internal audit findings, non conformity, external complain', 'IAFNCEC', 4, 0, 0, '2023-05-22 20:18:20', '2023-05-22 20:18:20', NULL, '-');
INSERT INTO `m_category` VALUES (11, 'internal complain', 'IC', 4, 0, 0, '2023-05-22 20:18:51', '2023-05-22 20:18:51', NULL, '-');
INSERT INTO `m_category` VALUES (12, 'external complain', 'EC', 4, 4, 4, '2023-05-22 20:20:33', '2023-05-22 20:43:15', NULL, '--');
INSERT INTO `m_category` VALUES (13, 'safety non compliance', 'SNC', 4, 0, 0, '2023-05-22 20:21:40', '2023-05-22 20:21:40', NULL, '-');
INSERT INTO `m_category` VALUES (14, 'oportunity for improvement, external complain', 'OIEC', 4, 0, 0, '2023-05-22 20:22:04', '2023-05-22 20:22:04', NULL, '-');
INSERT INTO `m_category` VALUES (15, 'internal audit findings', 'IAF', 4, 0, 0, '2023-05-22 20:23:34', '2023-05-22 20:23:34', NULL, '-');
INSERT INTO `m_category` VALUES (16, 'internal audit findings, non conformity', 'IAFNC', 4, 0, 0, '2023-05-22 20:35:01', '2023-05-22 20:35:01', NULL, '-');

-- ----------------------------
-- Table structure for m_div
-- ----------------------------
DROP TABLE IF EXISTS `m_div`;
CREATE TABLE `m_div`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_div
-- ----------------------------
INSERT INTO `m_div` VALUES (1, 'Sales', 'SALES', 4, 0, 0, '2023-05-22 21:01:16', '2023-05-22 21:01:16', NULL, '-');
INSERT INTO `m_div` VALUES (2, 'IC', 'IC', 4, 0, 0, '2023-05-22 21:02:11', '2023-05-22 21:02:11', NULL, '-');
INSERT INTO `m_div` VALUES (3, 'Comercial', 'COMERCIAL', 4, 4, 4, '2023-05-22 21:02:30', '2023-05-22 21:04:22', NULL, '--');
INSERT INTO `m_div` VALUES (4, 'Key Account', 'KEY ACCOUNT', 4, 0, 0, '2023-05-22 21:02:51', '2023-05-22 21:02:51', NULL, '-');
INSERT INTO `m_div` VALUES (5, 'HSE', 'HSE', 4, 0, 0, '2023-05-22 21:03:06', '2023-05-22 21:03:06', NULL, '-');
INSERT INTO `m_div` VALUES (6, 'OPERATION', 'OPERATION', 4, 0, 0, '2023-05-22 21:03:31', '2023-05-22 21:03:31', NULL, '-');
INSERT INTO `m_div` VALUES (7, 'Management', 'MANAGEMENT', 4, 0, 0, '2023-05-22 21:03:51', '2023-05-22 21:03:51', NULL, '-');
INSERT INTO `m_div` VALUES (8, 'CR', 'CR', 4, 0, 0, '2023-05-22 21:04:09', '2023-05-22 21:04:09', NULL, '-');
INSERT INTO `m_div` VALUES (9, 'CC', 'CC', 4, 0, 0, '2023-05-22 21:16:50', '2023-05-22 21:16:50', NULL, '-');
INSERT INTO `m_div` VALUES (10, 'IT', 'IT', 4, 0, 0, '2023-05-22 21:17:53', '2023-05-22 21:17:53', NULL, '-');
INSERT INTO `m_div` VALUES (11, 'TRUCKING', 'TRUCKING', 4, 0, 0, '2023-05-22 21:18:22', '2023-05-22 21:18:22', NULL, '-');
INSERT INTO `m_div` VALUES (12, 'HR&GA', 'HR&GA', 4, 0, 0, '2023-05-22 21:18:41', '2023-05-22 21:18:41', NULL, '-');
INSERT INTO `m_div` VALUES (13, 'PROCUREMENT', 'PROCUREMENT', 4, 0, 0, '2023-05-22 21:19:19', '2023-05-22 21:19:19', NULL, '-');

-- ----------------------------
-- Table structure for m_employee
-- ----------------------------
DROP TABLE IF EXISTS `m_employee`;
CREATE TABLE `m_employee`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `div_id` int(11) NULL DEFAULT NULL,
  `pos_id` int(11) NULL DEFAULT NULL,
  `brach_id` int(11) NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of m_employee
-- ----------------------------
INSERT INTO `m_employee` VALUES (1, 'ELLIE CAMACHO', 6, 1, 2, '9077878768', 'Jl. Medan merdeka.', 4, 4, 4, '2023-05-22 22:16:34', '2023-05-23 05:46:42', NULL);
INSERT INTO `m_employee` VALUES (2, 'FIN CASEY', 4, 2, 1, '431414314', 'Jl. Jambangan', 4, NULL, NULL, '2023-05-22 22:20:10', '2023-05-22 22:20:10', NULL);
INSERT INTO `m_employee` VALUES (3, 'GAMORA', 6, 1, 1, '3442354325', 'Jl. Sikatan ', 4, NULL, NULL, '2023-05-22 22:21:06', '2023-05-22 22:21:06', NULL);
INSERT INTO `m_employee` VALUES (4, 'NAMORITA \"NITA\" PRENTISS', 3, 1, 1, '32235425', 'Jl. Ngagel', 4, NULL, NULL, '2023-05-22 22:21:43', '2023-05-22 22:21:43', NULL);
INSERT INTO `m_employee` VALUES (5, 'STEPHEN VINCENT STRANGE', 4, 3, 1, '43413414', 'Jl. Kendung', 4, NULL, NULL, '2023-05-22 22:22:16', '2023-05-22 22:22:16', NULL);
INSERT INTO `m_employee` VALUES (6, 'WANDA MAXIMOFF', 1, 1, 1, '34423543256', '--', 4, NULL, NULL, '2023-05-23 14:11:08', '2023-05-23 14:11:08', NULL);

-- ----------------------------
-- Table structure for m_position
-- ----------------------------
DROP TABLE IF EXISTS `m_position`;
CREATE TABLE `m_position`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_position
-- ----------------------------
INSERT INTO `m_position` VALUES (1, 'Staff', 'ST', 4, 0, 0, '2023-05-22 21:15:20', '2023-05-22 21:15:20', NULL, '-');
INSERT INTO `m_position` VALUES (2, 'Supervisor', 'SPV', 4, 0, 0, '2023-05-22 21:16:07', '2023-05-22 21:16:07', NULL, '-');
INSERT INTO `m_position` VALUES (3, 'Manager', 'MGR', 4, 4, 4, '2023-05-22 21:19:49', '2023-05-22 21:20:31', NULL, '-');

-- ----------------------------
-- Table structure for m_stage
-- ----------------------------
DROP TABLE IF EXISTS `m_stage`;
CREATE TABLE `m_stage`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of m_stage
-- ----------------------------
INSERT INTO `m_stage` VALUES (17, 'Open', 'O', 4, 0, 0, '2023-05-23 11:50:45', '2023-05-23 11:50:45', NULL, '-', 1);
INSERT INTO `m_stage` VALUES (18, 'Voided', 'VOI', 4, 0, 0, '2023-05-23 12:41:35', '2023-05-23 12:41:35', NULL, '-', 3);
INSERT INTO `m_stage` VALUES (19, 'Closed', 'CLO', 4, 4, 4, '2023-05-23 12:41:53', '2023-05-23 13:09:15', NULL, '--', 2);
INSERT INTO `m_stage` VALUES (20, 'Re-Open', 'RO', 4, 0, 0, '2023-05-23 12:42:09', '2023-05-23 12:42:09', NULL, '-', 1);
INSERT INTO `m_stage` VALUES (21, 'Verified', 'VER', 4, 0, 0, '2023-05-23 12:42:26', '2023-05-23 12:42:26', NULL, '-', 1);
INSERT INTO `m_stage` VALUES (22, 'Responded', 'RES', 4, 0, 0, '2023-05-23 12:42:39', '2023-05-23 12:42:39', NULL, '-', 1);
INSERT INTO `m_stage` VALUES (23, 'Draft', 'DRA', 4, 0, 0, '2023-05-23 12:43:03', '2023-05-23 12:43:03', NULL, '-', 0);
INSERT INTO `m_stage` VALUES (24, 'Submitted', 'SUB', 4, 4, 0, '2023-05-23 17:07:09', '2023-05-23 17:07:24', NULL, '-', 1);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `modul_id` int(11) NULL DEFAULT NULL,
  `token` int(11) NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1681536929, 1);

-- ----------------------------
-- Table structure for t_carp
-- ----------------------------
DROP TABLE IF EXISTS `t_carp`;
CREATE TABLE `t_carp`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NULL DEFAULT NULL,
  `code` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `initiator_by` int(11) NULL DEFAULT NULL,
  `recipient_by` int(11) NULL DEFAULT NULL,
  `verified_by` int(11) NULL DEFAULT NULL,
  `due_date` date NULL DEFAULT NULL,
  `effectiveness` int(11) NULL DEFAULT NULL,
  `status_date` date NULL DEFAULT NULL,
  `stage` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_carp
-- ----------------------------
INSERT INTO `t_carp` VALUES (1, 2, 'CARP00001\r\n', 2, 1, 4, '2023-05-25', 1, NULL, 21, 1, '2023-05-23 16:14:55', '2023-05-23 22:41:51', NULL, 0, 4, NULL);
INSERT INTO `t_carp` VALUES (2, 3, 'CARP00002', 2, 2, 4, '2023-05-24', 2, NULL, 19, 2, '2023-05-01 16:18:17', '2023-05-23 22:39:44', NULL, 0, 4, NULL);
INSERT INTO `t_carp` VALUES (3, 3, 'CARP00003', 2, 3, 4, '2023-05-24', 2, NULL, 23, 0, '2023-05-31 16:18:17', '2023-05-23 22:39:44', NULL, 0, 4, NULL);
INSERT INTO `t_carp` VALUES (4, 3, 'CARP00004', 2, 3, 4, '2023-05-24', 1, NULL, 23, 0, '2023-04-25 16:18:17', '2023-05-23 22:39:44', NULL, 0, 4, NULL);
INSERT INTO `t_carp` VALUES (5, 3, 'CARP00005', 2, 3, 4, '2023-05-24', 2, NULL, 23, 0, '2023-04-26 16:18:17', '2023-05-23 22:39:44', NULL, 0, 4, NULL);
INSERT INTO `t_carp` VALUES (6, 3, 'CARP00006', 2, 4, 4, '2023-05-24', 2, NULL, 23, 0, '2023-03-22 16:18:17', '2023-05-23 22:39:44', NULL, 0, 4, NULL);

-- ----------------------------
-- Table structure for t_carp_progress
-- ----------------------------
DROP TABLE IF EXISTS `t_carp_progress`;
CREATE TABLE `t_carp_progress`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carp_id` int(11) NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_carp_progress
-- ----------------------------
INSERT INTO `t_carp_progress` VALUES (1, 2, 'sdsds', '2023-05-23 21:08:33', '2023-05-23 21:08:33');
INSERT INTO `t_carp_progress` VALUES (2, 2, 'tttteee', '2023-05-23 21:16:04', '2023-05-23 21:16:04');
INSERT INTO `t_carp_progress` VALUES (3, 2, 'sddasaf', '2023-05-23 21:21:28', '2023-05-23 21:21:28');
INSERT INTO `t_carp_progress` VALUES (4, 2, 'fdsfdsfsdf', '2023-05-23 21:22:32', '2023-05-23 21:22:32');
INSERT INTO `t_carp_progress` VALUES (5, 1, 'tdsfgds', '2023-05-23 21:44:30', '2023-05-23 21:44:30');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `employee_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'ragil.bapolki.putra@gmail.com', 'bapolki', '$2y$10$TyQryRNm.Zpw5THYaELaje.0g39JRYUOecBGq39kZmesSht3aSMVy', '62436dd2b780b7e0604b17de939b89eb', NULL, '2023-04-15 02:07:38', '25528e1a30dd6a311cede99fc22860c5', NULL, NULL, 0, 0, '2023-04-15 01:07:06', '2023-04-15 01:07:38', '2023-04-15 13:08:05', NULL);
INSERT INTO `users` VALUES (2, 'b1.bapolki@gmail.com', 'ragilbapolki', '$2y$10$yffx1GAlCrijXAlLOAW/hebkLokF6NaFdRzrS1P0d21csc93M/nny', NULL, NULL, NULL, 'c8163c08ef3f46f8c99c4385cd232a43', NULL, NULL, 1, 0, '2023-04-15 01:08:46', '2023-04-15 01:08:46', NULL, NULL);
INSERT INTO `users` VALUES (3, 'r1.ragilbapolki@gmail.com', 'ragilbapolkiputra', '$2y$10$dOHdDz1uXTdQYkyL9NmCg.mMqsCKhMEbysc0nMJ86GLqIDJDQGFoG', NULL, NULL, NULL, '8101b354448d411bca6a709cdc0862f0', NULL, NULL, 0, 0, '2023-04-15 01:22:29', '2023-05-23 16:06:40', NULL, 2);
INSERT INTO `users` VALUES (4, 'admin@gmail.com', 'admin', '$2y$10$zSMb8Zh7SCf4eBtmMooDLOV3MhSMwIYpqlYVIZPrnPON.XaGXEYoS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-04-15 01:30:09', '2023-05-23 16:04:50', NULL, 4);
INSERT INTO `users` VALUES (5, 'et801330@gmail.com', 'khidir', '$2y$10$zSMb8Zh7SCf4eBtmMooDLOV3MhSMwIYpqlYVIZPrnPON.XaGXEYoS', NULL, NULL, NULL, 'bc9d0aeb97c42fff92b0b1c79b65edfd', NULL, NULL, 0, 0, '2023-05-22 19:20:00', '2023-05-22 19:20:00', NULL, NULL);

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

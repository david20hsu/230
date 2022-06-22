/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : goal_pp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-12-04 14:39:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for events_set
-- ----------------------------
DROP TABLE IF EXISTS `events_set`;
CREATE TABLE `events_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tp` varchar(10) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dutyer` varchar(10) DEFAULT NULL,
  `color` varchar(7) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `set_code` varchar(2) NOT NULL,
  `set_num` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events_set
-- ----------------------------
INSERT INTO `events_set` VALUES ('2', '客服', '信用卡月結線上刷卡', '', '徐先生', '#0071c5', '2020-11-05 00:00:00', '2020-11-06 00:00:00', '進度', 'M', '');
INSERT INTO `events_set` VALUES ('3', '客服', '追蹤到期承攬合約書', '', '麗雯', '#FF0000', '2020-11-10 00:00:00', '2020-11-11 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('4', '客服', '配送業務行政會議', '', '徐先生', '#0071c5', '2020-11-02 00:00:00', '2020-11-03 00:00:00', '計畫', 'W', '1');
INSERT INTO `events_set` VALUES ('9', '客服', '薪資表', '', '銀員', '#FF0000', '2020-11-13 00:00:00', '2020-11-14 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('10', '客服', '宅配超商繳款下載+列印二次帳單', '', '莉芬', '#FF0000', '2020-11-15 00:00:00', '2020-11-17 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('11', '客服', '宅配超商繳款結帳日', '小婕,麗雯,銀員', '行政組', '#FF0000', '2020-11-20 00:00:00', '2020-11-21 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('12', '客服', '宅配繳款進度表+檢點評分表', '', '銀員', '#FF0000', '2020-11-30 00:00:00', '2020-12-01 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('13', '客服', '團戶繳款進度表+關帳+列印帳單+發票', '', '淑芬', '#FF0000', '2020-11-30 00:00:00', '2020-12-01 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('14', '客服', '關帳+往來帳+ATM+預繳+貨款', '', '莉芬', '#FF0000', '2020-11-30 00:00:00', '2020-12-01 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('15', '客服', '最後次預繳入帳(催款)', '', '莉芬', '#FF0000', '2020-11-27 00:00:00', '2020-11-28 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('16', '客服', '列印預繳單', '', '淑君', '#FF0000', '2020-11-10 00:00:00', '2020-11-11 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('17', '客服', '第一次預繳入帳(催款)', '', '莉芬', '#FF0000', '2020-11-17 00:00:00', '2020-11-18 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('18', '客服', '列印預繳單', '', '淑君', '#FF0000', '2020-11-20 00:00:00', '2020-11-21 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('19', '客服', '跑馬燈更新', '', '麗雯', '#FF0000', '2020-11-27 00:00:00', '2020-11-28 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('20', '客服', '上月零用金結算', '', '麗雯', '#0071c5', '2020-11-05 00:00:00', '2020-11-06 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('21', '客服', '銀行扣款ACH', '', '莉芬', '#0071c5', '2020-11-05 00:00:00', '2020-11-06 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('22', '客服', '盤點副產品+玩具庫存', '', '行政組', '#FF0000', '2020-11-30 00:00:00', '2020-12-01 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('23', '客服', '發放配送佣金表', '', '行政組', '#FF0000', '2020-11-18 00:00:00', '2020-11-19 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('24', '客服', '月報表發放', '麗雯、小婕、銀員', '行政組', '#FF0000', '2020-11-30 00:00:00', '2020-12-01 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('25', '客服', '提供月報表考題答案', '麗雯、小婕、銀員', '行政組', '#FF0000', '2020-11-27 00:00:00', '2020-11-28 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('26', '客服', '業務呆帳帳單發放', '', '莉芬', '#FF0000', '2020-11-25 00:00:00', '2020-11-26 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('27', '客服', '團戶玩具庫存表', '報庫存', '淑芬', '#FF0000', '2020-11-30 00:00:00', '2020-12-01 00:00:00', '計畫', 'M', '');
INSERT INTO `events_set` VALUES ('28', '客服', '值班人員', '小婕,麗雯,銀員', '徐先生', '#008000', '2020-11-07 00:00:00', '2020-11-08 00:00:00', '計畫', 'W', '5');

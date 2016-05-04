/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : tptest

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-04-26 22:54:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_wmenu
-- ----------------------------
DROP TABLE IF EXISTS `tp_wmenu`;
CREATE TABLE `tp_wmenu` (
  `wm_id` int(11) NOT NULL AUTO_INCREMENT,
  `wm_name` varchar(20) DEFAULT NULL,
  `wm_type` varchar(20) DEFAULT NULL,
  `wm_type_attr` varchar(255) DEFAULT NULL,
  `wm_state` tinyint(1) DEFAULT NULL COMMENT '1启用2禁用',
  `wm_createtime` datetime DEFAULT NULL,
  PRIMARY KEY (`wm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

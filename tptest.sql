/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : tptest

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-03-23 10:58:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(300) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `logintime` int(100) NOT NULL,
  `login_num` int(10) NOT NULL DEFAULT '0',
  `loginip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '超级管理员', '1458701812', '100', '');

-- ----------------------------
-- Table structure for tp_attribute
-- ----------------------------
DROP TABLE IF EXISTS `tp_attribute`;
CREATE TABLE `tp_attribute` (
  `attr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `attr_name` varchar(500) DEFAULT '' COMMENT '属性名称',
  `parent_id` int(10) DEFAULT '0' COMMENT '父级ID',
  `attr_price` decimal(10,0) DEFAULT '0' COMMENT '额外加的名字',
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- ----------------------------
-- Records of tp_attribute
-- ----------------------------

-- ----------------------------
-- Table structure for tp_brand
-- ----------------------------
DROP TABLE IF EXISTS `tp_brand`;
CREATE TABLE `tp_brand` (
  `brand_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `brand_name` varchar(500) NOT NULL COMMENT '品牌name',
  `cat_id` int(10) NOT NULL DEFAULT '0' COMMENT '类型ID',
  `brand_img` varchar(500) NOT NULL COMMENT '品牌缩略图',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `is_show` int(2) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `brand_description` varchar(5000) NOT NULL COMMENT '品牌描述',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_brand
-- ----------------------------

-- ----------------------------
-- Table structure for tp_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `cat_name` varchar(100) NOT NULL COMMENT '栏目名称',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `is_show` int(2) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `statu` int(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `type_id` int(10) NOT NULL DEFAULT '0' COMMENT '类型ID',
  `view` varchar(500) NOT NULL COMMENT '链接地址',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of tp_category
-- ----------------------------
INSERT INTO `tp_category` VALUES ('48', '222222222222', '41', '0', '0', '0', '', '0');
INSERT INTO `tp_category` VALUES ('62', '11', '0', '0', '0', '0', '', '0');
INSERT INTO `tp_category` VALUES ('58', '1111', '56', '0', '0', '0', '', '0');
INSERT INTO `tp_category` VALUES ('60', 'AA', '0', '0', '0', '0', '', '0');
INSERT INTO `tp_category` VALUES ('55', '1212121212', '51', '0', '0', '21', '', '0');
INSERT INTO `tp_category` VALUES ('61', '2222', '59', '0', '0', '0', '', '0');
INSERT INTO `tp_category` VALUES ('64', 'qwert', '0', '1', '0', '21', '', '0');

-- ----------------------------
-- Table structure for tp_goods
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods`;
CREATE TABLE `tp_goods` (
  `goods_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `brand_id` int(20) DEFAULT '0' COMMENT '品牌ID',
  `cat_id` int(20) DEFAULT '0' COMMENT '类型ID',
  `goods_sn` varchar(200) DEFAULT '' COMMENT '商品编号',
  `goods_name` varchar(1000) DEFAULT '' COMMENT '商品名称',
  `goods_description` varchar(2000) DEFAULT '' COMMENT '商品描述',
  `goods_thumb` varchar(300) DEFAULT '' COMMENT '商品缩略图',
  `market_price` decimal(20,0) DEFAULT '0' COMMENT '市场价格',
  `shop_price` decimal(20,0) DEFAULT '0' COMMENT '本店价格',
  `sales_price` decimal(20,0) DEFAULT '0' COMMENT '销售价格',
  `sales_start_time` int(30) DEFAULT '0' COMMENT '销售开始时间',
  `sales_end_time` int(30) DEFAULT '0' COMMENT '销售结束时间',
  `is_sale` int(2) DEFAULT '0' COMMENT '是否销售/上架',
  `is_sale_time` int(30) DEFAULT '0' COMMENT '上架时间',
  `add_time` int(30) DEFAULT '0' COMMENT '加入时间',
  `update_time` int(30) DEFAULT '0' COMMENT '修改时间',
  `goods_number` int(10) DEFAULT '0' COMMENT '商品库存',
  `sale_number` int(10) DEFAULT '0' COMMENT '销售量',
  `is_hot` int(2) DEFAULT '0' COMMENT '热款',
  `is_boom` int(2) DEFAULT '0' COMMENT '爆款',
  `is_new` int(2) DEFAULT '0' COMMENT '新款',
  `is_best` int(2) DEFAULT '0' COMMENT '精品',
  `comment_count` int(10) DEFAULT '0' COMMENT '评论量',
  `goods_para` text COMMENT '商品规格 ',
  `is_delete` int(2) DEFAULT '0' COMMENT '是否删除',
  `click_count` int(10) DEFAULT '0' COMMENT '点击次数',
  `collect_count` int(10) DEFAULT '0' COMMENT '收藏次数',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_goods
-- ----------------------------

-- ----------------------------
-- Table structure for tp_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_attr`;
CREATE TABLE `tp_goods_attr` (
  `attr_id` int(10) NOT NULL COMMENT '关联表属性ID',
  `goods_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for tp_type
-- ----------------------------
DROP TABLE IF EXISTS `tp_type`;
CREATE TABLE `tp_type` (
  `type_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `type_name` varchar(300) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='类型表';

-- ----------------------------
-- Records of tp_type
-- ----------------------------
INSERT INTO `tp_type` VALUES ('21', '5203344');
INSERT INTO `tp_type` VALUES ('22', '5201314');
INSERT INTO `tp_type` VALUES ('23', '250');

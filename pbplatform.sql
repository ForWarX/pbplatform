-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2015 at 02:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pbplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `pb_brand_cn`
--

CREATE TABLE IF NOT EXISTS `pb_brand_cn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `desc` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品牌' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_carton_spec`
--

CREATE TABLE IF NOT EXISTS `pb_carton_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `length` float NOT NULL,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='箱规' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_category_cn`
--

CREATE TABLE IF NOT EXISTS `pb_category_cn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='品类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_currency`
--

CREATE TABLE IF NOT EXISTS `pb_currency` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `desc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='货币';

-- --------------------------------------------------------

--
-- Table structure for table `pb_customer`
--

CREATE TABLE IF NOT EXISTS `pb_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(15) NOT NULL COMMENT '客户货号',
  `name` varchar(30) NOT NULL COMMENT '客户名',
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客户信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_globals`
--

CREATE TABLE IF NOT EXISTS `pb_globals` (
  `key` varchar(15) NOT NULL COMMENT '变量名',
  `value` varchar(50) NOT NULL COMMENT '变量值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='统一变量';

-- --------------------------------------------------------

--
-- Table structure for table `pb_goods`
--

CREATE TABLE IF NOT EXISTS `pb_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_code` varchar(15) NOT NULL COMMENT '产品货号',
  `hscode` varchar(15) NOT NULL,
  `type` enum('','crossborder','local','all') NOT NULL DEFAULT '' COMMENT '商品类型',
  `spec` varchar(50) NOT NULL COMMENT '规格',
  `trade_term` enum('','fob','cif') NOT NULL DEFAULT '' COMMENT '贸易条款',
  `guarantee` varchar(25) NOT NULL COMMENT '保质期',
  `img_dir` varchar(50) NOT NULL COMMENT '图片路径',
  `block` int(11) NOT NULL COMMENT '版规',
  `postal_tax` float NOT NULL COMMENT '行邮税',
  `tariff` float NOT NULL COMMENT '关税',
  `bar_code` varchar(15) NOT NULL COMMENT '条形码',
  `special` varchar(15) NOT NULL COMMENT '特殊属性',
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品基本信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_goods_cn`
--

CREATE TABLE IF NOT EXISTS `pb_goods_cn` (
  `good_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '产品名',
  `desc` varchar(1500) NOT NULL COMMENT '产品描述',
  `origin` varchar(50) NOT NULL COMMENT '产地',
  `export` varchar(50) NOT NULL COMMENT '出口地',
  `ingredient` varchar(800) NOT NULL COMMENT '配料',
  `unit` varchar(10) NOT NULL COMMENT '销售单位',
  PRIMARY KEY (`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品描述类信息';

-- --------------------------------------------------------

--
-- Table structure for table `pb_label`
--

CREATE TABLE IF NOT EXISTS `pb_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `label` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_package`
--

CREATE TABLE IF NOT EXISTS `pb_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nw` float NOT NULL COMMENT '净重（kg）',
  `gw` float NOT NULL COMMENT '毛重（kg）',
  `length` float NOT NULL COMMENT 'cm',
  `width` float NOT NULL COMMENT 'cm',
  `height` float NOT NULL COMMENT 'cm',
  `num` int(11) NOT NULL,
  `desc` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='包装' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_package_relation`
--

CREATE TABLE IF NOT EXISTS `pb_package_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='包装关联' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_purchase`
--

CREATE TABLE IF NOT EXISTS `pb_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `currency_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='采购信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_record`
--

CREATE TABLE IF NOT EXISTS `pb_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `port` enum('','天津','广州','宁波') NOT NULL DEFAULT '' COMMENT '口岸',
  `type` enum('','cross border','local') NOT NULL DEFAULT '' COMMENT '类别',
  `status` enum('','未备案','备案中','已备案') NOT NULL DEFAULT '' COMMENT '备案状态',
  `img_url` varchar(100) NOT NULL COMMENT '备案图路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='备案信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_special_health_cn`
--

CREATE TABLE IF NOT EXISTS `pb_special_health_cn` (
  `good_id` int(11) NOT NULL,
  `form` varchar(10) NOT NULL COMMENT '剂型',
  `feature` varchar(1200) NOT NULL COMMENT '特点',
  `dosage` varchar(100) NOT NULL COMMENT '推荐用量',
  `attention` varchar(500) NOT NULL COMMENT '注意事项',
  `storage` varchar(300) NOT NULL COMMENT '储存方式',
  PRIMARY KEY (`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='保健品特殊属性，配料要写成成分';

-- --------------------------------------------------------

--
-- Table structure for table `pb_supplier_cn`
--

CREATE TABLE IF NOT EXISTS `pb_supplier_cn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contacts` varchar(50) NOT NULL COMMENT '联系人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供货商' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_test`
--

CREATE TABLE IF NOT EXISTS `pb_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pb_test`
--

INSERT INTO `pb_test` (`id`, `test`) VALUES
(1, 123);

-- --------------------------------------------------------

--
-- Table structure for table `pb_transport`
--

CREATE TABLE IF NOT EXISTS `pb_transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `type` enum('','air_weight','air_volume','sea_whole','sea_bulk') NOT NULL DEFAULT '' COMMENT '运输方式',
  `num` int(11) NOT NULL COMMENT '数量',
  `price` float NOT NULL COMMENT '单位价格（$/unit）',
  `from` int(11) NOT NULL COMMENT '出发地ID',
  `to` int(11) NOT NULL COMMENT '目的地ID',
  `time` float NOT NULL COMMENT '运输时间（天）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='运输' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_transport_place_cn`
--

CREATE TABLE IF NOT EXISTS `pb_transport_place_cn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='运输地点' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pb_user`
--

CREATE TABLE IF NOT EXISTS `pb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户账号' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=NO_AUTO_VALUE_ON_ZERO */;


CREATE DATABASE /*!32312 IF NOT EXISTS*/ `dfis`;
USE `dfis`;
CREATE TABLE `customer` (
  `customer_name` varchar(100) default '',
  `customer_date` datetime default NULL,
  `cust_stat` char(3) default NULL,
  `customer_cd` int(8) NOT NULL default '0',
  `pay_type` varchar(5) default NULL,
  `check_no` varchar(45) default NULL,
  `bank_branch` varchar(100) default NULL,
  `due_date` datetime default NULL,
  `check_stat` varchar(10) default NULL,
  `discount` decimal(8,2) default NULL,
  PRIMARY KEY  (`customer_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `products` (
  `prod_code` varchar(16) NOT NULL default '',
  `prod_name` varchar(100) default NULL,
  `price` decimal(8,2) default NULL,
  `quantity` int(8) unsigned default NULL,
  `order_qty` int(8) unsigned default NULL,
  `res_qty` int(8) unsigned default NULL,
  PRIMARY KEY  (`prod_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `products` (`prod_code`,`prod_name`,`price`,`quantity`,`order_qty`,`res_qty`) VALUES 
 ('A01','DRAGONS SMOKE BOMB','150.00',0,0,0),
 ('A02','DANCING DRAGONS','20.00',0,0,0),
 ('A03','DRAGONS ARTILLERY TANK','70.00',0,0,0),
 ('A04','DRAGONS LUCKY RINGS','70.00',0,0,0),
 ('A05','DRAGONS PARTY POPPER','70.00',0,0,0),
 ('A06','DRAGONS AEROFETTI(SMALL)','550.00',0,0,0),
 ('A07','DRAGONS AEROFETTI (MEDIUM)','550.00',0,0,0),
 ('A09','DRAGONS  POT OF GOLD','240.00',0,0,0),
 ('B01','DRAGONS FAIRY STICKS','25.00',0,0,0),
 ('B02','DRAGON MAGIC WANDS','100.00',0,0,0),
 ('B03','DRAGON LANCE','70.00',0,0,0),
 ('B04','DRAGONS ICE CANDLES','150.00',0,0,0),
 ('B05','DRAGONS FLAME OF HOPE','150.00',0,0,0),
 ('C01','DRAGONS FORTUNE FOUNTAIN','225.00',0,0,0),
 ('C02','DRAGONS SERENITY FOUNTAIN','325.00',0,0,0),
 ('C03','DRAGONS FOUNTAIN OF YOUTH','325.00',0,0,0),
 ('C04','DRAGONS PEACOCK FOUNTAIN','225.00',0,0,0),
 ('C05','DRAGONS WISHING WELL','160.00',0,0,0),
 ('C06','DRAGONS NIAGARA FALLS','600.00',0,0,0),
 ('D01 A','40 CONSECUTIVE REPORTS','300.00',0,0,0);
INSERT INTO `products` (`prod_code`,`prod_name`,`price`,`quantity`,`order_qty`,`res_qty`) VALUES 
 ('D01 B','120 CONSECUTIVE REPORTS','500.00',0,0,0),
 ('D01 C','1200 CONSECUTIVE REPORTS (10 FEET)','500.00',0,0,0),
 ('D01 D','3600 CONSECUTIVE REPORTS (30 FEET)','1500.00',0,0,0),
 ('D01 E','10800 CONSECUTIVE REPORTS (88 FEET)','4500.00',0,0,0),
 ('J06A','DRAGONS BLOOMING GARDEN CLASSIC (10)','3000.00',0,0,0);
CREATE TABLE `sales` (
  `customer_cd` varchar(16) NOT NULL default '',
  `item_cd` varchar(16) NOT NULL default '',
  `qty` int(8) unsigned default NULL,
  `price` decimal(8,2) default NULL,
  `order_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`customer_cd`,`item_cd`,`order_dt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

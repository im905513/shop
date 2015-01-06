CREATE TABLE `mod_member` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_account` varchar(100) DEFAULT NULL,
  `member_name` varchar(50) DEFAULT NULL,
  `member_pass` varchar(100) DEFAULT NULL,
  `member_city` varchar(100) DEFAULT NULL,
  `member_addr` varchar(255) DEFAULT NULL,
  `member_mobile` varchar(20) DEFAULT NULL,
  `vat_number` varchar(50) DEFAULT NULL,
  `invoice_title` varchar(50) DEFAULT NULL,
  `agree_edm` tinyint(1) DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `modi_time` datetime DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
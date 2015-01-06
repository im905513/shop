CREATE TABLE `mod_edm` (
  `edm_id` int(20) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `targets` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `is_response` int(1) DEFAULT '0',
  `is_sended` int(1) DEFAULT '0',
  `modi_time` datetime NOT NULL COMMENT '修改時間',
  `send_time` datetime NOT NULL COMMENT '寄信時間',
  PRIMARY KEY (`edm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `mod_edm_log` (
  `edm_log_id` int(4) NOT NULL AUTO_INCREMENT,
  `edm_id` int(4) NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `has_send` tinyint(4) NOT NULL,
  `msg` int(11) NOT NULL,
  `run_date` datetime DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `target` text COLLATE utf8_unicode_ci NOT NULL,
  `member_id` int(4) NOT NULL,
  PRIMARY KEY (`edm_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `mod_event` (
  `event_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_title` varchar(50) NOT NULL DEFAULT '',
  `event_start_date` datetime NOT NULL,
  `event_end_date` datetime NOT NULL,
  `regi_start_date` datetime NOT NULL,
  `regi_end_date` datetime NOT NULL,
  `event_place` varchar(200) NOT NULL DEFAULT '',
  `event_charge` int(10) NOT NULL,
  `event_detail` text,
  `event_photo` varchar(255) DEFAULT NULL,
  `regi_limit_num` int(10) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

CREATE TABLE `mod_register` (
  `regi_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint(20) NOT NULL,
  `account` varchar(20) NOT NULL DEFAULT '',
  `drop_date` datetime NOT NULL,
  `regi_type` int(3) NOT NULL,
  PRIMARY KEY (`regi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
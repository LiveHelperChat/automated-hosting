CREATE TABLE `lhc_instance_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request` int(11) NOT NULL,
  `expires` int(11) NOT NULL,
  `suspended` int(11) NOT NULL,
  `terminate` int(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `locale` varchar(200) NOT NULL,
  `siteaccess` varchar(200) NOT NULL,
  `time_zone` varchar(200) NOT NULL,
  `date_format` varchar(200) NOT NULL DEFAULT 'Y-m-d',
  `date_hour_format` varchar(200) NOT NULL DEFAULT 'H:i:s',
  `date_date_hour_format` varchar(200) NOT NULL DEFAULT 'Y-m-d H:i:s',
  PRIMARY KEY (`id`),
  KEY `address` (`address`)
) ENGINE=InnoDB;
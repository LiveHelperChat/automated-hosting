-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `lh_abstract_auto_responder`;
CREATE TABLE `lh_abstract_auto_responder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteaccess` varchar(3) NOT NULL,
  `wait_message` varchar(250) NOT NULL,
  `wait_timeout` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `timeout_message` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteaccess_position` (`siteaccess`,`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_abstract_email_template`;
CREATE TABLE `lh_abstract_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `from_name` varchar(150) NOT NULL,
  `from_name_ac` tinyint(4) NOT NULL,
  `from_email` varchar(150) NOT NULL,
  `from_email_ac` tinyint(4) NOT NULL,
  `content` text NOT NULL,
  `subject` varchar(250) NOT NULL,
  `subject_ac` tinyint(4) NOT NULL,
  `reply_to` varchar(150) NOT NULL,
  `reply_to_ac` tinyint(4) NOT NULL,
  `recipient` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`) VALUES
(1,	'Send mail to user',	'Live Support',	0,	'',	0,	'Dear {user_chat_nick},\r\n\r\n{additional_message}\r\n\r\nLive Support response:\r\n{messages_content}\r\n\r\nSincerely,\r\nLive Support Team\r\n',	'{name_surname} has responded to your request',	1,	'',	1,	''),
(2,	'Support request from user',	'',	0,	'',	0,	'Hello,\r\n\r\nUser request data:\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nAdditional data, if any:\r\n{additional_data}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nSincerely,\r\nLive Support Team',	'Support request from user',	0,	'',	0,	'{email_replace}'),
(3,	'User mail for himself',	'Live Support',	0,	'',	0,	'Dear {user_chat_nick},\r\n\r\nTranscript:\r\n{messages_content}\r\n\r\nSincerely,\r\nLive Support Team\r\n',	'Chat transcript',	0,	'',	0,	'');

DROP TABLE IF EXISTS `lh_abstract_proactive_chat_invitation`;
CREATE TABLE `lh_abstract_proactive_chat_invitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteaccess` varchar(10) NOT NULL,
  `time_on_site` int(11) NOT NULL,
  `pageviews` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_returning` text NOT NULL,
  `executed_times` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `wait_message` varchar(250) NOT NULL,
  `timeout_message` varchar(250) NOT NULL,
  `wait_timeout` int(11) NOT NULL,
  `operator_name` varchar(100) NOT NULL,
  `message_returning_nick` varchar(100) NOT NULL,
  `position` int(11) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `requires_email` int(11) NOT NULL,
  `requires_phone` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time_on_site_pageviews_siteaccess_position` (`time_on_site`,`pageviews`,`siteaccess`,`identifier`,`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_canned_msg`;
CREATE TABLE `lh_canned_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `position` int(11) NOT NULL,
  `delay` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_chat`;
CREATE TABLE `lh_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `nick` varchar(50) NOT NULL,
				  `status` int(11) NOT NULL DEFAULT '0',
				  `status_sub` int(11) NOT NULL DEFAULT '0',
				  `time` int(11) NOT NULL,
				  `user_id` int(11) NOT NULL,
				  `user_closed_ts` int(11) NOT NULL,
				  `hash` varchar(40) NOT NULL,
				  `referrer` text NOT NULL,
        	   	  `session_referrer` text NOT NULL,
        	   	  `chat_variables` text NOT NULL,
        	   	  `remarks` text NOT NULL,
				  `ip` varchar(100) NOT NULL,
				  `chat_locale_to` varchar(10) NOT NULL,
				  `chat_locale` varchar(10) NOT NULL,
				  `dep_id` int(11) NOT NULL,
				  `user_status` int(11) NOT NULL DEFAULT '0',
				  `support_informed` int(11) NOT NULL DEFAULT '0',
				  `unread_messages_informed` int(11) NOT NULL DEFAULT '0',
				  `reinform_timeout` int(11) NOT NULL DEFAULT '0',
				  `email` varchar(100) NOT NULL,
				  `country_code` varchar(100) NOT NULL,
				  `country_name` varchar(100) NOT NULL,
				  `user_tz_identifier` varchar(50) NOT NULL,
				  `user_typing` int(11) NOT NULL,
				  `user_typing_txt` varchar(50) NOT NULL,
				  `operator_typing` int(11) NOT NULL,
        	   	  `operator_typing_id` int(11) NOT NULL,
				  `phone` varchar(100) NOT NULL,
				  `has_unread_messages` int(11) NOT NULL,
				  `last_user_msg_time` int(11) NOT NULL,
				  `fbst` tinyint(1) NOT NULL,
				  `online_user_id` int(11) NOT NULL,
				  `last_msg_id` int(11) NOT NULL,
				  `additional_data` varchar(250) NOT NULL,
				  `timeout_message` varchar(250) NOT NULL,
				  `lat` varchar(10) NOT NULL,
				  `lon` varchar(10) NOT NULL,
				  `city` varchar(100) NOT NULL,
				  `operation` text NOT NULL,
				  `operation_admin` varchar(200) NOT NULL,
				  `mail_send` int(11) NOT NULL,
        	   	  `screenshot_id` int(11) NOT NULL,
        	   	  `wait_time` int(11) NOT NULL,
        	   	  `wait_timeout` int(11) NOT NULL,
        	   	  `wait_timeout_send` int(11) NOT NULL,
  				  `chat_duration` int(11) NOT NULL,
  				  `tslasign` int(11) NOT NULL,
        	   	  `priority` int(11) NOT NULL,
        	   	  `chat_initiator` int(11) NOT NULL,
        	   	  `transfer_timeout_ts` int(11) NOT NULL,
        	   	  `transfer_timeout_ac` int(11) NOT NULL,
        	   	  `transfer_if_na` int(11) NOT NULL,
        	   	  `na_cb_executed` int(11) NOT NULL,
        	   	  `nc_cb_executed` tinyint(1) NOT NULL,
				  PRIMARY KEY (`id`),
				  KEY `status_user_id` (`status`,`user_id`),
				  KEY `user_id` (`user_id`),
				  KEY `online_user_id` (`online_user_id`),
				  KEY `dep_id` (`dep_id`),
				  KEY `has_unread_messages_dep_id_id` (`has_unread_messages`,`dep_id`,`id`),
				  KEY `status_dep_id_id` (`status`,`dep_id`,`id`),
        	   	  KEY `status_dep_id_priority_id` (`status`,`dep_id`,`priority`,`id`),
        	   	  KEY `status_priority_id` (`status`,`priority`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lh_chat_archive_range`;
CREATE TABLE `lh_chat_archive_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `range_from` int(11) NOT NULL,
  `range_to` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_chat_blocked_user`;
CREATE TABLE `lh_chat_blocked_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datets` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_chat_config`;
CREATE TABLE `lh_chat_config` (
  `identifier` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `explain` varchar(250) NOT NULL,
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('application_name',	'a:6:{s:3:\"eng\";s:12:\"Live support\";s:3:\"lit\";s:12:\"Live support\";s:3:\"hrv\";s:0:\"\";s:3:\"esp\";s:0:\"\";s:3:\"por\";s:0:\"\";s:10:\"site_admin\";s:12:\"Live support\";}',	1,	'Support application name, visible in browser title.',	0),
('chatbox_data',	'a:6:{i:0;b:0;s:20:\"chatbox_auto_enabled\";i:0;s:19:\"chatbox_secret_hash\";s:{chat_box_hash_length}:\"{chat_box_hash}\";s:20:\"chatbox_default_name\";s:7:\"Chatbox\";s:17:\"chatbox_msg_limit\";i:50;s:22:\"chatbox_default_opname\";s:7:\"Manager\";}',	0,	'Chatbox configuration',	1),
('customer_company_name',	'Live Support',	0,	'Your company name - visible in bottom left corner',	0),
('customer_site_url',	'#',	0,	'Your site URL address',	0),
('banned_ip_range','',0,'Which ip should not be allowed to chat',0),
('disable_popup_restore',	'0',	0,	'Disable option in widget to open new window. 0 - no, 1 - restore icon will be hidden',	0),
('export_hash',	'{export_hash_chats}',	0,	'Chats export secret hash',	0),
('geo_data',	'a:8:{i:0;b:0;s:21:\"geo_detection_enabled\";i:1;s:22:\"geo_service_identifier\";s:10:\"mod_geoip2\";s:23:\"mod_geo_ip_country_code\";s:18:\"GEOIP_COUNTRY_CODE\";s:23:\"mod_geo_ip_country_name\";s:18:\"GEOIP_COUNTRY_NAME\";s:20:\"mod_geo_ip_city_name\";s:10:\"GEOIP_CITY\";s:19:\"mod_geo_ip_latitude\";s:14:\"GEOIP_LATITUDE\";s:20:\"mod_geo_ip_longitude\";s:15:\"GEOIP_LONGITUDE\";}',	0,	'',	1),
('geo_location_data',	'a:3:{s:4:\"zoom\";i:4;s:3:\"lat\";s:7:\"49.8211\";s:3:\"lng\";s:7:\"11.7835\";}',	0,	'',	1),
('list_online_operators',	'0',	0,	'List online operators, 0 - no, 1 - yes.',	0),
('message_seen_timeout',	'24',	0,	'Proactive message timeout in hours. After how many hours proactive chat mesasge should be shown again.',	0),
('pro_active_invite',	'1',	0,	'Is pro active chat invitation active. Online users tracking also has to be enabled',	0),
('pro_active_limitation',	'-1',	0,	'Pro active chats invitations limitation based on pending chats, (-1) do not limit, (0,1,n+1) number of pending chats can be for invitation to be shown.',	0),
('pro_active_show_if_offline',	'0',	0,	'Should invitation logic be executed if there is no online operators, 0 - no, 1 - yes',	0),
('reopen_chat_enabled',	'1',	0,	'Reopen chat functionality enabled, 0 - No, 1 - Yes',	0),
('run_departments_workflow',	'0',	0,	'Should cronjob run departments tranfer workflow, even if user leaves a chat, 0 - no, 1 - yes',	0),
('run_unaswered_chat_workflow',	'0',	0,	'Should cronjob run unanswered chats workflow and execute unaswered chats callback, 0 - no, any other number bigger than 0 is a minits how long chat have to be not accepted before executing callback.',	0),
('smtp_data',	'a:5:{s:4:\"host\";s:0:\"\";s:4:\"port\";s:2:\"25\";s:8:\"use_smtp\";i:0;s:8:\"username\";s:0:\"\";s:8:\"password\";s:0:\"\";}',	0,	'SMTP configuration',	1),
('start_chat_data',	'a:10:{i:0;b:0;s:21:\"name_visible_in_popup\";b:1;s:27:\"name_visible_in_page_widget\";b:1;s:19:\"name_require_option\";s:8:\"required\";s:22:\"email_visible_in_popup\";b:1;s:28:\"email_visible_in_page_widget\";b:1;s:20:\"email_require_option\";s:8:\"required\";s:24:\"message_visible_in_popup\";b:1;s:30:\"message_visible_in_page_widget\";b:1;s:22:\"message_require_option\";s:8:\"required\";}',	0,	'',	1),
('tracked_users_cleanup',	'160',	0,	'How many days keep records of online users.',	0),
('track_footprint',	'1',	0,	'Track users footprint. For this also online visitors tracking should be enabled',	0),
('track_online_visitors',	'1',	0,	'Enable online site visitors tracking, 0 - no, 1 - yes',	0),
('voting_days_limit',	'7',	0,	'How many days voting widget should not be expanded after last show',	0);

DROP TABLE IF EXISTS `lh_chat_online_user`;
CREATE TABLE `lh_chat_online_user` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `vid` varchar(50) NOT NULL,
                  `ip` varchar(50) NOT NULL,
                  `current_page` text NOT NULL,
        	   	  `page_title` varchar(250) NOT NULL,
                  `referrer` text NOT NULL,
                  `chat_id` int(11) NOT NULL,
                  `invitation_seen_count` int(11) NOT NULL,
        	   	  `invitation_id` int(11) NOT NULL,
                  `last_visit` int(11) NOT NULL,
        	   	  `first_visit` int(11) NOT NULL,
        	   	  `total_visits` int(11) NOT NULL,
        	   	  `pages_count` int(11) NOT NULL,
        	   	  `last_check_time` int(11) NOT NULL,
        	   	  `tt_pages_count` int(11) NOT NULL,
        	   	  `invitation_count` int(11) NOT NULL,
        	   	  `dep_id` int(11) NOT NULL,
                  `user_agent` varchar(250) NOT NULL,
                  `visitor_tz` varchar(50) NOT NULL,
                  `user_country_code` varchar(50) NOT NULL,
                  `user_country_name` varchar(50) NOT NULL,
                  `operator_message` text NOT NULL,
                  `operator_user_proactive` varchar(100) NOT NULL,
                  `operator_user_id` int(11) NOT NULL,
                  `message_seen` int(11) NOT NULL,
                  `message_seen_ts` int(11) NOT NULL,
        	   	  `lat` varchar(10) NOT NULL,
  				  `lon` varchar(10) NOT NULL,
  				  `city` varchar(100) NOT NULL,
        	   	  `reopen_chat` int(11) NOT NULL,
        	   	  `time_on_site` int(11) NOT NULL,
  				  `tt_time_on_site` int(11) NOT NULL,
        	   	  `requires_email` int(11) NOT NULL,
        	   	  `requires_username` int(11) NOT NULL,
        	   	  `requires_phone` int(11) NOT NULL,
        	   	  `screenshot_id` int(11) NOT NULL,
        	   	  `identifier` varchar(50) NOT NULL,
        	   	  `operation` varchar(200) NOT NULL,
        	   	  `online_attr` varchar(250) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `vid` (`vid`),
				  KEY `dep_id` (`dep_id`),
				  KEY `last_visit_dep_id` (`last_visit`,`dep_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_chat_online_user_footprint`;
CREATE TABLE `lh_chat_online_user_footprint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `online_user_id` int(11) NOT NULL,
  `page` varchar(250) NOT NULL,
  `vtime` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id_vtime` (`chat_id`,`vtime`),
  KEY `online_user_id` (`online_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_chatbox`;
CREATE TABLE `lh_chatbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_chatbox` (`id`, `identifier`, `name`, `chat_id`, `active`) VALUES
(2,	'default',	'Chatbox',	1,	1);

DROP TABLE IF EXISTS `lh_departament`;
CREATE TABLE `lh_departament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `priority` int(11) NOT NULL,
  `department_transfer_id` int(11) NOT NULL,
  `transfer_timeout` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_departament` (`id`, `name`, `email`, `identifier`, `priority`, `department_transfer_id`, `transfer_timeout`) VALUES
(1,	'default',	'',	'',	0,	0,	0);

DROP TABLE IF EXISTS `lh_faq`;
CREATE TABLE `lh_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) NOT NULL,
  `answer` text NOT NULL,
  `url` varchar(250) NOT NULL,
  `active` int(11) NOT NULL,
  `has_url` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `active_url` (`active`,`url`),
  KEY `has_url` (`has_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_forgotpasswordhash`;
CREATE TABLE `lh_forgotpasswordhash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_group`;
CREATE TABLE `lh_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_group` (`id`, `name`) VALUES
(1,	'Administrators'),
(2,	'Operators');

DROP TABLE IF EXISTS `lh_grouprole`;
CREATE TABLE `lh_grouprole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`role_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_grouprole` (`id`, `group_id`, `role_id`) VALUES
(1,	1,	1),
(2,	2,	2);

DROP TABLE IF EXISTS `lh_groupuser`;
CREATE TABLE `lh_groupuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_id_2` (`group_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_groupuser` (`id`, `group_id`, `user_id`) VALUES
(1,	1,	1);

DROP TABLE IF EXISTS `lh_msg`;
CREATE TABLE `lh_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `time` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name_support` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id_id` (`chat_id`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_question`;
CREATE TABLE `lh_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `active` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `is_voting` int(11) NOT NULL,
  `question_intro` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `priority` (`priority`),
  KEY `active_priority` (`active`,`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_question_answer`;
CREATE TABLE `lh_question_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` bigint(20) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_question_option`;
CREATE TABLE `lh_question_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_name` varchar(250) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_question_option_answer`;
CREATE TABLE `lh_question_option_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `ip` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_role`;
CREATE TABLE `lh_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_role` (`id`, `name`) VALUES
(1,	'Administrators'),
(2,	'Operators');

DROP TABLE IF EXISTS `lh_rolefunction`;
CREATE TABLE `lh_rolefunction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `function` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_rolefunction` (`id`, `role_id`, `module`, `function`) VALUES
(1,	1,	'*',	'*'),
(2,	2,	'lhuser',	'selfedit'),
(3,	2,	'lhuser',	'changeonlinestatus'),
(4,	2,	'lhchat',	'use'),
(5,	2,	'lhchat',	'singlechatwindow'),
(6,	2,	'lhchat',	'allowopenremotechat'),
(7,	2,	'lhchat',	'allowchattabs'),
(8,	2,	'lhchat',	'use_onlineusers'),
(9,	2,	'lhfront',	'use'),
(10,	2,	'lhsystem',	'use'),
(11,	2,	'lhchat',	'allowblockusers'),
(12,	2,	'lhsystem',	'generatejs'),
(13,	2,	'lhsystem',	'changelanguage'),
(14,	2,	'lhchat',	'allowtransfer'),
(15,	2,	'lhchat',	'administratecannedmsg'),
(16,	2,	'lhquestionary',	'manage_questionary'),
(17,	2,	'lhfaq',	'manage_faq'),
(18,	2,	'lhchatbox',	'manage_chatbox'),
(19,	2,	'lhxml',	'*');

DROP TABLE IF EXISTS `lh_transfer`;
CREATE TABLE `lh_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `transfer_user_id` int(11) NOT NULL,
  `from_dep_id` int(11) NOT NULL,
  `transfer_to_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`),
  KEY `transfer_user_id_dep_id` (`transfer_user_id`,`dep_id`),
  KEY `transfer_to_user_id` (`transfer_to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_userdep`;
CREATE TABLE `lh_userdep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `last_activity` int(11) NOT NULL,
  `hide_online` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `last_activity_hide_online_dep_id` (`last_activity`,`hide_online`,`dep_id`),
  KEY `dep_id` (`dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_userdep` (`id`, `user_id`, `dep_id`, `last_activity`, `hide_online`) VALUES
(1,	1,	0,	1381856323,	0);

DROP TABLE IF EXISTS `lh_users`;
CREATE TABLE `lh_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `disabled` tinyint(4) NOT NULL,
  `hide_online` tinyint(1) NOT NULL,
  `all_departments` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hide_online` (`hide_online`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_users` (`id`, `username`, `password`, `email`, `name`, `surname`, `disabled`, `hide_online`, `all_departments`) VALUES
(1,	'{email_replace}',	'{password_hash}',	'{email_replace}',	'Operator',	'',	0,	0,	1);

DROP TABLE IF EXISTS `lh_users_remember`;
CREATE TABLE `lh_users_remember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lh_users_setting`;
CREATE TABLE `lh_users_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_users_setting` (`id`, `user_id`, `identifier`, `value`) VALUES
(1,	1,	'enable_pending_list',	'1'),
(2,	1,	'enable_active_list',	'1'),
(3,	1,	'enable_close_list',	'0'),
(4,	1,	'enable_unread_list',	'1'),
(5,	1,	'new_chat_sound',	'1'),
(6,	1,	'chat_message',	'1');

DROP TABLE IF EXISTS `lh_users_setting_option`;
CREATE TABLE `lh_users_setting_option` (
  `identifier` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `attribute` varchar(40) NOT NULL,
  PRIMARY KEY (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES
('chat_message',	'',	''),
('enable_active_list',	'',	''),
('enable_close_list',	'',	''),
('enable_pending_list',	'',	''),
('enable_unread_list',	'',	''),
('new_chat_sound',	'',	'');


CREATE TABLE `lh_chat_file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `upload_name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('file_configuration',	'a:7:{i:0;b:0;s:5:\"ft_op\";s:43:\"gif|jpe?g|png|zip|rar|xls|doc|docx|xlsx|pdf\";s:5:\"ft_us\";s:26:\"gif|jpe?g|png|doc|docx|pdf\";s:6:\"fs_max\";i:2048;s:18:\"active_user_upload\";b:0;s:16:\"active_op_upload\";b:1;s:19:\"active_admin_upload\";b:1;}',	0,	'Files configuration item',	1);

ALTER TABLE `lh_faq`
ADD `is_wildcard` tinyint(1) NOT NULL,
COMMENT='';

ALTER TABLE `lh_faq`
ADD INDEX `is_wildcard` (`is_wildcard`);

ALTER TABLE `lh_users`
ADD `filepath` varchar(200) COLLATE 'utf8_general_ci' NOT NULL,
ADD `filename` varchar(200) COLLATE 'utf8_general_ci' NOT NULL AFTER `filepath`,
COMMENT='';



ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD `show_random_operator` int(11) NOT NULL,
COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('ignorable_ip',	'',	0,	'Which ip should be ignored in online users list, separate by comma',0);



ALTER TABLE `lh_departament`
ADD `mod` tinyint(1) NOT NULL,
ADD `tud` tinyint(1) NOT NULL AFTER `mod`,
ADD `wed` tinyint(1) NOT NULL AFTER `tud`,
ADD `thd` tinyint(1) NOT NULL AFTER `wed`,
ADD `frd` tinyint(1) NOT NULL AFTER `thd`,
ADD `sad` tinyint(1) NOT NULL AFTER `frd`,
ADD `sud` tinyint(1) NOT NULL AFTER `sad`,
ADD `start_hour` int(2) NOT NULL AFTER `sud`,
ADD `end_hour` int(2) NOT NULL AFTER `start_hour`,
ADD `inform_options` varchar(250) COLLATE 'utf8_general_ci' NOT NULL AFTER `end_hour`,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `online_hours_active` tinyint(1) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `inform_delay` int NOT NULL,
COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('xmp_data',	'a:9:{i:0;b:0;s:4:\"host\";s:15:\"talk.google.com\";s:6:\"server\";s:9:\"gmail.com\";s:8:\"resource\";s:6:\"xmpphp\";s:4:\"port\";s:4:\"5222\";s:7:\"use_xmp\";i:0;s:8:\"username\";s:0:\"\";s:8:\"password\";s:0:\"\";s:11:\"xmp_message\";s:77:\"You have a new chat request\r\n{messages}\r\nClick to accept a chat\r\n{url_accept}\";}',	0,	'XMP data',	1);

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`) VALUES
(4,	'New chat request',	'Live support',	0,	'',	0,	'Hello,\r\n\r\nUser request data:\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nClick to accept chat automatically\r\n{url_accept}\r\n\r\nSincerely,\r\nLive Support Team',	'New chat request',	0,	'',	0,	'');

ALTER TABLE `lh_departament`
ADD INDEX `oha_sh_eh` (`online_hours_active`, `start_hour`, `end_hour`);

CREATE TABLE `lh_chat_accept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`) VALUES
(5,	'Chat was closed',	'Live support',	0,	'',	0,	'Hello,\r\n\r\n{operator} has closed a chat\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nAdditional data, if any:\r\n{additional_data}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nSincerely,\r\nLive Support Team',	'Chat was closed',	0,	'',	0,	'');

ALTER TABLE `lh_departament`
ADD `inform_close` int(11) NOT NULL,
COMMENT='';



ALTER TABLE `lh_users`
ADD `skype` varchar(100) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_chat_accept`
ADD `wused` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `xmpp_recipients` varchar(250) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `xmpp_group_recipients` varchar(250) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD `xmpp_username` varchar(100) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD INDEX `email` (`email`),
ADD INDEX `xmpp_username` (`xmpp_username`);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('accept_chat_link_timeout',	'300',	0,	'How many seconds accept chat link is valid. Set 0 to force login all the time manually.',	0);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('session_captcha',0,	0,	'Use session captcha. LHC have to be installed on the same domain or subdomain.',	0);

ALTER TABLE `lh_departament`
ADD `disabled` int NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD INDEX `disabled` (`disabled`);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sound_invitation', 1, 0, 'Play sound on invitation to chat.',	0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('sync_sound_settings',	'a:11:{i:0;b:0;s:12:\"repeat_sound\";i:1;s:18:\"repeat_sound_delay\";i:5;s:10:\"show_alert\";b:0;s:22:\"new_chat_sound_enabled\";b:1;s:31:\"new_message_sound_admin_enabled\";b:1;s:30:\"new_message_sound_user_enabled\";b:1;s:14:\"online_timeout\";d:300;s:22:\"check_for_operator_msg\";d:10;s:21:\"back_office_sinterval\";d:10;s:22:\"chat_message_sinterval\";d:3.5;}',	0,	'',	1);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('accept_tos_link', '#', 0, 'Change to your site Terms of Service',        0);UPDATE `lh_chat_config` SET
`identifier` = 'sync_sound_settings',
`value` = 'a:15:{i:0;b:0;s:12:\"repeat_sound\";i:1;s:18:\"repeat_sound_delay\";i:5;s:10:\"show_alert\";b:0;s:22:\"new_chat_sound_enabled\";b:1;s:31:\"new_message_sound_admin_enabled\";b:1;s:30:\"new_message_sound_user_enabled\";b:1;s:14:\"online_timeout\";d:300;s:22:\"check_for_operator_msg\";d:10;s:21:\"back_office_sinterval\";d:10;s:22:\"chat_message_sinterval\";d:3.5;s:20:\"long_polling_enabled\";b:0;s:30:\"polling_chat_message_sinterval\";d:1.5;s:29:\"polling_back_office_sinterval\";d:5;s:18:\"connection_timeout\";i:30;}',
`type` = '0',
`explain` = '',
`hidden` = '1'
WHERE `identifier` = 'sync_sound_settings';INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('track_domain',	'',	0,	'Set your domain to enable user tracking across different domain subdomains.',	0);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('explicit_http_mode', '',0,'Please enter explicit http mode. Either http: or https:, do not forget : at the end.', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('max_message_length','500',0,'Maximum message length in characters', '0');

ALTER TABLE `lh_departament`
ADD `delay_lm` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD `hide_after_ntimes` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD `referrer` varchar(250) NOT NULL,
COMMENT='';ALTER TABLE `lh_users`
ADD `time_zone` varchar(100) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_chat_file`
ADD INDEX `user_id` (`user_id`);ALTER TABLE `lh_question` ADD `revote` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `lh_question_option_answer` ADD `ctime` int NOT NULL;ALTER TABLE `lh_canned_msg`
ADD `department_id` int(11) NOT NULL,
ADD `user_id` int(11) NOT NULL AFTER `department_id`,
COMMENT='';

ALTER TABLE `lh_canned_msg`
ADD INDEX `department_id` (`department_id`),
ADD INDEX `user_id` (`user_id`);



ALTER TABLE `lh_abstract_email_template`
ADD `bcc_recipients` varchar(200) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_faq`
ADD `email` varchar(50) NOT NULL,
ADD `identifier` varchar(10) NOT NULL AFTER `email`,
COMMENT='';

ALTER TABLE `lh_faq`
ADD INDEX `identifier` (`identifier`);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('need_help_tip','0',0,'Show need help tooltip?', '0');


INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('need_help_tip_timeout','24',0,'Need help tooltip timeout, after how many hours show again tooltip?', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('use_secure_cookie','0',0,'Use secure cookie, check this if you want to force SSL all the time', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('faq_email_required','0',0,'Is visitor e-mail required for FAQ', '0');
INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`) VALUES
(6,	'New FAQ question',	'Live support',	0,	'',	0,	'Hello,\r\n\r\nNew FAQ question\r\nEmail: {email}\r\n\r\nQuestion:\r\n{question}\r\n\r\nURL to answer a question:\r\n{url_request}\r\n\r\nSincerely,\r\nLive Support Team',	'New FAQ question',	0,	'',	0,	'',	'');

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('disable_print','0',0,'Disable chat print', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('disable_send','0',0,'Disable chat transcript send', '0');

ALTER TABLE `lh_users`
ADD `job_title` varchar(100) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD `operator_ids` varchar(100) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD `invisible_mode` tinyint(1) NOT NULL,
COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('hide_disabled_department','1',0,'Hide disabled department widget', '0');

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('ignore_user_status','0',0,'Ignore users online statuses and use departments online hours', '0');

CREATE TABLE `lh_abstract_browse_offer_invitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteaccess` varchar(10) NOT NULL,
  `time_on_site` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `lhc_iframe_content` tinyint(4) NOT NULL,
  `custom_iframe_url` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `executed_times` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  `active` int(11) NOT NULL,
  `has_url` int(11) NOT NULL,
  `is_wildcard` int(11) NOT NULL,
  `referrer` varchar(250) NOT NULL,
  `priority` varchar(250) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lh_departament`
ADD `hidden` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD INDEX `disabled_hidden` (`disabled`, `hidden`),
DROP INDEX `disabled`;

ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD `dep_id` int NOT NULL,
COMMENT='';

ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD INDEX `identifier` (`identifier`),
ADD INDEX `dep_id` (`dep_id`);

ALTER TABLE `lh_departament`
ADD `inform_unread` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `inform_unread_delay` int(11) NOT NULL,
COMMENT='';

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`) VALUES
(7,	'New unread message',	'Live support',	0,	'',	0,	'Hello,\r\n\r\nUser request data:\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nCountry: {country}\r\nCity: {city}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nClick to accept chat automatically\r\n{url_accept}\r\n\r\nSincerely,\r\nLive Support Team',	'New unread message',	0,	'',	0,	'',	'');

ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD `requires_username` int(11) NOT NULL,
COMMENT='';

CREATE TABLE `lh_abstract_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `recipient` varchar(250) NOT NULL,
  `active` int(11) NOT NULL,
  `name_attr` varchar(250) NOT NULL,
  `intro_attr` varchar(250) NOT NULL,
  `xls_columns` text NOT NULL,
  `pagelayout` varchar(200) NOT NULL,
  `post_content` text NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `lh_abstract_form_collected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `identifier` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) DEFAULT CHARSET=utf8;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('bbc_button_visible','1',0,'Show BB Code button', '0');

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`) VALUES (8,'Filled form','Live support',0,'',0,'Hello,\r\n\r\nUser has filled a form\r\nForm name - {form_name}\r\nUser IP - {ip}\r\nDownload filled data - {url_download}\r\n\r\nSincerely,\r\nLive Support Team','Filled form - {form_name}',	0,	'',	0,	'',	'');


ALTER TABLE `lh_departament`
ADD `nc_cb_execute` tinyint(1) NOT NULL,
ADD `na_cb_execute` tinyint(1) NOT NULL AFTER `nc_cb_execute`,
COMMENT='';


INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('disable_html5_storage','1',0,'Disable HMTL5 storage, check it if your site is switching between http and https', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('automatically_reopen_chat','0',0,'Automatically reopen chat on widget open', '0');
ALTER TABLE `lh_abstract_browse_offer_invitation`
ADD `callback_content` text COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';
INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`) VALUES
(9,	'Chat was accepted',	'Live support',	0,	'',	0,	'Hello,\r\n\r\nOperator {user_name} has accepted a chat [{chat_id}]\r\n\r\nUser request data:\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nCountry: {country}\r\nCity: {city}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nClick to accept chat automatically\r\n{url_accept}\r\n\r\nSincerely,\r\nLive Support Team',	'Chat was accepted [{chat_id}]',	0,	'',	0,	'',	'');

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('autoclose_timeout','0', 0, 'Automatic chats closing. 0 - disabled, n > 0 time in minutes before chat is automatically closed', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('autopurge_timeout','0', 0, 'Automatic chats purging. 0 - disabled, n > 0 time in minutes before chat is automatically deleted', '0');

ALTER TABLE `lh_userdep`
ADD `last_accepted` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `active_balancing` tinyint(1) NOT NULL,
ADD `max_active_chats` int NOT NULL AFTER `active_balancing`,
ADD `max_timeout_seconds` int NOT NULL AFTER `max_active_chats`,
COMMENT='';

ALTER TABLE `lh_userdep`
ADD `active_chats` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_canned_msg`
ADD `auto_send` tinyint(1) NOT NULL,
COMMENT='';

CREATE TABLE `lh_abstract_widget_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
                 `name` varchar(250) NOT NULL,
                 `onl_bcolor` varchar(10) NOT NULL,
                 `bor_bcolor` varchar(10) NOT NULL DEFAULT 'e3e3e3',
                 `text_color` varchar(10) NOT NULL,
                 `online_image` varchar(250) NOT NULL,
                 `online_image_path` varchar(250) NOT NULL,
                 `offline_image` varchar(250) NOT NULL,
                 `offline_image_path` varchar(250) NOT NULL,
                 `logo_image` varchar(250) NOT NULL,
                 `logo_image_path` varchar(250) NOT NULL,
                 `need_help_image` varchar(250) NOT NULL,
                 `header_background` varchar(10) NOT NULL,
                 `need_help_tcolor` varchar(10) NOT NULL,
                 `need_help_bcolor` varchar(10) NOT NULL,
                 `need_help_border` varchar(10) NOT NULL,
                 `need_help_close_bg` varchar(10) NOT NULL,
                 `need_help_hover_bg` varchar(10) NOT NULL,
                 `need_help_close_hover_bg` varchar(10) NOT NULL,
                 `need_help_image_path` varchar(250) NOT NULL,
                 `custom_status_css` text NOT NULL,
                 `custom_container_css` text NOT NULL,
                 `custom_widget_css` text NOT NULL,
                 `need_help_header` varchar(250) NOT NULL,
                 `need_help_text` varchar(250) NOT NULL,
                 `online_text` varchar(250) NOT NULL,
                 `offline_text` varchar(250) NOT NULL,
                 `widget_border_color` varchar(10) NOT NULL,
                 `copyright_image` varchar(250) NOT NULL,
                 `copyright_image_path` varchar(250) NOT NULL,
                 `widget_copyright_url` varchar(250) NOT NULL,
                 `show_copyright` int(11) NOT NULL DEFAULT '1',
                 `explain_text` text NOT NULL,
                 `intro_operator_text` varchar(250) NOT NULL,
                 `operator_image` varchar(250) NOT NULL,
                 `operator_image_path` varchar(250) NOT NULL,
                 `minimize_image` varchar(250) NOT NULL,
                 `minimize_image_path` varchar(250) NOT NULL,
                 `restore_image` varchar(250) NOT NULL,
                 `restore_image_path` varchar(250) NOT NULL,
                 `close_image` varchar(250) NOT NULL,
                 `close_image_path` varchar(250) NOT NULL,
                 `popup_image` varchar(250) NOT NULL,
                 `popup_image_path` varchar(250) NOT NULL,
                 `hide_close` int(11) NOT NULL,
                 `hide_popup` int(11) NOT NULL,
                 `header_height` int(11) NOT NULL,
                 `support_joined` varchar(250) NOT NULL,
                 `support_closed` varchar(250) NOT NULL,
                 `pending_join` varchar(250) NOT NULL,
                 `noonline_operators` varchar(250) NOT NULL,
                 `noonline_operators_offline` varchar(250) NOT NULL,
                 `header_padding` int(11) NOT NULL,
                 `widget_border_width` int(11) NOT NULL,
                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`)
VALUES ('new_user_bn', '', '');

INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`)
VALUES ('new_user_sound', '', '');

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('allow_reopen_closed','1', 0, 'Allow user to reopen closed chats?', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('reopen_as_new','1', 0, 'Reopen closed chat as new? Otherwise it will be reopened as active.', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('default_theme_id','0', 0, 'Default theme ID.', '1');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('update_ip','127.0.0.1',0,'Which ip should be allowed to update DB by executing http request, separate by comma?',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('track_if_offline','0',0,'Track online visitors even if there is no online operators',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('min_phone_length','8',0,'Minimum phone number length',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('geoadjustment_data',	'a:8:{i:0;b:0;s:18:\"use_geo_adjustment\";b:0;s:13:\"available_for\";s:0:\"\";s:15:\"other_countries\";s:6:\"custom\";s:8:\"hide_for\";s:0:\"\";s:12:\"other_status\";s:7:\"offline\";s:11:\"rest_status\";s:6:\"hidden\";s:12:\"apply_widget\";i:0;}',	0,	'Geo adjustment settings',	1);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('mheight','',0,'Messages box height',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('checkstatus_timeout','0',0,'Interval between chat status checks in seconds, 0 disabled.',0);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('suggest_leave_msg','1',0,'Suggest user to leave a message then user chooses offline department',0);

INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('oupdate_timeout', '', '');
INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('ouser_timeout', '', '');
INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('o_department', '', '');
INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('omax_rows', '', '');
INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('ogroup_by', '', '');
INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('omap_depid', '', '');
INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('omap_mtimeout', '', '');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('show_language_switcher','0',0,'Show users option to switch language at widget',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('show_languages','eng,lit,hrv,esp,por,nld,ara,ger,pol,rus,ita,fre,chn,cse,nor,tur,vnm,idn,sve,per,ell,dnk,rou,bgr,tha,geo,fin,alb',0,'Between what languages user should be able to switch',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('track_is_online','0',0,'Track is user still on site, chat status checks also has to be enabled',0);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sharing_auto_allow','0',0,'Do not ask permission for users to see their screen',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sharing_nodejs_enabled','0',0,'NodeJs support enabled',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sharing_nodejs_secure','0',0,'Connect to NodeJs in https mode',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sharing_nodejs_socket_host','',0,'Host where NodeJs is running',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sharing_nodejs_sllocation','https://cdn.socket.io/socket.io-1.1.0.js',0,'Location of SocketIO JS library',0);
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('disable_js_execution','1',0,'Disable JS execution in Co-Browsing operator window',0);

CREATE TABLE `lh_cobrowse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  `initialize` longtext NOT NULL,
  `modifications` longtext NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `w` int(11) NOT NULL,
  `wh` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('speech_data','a:3:{i:0;b:0;s:8:\"language\";i:7;s:7:\"dialect\";s:5:\"en-US\";}',	1,	'',	1);

CREATE TABLE IF NOT EXISTS `lh_speech_language` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(100) NOT NULL,
                  PRIMARY KEY (`id`)
               ) DEFAULT CHARSET=utf8;
               
CREATE TABLE IF NOT EXISTS `lh_speech_language_dialect` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `language_id` int(11) NOT NULL,
                  `lang_name` varchar(100) NOT NULL,
                  `lang_code` varchar(100) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `language_id` (`language_id`)
               ) DEFAULT CHARSET=utf8;
                              
CREATE TABLE IF NOT EXISTS `lh_speech_chat_language` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `chat_id` int(11) NOT NULL,
                  `language_id` int(11) NOT NULL,
                  `dialect` varchar(50) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `chat_id` (`chat_id`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
               
INSERT INTO `lh_speech_language` (`id`, `name`) VALUES
        	   (1,	'Afrikaans'),
        	   (2,	'Bahasa Indonesia'),
        	   (3,	'Bahasa Melayu'),
        	   (4,	'Català'),
        	   (5,	'Čeština'),
        	   (6,	'Deutsch'),
        	   (7,	'English'),
        	   (8,	'Español'),
        	   (9,	'Euskara'),
        	   (10,	'Français'),
        	   (11,	'Galego'),
        	   (12,	'Hrvatski'),
        	   (13,	'IsiZulu'),
        	   (14,	'Íslenska'),
        	   (15,	'Italiano'),
        	   (16,	'Magyar'),
        	   (17,	'Nederlands'),
        	   (18,	'Norsk bokmål'),
        	   (19,	'Polski'),
        	   (20,	'Português'),
        	   (21,	'Română'),
        	   (22,	'Slovenčina'),
        	   (23,	'Suomi'),
        	   (24,	'Svenska'),
        	   (25,	'Türkçe'),
        	   (26,	'български'),
        	   (27,	'Pусский'),
        	   (28,	'Српски'),
        	   (29,	'한국어'),
        	   (30,	'中文'),
        	   (31,	'日本語'),
        	   (32,	'Lingua latīna');
        	   
INSERT INTO `lh_speech_language_dialect` (`id`, `language_id`, `lang_name`, `lang_code`) VALUES
                (1,	1,	'Afrikaans',	'af-ZA'),
                (2,	2,	'Bahasa Indonesia',	'id-ID'),
                (3,	3,	'Bahasa Melayu',	'ms-MY'),
                (4,	4,	'Català',	'ca-ES'),
                (5,	5,	'Čeština',	'cs-CZ'),
                (6,	6,	'Deutsch',	'de-DE'),
                (7,	7,	'Australia',	'en-AU'),
                (8,	7,	'Canada',	'en-CA'),
                (9,	7,	'India',	'en-IN'),
                (10,	7,	'New Zealand',	'en-NZ'),
                (11,	7,	'South Africa',	'en-ZA'),
                (12,	7,	'United Kingdom',	'en-GB'),
                (13,	7,	'United States',	'en-US'),
                (14,	8,	'Argentina',	'es-AR'),
                (15,	8,	'Bolivia',	'es-BO'),
                (16,	8,	'Chile',	'es-CL'),
                (17,	8,	'Colombia',	'es-CO'),
                (18,	8,	'Costa Rica',	'es-CR'),
                (19,	8,	'Ecuador',	'es-EC'),
                (20,	8,	'El Salvador',	'es-SV'),
                (21,	8,	'España',	'es-ES'),
                (22,	8,	'Estados Unidos',	'es-US'),
                (23,	8,	'Guatemala',	'es-GT'),
                (24,	8,	'Honduras',	'es-HN'),
                (25,	8,	'México',	'es-MX'),
                (26,	8,	'Nicaragua',	'es-NI'),
                (27,	8,	'Panamá',	'es-PA'),
                (28,	8,	'Paraguay',	'es-PY'),
                (29,	8,	'Perú',	'es-PE'),
                (30,	8,	'Puerto Rico',	'es-PR'),
                (31,	8,	'República Dominicana',	'es-DO'),
                (32,	8,	'Uruguay',	'es-UY'),
                (33,	8,	'Venezuela',	'es-VE'),
                (34,	9,	'Euskara',	'eu-ES'),
                (35,	10,	'Français',	'fr-FR'),
                (36,	11,	'Galego',	'gl-ES'),
                (37,	12,	'Hrvatski',	'hr_HR'),
                (38,	13,	'IsiZulu',	'zu-ZA'),
                (39,	14,	'Íslenska',	'is-IS'),
                (40,	15,	'Italia',	'it-IT'),
                (41,	15,	'Svizzera',	'it-CH'),
                (42,	16,	'Magyar',	'hu-HU'),
                (43,	17,	'Nederlands',	'nl-NL'),
                (44,	18,	'Norsk bokmål',	'nb-NO'),
                (45,	19,	'Polski',	'pl-PL'),
                (46,	20,	'Brasil',	'pt-BR'),
                (47,	20,	'Portugal',	'pt-PT'),
                (48,	21,	'Română',	'ro-RO'),
                (49,	22,	'Slovenčina',	'sk-SK'),
                (50,	23,	'Suomi',	'fi-FI'),
                (51,	24,	'Svenska',	'sv-SE'),
                (52,	25,	'Türkçe',	'tr-TR'),
                (53,	26,	'български',	'bg-BG'),
                (54,	27,	'Pусский',	'ru-RU'),
                (55,	28,	'Српски',	'sr-RS'),
                (56,	29,	'한국어',	'ko-KR'),
                (57,	30,	'普通话 (中国大陆)',	'cmn-Hans-CN'),
                (58,	30,	'普通话 (香港)',	'cmn-Hans-HK'),
                (59,	30,	'中文 (台灣)',	'cmn-Hant-TW'),
                (60,	30,	'粵語 (香港)',	'yue-Hant-HK'),
                (61,	31,	'日本語',	'ja-JP'),
                (62,	32,	'Lingua latīna',	'la');   
                
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('front_tabs', 'online_users,online_map,pending_chats,active_chats,unread_chats,closed_chats,online_operators', '0', 'Home page tabs order', '0');

ALTER TABLE `lh_chat_online_user`
ADD `notes` varchar(250) COLLATE 'utf8_general_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_abstract_auto_responder`
ADD `repeat_number` int(11) NOT NULL DEFAULT '1',
COMMENT='';

ALTER TABLE `lh_chat`
ADD `wait_timeout_repeat` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_abstract_proactive_chat_invitation`
ADD `repeat_number` int NOT NULL DEFAULT '1',
COMMENT='';

ALTER TABLE `lh_abstract_email_template`
ADD `user_mail_as_sender` tinyint(4) NOT NULL,
COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('translation_data',	'a:6:{i:0;b:0;s:19:\"translation_handler\";s:4:\"bing\";s:19:\"enable_translations\";b:0;s:14:\"bing_client_id\";s:0:\"\";s:18:\"bing_client_secret\";s:0:\"\";s:14:\"google_api_key\";s:0:\"\";}',	0,	'Translation data',	1);


ALTER TABLE `lh_group`
ADD `disabled` int NOT NULL,
COMMENT='';

ALTER TABLE `lh_group`
ADD INDEX `disabled` (`disabled`);

ALTER TABLE `lh_abstract_widget_theme`
ADD `name_company` varchar(250) COLLATE 'utf8_general_ci' NOT NULL AFTER `name`,
COMMENT='';

ALTER TABLE `lh_users`
ADD `rec_per_req` tinyint(1) NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD INDEX `rec_per_req` (`rec_per_req`);

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`, `user_mail_as_sender`) VALUES
(10,	'Permission request',	'Live Helper Chat',	0,	'',	0,	'Hello,\r\n\r\nOperator {user} has requested these permissions\n\r\n{permissions}\r\n\r\nSincerely,\r\nLive Support Team',	'Permission request from {user}',	0,	'',	0,	'',	'',	0);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sharing_nodejs_path','',0,'socket.io path, optional',0);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('autologin_data',	'a:3:{i:0;b:0;s:11:\"secret_hash\";s:16:\"please_change_me\";s:7:\"enabled\";i:0;}',	0,	'Autologin configuration data',	1);
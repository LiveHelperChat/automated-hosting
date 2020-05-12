-- Adminer 3.6.1 MySQL dump

SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci';
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `lh_abstract_auto_responder`;
CREATE TABLE `lh_abstract_auto_responder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteaccess` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timeout_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_id` int(11) NOT NULL,
  `repeat_number` int(11) NOT NULL DEFAULT 1,
  `wait_timeout_2` int(11) NOT NULL,
  `timeout_message_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_3` int(11) NOT NULL,
  `timeout_message_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_4` int(11) NOT NULL,
  `timeout_message_4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_5` int(11) NOT NULL,
  `timeout_message_5` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_reply_1` int(11) NOT NULL,
  `timeout_reply_message_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_reply_2` int(11) NOT NULL,
  `timeout_reply_message_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_reply_3` int(11) NOT NULL,
  `timeout_reply_message_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_reply_4` int(11) NOT NULL,
  `timeout_reply_message_4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_reply_5` int(11) NOT NULL,
  `timeout_reply_message_5` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ignore_pa_chat` int(11) NOT NULL,
  `survey_timeout` int(11) NOT NULL DEFAULT '0',
  `survey_id` int(11) NOT NULL DEFAULT '0',
  `only_proactive` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_hold_1` int(11) NOT NULL,
  `wait_timeout_hold_2` int(11) NOT NULL,
  `wait_timeout_hold_3` int(11) NOT NULL,
  `wait_timeout_hold_4` int(11) NOT NULL,
  `wait_timeout_hold_5` int(11) NOT NULL,
  `timeout_hold_message_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeout_hold_message_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeout_hold_message_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeout_hold_message_4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeout_hold_message_5` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_timeout_hold` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `languages` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bot_configuration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteaccess_position` (`siteaccess`,`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`) VALUES
(1,	'Send mail to user',	'Live Support',	0,	'',	0,	'Dear {user_chat_nick},\r\n\r\n{additional_message}\r\n\r\nLive Support response:\r\n{messages_content}\r\n\r\nSincerely,\r\nLive Support Team\r\n',	'{name_surname} has responded to your request',	1,	'',	1,	''),
(2,	'Support request from user',	'',	0,	'',	0,	'Hello,\r\n\r\nUser request data:\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nAdditional data, if any:\r\n{additional_data}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nSincerely,\r\nLive Support Team',	'Support request from user',	0,	'',	0,	'{email_replace}'),
(3,	'User mail for himself',	'Live Support',	0,	'',	0,	'Dear {user_chat_nick},\r\n\r\nTranscript:\r\n{messages_content}\r\n\r\nSincerely,\r\nLive Support Team\r\n',	'Chat transcript',	0,	'',	0,	'');

DROP TABLE IF EXISTS `lh_abstract_proactive_chat_invitation`;
CREATE TABLE `lh_abstract_proactive_chat_invitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteaccess` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_on_site` int(11) NOT NULL,
  `pageviews` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_times` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `identifier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requires_email` int(11) NOT NULL,
  `show_random_operator` int(11) NOT NULL,
  `hide_after_ntimes` int(11) NOT NULL,
  `referrer` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_ids` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_id` int(11) NOT NULL,
  `requires_username` int(11) NOT NULL,
  `inject_only_html` tinyint(1) NOT NULL,
  `requires_phone` int(11) NOT NULL,
  `message_returning` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_returning_nick` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dynamic_invitation` int(11) NOT NULL,
  `iddle_for` int(11) NOT NULL,
  `event_type` int(11) NOT NULL,
  `event_invitation` int(11) NOT NULL,
  `autoresponder_id` int(11) NOT NULL,
  `show_on_mobile` int(11) NOT NULL,
  `delay` int(11) NOT NULL,
  `delay_init` int(11) NOT NULL,
  `show_instant` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `trigger_id` int(11) NOT NULL,
  `bot_offline` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time_on_site_pageviews_siteaccess_position` (`time_on_site`,`pageviews`,`siteaccess`,`position`),
  KEY `identifier` (`identifier`),
  KEY `dep_id` (`dep_id`),
  KEY `tag` (`tag`),
  KEY `dynamic_invitation` (`dynamic_invitation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `lh_canned_msg`;
CREATE TABLE `lh_canned_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `explain` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fallback_msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `html_snippet` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `delay` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `auto_send` tinyint(1) NOT NULL,
  `attr_int_1` int(11) NOT NULL,
  `attr_int_2` int(11) NOT NULL,
  `attr_int_3` int(11) NOT NULL,
  `languages` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `user_id` (`user_id`),
  KEY `attr_int_1` (`attr_int_1`),
  KEY `attr_int_2` (`attr_int_2`),
  KEY `attr_int_3` (`attr_int_3`),
  KEY `position_title_v2` (`position`,`title`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_chat`;
CREATE TABLE `lh_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `time` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_id` int(11) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `support_informed` int(11) NOT NULL DEFAULT 0,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_typing` int(11) NOT NULL,
  `operator_typing` int(11) NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_unread_messages` int(11) NOT NULL,
  `last_user_msg_time` int(11) NOT NULL,
  `last_msg_id` int(11) NOT NULL,
  `additional_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_send` int(11) NOT NULL,
  `lat` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lon` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_referrer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wait_time` int(11) NOT NULL,
  `chat_duration` int(11) NOT NULL,
  `chat_variables` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `user_typing_txt` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_initiator` int(11) NOT NULL,
  `online_user_id` int(11) NOT NULL,
  `transfer_timeout_ts` int(11) NOT NULL,
  `transfer_timeout_ac` int(11) NOT NULL,
  `transfer_if_na` int(11) NOT NULL,
  `na_cb_executed` int(11) NOT NULL,
  `fbst` tinyint(1) NOT NULL,
  `nc_cb_executed` tinyint(1) NOT NULL,
  `operator_typing_id` int(11) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_sub` int(11) NOT NULL DEFAULT '0',
  `operation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenshot_id` int(11) NOT NULL,
  `operation_admin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unread_messages_informed` int(11) NOT NULL DEFAULT 0,
  `reinform_timeout` int(11) NOT NULL DEFAULT 0,
  `tslasign` int(11) NOT NULL,
  `user_tz_identifier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_closed_ts` int(11) NOT NULL DEFAULT 0,
  `chat_locale` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_locale_to` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unanswered_chat` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `last_op_msg_time` int(11) NOT NULL DEFAULT 0,
  `has_unread_op_messages` int(11) NOT NULL DEFAULT 0,
  `unread_op_messages_informed` int(11) NOT NULL DEFAULT 0,
  `status_sub_sub` int(11) NOT NULL DEFAULT 0,
  `status_sub_arg` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uagent` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `auto_responder_id` int(11) NOT NULL,
  `lsync` int(11) NOT NULL,
  `usaccept` int(11) NOT NULL DEFAULT 0,
  `transfer_uid` int(11) NOT NULL,
  `pnd_time` int(11) NOT NULL DEFAULT 0,
  `cls_time` int(11) NOT NULL DEFAULT 0,
  `anonymized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`),
  KEY `online_user_id` (`online_user_id`),
  KEY `status_user_id` (`status`,`user_id`),
  KEY `unanswered_chat` (`unanswered_chat`),
  KEY `product_id` (`product_id`),
  KEY `unread_operator` (`has_unread_op_messages`,`unread_op_messages_informed`),
  KEY `user_id_sender_user_id` (`user_id`,`sender_user_id`),
  KEY `sender_user_id` (`sender_user_id`),
  KEY `status` (`status`),
  KEY `dep_id_status` (`dep_id`,`status`),
  KEY `anonymized` (`anonymized`),
  KEY `has_unread_messages` (`has_unread_messages`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `lh_chat_archive_range`;
CREATE TABLE `lh_chat_archive_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `range_from` int(11) NOT NULL,
  `range_to` int(11) NOT NULL,
  `older_than` int(11) NOT NULL,
  `last_id` int(11) NOT NULL,
  `first_id` int(11) NOT NULL,
  `year_month` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_chat_blocked_user`;
CREATE TABLE `lh_chat_blocked_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datets` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_chat_config`;
CREATE TABLE `lh_chat_config` (
  `identifier` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `explain` varchar(250) NOT NULL,
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('application_name',	'a:6:{s:3:\"eng\";s:12:\"Live support\";s:3:\"lit\";s:12:\"Live support\";s:3:\"hrv\";s:0:\"\";s:3:\"esp\";s:0:\"\";s:3:\"por\";s:0:\"\";s:10:\"site_admin\";s:12:\"Live support\";}',	1,	'Support application name, visible in browser title.',	0),
('chatbox_data',	'a:6:{i:0;b:0;s:20:\"chatbox_auto_enabled\";i:0;s:19:\"chatbox_secret_hash\";s:{chat_box_hash_length}:\"{chat_box_hash}\";s:20:\"chatbox_default_name\";s:7:\"Chatbox\";s:17:\"chatbox_msg_limit\";i:50;s:22:\"chatbox_default_opname\";s:7:\"Manager\";}',	0,	'Chatbox configuration',	1),
('customer_company_name',	'Live Support',	0,	'Your company name - visible in bottom left corner',	0),
('customer_site_url',	'#',	0,	'Your site URL address',	0),
('banned_ip_range','',0,'Which ip should not be allowed to chat',0),
('disable_popup_restore',	'0',	0,	'Disable option in widget to open new window. 0 - no, 1 - restore icon will be hidden',	0),
('export_hash',	'{export_hash_chats}',	0,	'Chats export secret hash',	0),
('geo_data',	'a:5:{i:0;b:0;s:21:\"geo_detection_enabled\";i:1;s:22:\"geo_service_identifier\";s:8:\"max_mind\";s:23:\"max_mind_detection_type\";s:4:\"city\";s:22:\"max_mind_city_location\";s:37:\"var/external/geoip/GeoLite2-City.mmdb\";}',	0,	'',	1),
('geo_location_data',	'a:3:{s:4:\"zoom\";i:4;s:3:\"lat\";s:7:\"49.8211\";s:3:\"lng\";s:7:\"11.7835\";}',	0,	'',	1),
('list_online_operators',	'1',	0,	'List online operators, 0 - no, 1 - yes.',	0),
('message_seen_timeout',	'24',	0,	'Proactive message timeout in hours. After how many hours proactive chat mesasge should be shown again.',	0),
('pro_active_invite',	'1',	0,	'Is pro active chat invitation active. Online users tracking also has to be enabled',	0),
('pro_active_limitation',	'-1',	0,	'Pro active chats invitations limitation based on pending chats, (-1) do not limit, (0,1,n+1) number of pending chats can be for invitation to be shown.',	0),
('pro_active_show_if_offline',	'0',	0,	'Should invitation logic be executed if there is no online operators, 0 - no, 1 - yes',	0),
('reopen_chat_enabled',	'1',	0,	'Reopen chat functionality enabled, 0 - No, 1 - Yes',	0),
('run_departments_workflow',	'0',	0,	'Should cronjob run departments tranfer workflow, even if user leaves a chat, 0 - no, 1 - yes',	0),
('run_unaswered_chat_workflow',	'0',	0,	'Should cronjob run unanswered chats workflow and execute unaswered chats callback, 0 - no, any other number bigger than 0 is a minits how long chat have to be not accepted before executing callback.',	0),
('smtp_data',	'a:5:{s:4:\"host\";s:0:\"\";s:4:\"port\";s:2:\"25\";s:8:\"use_smtp\";i:0;s:8:\"username\";s:0:\"\";s:8:\"password\";s:0:\"\";}',	0,	'SMTP configuration',	1),
('start_chat_data',	'a:23:{i:0;b:0;s:21:\"name_visible_in_popup\";b:1;s:27:\"name_visible_in_page_widget\";b:1;s:19:\"name_require_option\";s:8:\"required\";s:22:\"email_visible_in_popup\";b:0;s:28:\"email_visible_in_page_widget\";b:0;s:20:\"email_require_option\";s:8:\"required\";s:24:\"message_visible_in_popup\";b:1;s:30:\"message_visible_in_page_widget\";b:1;s:22:\"message_require_option\";s:8:\"required\";s:22:\"phone_visible_in_popup\";b:0;s:28:\"phone_visible_in_page_widget\";b:0;s:20:\"phone_require_option\";s:8:\"required\";s:21:\"force_leave_a_message\";b:0;s:29:\"offline_name_visible_in_popup\";b:1;s:35:\"offline_name_visible_in_page_widget\";b:1;s:27:\"offline_name_require_option\";s:8:\"required\";s:30:\"offline_phone_visible_in_popup\";b:0;s:36:\"offline_phone_visible_in_page_widget\";b:0;s:28:\"offline_phone_require_option\";s:8:\"required\";s:32:\"offline_message_visible_in_popup\";b:1;s:38:\"offline_message_visible_in_page_widget\";b:1;s:30:\"offline_message_require_option\";s:8:\"required\";}',	0,	'',	1),
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
                  `user_agent` text NOT NULL,
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
        	   	  `online_attr` text NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `vid` (`vid`),
				  KEY `dep_id` (`dep_id`),
				  KEY `last_visit_dep_id` (`last_visit`,`dep_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_chat_online_user_footprint`;
CREATE TABLE `lh_chat_online_user_footprint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `online_user_id` int(11) NOT NULL,
  `page` varchar(2083) NOT NULL,
  `vtime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  KEY `online_user_id` (`online_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_chatbox`;
CREATE TABLE `lh_chatbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  KEY `active_url_2` (`active`,`url`(191)),
  KEY `has_url` (`has_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_forgotpasswordhash`;
CREATE TABLE `lh_forgotpasswordhash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_group`;
CREATE TABLE `lh_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_grouprole` ADD INDEX `group_id_primary` (`group_id`);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_groupuser` (`id`, `group_id`, `user_id`) VALUES
(1,	1,	1);

DROP TABLE IF EXISTS `lh_msg`;
CREATE TABLE `lh_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name_support` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_msg` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id_id` (`chat_id`,`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_question_option`;
CREATE TABLE `lh_question_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_name` varchar(250) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_question_option_answer`;
CREATE TABLE `lh_question_option_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `ip` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_role`;
CREATE TABLE `lh_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_rolefunction` (`role_id`, `module`, `function`) VALUES
(1,	'*',	'*'),
(2,	'lhuser',	'selfedit'),
(2,	'lhuser',	'changeonlinestatus'),
(2,	'lhuser',	'changeskypenick'),
(2,	'lhuser',	'personalcannedmsg'),
(2,	'lhuser',	'change_visibility_list'),
(2,	'lhuser',	'see_assigned_departments'),
(2,	'lhuser',	'canseedepartmentstats'),
(2,	'lhchat',	'use'),
(2,	'lhchat',	'allowtransferdirectly'),
(2,	'lhchat',	'singlechatwindow'),
(2,	'lhchat',	'allowopenremotechat'),
(2,	'lhchat',	'allowchattabs'),
(2,	'lhchat',	'use_onlineusers'),
(2,	'lhchat',	'allowtransfer'),
(2,	'lhchat',	'administratecannedmsg'),
(2,	'lhchat',	'allowblockusers'),
(2,	'lhchat',	'chattabschrome'),
(2,	'lhchat',	'take_screenshot'),
(2,	'lhchat',	'allowredirect'),
(2,	'lhchat',	'open_all'),
(2,	'lhchat',	'sees_all_online_visitors'),
(2,	'lhpermission',	'see_permissions'),
(2,	'lhtranslation',	'use'),
(2,	'lhcobrowse',	'browse'),
(2,	'lhfront',	'use'),
(2,	'lhfile',	'use_operator'),
(2,	'lhfile',	'file_delete_chat'),
(2,	'lhsystem',	'use'),
(2,	'lhsystem',	'generatejs'),
(2,	'lhsystem',	'changelanguage'),
(2,	'lhbrowseoffer',	'manage_bo'),
(2,	'lhstatistic',	'use'),
(2,	'lhspeech',	'changedefaultlanguage'),
(2,	'lhspeech',	'use'),
(2,	'lhspeech',	'change_chat_recognition'),
(2,	'lhquestionary',	'manage_questionary'),
(2,	'lhfaq',	'manage_faq'),
(2,	'lhchatbox',	'manage_chatbox'),
(2,	'lhcannedmsg',	'use'),
(2,	'lhtheme',	'personaltheme'),
(2,	'lhspeech',	'change_chat_recognition'),
(2,	'lhuser',	'userlistonline'),
(2,	'lhxml',	'*');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_userdep`;
CREATE TABLE IF NOT EXISTS `lh_userdep` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `user_id` int(11) NOT NULL,
                  `dep_id` int(11) NOT NULL,
                  `last_activity` int(11) NOT NULL,
                  `exclude_autoasign` tinyint(1) NOT NULL DEFAULT '0',
                  `hide_online` int(11) NOT NULL,
                  `last_accepted` int(11) NOT NULL DEFAULT '0',
                  `active_chats` int(11) NOT NULL DEFAULT '0',
                  `pending_chats` int(11) NOT NULL DEFAULT '0',
                  `inactive_chats` int(11) NOT NULL DEFAULT '0',
                  `max_chats` int(11) NOT NULL DEFAULT '0',
                  `type` int(11) NOT NULL DEFAULT '0',
                  `ro` tinyint(1) NOT NULL DEFAULT '0',
                  `hide_online_ts` int(11) NOT NULL DEFAULT '0',
                  `dep_group_id` int(11) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`id`),
                  KEY `last_activity_hide_online_dep_id` (`last_activity`,`hide_online`,`dep_id`),
                  KEY `dep_id` (`dep_id`),
                  KEY `user_id_type` (`user_id`,`type`)
                ) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_users` (`id`, `username`, `password`, `email`, `name`, `surname`, `disabled`, `hide_online`, `all_departments`) VALUES
(1,	'{email_replace}',	'{password_hash}',	'{email_replace}',	'Operator',	'',	0,	0,	1);

DROP TABLE IF EXISTS `lh_users_remember`;
CREATE TABLE `lh_users_remember` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lh_users_setting`;
CREATE TABLE `lh_users_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('file_configuration',	'a:7:{i:0;b:0;s:5:\"ft_op\";s:43:\"gif|jpe?g|png|zip|rar|xls|doc|docx|xlsx|pdf\";s:5:\"ft_us\";s:26:\"gif|jpe?g|png|doc|docx|pdf\";s:6:\"fs_max\";i:2048;s:18:\"active_user_upload\";b:0;s:16:\"active_op_upload\";b:1;s:19:\"active_admin_upload\";b:1;}',	0,	'Files configuration item',	1);

ALTER TABLE `lh_faq`
ADD `is_wildcard` tinyint(1) NOT NULL,
COMMENT='';

ALTER TABLE `lh_faq`
ADD INDEX `is_wildcard` (`is_wildcard`);

ALTER TABLE `lh_users`
ADD `filepath` varchar(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
ADD `filename` varchar(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL AFTER `filepath`,
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
ADD `inform_options` varchar(250) COLLATE 'utf8mb4_unicode_ci' NOT NULL AFTER `end_hour`,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`) VALUES
(5,	'Chat was closed',	'Live support',	0,	'',	0,	'Hello,\r\n\r\n{operator} has closed a chat\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nAdditional data, if any:\r\n{additional_data}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nSincerely,\r\nLive Support Team',	'Chat was closed',	0,	'',	0,	'');

ALTER TABLE `lh_departament`
ADD `inform_close` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD `skype` varchar(50) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_chat_accept`
ADD `wused` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `xmpp_recipients` text COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `xmpp_group_recipients` text COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD `xmpp_username` varchar(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD INDEX `email` (`email`),
ADD INDEX `xmpp_username` (`xmpp_username`(191));

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

ALTER TABLE `lh_users`
ADD `time_zone` varchar(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_chat_file`
ADD INDEX `user_id` (`user_id`);ALTER TABLE `lh_question` ADD `revote` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `lh_question_option_answer` ADD `ctime` int NOT NULL;

ALTER TABLE `lh_abstract_email_template`
ADD `bcc_recipients` varchar(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
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
ADD `job_title` varchar(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_departament`
ADD `hidden` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD INDEX `disabled_hidden` (`disabled`, `hidden`),
DROP INDEX `disabled`;

ALTER TABLE `lh_departament`
ADD `inform_unread` tinyint(1) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `inform_unread_delay` int(11) NOT NULL,
COMMENT='';

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`) VALUES
(7,	'New unread message',	'Live support',	0,	'',	0,	'Hello,\r\n\r\nUser request data:\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nCountry: {country}\r\nCity: {city}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nClick to accept chat automatically\r\n{url_accept}\r\n\r\nSincerely,\r\nLive Support Team',	'New unread message',	0,	'',	0,	'',	'');

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
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_abstract_form_collected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `identifier` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('bbc_button_visible','1',0,'Show BB Code button', '0');

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`) VALUES (8,'Filled form','Live support',0,'',0,'Hello,\r\n\r\nUser has filled a form\r\nForm name - {form_name}\r\nUser IP - {ip}\r\nDownload filled data - {url_download}\r\n\r\nSincerely,\r\nLive Support Team','Filled form - {form_name}',	0,	'',	0,	'',	'');


ALTER TABLE `lh_departament`
ADD `nc_cb_execute` tinyint(1) NOT NULL,
ADD `na_cb_execute` tinyint(1) NOT NULL AFTER `nc_cb_execute`,
COMMENT='';


INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('disable_html5_storage','1',0,'Disable HMTL5 storage, check it if your site is switching between http and https', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('automatically_reopen_chat','0',0,'Automatically reopen chat on widget open', '0');
ALTER TABLE `lh_abstract_browse_offer_invitation`
ADD `callback_content` longtext COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';
INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`) VALUES
(9,	'Chat was accepted',	'Live support',	0,	'',	0,	'Hello,\r\n\r\nOperator {user_name} has accepted a chat [{chat_id}]\r\n\r\nUser request data:\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nCountry: {country}\r\nCity: {city}\r\nIP: {ip}\r\n\r\nMessage:\r\n{message}\r\n\r\nURL of page from which user has send request:\r\n{url_request}\r\n\r\nClick to accept chat automatically\r\n{url_accept}\r\n\r\nSincerely,\r\nLive Support Team',	'Chat was accepted [{chat_id}]',	0,	'',	0,	'',	'');

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('autoclose_timeout','0', 0, 'Automatic chats closing. 0 - disabled, n > 0 time in minutes before chat is automatically closed', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('autopurge_timeout','0', 0, 'Automatic chats purging. 0 - disabled, n > 0 time in minutes before chat is automatically deleted', '0');

ALTER TABLE `lh_departament`
ADD `active_balancing` tinyint(1) NOT NULL,
ADD `max_active_chats` int NOT NULL AFTER `active_balancing`,
ADD `max_timeout_seconds` int NOT NULL AFTER `max_active_chats`,
COMMENT='';

CREATE TABLE `lh_abstract_widget_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_company` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onl_bcolor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bor_bcolor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'e3e3e3',
  `text_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `online_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `online_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offline_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offline_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_background` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_tcolor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_bcolor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_border` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_close_bg` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_hover_bg` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_close_hover_bg` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_status_css` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_container_css` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_widget_css` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_header` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `need_help_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `online_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offline_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `widget_border_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `widget_copyright_url` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_copyright` int(11) NOT NULL DEFAULT 1,
  `explain_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro_operator_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimize_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimize_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restore_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restore_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `popup_image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `popup_image_path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hide_close` int(11) NOT NULL,
  `hide_popup` int(11) NOT NULL,
  `header_height` int(11) NOT NULL,
  `header_padding` int(11) NOT NULL,
  `widget_border_width` int(11) NOT NULL,
  `support_joined` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_closed` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pending_join` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noonline_operators` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noonline_operators_offline` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_need_help` int(11) NOT NULL DEFAULT 1,
  `show_need_help_timeout` int(11) NOT NULL DEFAULT 24,
  `show_voting` tinyint(1) NOT NULL DEFAULT 1,
  `department_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_select` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buble_visitor_background` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buble_visitor_title_color` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buble_visitor_text_color` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buble_operator_background` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buble_operator_title_color` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buble_operator_text_color` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_popup_css` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hide_ts` int(11) NOT NULL,
  `widget_response_width` int(11) NOT NULL,
  `show_need_help_delay` int(11) NOT NULL,
  `show_status_delay` int(11) NOT NULL,
  `modern_look` tinyint(1) NOT NULL DEFAULT 0,
  `bot_status_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bot_configuration` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_configuration` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('new_user_bn', '', '');
INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('new_user_sound', '', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('speech_data','a:3:{i:0;b:0;s:8:\"language\";i:7;s:7:\"dialect\";s:5:\"en-US\";}',	1,	'',	1);

CREATE TABLE IF NOT EXISTS `lh_speech_chat_language` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `chat_id` int(11) NOT NULL,
                  `language_id` int(11) NOT NULL,
                  `dialect` varchar(50) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `chat_id` (`chat_id`)
               ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `lh_speech_language` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(100) NOT NULL,
                  `siteaccess` varchar(3) NOT NULL DEFAULT '',
                  PRIMARY KEY (`id`)
               ) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `lh_speech_language_dialect` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                  `language_id` int(11) NOT NULL,
                  `lang_name` varchar(100) NOT NULL,
                  `lang_code` varchar(100) NOT NULL,
                  `short_code` varchar(4) NOT NULL DEFAULT '',
                  PRIMARY KEY (`id`),
                  KEY `language_id` (`language_id`),
                  KEY `short_code` (`short_code`),
                  KEY `lang_code` (`lang_code`)
                ) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_speech_language` (`id`, `name`, `siteaccess`) VALUES
				(1,	'Afrikaans',''),
				(2,	'Bahasa Indonesia',''),
				(3,	'Bahasa Melayu',''),
				(4,	'Català',''),
				(5,	'Čeština',''),
				(6,	'Deutsch','ger'),
				(7,	'English',''),
				(8,	'Español','esp'),
				(9,	'Euskara',''),
				(10,	'Français','fre'),
				(11,	'Galego',''),
				(12,	'Hrvatski',''),
				(13,	'IsiZulu',''),
				(14,	'Íslenska',''),
				(15,	'Italiano','ita'),
				(16,	'Magyar',''),
				(17,	'Nederlands','nld'),
				(18,	'Norsk bokmål',''),
				(19,	'Polski','pol'),
				(20,	'Português','por'),
				(21,	'Română',''),
				(22,	'Slovenčina',''),
				(23,	'Suomi','fin'),
				(24,	'Svenska',''),
				(25,	'Türkçe','tur'),
				(26,	'български',''),
				(27,	'Pусский','rus'),
				(28,	'Српски',''),
				(29,	'한국어',''),
				(30,	'中文',''),
				(31,	'日本語',''),
				(32,	'Lingua latīna',''),
				(33,	'Lithuanian','lit'),
				(34,	'Latvia',''),
				(35,	'Afar',''),
				(36,	'Arabic',''),
				(37,	'Assamese',''),
				(38,	'Azerbaijani',''),
				(39,	'Bulgarian','bgr'),
				(40,	'Bangla',''),
				(41,	'Bosnian',''),
				(42,	'Cakchiquel',''),
				(43,	'Danish',''),
				(44,	'Greek',''),
				(45,	'Estonian',''),
				(46,	'Persian',''),
				(47,	'Filipino',''),
				(48,	'Gujarati',''),
				(49,	'Hebrew',''),
				(50,	'Croatian',''),
				(51,	'Indonesia',''),
				(52,	'Icelandic',''),
				(53,	'Georgian',''),
				(54,	'Maori (New Zealand)',''),
				(55,	'Macedonian',''),
				(56,	'Malay (Latin)',''),
				(57,	'Maltese',''),
				(58,	'Norwegian Nynorsk',''),
				(59,	'Norwegian','nor'),
				(60,	'Northern Sotho (South Africa)',''),
				(61,	'Slovenian',''),
				(63,	'Thai',''),
				(64,	'Tagalog',''),
				(65,	'Tongan',''),
				(66,	'Ukrainian',''),
				(67,	'Vietnamese','vnm'),
				(68,	'Chinese','chn');

INSERT INTO `lh_speech_language_dialect` (`id`, `language_id`, `lang_name`, `lang_code`, `short_code`) VALUES
(1,	1,	'Afrikaans',	'af-ZA',	'af'),
(2,	2,	'Bahasa Indonesia',	'id-ID',	'id'),
(3,	3,	'Bahasa Melayu',	'ms-MY',	''),
(4,	4,	'Català',	'ca-ES',	''),
(5,	5,	'Čeština',	'cs-CZ',	'cs'),
(6,	6,	'Deutsch',	'de-DE',	'de'),
(7,	7,	'Australia',	'en-AU',	''),
(8,	7,	'Canada',	'en-CA',	''),
(9,	7,	'India',	'en-IN',	''),
(10,	7,	'New Zealand',	'en-NZ',	''),
(11,	7,	'South Africa',	'en-ZA',	''),
(12,	7,	'United Kingdom',	'en-GB',	'en'),
(13,	7,	'United States',	'en-US',	''),
(14,	8,	'Argentina',	'es-AR',	''),
(15,	8,	'Bolivia',	'es-BO',	''),
(16,	8,	'Chile',	'es-CL',	''),
(17,	8,	'Colombia',	'es-CO',	''),
(18,	8,	'Costa Rica',	'es-CR',	''),
(19,	8,	'Ecuador',	'es-EC',	''),
(20,	8,	'El Salvador',	'es-SV',	''),
(21,	8,	'España',	'es-ES',	'es'),
(22,	8,	'Estados Unidos',	'es-US',	''),
(23,	8,	'Guatemala',	'es-GT',	''),
(24,	8,	'Honduras',	'es-HN',	''),
(25,	8,	'México',	'es-MX',	''),
(26,	8,	'Nicaragua',	'es-NI',	''),
(27,	8,	'Panamá',	'es-PA',	''),
(28,	8,	'Paraguay',	'es-PY',	''),
(29,	8,	'Perú',	'es-PE',	''),
(30,	8,	'Puerto Rico',	'es-PR',	''),
(31,	8,	'República Dominicana',	'es-DO',	''),
(32,	8,	'Uruguay',	'es-UY',	''),
(33,	8,	'Venezuela',	'es-VE',	''),
(34,	9,	'Euskara',	'eu-ES',	''),
(35,	10,	'Français',	'fr-FR',	'fr'),
(36,	11,	'Galego',	'gl-ES',	''),
(37,	12,	'Hrvatski',	'hr_HR',	''),
(38,	13,	'IsiZulu',	'zu-ZA',	''),
(39,	14,	'Íslenska',	'is-IS',	''),
(40,	15,	'Italia',	'it-IT',	'it'),
(41,	15,	'Svizzera',	'it-CH',	'it'),
(42,	16,	'Magyar',	'hu-HU',	'hu'),
(43,	17,	'Nederlands',	'nl-NL',	'nl'),
(44,	18,	'Norsk bokmål',	'nb-NO',	'nb'),
(45,	19,	'Polski',	'pl-PL',	'pl'),
(46,	20,	'Brasil',	'pt-BR',	''),
(47,	20,	'Portugal',	'pt-PT',	'pt'),
(48,	21,	'Română',	'ro-RO',	'ro'),
(49,	22,	'Slovenčina',	'sk-SK',	'sk'),
(50,	23,	'Suomi',	'fi-FI',	'fi'),
(51,	24,	'Swedish',	'sv-SE',	'sv'),
(52,	25,	'Türkçe',	'tr-TR',	'tr'),
(53,	26,	'български',	'bg-BG',	''),
(54,	27,	'Pусский',	'ru-RU',	'ru'),
(55,	28,	'Serbian',	'sr-RS',	'sr'),
(56,	29,	'한국어',	'ko-KR',	'ko'),
(57,	30,	'普通话 (中国大陆)',	'cmn-Hans-CN',	''),
(58,	30,	'普通话 (香港)',	'cmn-Hans-HK',	''),
(59,	30,	'中文 (台灣)',	'cmn-Hant-TW',	''),
(60,	30,	'粵語 (香港)',	'yue-Hant-HK',	''),
(61,	31,	'日本語',	'ja-JP',	'ja'),
(62,	32,	'Lingua latīna',	'la',	''),
(64,	33,	'Lithuanian',	'lt-LT',	'lt'),
(65,	34,	'Latvia',	'lv-LV',	'lv'),
(66,	35,	'Afar',	'aa-DJ',	'aa'),
(67,	36,	'Egypt',	'ar-EG',	'ar'),
(68,	37,	'India',	'as-IN',	'as'),
(69,	38,	'Azerbaijani',	'az-AZ',	'az'),
(70,	39,	'Bulgarian',	'bg',	'bg'),
(71,	40,	'Bangla',	'bn',	'bn'),
(72,	41,	'Bosnian',	'bs-BA',	'bs'),
(73,	42,	'Cakchiquel',	'cak',	'cak'),
(74,	43,	'Danish',	'da-dk',	'da'),
(75,	44,	'Greek',	'el-GR',	'el'),
(76,	45,	'Estonian',	'et-EE',	'et'),
(77,	46,	'Persian',	'fa-IR',	'fa'),
(78,	47,	'Filipino',	'fil',	'fil'),
(79,	48,	'Gujarati',	'gu-IN',	'gu'),
(80,	49,	'Hebrew',	'he',	'he'),
(81,	50,	'Croatian',	'hr-HR',	'hr'),
(82,	51,	'Indonesia',	'in',	'in'),
(83,	52,	'Icelandic',	'is',	'is'),
(84,	53,	'Georgian',	'ka-ge',	'ka'),
(85,	54,	'Maori (New Zealand)',	'mi-nz',	'mi'),
(86,	55,	'Macedonian',	'mk-MK',	'mk'),
(87,	56,	'Malay (Latin)',	'ms',	'ms'),
(88,	57,	'Maltese',	'mt',	'mt'),
(89,	58,	'Norwegian Nynorsk',	'nn-NO',	'nn'),
(90,	59,	'Norwegian',	'no',	'no'),
(91,	60,	'Northern Sotho (South Africa)',	'nso-za',	'nso'),
(92,	61,	'Slovenian',	'sl-SI',	'sl'),
(94,	63,	'Thai',	'th-TH',	'th'),
(95,	64,	'Tagalog',	'tl',	'tl'),
(96,	65,	'Tongan',	'to-TO',	'to'),
(97,	66,	'Ukrainian',	'uk-UA',	'uk'),
(98,	67,	'Vietnamese',	'vi-VN',	'vi'),
(99,	68,	'Chinese',	'zh-CN',	'zh'),
(100,	36,	'Egypt',	'ar-AE',	''),
(101,	36,	'Egypt',	'ar-IQ',	''),
(102,	41,	'Bosnian',	'bs-Latn-BA',	''),
(103,	6,	'Deutsch',	'de-at',	''),
(104,	6,	'Deutsch',	'de-ch',	''),
(105,	6,	'Deutsch',	'de-GB',	''),
(106,	6,	'Deutsch',	'de-LI',	''),
(107,	6,	'Deutsch',	'de-LU',	''),
(108,	7,	'United Kingdom',	'en-029',	''),
(109,	7,	'United Kingdom',	'en-AS',	''),
(110,	7,	'United Kingdom',	'en-BE',	''),
(111,	7,	'United Kingdom',	'en-BM',	''),
(112,	7,	'United Kingdom',	'en-BS',	''),
(113,	7,	'United Kingdom',	'en-BW',	''),
(114,	7,	'United Kingdom',	'en-CH',	''),
(115,	7,	'United Kingdom',	'en-CX',	''),
(116,	7,	'United Kingdom',	'en-CY',	''),
(117,	7,	'United Kingdom',	'en-DE',	''),
(118,	7,	'United Kingdom',	'en-DK',	''),
(119,	7,	'United Kingdom',	'en-DM',	''),
(120,	7,	'United Kingdom',	'en-GY',	''),
(121,	7,	'United Kingdom',	'en-HK',	''),
(122,	7,	'United Kingdom',	'en-ie',	''),
(123,	7,	'United Kingdom',	'en-IM',	''),
(124,	7,	'United Kingdom',	'en-JM',	''),
(125,	7,	'United Kingdom',	'en-KY',	''),
(126,	7,	'United Kingdom',	'en-MY',	''),
(127,	7,	'United Kingdom',	'en-NF',	''),
(128,	7,	'United Kingdom',	'en-NG',	''),
(129,	7,	'United Kingdom',	'en-NL',	''),
(130,	7,	'United Kingdom',	'en-PH',	''),
(131,	7,	'United Kingdom',	'en-SE',	''),
(132,	7,	'United Kingdom',	'en-sg',	''),
(133,	7,	'United Kingdom',	'en-SI',	''),
(134,	7,	'United Kingdom',	'en-SS',	''),
(135,	7,	'United Kingdom',	'en-TO',	''),
(136,	7,	'United Kingdom',	'en-TZ',	''),
(137,	7,	'United Kingdom',	'en-UG',	''),
(138,	7,	'United Kingdom',	'en-UK',	''),
(139,	7,	'United Kingdom',	'en-ZG',	''),
(140,	7,	'United Kingdom',	'en-ZM',	''),
(141,	7,	'United Kingdom',	'en-ZW',	''),
(142,	8,	'España',	'es-419',	''),
(143,	8,	'España',	'es-xl',	''),
(144,	47,	'Filipino',	'fil-PH',	''),
(145,	10,	'Français',	'fr-BE',	''),
(146,	10,	'Français',	'fr-ca',	''),
(147,	10,	'Français',	'fr-ch',	''),
(148,	10,	'Français',	'fr-CM',	''),
(149,	10,	'Français',	'fr-MC',	''),
(150,	49,	'Hebrew',	'he-IL',	''),
(151,	50,	'Croatian',	'hr-BA',	''),
(152,	17,	'Nederlands',	'nl-BE',	''),
(153,	19,	'Polski',	'pl-GB',	''),
(154,	27,	'Pусский',	'ru-KZ',	''),
(155,	27,	'Pусский',	'ru-UA',	''),
(156,	28,	'Serbian',	'sr-BA',	''),
(157,	28,	'Serbian',	'sr-Latn-RS',	''),
(158,	68,	'Chinese',	'zh-MO',	''),
(159,	68,	'Chinese',	'zh-SG',	''),
(160,	68,	'Chinese',	'zh-TW',	'');

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('front_tabs', 'dashboard,online_users,online_map', '0', 'Home page tabs order', '0');

ALTER TABLE `lh_chat_online_user`
ADD `notes` varchar(250) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_abstract_email_template`
ADD `user_mail_as_sender` tinyint(4) NOT NULL,
COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('translation_data',	'a:6:{i:0;b:0;s:19:\"translation_handler\";s:4:\"bing\";s:19:\"enable_translations\";b:0;s:14:\"bing_client_id\";s:0:\"\";s:18:\"bing_client_secret\";s:0:\"\";s:14:\"google_api_key\";s:0:\"\";}',	0,	'Translation data',	1);


ALTER TABLE `lh_group`
ADD `disabled` tinyint(1) NOT NULL,
COMMENT='';

ALTER TABLE `lh_group`
ADD INDEX `disabled` (`disabled`);

ALTER TABLE `lh_users`
ADD `rec_per_req` tinyint(1) NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD INDEX `rec_per_req` (`rec_per_req`);

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`, `user_mail_as_sender`) VALUES
(10,	'Permission request',	'Live Helper Chat',	0,	'',	0,	'Hello,\r\n\r\nOperator {user} has requested these permissions\n\r\n{permissions}\r\n\r\nSincerely,\r\nLive Support Team',	'Permission request from {user}',	0,	'',	0,	'',	'',	0);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('sharing_nodejs_path','',0,'socket.io path, optional',0);

ALTER TABLE `lh_cobrowse`
ADD `online_user_id` int(11) NOT NULL AFTER `chat_id`,
COMMENT='';

ALTER TABLE `lh_cobrowse`
ADD INDEX `online_user_id` (`online_user_id`);

ALTER TABLE `lh_chat_online_user`
CHANGE `operation` `operation` text COLLATE 'utf8mb4_unicode_ci' NOT NULL AFTER `reopen_chat`,
COMMENT='';

ALTER TABLE `lh_chat_online_user`
ADD `online_attr_system` text COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_chat_online_user`
ADD `operation_chat` text COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_chat_file`
ADD `online_user_id` int(11) NOT NULL,
COMMENT='';

ALTER TABLE `lh_chat_file`
ADD INDEX `online_user_id` (`online_user_id`);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES
('autologin_data',	'a:3:{i:0;b:0;s:11:\"secret_hash\";s:16:\"please_change_me\";s:7:\"enabled\";i:0;}',	0,	'Autologin configuration data',	1);

ALTER TABLE `lh_departament`
ADD `attr_int_1` int(11) NOT NULL DEFAULT '0',
ADD `attr_int_2` int(11) NOT NULL DEFAULT '0' AFTER `attr_int_1`,
ADD `attr_int_3` int(11) NOT NULL DEFAULT '0' AFTER `attr_int_2`,
COMMENT='';

ALTER TABLE `lh_departament`
ADD INDEX `attr_int_1` (`attr_int_1`),
ADD INDEX `attr_int_2` (`attr_int_2`),
ADD INDEX `attr_int_3` (`attr_int_3`);

ALTER TABLE `lh_users` ADD `session_id` varchar(40) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
COMMENT='';

ALTER TABLE `lh_users`
ADD `active_chats_counter` int NOT NULL,
ADD `closed_chats_counter` int NOT NULL AFTER `active_chats_counter`,
ADD `pending_chats_counter` int NOT NULL AFTER `closed_chats_counter`,
COMMENT='';

ALTER TABLE `lh_users`
ADD `departments_ids` varchar(100) NOT NULL,
COMMENT='';

ALTER TABLE `lh_departament`
ADD `active_chats_counter` int(11) NOT NULL,
ADD `pending_chats_counter` int(11) NOT NULL AFTER `active_chats_counter`,
ADD `closed_chats_counter` int(11) NOT NULL AFTER `pending_chats_counter`,
COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('dashboard_order', '[["online_operators","departments_stats","online_visitors"],["my_chats","pending_chats","transfered_chats"],["active_chats","bot_chats"]]', '0', 'Home page dashboard widgets order', '0');
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('hide_right_column_frontpage', '1', '0', 'Hide right column in frontpage', '0');

CREATE TABLE `lh_abstract_survey_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ftime` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `max_stars_1` int(11) NOT NULL,
  `max_stars_2` int(11) NOT NULL,
  `max_stars_3` int(11) NOT NULL,
  `max_stars_4` int(11) NOT NULL,
  `max_stars_5` int(11) NOT NULL,
  `question_options_1` int(11) NOT NULL,
  `question_options_2` int(11) NOT NULL,
  `question_options_3` int(11) NOT NULL,
  `question_options_4` int(11) NOT NULL,
  `question_options_5` int(11) NOT NULL,
  `question_plain_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_5` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `survey_id` (`survey_id`),
  KEY `chat_id` (`chat_id`),
  KEY `user_id` (`user_id`),
  KEY `dep_id` (`dep_id`),
  KEY `ftime` (`ftime`),
  KEY `max_stars_1` (`max_stars_1`),
  KEY `max_stars_2` (`max_stars_2`),
  KEY `max_stars_3` (`max_stars_3`),
  KEY `max_stars_4` (`max_stars_4`),
  KEY `max_stars_5` (`max_stars_5`),
  KEY `question_options_1` (`question_options_1`),
  KEY `question_options_2` (`question_options_2`),
  KEY `question_options_3` (`question_options_3`),
  KEY `question_options_4` (`question_options_4`),
  KEY `question_options_5` (`question_options_5`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_abstract_survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_stars_1` int(11) NOT NULL,
  `max_stars_1_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_stars_1_pos` int(11) NOT NULL,
  `max_stars_1_req` int(11) NOT NULL,
  `max_stars_1_enabled` int(11) NOT NULL,
  `max_stars_2_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_stars_2_pos` int(11) NOT NULL,
  `max_stars_2` int(11) NOT NULL,
  `max_stars_2_enabled` int(11) NOT NULL,
  `max_stars_2_req` int(11) NOT NULL,
  `max_stars_3_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_stars_3_pos` int(11) NOT NULL,
  `max_stars_3` int(11) NOT NULL,
  `max_stars_3_enabled` int(11) NOT NULL,
  `max_stars_3_req` int(11) NOT NULL,
  `max_stars_4_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_stars_4_pos` int(11) NOT NULL,
  `max_stars_4_req` int(11) NOT NULL,
  `max_stars_4` int(11) NOT NULL,
  `max_stars_4_enabled` int(11) NOT NULL,
  `max_stars_5_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_stars_5_pos` int(11) NOT NULL,
  `max_stars_5_req` int(11) NOT NULL,
  `max_stars_5` int(11) NOT NULL,
  `max_stars_5_enabled` int(11) NOT NULL,
  `question_options_1` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_1_items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_1_pos` int(11) NOT NULL,
  `question_options_1_req` int(11) NOT NULL,
  `question_options_1_enabled` int(11) NOT NULL,
  `question_options_2` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_2_items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_2_pos` int(11) NOT NULL,
  `question_options_2_req` int(11) NOT NULL,
  `question_options_2_enabled` int(11) NOT NULL,
  `question_options_3` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_3_items` text CHARACTER SET utf8 NOT NULL,
  `question_options_3_pos` int(11) NOT NULL,
  `question_options_3_req` int(11) NOT NULL,
  `question_options_3_enabled` int(11) NOT NULL,
  `question_options_4` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_4_enabled` int(11) NOT NULL,
  `question_options_4_req` int(11) NOT NULL,
  `question_options_4_items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_4_pos` int(11) NOT NULL,
  `question_options_5` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_5_items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_options_5_pos` int(11) NOT NULL,
  `question_options_5_req` int(11) NOT NULL,
  `question_options_5_enabled` int(11) NOT NULL,
  `question_plain_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_1_pos` int(11) NOT NULL,
  `question_plain_1_enabled` int(11) NOT NULL,
  `question_plain_1_req` int(11) NOT NULL,
  `question_plain_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_2_pos` int(11) NOT NULL,
  `question_plain_2_enabled` int(11) NOT NULL,
  `question_plain_2_req` int(11) NOT NULL,
  `question_plain_3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_3_pos` int(11) NOT NULL,
  `question_plain_3_req` int(11) NOT NULL,
  `question_plain_3_enabled` int(11) NOT NULL,
  `question_plain_4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_4_pos` int(11) NOT NULL,
  `question_plain_4_enabled` int(11) NOT NULL,
  `question_plain_4_req` int(11) NOT NULL,
  `question_plain_5` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_plain_5_pos` int(11) NOT NULL,
  `question_plain_5_enabled` int(11) NOT NULL,
  `question_plain_5_req` int(11) NOT NULL,
  `feedback_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('online_if','0','0','','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('track_mouse_activity','0','0','Should mouse movement be tracked as activity measure, if not checked only basic events would be tracked','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('track_activity','0','0','Track users activity on site?','0');

ALTER TABLE `lh_chat_online_user` ADD `user_active` int(11) NOT NULL, COMMENT='';

INSERT INTO `lh_users_setting_option` (`identifier`, `class`, `attribute`) VALUES ('dwo',	'',	'');


ALTER TABLE `lh_departament` ADD `visible_if_online` tinyint(1) NOT NULL, COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('hide_button_dropdown','0','0','Hide close button in dropdown','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('on_close_exit_chat','0','0','On chat close exit chat','0');
ALTER TABLE `lh_departament` ADD `sort_priority` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_departament` ADD INDEX `sort_priority_name` (`sort_priority`,`name`);


ALTER TABLE `lh_users` ADD `attr_int_1` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_users` ADD `attr_int_2` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_users` ADD `attr_int_3` int(11) NOT NULL, COMMENT='';

CREATE TABLE `lh_abstract_product` (`id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(250) NOT NULL, `disabled` int(11) NOT NULL, `priority` int(11) NOT NULL, `departament_id` int(11) NOT NULL, KEY `departament_id` (`departament_id`), PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('product_enabled_module','0','0','Product module is enabled','1');

ALTER TABLE `lh_users` CHANGE `password` `password` varchar(200) NOT NULL;
CREATE TABLE `lh_chat_paid` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `hash` varchar(250) NOT NULL, `chat_id` int(11) NOT NULL,  PRIMARY KEY (`id`),  KEY `hash` (`hash`(191)), KEY `chat_id` (`chat_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('paidchat_data','','0','Paid chat configuration','1');

ALTER TABLE `lh_users` ADD `chat_nickname` varchar(100) NOT NULL, COMMENT='';


CREATE TABLE `lh_abstract_rest_api_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `api_key` (`api_key`),
  KEY `user_id` (`user_id`)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_admin_theme` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `name` varchar(100) NOT NULL,
       `static_content` longtext NOT NULL,
       `static_js_content` longtext NOT NULL,
       `static_css_content` longtext NOT NULL,
       `header_content` text NOT NULL,
       `header_css` text NOT NULL,
       PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('default_admin_theme_id',	'0',	0,	'Default admin theme',	1);

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('disable_iframe_sharing',	'1',	0,	'Disable iframes in sharing mode',	0);
ALTER TABLE `lh_users` ADD `operation_admin` text NOT NULL, COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('inform_unread_message',	'0',	0,	'Inform visitor about unread messages from operator, value in minutes. 0 - disabled',	0);

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`, `user_mail_as_sender`) VALUES (11,	'You have unread messages',	'Live Helper Chat',	0,	'',	0,	'Hello,\r\n\r\nOperator {operator} has answered to you\r\n\r\n{messages}\r\n\r\nSincerely,\r\nLive Support Team',	'Operator has answered to your request',	0,	'',	0,	'',	'',	0);

ALTER TABLE `lh_departament` DROP `mod`,COMMENT='';
ALTER TABLE `lh_departament` DROP `tud`,COMMENT='';
ALTER TABLE `lh_departament` DROP `wed`,COMMENT='';
ALTER TABLE `lh_departament` DROP `thd`,COMMENT='';
ALTER TABLE `lh_departament` DROP `frd`,COMMENT='';
ALTER TABLE `lh_departament` DROP `sad`,COMMENT='';
ALTER TABLE `lh_departament` DROP `sud`,COMMENT='';
ALTER TABLE `lh_departament` DROP `start_hour`,COMMENT='';
ALTER TABLE `lh_departament` DROP `end_hour`,COMMENT='';
ALTER TABLE `lh_departament` ADD `mod_start_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `mod_end_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `tud_start_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `tud_end_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `wed_start_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `wed_end_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `thd_start_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `thd_end_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `frd_start_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `frd_end_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `sad_start_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `sad_end_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `sud_start_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD `sud_end_hour` int(4) NOT NULL DEFAULT '-1', COMMENT='';
ALTER TABLE `lh_departament` ADD INDEX `active_mod` (`online_hours_active`,`mod_start_hour`,`mod_end_hour`);
ALTER TABLE `lh_departament` ADD INDEX `active_tud` (`online_hours_active`,`tud_start_hour`,`tud_end_hour`);
ALTER TABLE `lh_departament` ADD INDEX `active_wed` (`online_hours_active`,`wed_start_hour`,`wed_end_hour`);
ALTER TABLE `lh_departament` ADD INDEX `active_thd` (`online_hours_active`,`thd_start_hour`,`thd_end_hour`);
ALTER TABLE `lh_departament` ADD INDEX `active_frd` (`online_hours_active`,`frd_start_hour`,`frd_end_hour`);
ALTER TABLE `lh_departament` ADD INDEX `active_sad` (`online_hours_active`,`sad_start_hour`,`sad_end_hour`);
ALTER TABLE `lh_departament` ADD INDEX `active_sud` (`online_hours_active`,`sud_start_hour`,`sud_end_hour`);
ALTER TABLE `lh_departament` DROP INDEX `oha_sh_eh`;
CREATE TABLE IF NOT EXISTS `lh_departament_custom_work_hours` (`id` int(11) NOT NULL AUTO_INCREMENT,`dep_id` int(11) NOT NULL,`date_from` int(11) NOT NULL,`date_to` int(11) NOT NULL,`start_hour` int(11) NOT NULL,`end_hour` int(11) NOT NULL,PRIMARY KEY (`id`),KEY `dep_id` (`dep_id`),KEY `date_from` (`date_from`),KEY `search_active` (`date_from`, `date_to`, `dep_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_departament_group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_group_id` (`dep_group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_departament_group_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_id` int(11) NOT NULL,
  `dep_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_group_id` (`dep_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_departament_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_departament` ADD `inform_close_all` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_departament` ADD `inform_close_all_email` varchar(250) NOT NULL, COMMENT='';
INSERT INTO `lh_chat_config` (`identifier`, `value`, `type`, `explain`, `hidden`) VALUES ('product_show_departament',	'0',	0,	'Enable products show by departments',	1);
ALTER TABLE `lh_departament` ADD `product_configuration` varchar(250) NOT NULL, COMMENT='';

CREATE TABLE `lh_abstract_product_departament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `departament_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departament_id` (`departament_id`)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(40) NOT NULL,
  `device_type` int(11) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) NOT NULL,
  `expires_on` int(11) NOT NULL,
  `notifications_status` int(11) NOT NULL DEFAULT '1',
  `is_background` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `device_token_device_type_v2` (`device_token`(191),`device_type`),
  KEY `token` (`token`)
)  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_canned_msg_tag_link` ( `id` int(11) NOT NULL AUTO_INCREMENT, `tag_id` int(11) NOT NULL, `canned_id` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `canned_id` (`canned_id`), KEY `tag_id` (`tag_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_canned_msg_tag` ( `id` int(11) NOT NULL AUTO_INCREMENT, `tag` varchar(40) NOT NULL, `cnt` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `tag` (`tag`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('activity_timeout','5','0','How long operator should go offline automatically because of inactivity. Value in minutes','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('activity_track_all','0','0','Track all logged operators activity and ignore their individual settings.','0');
ALTER TABLE `lh_users` ADD `inactive_mode` tinyint(1) NOT NULL, COMMENT='';

CREATE TABLE `lh_group_work` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `group_id` int(11) NOT NULL, `group_work_id` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `group_id` (`group_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_abstract_proactive_chat_variables` ( `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(50) NOT NULL, `identifier` varchar(50) NOT NULL, `store_timeout` int(11) NOT NULL, `filter_val` int(11) NOT NULL DEFAULT '0', PRIMARY KEY (`id`), KEY `identifier` (`identifier`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_abstract_proactive_chat_event` ( `id` int(11) NOT NULL AUTO_INCREMENT, `vid_id` int(11) NOT NULL, `ev_id` int(11) NOT NULL, `ts` int(11) NOT NULL, `val` varchar(50) NOT NULL, PRIMARY KEY (`id`), KEY `vid_id_ev_id_val_ts` (`vid_id`,`ev_id`,`val`,`ts`), KEY `vid_id_ev_id_ts` (`vid_id`,`ev_id`,`ts`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_abstract_proactive_chat_invitation_event` ( `id` int(11) NOT NULL AUTO_INCREMENT, `invitation_id` int(11) NOT NULL, `event_id` int(11) NOT NULL, `min_number` int(11) NOT NULL, `during_seconds` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `invitation_id` (`invitation_id`), KEY `event_id` (`event_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_departament` ADD `pending_max` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_departament` ADD `pending_group_max` int(11) NOT NULL, COMMENT='';

CREATE TABLE `lh_departament_limit_group_member` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `dep_id` int(11) NOT NULL,
   `dep_limit_group_id` int(11) NOT NULL,
   PRIMARY KEY (`id`),
   KEY `dep_limit_group_id` (`dep_limit_group_id`))
DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_departament_limit_group` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `name` varchar(50) NOT NULL,
   `pending_max` int(11) NOT NULL,
   PRIMARY KEY (`id`))
DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_abstract_auto_responder_chat` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `chat_id` int(11) NOT NULL,
                  `auto_responder_id` int(11) NOT NULL,
                  `wait_timeout_send` int(11) NOT NULL,
                  `pending_send_status` int(11) NOT NULL,
                  `active_send_status` int(11) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `chat_id` (`chat_id`)
                ) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_users_online_session` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `user_id` int(11) NOT NULL, `duration` int(11) NOT NULL, `time` int(11) NOT NULL, `lactivity` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `user_id_lactivity` (`user_id`, `lactivity`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `lh_chat_start_settings` ( `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(50) NOT NULL, `data` longtext NOT NULL, `department_id` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `department_id` (`department_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_departament` ADD INDEX `active_chats_counter` (`active_chats_counter`);
ALTER TABLE `lh_departament` ADD INDEX `pending_chats_counter` (`pending_chats_counter`);
ALTER TABLE `lh_departament` ADD INDEX `closed_chats_counter` (`closed_chats_counter`);

ALTER TABLE `lh_transfer` ADD `ctime` int(11) NOT NULL, COMMENT='';
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('transfer_configuration','0','0','Transfer configuration','1');

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('assign_workflow_timeout','0','0','Chats waiting in pending queue more than n seconds should be auto-assigned first. Time in seconds','0');

ALTER TABLE `lh_rolefunction` ADD `limitation` text NOT NULL, COMMENT='';

ALTER TABLE `lh_users` ADD `auto_accept` tinyint(1) NOT NULL, COMMENT='';
ALTER TABLE `lh_users` ADD `max_active_chats` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_users` ADD `exclude_autoasign` tinyint(1) NOT NULL, COMMENT='';


ALTER TABLE `lh_departament` ADD `exclude_inactive_chats` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_departament` ADD `max_ac_dep_chats` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_departament` ADD `delay_before_assign` int(11) NOT NULL, COMMENT='';


INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('tracked_footprint_cleanup','90','0','How many days keep records of users footprint.','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('cleanup_cronjob','0','0','Cleanup should should be done only using cronjob.','0');



CREATE TABLE `lh_abstract_subject` ( `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_abstract_subject_dep` ( `id` int(11) NOT NULL AUTO_INCREMENT, `dep_id` int(11) NOT NULL, `subject_id` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `subject_id` (`subject_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_abstract_subject_chat` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `subject_id` int(11) NOT NULL, `chat_id` bigint(20) NOT NULL, PRIMARY KEY (`id`), KEY `chat_id` (`chat_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('cduration_timeout_user','4','0','How long operator can wait for message from visitor before time between messages are ignored. Values in minutes.','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('cduration_timeout_operator','10','0','How long visitor can wait for message from operator before time between messages are ignored. Values in minutes.','0');
ALTER TABLE `lh_chat_file` ADD `persistent` int(11) NOT NULL, COMMENT='';
CREATE TABLE `lh_group_object` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `object_id` bigint(20) NOT NULL, `group_id` bigint(20) NOT NULL, `type` bigint(20) NOT NULL, PRIMARY KEY (`id`), KEY `object_id_type` (`object_id`,`type`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_group` ADD `required` tinyint(1) NOT NULL DEFAULT '0', COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('do_no_track_ip','0','0','Do not track visitors IP','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('encrypt_msg_after','0','0','After how many days anonymize messages','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('encrypt_msg_op','0','0','Anonymize also operators messages','0');


ALTER TABLE `lh_departament` ADD `bot_configuration` text NOT NULL, COMMENT='';

CREATE TABLE `lh_departament_availability` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `dep_id` int(11) NOT NULL, `hour` int(11) NOT NULL, `hourminute` int(4) NOT NULL, `minute` int(11) NOT NULL, `time` int(11) NOT NULL, `ymdhi` bigint(20) NOT NULL, `ymd` int(11) NOT NULL, `status` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `ymdhi` (`ymdhi`), KEY `dep_id` (`dep_id`),  KEY `hourminute` (`hourminute`), KEY `time` (`time`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_generic_bot_bot` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL,`attr_str_1` varchar(100) NOT NULL,`attr_str_2` varchar(100) NOT NULL,`attr_str_3` varchar(100) NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_group` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL, `bot_id` bigint(20) NOT NULL, PRIMARY KEY (`id`), KEY `bot_id` (`bot_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_trigger` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL, `default_always` int(11), `actions` longtext NOT NULL, `group_id` bigint(20) NOT NULL, `bot_id` int(11) NOT NULL, `default` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `bot_id` (`bot_id`) ,KEY `group_id` (`group_id`), KEY `default_always` (`default_always`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_trigger_event` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `pattern` varchar(250) NOT NULL,`pattern_exc` varchar(250) NOT NULL, `trigger_id` bigint(20) NOT NULL, `bot_id` int(11) NOT NULL, `type` int(11) NOT NULL,`configuration` text NOT NULL, PRIMARY KEY (`id`), KEY `pattern_v2` (`pattern`(191)), KEY `type` (`type`), KEY `trigger_id` (`trigger_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_payload` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL, `payload` varchar(100) NOT NULL, `bot_id` int(11) NOT NULL, `trigger_id` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `bot_id` (`bot_id`), KEY `trigger_id` (`trigger_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_chat_workflow` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `chat_id` bigint(20) NOT NULL,`trigger_id` bigint(20) NOT NULL, `identifier` varchar(100) NOT NULL, `status` int(11) NOT NULL, `collected_data` text, PRIMARY KEY (`id`), KEY `chat_id` (`chat_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_generic_bot_chat_event` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `chat_id` bigint(20) NOT NULL, `content` longtext NOT NULL, `ctime` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `chat_id` (`chat_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `lh_generic_bot_trigger` ADD `default_unknown` int(11) NOT NULL, COMMENT='';

ALTER TABLE `lh_generic_bot_chat_workflow` ADD `time` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_bot` ADD `nick` varchar(100) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_trigger_event` CHANGE `pattern_exc` `pattern_exc` text NOT NULL, CHANGE `pattern` `pattern` text NOT NULL, CHANGE `configuration` `configuration` longtext NOT NULL;

CREATE TABLE `lh_notification_subscriber` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `chat_id` bigint(20) NOT NULL, `online_user_id` bigint(20) NOT NULL, `dep_id` int(11) NOT NULL, `theme_id` int(11) NOT NULL, `ctime` int(11) NOT NULL, `utime` int(11) NOT NULL, `status` int(11) NOT NULL, `params` text NOT NULL, `device_type` tinyint(1) NOT NULL,`subscriber_hash` varchar(50) NOT NULL, `uagent` varchar(250) NOT NULL, `ip` varchar(250) NOT NULL, `last_error` text NOT NULL, PRIMARY KEY (`id`), KEY `chat_id` (`chat_id`), KEY `dep_id` (`dep_id`), KEY `online_user_id` (`online_user_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('list_unread','0','0','List unread chats','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('list_closed','0','0','List closed chats','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('disable_live_autoassign','0','0','Disable live auto assign','0');

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('autoclose_timeout_pending','0','0','Automatic pending chats closing. 0 - disabled, n > 0 time in minutes before chat is automatically closed','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('autoclose_timeout_active','0','0','Automatic active chats closing. 0 - disabled, n > 0 time in minutes before chat is automatically closed','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('autoclose_timeout_bot','0','0','Automatic bot chats closing. 0 - disabled, n > 0 time in minutes before chat is automatically closed','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('open_closed_chat_timeout','1800','0','How many seconds customer has to open already closed chat.','0');

CREATE TABLE `lh_speech_user_language` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `user_id` bigint(20) NOT NULL, `language` varchar(20) NOT NULL, PRIMARY KEY (`id`), KEY `user_id_language` (`user_id`,`language`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `lh_departament` ADD `assign_same_language` int(11) NOT NULL, COMMENT='';

ALTER TABLE `lh_chat` ADD `invitation_id` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_abstract_proactive_chat_invitation` ADD `disabled` int(11) NOT NULL, COMMENT='';

CREATE TABLE `lh_abstract_proactive_chat_campaign` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `name` varchar(50) NOT NULL, `text` text NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_abstract_proactive_chat_campaign_conv` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `device_type` tinyint(11) NOT NULL,
  `invitation_type` tinyint(1) NOT NULL,
  `invitation_status` tinyint(1) NOT NULL,
  `chat_id` bigint(20) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `invitation_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `con_time` int(11) NOT NULL,
  `vid_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_id` (`campaign_id`),
  KEY `invitation_id` (`invitation_id`),
  KEY `ctime` (`ctime`),
  KEY `invitation_status` (`invitation_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_chat_online_user` ADD `conversion_id` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_abstract_proactive_chat_invitation` ADD `campaign_id` int(11) NOT NULL, COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('departament_availability','364','0','How long department availability statistic should be kept? (days)','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('uonline_sessions','364','0','How long keep operators online sessions data? (days)','0');

INSERT INTO `lh_users_setting_option` (`identifier`,`class`,`attribute`) VALUES ('ocountry','','');
INSERT INTO `lh_users_setting_option` (`identifier`,`class`,`attribute`) VALUES ('otime_on_site','','');

ALTER TABLE `lh_abstract_proactive_chat_invitation` ADD `design_data` longtext NOT NULL, COMMENT='';
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('reverse_pending','0','0','Make default pending chats order from old to new','0');
ALTER TABLE `lh_abstract_widget_theme` ADD `pending_join_queue` varchar(250) NOT NULL, COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('recaptcha_data','a:4:{i:0;b:0;s:8:"site_key";s:0:"";s:10:"secret_key";s:0:"";s:7:"enabled";i:0;}','0','Re-captcha configuration','1');

ALTER TABLE `lh_admin_theme` ADD `css_attributes` longtext NOT NULL, COMMENT='';
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('mheight_op','200','0','Messages box height for operator','0');
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('listd_op','10','0','Default number of online operators to show','0');

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('password_data','','0','Password requirements','1');
ALTER TABLE `lh_users` ADD `pswd_updated` int(11) NOT NULL, COMMENT='';

CREATE TABLE `lh_abstract_rest_api_key_remote` ( `id` int(11) NOT NULL AUTO_INCREMENT, `api_key` varchar(50) NOT NULL, `username` varchar(50) NOT NULL, `name` varchar(50) NOT NULL, `host` varchar(250) NOT NULL, `active` tinyint(1) NOT NULL DEFAULT '0', `position` int(11) NOT NULL DEFAULT '0', PRIMARY KEY (`id`), KEY `active` (`active`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_abstract_chat_variable` ( `id` int(11) NOT NULL AUTO_INCREMENT, `var_name` varchar(255) NOT NULL, `var_identifier` varchar(255) NOT NULL, `type` tinyint(1) NOT NULL,`js_variable` varchar(255) NOT NULL, `dep_id` int(11) NOT NULL, `persistent` tinyint(1) NOT NULL, PRIMARY KEY (`id`), KEY `dep_id` (`dep_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_abstract_chat_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `conditions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enabled` (`enabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `lh_abstract_chat_priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dep_id` (`dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_generic_bot_chat_event` ADD `counter` int(11) NOT NULL, COMMENT='';

CREATE TABLE `lh_generic_bot_pending_event` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `chat_id` bigint(20) NOT NULL, `trigger_id` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `chat_id` (`chat_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_exception` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL, `priority` int(11) NOT NULL, `active` tinyint(1) NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_exception_message` ( `id` bigint(20) NOT NULL AUTO_INCREMENT, `code` varchar(20) NOT NULL, `exception_group_id` int(11) NOT NULL, `priority` int(11) NOT NULL, `active` tinyint(1) NOT NULL, `message` text NOT NULL, PRIMARY KEY (`id`), KEY `code` (`code`), KEY `exception_group_id` (`exception_group_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_generic_bot_bot` ADD `filepath` varchar(250) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_bot` ADD `filename` varchar(250) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_bot` ADD `configuration` longtext NOT NULL, COMMENT='';

CREATE TABLE `lh_audits` (`id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, `category` varchar(255) NOT NULL, `file` varchar(255), `object_id` bigint(20) DEFAULT '0', `line` bigint(20), `message` longtext NOT NULL, `severity` varchar(255) NOT NULL, `source` varchar(255) NOT NULL, `time` timestamp NOT NULL, KEY `object_id` (`object_id`), KEY `source` (`source`(191)), KEY `category` (`category`(191))) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_admin_theme` ADD `user_id` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_admin_theme` ADD INDEX `user_id` (`user_id`);

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('no_wildcard_cookie','0','0','Cookie should be valid only for domain where Javascript is embedded (excludes subdomains)','0');

ALTER TABLE `lh_abstract_chat_column` ADD `chat_enabled` tinyint(1) NOT NULL, COMMENT='';
ALTER TABLE `lh_abstract_chat_column` ADD `online_enabled` tinyint(1) NOT NULL, COMMENT='';
ALTER TABLE `lh_abstract_chat_column` ADD INDEX `online_enabled` (`online_enabled`);
ALTER TABLE `lh_abstract_chat_column` ADD INDEX `chat_enabled` (`chat_enabled`);

CREATE TABLE `lh_generic_bot_tr_group` ( `id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(50) NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `lh_generic_bot_tr_item` ( `id` int(11) NOT NULL AUTO_INCREMENT, `group_id` int(11) NOT NULL, `identifier` varchar(50) NOT NULL, `translation` text NOT NULL, PRIMARY KEY (`id`), KEY `identifier` (`identifier`), KEY `group_id` (`group_id`)) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_generic_bot_tr_group` ADD `nick` varchar(100) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_tr_group` ADD `configuration` longtext NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_tr_group` ADD `filepath` varchar(250) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_tr_group` ADD `filename` varchar(250) NOT NULL, COMMENT='';

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('footprint_background','0','0','Footprint updates should be processed in the background. Make sure you are running workflow background cronjob.','0');

CREATE TABLE `lh_chat_online_user_footprint_update` (
  `online_user_id` bigint(20) NOT NULL,
  `command` varchar(20) NOT NULL,
  `args` varchar(250) NOT NULL,
  `ctime` int(11) NOT NULL,
  KEY `online_user_id` (`online_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lh_generic_bot_trigger_event` ADD `on_start_type` tinyint(1) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_trigger_event` ADD `priority` int(11) NOT NULL, COMMENT='';
ALTER TABLE `lh_generic_bot_trigger_event` ADD INDEX `on_start_type` (`on_start_type`);
INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('preload_iframes','0','0','Preload widget. It will avoid loading delay after clicking widget','0');

CREATE TABLE `lh_generic_bot_repeat_restrict` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) NOT NULL,
  `trigger_id` bigint(20) DEFAULT NULL,
  `identifier` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `chat_id_trigger_id` (`chat_id`,`trigger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `lh_abstract_widget_theme` ADD `modified` int(11) NOT NULL, COMMENT='';

INSERT INTO `lh_abstract_email_template` (`id`, `name`, `from_name`, `from_name_ac`, `from_email`, `from_email_ac`, `content`, `subject`, `subject_ac`, `reply_to`, `reply_to_ac`, `recipient`, `bcc_recipients`, `user_mail_as_sender`) VALUES
(12,	'Visitor returned',	'Live Helper Chat',	0,	'',	0,	'Hello,\r\n\r\nVisitor information\r\nName: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\nDepartment: {department}\r\nCountry: {country}\r\nCity: {city}\r\nIP: {ip}\r\nCreated:	{created}\r\nUser left:	{user_left}\r\nWaited:	{waited}\r\nChat duration:	{chat_duration}\r\n\r\nSee more information at\r\n{url_accept}\r\n\r\nLast chat:\r\n{message}\r\n\r\nAdditional data, if any:\r\n{additional_data}\r\n\r\nSincerely,\r\nLive Support Team',	'Visitor returned - {username}',	0,	'',	0,	'',	'',	0);

CREATE TABLE `lh_generic_bot_rest_api` (`id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(20) NOT NULL, `description` varchar(250), `configuration` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `lh_generic_bot_trigger` ADD `default_unknown_btn` int(11) NOT NULL DEFAULT '0', COMMENT='';
ALTER TABLE `lh_generic_bot_trigger` ADD INDEX `default_unknown_btn` (`default_unknown_btn`);

INSERT INTO `lh_chat_config` (`identifier`,`value`,`type`,`explain`,`hidden`) VALUES ('valid_domains','','0','Domains where script can be embedded. E.g example.com, google.com','0');
ALTER TABLE `lhc_instance_client`
ADD `files_supported` int NOT NULL DEFAULT '1',
ADD `atranslations_supported` int NOT NULL DEFAULT '1' AFTER `files_supported`,
ADD `cobrowse_supported` int NOT NULL DEFAULT '1' AFTER `atranslations_supported`,
ADD `feature_1_supported` int NOT NULL AFTER `cobrowse_supported`,
ADD `feature_2_supported` int NOT NULL AFTER `feature_1_supported`,
ADD `feature_3_supported` int NOT NULL AFTER `feature_2_supported`,
COMMENT='';
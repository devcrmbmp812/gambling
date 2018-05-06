SELECT 'DATABASE OPERATIONS' AS 'OPERATION';
DROP DATABASE IF EXISTS `dbGamble`;
CREATE DATABASE IF NOT EXISTS `dbGamble`;

USE `dbGamble`;

SELECT 'TABLE OPERATIONS' AS 'OPERATION';

SELECT 'CREATE `tblCountries`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblCountries`;
CREATE TABLE IF NOT EXISTS `tblCountries`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`countryCode2` VARCHAR(2) NOT NULL DEFAULT '',
	`countryName` VARCHAR(100) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`),
	UNIQUE KEY `IDX_tblCountries_countryCode` (`countryCode2`),
	UNIQUE KEY `IDX_tblCountries_countryName` (`countryName`)
);

INSERT INTO `tblCountries` VALUES (1, 'US', 'United States');
INSERT INTO `tblCountries` VALUES (2, 'CA', 'Canada');
INSERT INTO `tblCountries` VALUES (3, 'AF', 'Afghanistan');
INSERT INTO `tblCountries` VALUES (4, 'AL', 'Albania');
INSERT INTO `tblCountries` VALUES (5, 'DZ', 'Algeria');
INSERT INTO `tblCountries` VALUES (6, 'DS', 'American Samoa');
INSERT INTO `tblCountries` VALUES (7, 'AD', 'Andorra');
INSERT INTO `tblCountries` VALUES (8, 'AO', 'Angola');
INSERT INTO `tblCountries` VALUES (9, 'AI', 'Anguilla');
INSERT INTO `tblCountries` VALUES (10, 'AQ', 'Antarctica');
INSERT INTO `tblCountries` VALUES (11, 'AG', 'Antigua and/or Barbuda');
INSERT INTO `tblCountries` VALUES (12, 'AR', 'Argentina');
INSERT INTO `tblCountries` VALUES (13, 'AM', 'Armenia');
INSERT INTO `tblCountries` VALUES (14, 'AW', 'Aruba');
INSERT INTO `tblCountries` VALUES (15, 'AU', 'Australia');
INSERT INTO `tblCountries` VALUES (16, 'AT', 'Austria');
INSERT INTO `tblCountries` VALUES (17, 'AZ', 'Azerbaijan');
INSERT INTO `tblCountries` VALUES (18, 'BS', 'Bahamas');
INSERT INTO `tblCountries` VALUES (19, 'BH', 'Bahrain');
INSERT INTO `tblCountries` VALUES (20, 'BD', 'Bangladesh');
INSERT INTO `tblCountries` VALUES (21, 'BB', 'Barbados');
INSERT INTO `tblCountries` VALUES (22, 'BY', 'Belarus');
INSERT INTO `tblCountries` VALUES (23, 'BE', 'Belgium');
INSERT INTO `tblCountries` VALUES (24, 'BZ', 'Belize');
INSERT INTO `tblCountries` VALUES (25, 'BJ', 'Benin');
INSERT INTO `tblCountries` VALUES (26, 'BM', 'Bermuda');
INSERT INTO `tblCountries` VALUES (27, 'BT', 'Bhutan');
INSERT INTO `tblCountries` VALUES (28, 'BO', 'Bolivia');
INSERT INTO `tblCountries` VALUES (29, 'BA', 'Bosnia and Herzegovina');
INSERT INTO `tblCountries` VALUES (30, 'BW', 'Botswana');
INSERT INTO `tblCountries` VALUES (31, 'BV', 'Bouvet Island');
INSERT INTO `tblCountries` VALUES (32, 'BR', 'Brazil');
INSERT INTO `tblCountries` VALUES (33, 'IO', 'British lndian Ocean Territory');
INSERT INTO `tblCountries` VALUES (34, 'BN', 'Brunei Darussalam');
INSERT INTO `tblCountries` VALUES (35, 'BG', 'Bulgaria');
INSERT INTO `tblCountries` VALUES (36, 'BF', 'Burkina Faso');
INSERT INTO `tblCountries` VALUES (37, 'BI', 'Burundi');
INSERT INTO `tblCountries` VALUES (38, 'KH', 'Cambodia');
INSERT INTO `tblCountries` VALUES (39, 'CM', 'Cameroon');
INSERT INTO `tblCountries` VALUES (40, 'CV', 'Cape Verde');
INSERT INTO `tblCountries` VALUES (41, 'KY', 'Cayman Islands');
INSERT INTO `tblCountries` VALUES (42, 'CF', 'Central African Republic');
INSERT INTO `tblCountries` VALUES (43, 'TD', 'Chad');
INSERT INTO `tblCountries` VALUES (44, 'CL', 'Chile');
INSERT INTO `tblCountries` VALUES (45, 'CN', 'China');
INSERT INTO `tblCountries` VALUES (46, 'CX', 'Christmas Island');
INSERT INTO `tblCountries` VALUES (47, 'CC', 'Cocos (Keeling) Islands');
INSERT INTO `tblCountries` VALUES (48, 'CO', 'Colombia');
INSERT INTO `tblCountries` VALUES (49, 'KM', 'Comoros');
INSERT INTO `tblCountries` VALUES (50, 'CG', 'Congo');
INSERT INTO `tblCountries` VALUES (51, 'CK', 'Cook Islands');
INSERT INTO `tblCountries` VALUES (52, 'CR', 'Costa Rica');
INSERT INTO `tblCountries` VALUES (53, 'HR', 'Croatia (Hrvatska)');
INSERT INTO `tblCountries` VALUES (54, 'CU', 'Cuba');
INSERT INTO `tblCountries` VALUES (55, 'CY', 'Cyprus');
INSERT INTO `tblCountries` VALUES (56, 'CZ', 'Czech Republic');
INSERT INTO `tblCountries` VALUES (57, 'DK', 'Denmark');
INSERT INTO `tblCountries` VALUES (58, 'DJ', 'Djibouti');
INSERT INTO `tblCountries` VALUES (59, 'DM', 'Dominica');
INSERT INTO `tblCountries` VALUES (60, 'DO', 'Dominican Republic');
INSERT INTO `tblCountries` VALUES (61, 'TP', 'East Timor');
INSERT INTO `tblCountries` VALUES (62, 'EC', 'Ecuador');
INSERT INTO `tblCountries` VALUES (63, 'EG', 'Egypt');
INSERT INTO `tblCountries` VALUES (64, 'SV', 'El Salvador');
INSERT INTO `tblCountries` VALUES (65, 'GQ', 'Equatorial Guinea');
INSERT INTO `tblCountries` VALUES (66, 'ER', 'Eritrea');
INSERT INTO `tblCountries` VALUES (67, 'EE', 'Estonia');
INSERT INTO `tblCountries` VALUES (68, 'ET', 'Ethiopia');
INSERT INTO `tblCountries` VALUES (69, 'FK', 'Falkland Islands (Malvinas)');
INSERT INTO `tblCountries` VALUES (70, 'FO', 'Faroe Islands');
INSERT INTO `tblCountries` VALUES (71, 'FJ', 'Fiji');
INSERT INTO `tblCountries` VALUES (72, 'FI', 'Finland');
INSERT INTO `tblCountries` VALUES (73, 'FR', 'France');
INSERT INTO `tblCountries` VALUES (74, 'FX', 'France, Metropolitan');
INSERT INTO `tblCountries` VALUES (75, 'GF', 'French Guiana');
INSERT INTO `tblCountries` VALUES (76, 'PF', 'French Polynesia');
INSERT INTO `tblCountries` VALUES (77, 'TF', 'French Southern Territories');
INSERT INTO `tblCountries` VALUES (78, 'GA', 'Gabon');
INSERT INTO `tblCountries` VALUES (79, 'GM', 'Gambia');
INSERT INTO `tblCountries` VALUES (80, 'GE', 'Georgia');
INSERT INTO `tblCountries` VALUES (81, 'DE', 'Germany');
INSERT INTO `tblCountries` VALUES (82, 'GH', 'Ghana');
INSERT INTO `tblCountries` VALUES (83, 'GI', 'Gibraltar');
INSERT INTO `tblCountries` VALUES (84, 'GR', 'Greece');
INSERT INTO `tblCountries` VALUES (85, 'GL', 'Greenland');
INSERT INTO `tblCountries` VALUES (86, 'GD', 'Grenada');
INSERT INTO `tblCountries` VALUES (87, 'GP', 'Guadeloupe');
INSERT INTO `tblCountries` VALUES (88, 'GU', 'Guam');
INSERT INTO `tblCountries` VALUES (89, 'GT', 'Guatemala');
INSERT INTO `tblCountries` VALUES (90, 'GN', 'Guinea');
INSERT INTO `tblCountries` VALUES (91, 'GW', 'Guinea-Bissau');
INSERT INTO `tblCountries` VALUES (92, 'GY', 'Guyana');
INSERT INTO `tblCountries` VALUES (93, 'HT', 'Haiti');
INSERT INTO `tblCountries` VALUES (94, 'HM', 'Heard and Mc Donald Islands');
INSERT INTO `tblCountries` VALUES (95, 'HN', 'Honduras');
INSERT INTO `tblCountries` VALUES (96, 'HK', 'Hong Kong');
INSERT INTO `tblCountries` VALUES (97, 'HU', 'Hungary');
INSERT INTO `tblCountries` VALUES (98, 'IS', 'Iceland');
INSERT INTO `tblCountries` VALUES (99, 'IN', 'India');
INSERT INTO `tblCountries` VALUES (100, 'ID', 'Indonesia');
INSERT INTO `tblCountries` VALUES (101, 'IR', 'Iran (Islamic Republic of)');
INSERT INTO `tblCountries` VALUES (102, 'IQ', 'Iraq');
INSERT INTO `tblCountries` VALUES (103, 'IE', 'Ireland');
INSERT INTO `tblCountries` VALUES (104, 'IL', 'Israel');
INSERT INTO `tblCountries` VALUES (105, 'IT', 'Italy');
INSERT INTO `tblCountries` VALUES (106, 'CI', 'Ivory Coast');
INSERT INTO `tblCountries` VALUES (107, 'JM', 'Jamaica');
INSERT INTO `tblCountries` VALUES (108, 'JP', 'Japan');
INSERT INTO `tblCountries` VALUES (109, 'JO', 'Jordan');
INSERT INTO `tblCountries` VALUES (110, 'KZ', 'Kazakhstan');
INSERT INTO `tblCountries` VALUES (111, 'KE', 'Kenya');
INSERT INTO `tblCountries` VALUES (112, 'KI', 'Kiribati');
INSERT INTO `tblCountries` VALUES (113, 'KP', 'Korea, Democratic People''s Republic of');
INSERT INTO `tblCountries` VALUES (114, 'KR', 'Korea, Republic of');
INSERT INTO `tblCountries` VALUES (115, 'XK', 'Kosovo');
INSERT INTO `tblCountries` VALUES (116, 'KW', 'Kuwait');
INSERT INTO `tblCountries` VALUES (117, 'KG', 'Kyrgyzstan');
INSERT INTO `tblCountries` VALUES (118, 'LA', 'Lao People''s Democratic Republic');
INSERT INTO `tblCountries` VALUES (119, 'LV', 'Latvia');
INSERT INTO `tblCountries` VALUES (120, 'LB', 'Lebanon');
INSERT INTO `tblCountries` VALUES (121, 'LS', 'Lesotho');
INSERT INTO `tblCountries` VALUES (122, 'LR', 'Liberia');
INSERT INTO `tblCountries` VALUES (123, 'LY', 'Libyan Arab Jamahiriya');
INSERT INTO `tblCountries` VALUES (124, 'LI', 'Liechtenstein');
INSERT INTO `tblCountries` VALUES (125, 'LT', 'Lithuania');
INSERT INTO `tblCountries` VALUES (126, 'LU', 'Luxembourg');
INSERT INTO `tblCountries` VALUES (127, 'MO', 'Macau');
INSERT INTO `tblCountries` VALUES (128, 'MK', 'Macedonia');
INSERT INTO `tblCountries` VALUES (129, 'MG', 'Madagascar');
INSERT INTO `tblCountries` VALUES (130, 'MW', 'Malawi');
INSERT INTO `tblCountries` VALUES (131, 'MY', 'Malaysia');
INSERT INTO `tblCountries` VALUES (132, 'MV', 'Maldives');
INSERT INTO `tblCountries` VALUES (133, 'ML', 'Mali');
INSERT INTO `tblCountries` VALUES (134, 'MT', 'Malta');
INSERT INTO `tblCountries` VALUES (135, 'MH', 'Marshall Islands');
INSERT INTO `tblCountries` VALUES (136, 'MQ', 'Martinique');
INSERT INTO `tblCountries` VALUES (137, 'MR', 'Mauritania');
INSERT INTO `tblCountries` VALUES (138, 'MU', 'Mauritius');
INSERT INTO `tblCountries` VALUES (139, 'TY', 'Mayotte');
INSERT INTO `tblCountries` VALUES (140, 'MX', 'Mexico');
INSERT INTO `tblCountries` VALUES (141, 'FM', 'Micronesia, Federated States of');
INSERT INTO `tblCountries` VALUES (142, 'MD', 'Moldova, Republic of');
INSERT INTO `tblCountries` VALUES (143, 'MC', 'Monaco');
INSERT INTO `tblCountries` VALUES (144, 'MN', 'Mongolia');
INSERT INTO `tblCountries` VALUES (145, 'ME', 'Montenegro');
INSERT INTO `tblCountries` VALUES (146, 'MS', 'Montserrat');
INSERT INTO `tblCountries` VALUES (147, 'MA', 'Morocco');
INSERT INTO `tblCountries` VALUES (148, 'MZ', 'Mozambique');
INSERT INTO `tblCountries` VALUES (149, 'MM', 'Myanmar');
INSERT INTO `tblCountries` VALUES (150, 'NA', 'Namibia');
INSERT INTO `tblCountries` VALUES (151, 'NR', 'Nauru');
INSERT INTO `tblCountries` VALUES (152, 'NP', 'Nepal');
INSERT INTO `tblCountries` VALUES (153, 'NL', 'Netherlands');
INSERT INTO `tblCountries` VALUES (154, 'AN', 'Netherlands Antilles');
INSERT INTO `tblCountries` VALUES (155, 'NC', 'New Caledonia');
INSERT INTO `tblCountries` VALUES (156, 'NZ', 'New Zealand');
INSERT INTO `tblCountries` VALUES (157, 'NI', 'Nicaragua');
INSERT INTO `tblCountries` VALUES (158, 'NE', 'Niger');
INSERT INTO `tblCountries` VALUES (159, 'NG', 'Nigeria');
INSERT INTO `tblCountries` VALUES (160, 'NU', 'Niue');
INSERT INTO `tblCountries` VALUES (161, 'NF', 'Norfork Island');
INSERT INTO `tblCountries` VALUES (162, 'MP', 'Northern Mariana Islands');
INSERT INTO `tblCountries` VALUES (163, 'NO', 'Norway');
INSERT INTO `tblCountries` VALUES (164, 'OM', 'Oman');
INSERT INTO `tblCountries` VALUES (165, 'PK', 'Pakistan');
INSERT INTO `tblCountries` VALUES (166, 'PW', 'Palau');
INSERT INTO `tblCountries` VALUES (167, 'PA', 'Panama');
INSERT INTO `tblCountries` VALUES (168, 'PG', 'Papua New Guinea');
INSERT INTO `tblCountries` VALUES (169, 'PY', 'Paraguay');
INSERT INTO `tblCountries` VALUES (170, 'PE', 'Peru');
INSERT INTO `tblCountries` VALUES (171, 'PH', 'Philippines');
INSERT INTO `tblCountries` VALUES (172, 'PN', 'Pitcairn');
INSERT INTO `tblCountries` VALUES (173, 'PL', 'Poland');
INSERT INTO `tblCountries` VALUES (174, 'PT', 'Portugal');
INSERT INTO `tblCountries` VALUES (175, 'PR', 'Puerto Rico');
INSERT INTO `tblCountries` VALUES (176, 'QA', 'Qatar');
INSERT INTO `tblCountries` VALUES (177, 'RE', 'Reunion');
INSERT INTO `tblCountries` VALUES (178, 'RO', 'Romania');
INSERT INTO `tblCountries` VALUES (179, 'RU', 'Russian Federation');
INSERT INTO `tblCountries` VALUES (180, 'RW', 'Rwanda');
INSERT INTO `tblCountries` VALUES (181, 'KN', 'Saint Kitts and Nevis');
INSERT INTO `tblCountries` VALUES (182, 'LC', 'Saint Lucia');
INSERT INTO `tblCountries` VALUES (183, 'VC', 'Saint Vincent and the Grenadines');
INSERT INTO `tblCountries` VALUES (184, 'WS', 'Samoa');
INSERT INTO `tblCountries` VALUES (185, 'SM', 'San Marino');
INSERT INTO `tblCountries` VALUES (186, 'ST', 'Sao Tome and Principe');
INSERT INTO `tblCountries` VALUES (187, 'SA', 'Saudi Arabia');
INSERT INTO `tblCountries` VALUES (188, 'SN', 'Senegal');
INSERT INTO `tblCountries` VALUES (189, 'RS', 'Serbia');
INSERT INTO `tblCountries` VALUES (190, 'SC', 'Seychelles');
INSERT INTO `tblCountries` VALUES (191, 'SL', 'Sierra Leone');
INSERT INTO `tblCountries` VALUES (192, 'SG', 'Singapore');
INSERT INTO `tblCountries` VALUES (193, 'SK', 'Slovakia');
INSERT INTO `tblCountries` VALUES (194, 'SI', 'Slovenia');
INSERT INTO `tblCountries` VALUES (195, 'SB', 'Solomon Islands');
INSERT INTO `tblCountries` VALUES (196, 'SO', 'Somalia');
INSERT INTO `tblCountries` VALUES (197, 'ZA', 'South Africa');
INSERT INTO `tblCountries` VALUES (198, 'GS', 'South Georgia South Sandwich Islands');
INSERT INTO `tblCountries` VALUES (199, 'ES', 'Spain');
INSERT INTO `tblCountries` VALUES (200, 'LK', 'Sri Lanka');
INSERT INTO `tblCountries` VALUES (201, 'SH', 'St. Helena');
INSERT INTO `tblCountries` VALUES (202, 'PM', 'St. Pierre and Miquelon');
INSERT INTO `tblCountries` VALUES (203, 'SD', 'Sudan');
INSERT INTO `tblCountries` VALUES (204, 'SR', 'Suriname');
INSERT INTO `tblCountries` VALUES (205, 'SJ', 'Svalbarn and Jan Mayen Islands');
INSERT INTO `tblCountries` VALUES (206, 'SZ', 'Swaziland');
INSERT INTO `tblCountries` VALUES (207, 'SE', 'Sweden');
INSERT INTO `tblCountries` VALUES (208, 'CH', 'Switzerland');
INSERT INTO `tblCountries` VALUES (209, 'SY', 'Syrian Arab Republic');
INSERT INTO `tblCountries` VALUES (210, 'TW', 'Taiwan');
INSERT INTO `tblCountries` VALUES (211, 'TJ', 'Tajikistan');
INSERT INTO `tblCountries` VALUES (212, 'TZ', 'Tanzania, United Republic of');
INSERT INTO `tblCountries` VALUES (213, 'TH', 'Thailand');
INSERT INTO `tblCountries` VALUES (214, 'TG', 'Togo');
INSERT INTO `tblCountries` VALUES (215, 'TK', 'Tokelau');
INSERT INTO `tblCountries` VALUES (216, 'TO', 'Tonga');
INSERT INTO `tblCountries` VALUES (217, 'TT', 'Trinidad and Tobago');
INSERT INTO `tblCountries` VALUES (218, 'TN', 'Tunisia');
INSERT INTO `tblCountries` VALUES (219, 'TR', 'Turkey');
INSERT INTO `tblCountries` VALUES (220, 'TM', 'Turkmenistan');
INSERT INTO `tblCountries` VALUES (221, 'TC', 'Turks and Caicos Islands');
INSERT INTO `tblCountries` VALUES (222, 'TV', 'Tuvalu');
INSERT INTO `tblCountries` VALUES (223, 'UG', 'Uganda');
INSERT INTO `tblCountries` VALUES (224, 'UA', 'Ukraine');
INSERT INTO `tblCountries` VALUES (225, 'AE', 'United Arab Emirates');
INSERT INTO `tblCountries` VALUES (226, 'GB', 'United Kingdom');
INSERT INTO `tblCountries` VALUES (227, 'UM', 'United States minor outlying islands');
INSERT INTO `tblCountries` VALUES (228, 'UY', 'Uruguay');
INSERT INTO `tblCountries` VALUES (229, 'UZ', 'Uzbekistan');
INSERT INTO `tblCountries` VALUES (230, 'VU', 'Vanuatu');
INSERT INTO `tblCountries` VALUES (231, 'VA', 'Vatican City State');
INSERT INTO `tblCountries` VALUES (232, 'VE', 'Venezuela');
INSERT INTO `tblCountries` VALUES (233, 'VN', 'Vietnam');
INSERT INTO `tblCountries` VALUES (234, 'VG', 'Virgin Islands (British)');
INSERT INTO `tblCountries` VALUES (235, 'VI', 'Virgin Islands (U.S.)');
INSERT INTO `tblCountries` VALUES (236, 'WF', 'Wallis and Futuna Islands');
INSERT INTO `tblCountries` VALUES (237, 'EH', 'Western Sahara');
INSERT INTO `tblCountries` VALUES (238, 'YE', 'Yemen');
INSERT INTO `tblCountries` VALUES (239, 'YU', 'Yugoslavia');
INSERT INTO `tblCountries` VALUES (240, 'ZR', 'Zaire');
INSERT INTO `tblCountries` VALUES (241, 'ZM', 'Zambia');
INSERT INTO `tblCountries` VALUES (242, 'ZW', 'Zimbabwe');

SELECT 'CREATE `tblState`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblState`;
CREATE TABLE IF NOT EXISTS `tblState`(
	`id` INT(11) AUTO_INCREMENT NOT NULL,
	`stateName` VARCHAR(20) NOT NULL,
	`createdBy` INT(11) NOT NULL,
	`createdOn` DATETIME NOT NULL,
	`isApproved` ENUM('Y', 'N') NOT NULL DEFAULT 'N',
	`isActive`  ENUM('Y', 'N') NOT NULL DEFAULT 'Y',
	`isDelete` ENUM('Y', 'N') NOT NULL DEFAULT 'N',
	`updateOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	`countryId` INT(11) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `UK_tblState_countryId_stateName`(`countryId`, `stateName`)
);

INSERT INTO `tblState` VALUES (1, 'West Bengal', 0, NOW(), 'Y', 'Y', 'N', NOW(), 99);
INSERT INTO `tblState` VALUES (2, 'Delhi', 0, NOW(), 'Y', 'Y', 'N', NOW(), 99);
INSERT INTO `tblState` VALUES (3, 'England', 0, NOW(), 'Y', 'Y', 'N', NOW(), 226);

SELECT 'CREATE `tblCity`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblCity`;
CREATE TABLE IF NOT EXISTS `tblCity`(
	`id` INT(11) AUTO_INCREMENT NOT NULL,
	`stateId` INT(11) NOT NULL,
	`cityName` VARCHAR(30) NOT NULL,
	`createdBy` VARCHAR(20) NOT NULL,
	`createdOn` DATETIME NOT NULL,
	`isApproved` ENUM('Y', 'N') NOT NULL DEFAULT 'N',
	`isActive`  ENUM('Y', 'N') NOT NULL DEFAULT 'Y',
	`isDelete` ENUM('Y', 'N') NOT NULL DEFAULT 'N',
	`updateOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`),
	UNIQUE KEY `UK_tblCity_stateId_cityName`(`stateId`, `cityName`)
);

INSERT INTO `tblCity` VALUES (1, 1, 'Kolkata', 0, NOW(), 'Y', 'Y', 'N', NOW());
INSERT INTO `tblCity` VALUES (2, 1, 'South 24 Parganas', 0, NOW(), 'Y', 'Y', 'N', NOW());
INSERT INTO `tblCity` VALUES (3, 1, 'Howrah', 0, NOW(), 'Y', 'Y', 'N', NOW());
INSERT INTO `tblCity` VALUES (4, 3, 'London', 0, NOW(), 'Y', 'Y', 'N', NOW());

SELECT 'CREATE `tblZipCode`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblZipCode`;
CREATE TABLE IF NOT EXISTS `tblZipCode`(
	`id` INT(11) AUTO_INCREMENT NOT NULL,
	`cityId` INT(11) NOT NULL,
	`zipCode` VARCHAR(10) NOT NULL,
	`createdBy` INT(11) NOT NULL,
	`createdOn` DATETIME NOT NULL,
	`isApproved` ENUM('Y', 'N') NOT NULL DEFAULT 'N',
	`isActive`  ENUM('Y', 'N') NOT NULL DEFAULT 'Y',
	`isDelete` ENUM('Y', 'N') NOT NULL DEFAULT 'N',
	`updateOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`),
	UNIQUE KEY `UK_tblZipCode_cityId_zipCode`(`cityId`, `zipCode`)
);

INSERT INTO `tblZipCode` VALUES (1, 1, '700084', 0, NOW(), 'Y', 'Y', 'N', NOW());
INSERT INTO `tblZipCode` VALUES (2, 4, 'E1 1EP', 0, NOW(), 'Y', 'Y', 'N', NOW());

SELECT 'CREATE `tblUserGroup`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblUserGroup`;
CREATE TABLE IF NOT EXISTS `tblUserGroup`(
	`id` INT(11) AUTO_INCREMENT NOT NULL,
	`title` VARCHAR(50) NOT NULL,
	`role` TEXT NOT NULL,
	`createdBy` INT(11) NOT NULL,
	`updateOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`),
	UNIQUE KEY `UK_tblUserGroup_title`(`title`)
);

INSERT INTO `tblUserGroup`(`id`, `title`, `role`, `createdBy`, `updateOn`) VALUES(1, 'Administrator', '{}', 0, NOW());
INSERT INTO `tblUserGroup`(`id`, `title`, `role`, `createdBy`, `updateOn`) VALUES(2, 'Admin Staff', '{}', 0, NOW());
INSERT INTO `tblUserGroup`(`id`, `title`, `role`, `createdBy`, `updateOn`) VALUES(3, 'Manager', '{}', 0, NOW());
INSERT INTO `tblUserGroup`(`id`, `title`, `role`, `createdBy`, `updateOn`) VALUES(4, 'Support Staff', '{}', 0, NOW());
INSERT INTO `tblUserGroup`(`id`, `title`, `role`, `createdBy`, `updateOn`) VALUES(5, 'Generale', '{}', 0, NOW());

SELECT 'CREATE `tblUser`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblUser`;
CREATE TABLE IF NOT EXISTS `tblUser`(
	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
	`parentId` INT(11) UNSIGNED NOT NULL DEFAULT 0,
	`email` VARCHAR(150) NOT NULL,
	`password` VARCHAR(60) NOT NULL,
	`groupId` INT(11) NOT NULL COMMENT '`tblUserGroup`->`id`',
	`createdOn` DATETIME NOT NULL,
	`updatedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	`createdBy` INT(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
	`updatedBy` INT(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the modifier of user',
	`isActive` ENUM('Y', 'N') NOT NULL DEFAULT 'Y',
	`isDelete` ENUM('Y', 'N') NOT NULL DEFAULT 'N',
	PRIMARY KEY(`id`),
	UNIQUE KEY `UK_tblUser_email` (`email`),
	INDEX `IDX_tblUser_parentId` (`parentId`)
);

INSERT INTO `tblUser` (`id`, `parentId`, `email`, `password`, `groupId`, `createdOn`, `updatedOn`, `isActive`, `createdBy`, `updatedBy`, `isDelete`) VALUES(1, 0, 'admin@gambler.com', 'test123', 1, NOW(), NOW(), 'Y', 0, 0, 'N');

SELECT 'CREATE `tblUserAccess`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblUserAccess`;
CREATE TABLE IF NOT EXISTS `tblUserAccess`(
	`id` INT(11) UNSIGNED NOT NULL COMMENT '`tblUser`->`id`',
	`role` TEXT NOT NULL,
	`modifiedBy` INT(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id',
	`updateOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`)
);

SELECT 'CREATE `tblUserDetails`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblUserDetails`;
CREATE TABLE IF NOT EXISTS `tblUserDetails`(
	`id` INT(11) UNSIGNED NOT NULL COMMENT '`tblUser`->`id`',
	`firstName` VARCHAR(100) NOT NULL,
	`lastName` VARCHAR(100) NOT NULL,
	`designation` VARCHAR(100) NULL,
	`gender` ENUM('M', 'F', 'T') NOT NULL DEFAULT 'M' COMMENT 'M = Male, F = Female, T = Transgender/Other',
	`dob` DATE NULL,
	`address` VARCHAR(500) NOT NULL,
	`settings` TEXT NULL,
	`zipCodeId` INT(11) NOT NULL COMMENT '`tblZipCode`->`id`',
	`cityId` INT(11) NOT NULL COMMENT '`tblCity`->`id`',
	`stateId` INT(11) NOT NULL COMMENT '`tblState`->`id`',
	`countryId` INT(11) NOT NULL COMMENT '`tblCountries`->`id`',
	`mobileNo` VARCHAR(20) NULL,
	`landlineNo` VARCHAR(20) NULL,
	`alternateNo` VARCHAR(20) NULL,
	`updatedBy` INT UNSIGNED NOT NULL DEFAULT 0,
	`updatedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`)
);

INSERT INTO `tblUserDetails` (`id`, `firstName`, `lastName`, `designation`, `gender`, `dob`, `address`, `zipCodeId`, `cityId`, `stateId`, `countryId`, `mobileNo`, `landlineNo`, `alternateNo`, `updatedOn`) VALUES(1, 'Ranjit', 'Das', 'Administrator', 'M', '1987-08-05', '1/10, East Boalia, Garia Sation', 1, 1, 1, 99, '+919830344377', '', '', NOW());

-- SELECT 'CREATE `tblRecommandSports`' AS 'TABLE OPERATIONS';
-- DROP TABLE IF EXISTS `tblRecommandSports`;
-- CREATE TABLE IF NOT EXISTS `tblRecommandSports`(
-- 	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
-- 	`sportName` VARCHAR(100) NOT NULL,
-- 	`joinCode` VARCHAR(100) NULL,
-- 	`sportLink` TEXT NULL,
-- 	`imageLink` TEXT NULL,
-- 	`updatedBy` INT UNSIGNED NOT NULL DEFAULT 0,
-- 	`updatedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
-- 	PRIMARY KEY (`id`),
-- );

SELECT 'CREATE `tblCMSPage`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblCMSPage`;
CREATE TABLE IF NOT EXISTS `tblCMSPage`(
	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
	`parentId` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '`tblCMSPage`->`id`',
	`pageName` VARCHAR(255) NOT NULL,
	`menueTitle` VARCHAR(255) NULL,
	`metaDescription` VARCHAR(255) NULL,
	`metaTitle` VARCHAR(255) NULL,
	`metaKeyWords` VARCHAR(255) NULL,
	`settings` TEXT NULL,
	`content` TEXT NULL,
	`createdOn` DATETIME NOT NULL,
	`createdBy` INT(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
	`updatedBy` INT UNSIGNED NOT NULL DEFAULT 0,
	`updatedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`),
	UNIQUE KEY `UK_tblCMSPage_pageName` (`pageName`)
);




/*New*/

SELECT 'CREATE `tblCategory`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblCategory`;
CREATE TABLE IF NOT EXISTS `tblCategory`(
	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
	`categoryId` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '`tblCategory`->`id`',
	`categoryName` VARCHAR(255) NOT NULL,
	`parentName` VARCHAR(255) NULL,
	`categoryDescription` VARCHAR(255) NULL,
	`categoryLink` VARCHAR(255) NULL,
	`createdOn` DATETIME NOT NULL,
	`createdBy` INT(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
	`updatedBy` INT UNSIGNED NOT NULL DEFAULT 0,
	`updatedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`),
	UNIQUE KEY `UK_tblCategory_categoryName` (`categoryName`)
);

SELECT 'CREATE `tblSlider`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblSlider`;
CREATE TABLE IF NOT EXISTS `tblSlider`(
	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
	`sliderImage` VARCHAR(255) NOT NULL,
	`sliderHeading` TEXT NULL,
	`SliderText` TEXT NULL,
	`createdOn` DATETIME NOT NULL,
	`createdBy` INT(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
	`updatedBy` INT UNSIGNED NOT NULL DEFAULT 0,
	`updatedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`)
);

SELECT 'CREATE `tblAds`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblAds`;
CREATE TABLE IF NOT EXISTS `tblAds`(
	`id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
	`adsImage` VARCHAR(255) NOT NULL,
	`adsLink` TEXT NULL,
	`createdOn` DATETIME NOT NULL,
	`createdBy` INT(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
	`updatedBy` INT UNSIGNED NOT NULL DEFAULT 0,
	`updatedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`)
);
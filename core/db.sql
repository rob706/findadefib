--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT 4,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `lastlogin` datetime NOT NULL DEFAULT current_timestamp(),

  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci;

--
-- Table structure for table `aed_machines`
--

CREATE TABLE `aed_machines` (
  `aed_id` int(11) NOT NULL AUTO_INCREMENT,
  `aed_location` text DEFAULT NULL,
  `aed_w3w` text DEFAULT NULL,
  `aed_geolocation` TEXT DEFAULT NULL,
  `aed_latitude` FLOAT NULL,
  `aed_longitude` FLOAT NULL,
  `aed_condition` text DEFAULT NULL,
  `aed_time_mon_start` time NOT NULL DEFAULT '00:00:00',
  `aed_time_mon_end` time NOT NULL DEFAULT '00:00:00',
  `aed_time_tue_start` time NOT NULL DEFAULT '00:00:00',
  `aed_time_tue_end` time NOT NULL DEFAULT '00:00:00',
  `aed_time_wed_start` time NOT NULL DEFAULT '00:00:00',
  `aed_time_wed_end` time NOT NULL DEFAULT '00:00:00',
  `aed_time_thur_start` time NOT NULL DEFAULT '00:00:00',
  `aed_time_thur_end` time NOT NULL DEFAULT '00:00:00',
  `aed_time_fri_start` time NOT NULL DEFAULT '00:00:00',
  `aed_time_fri_end` time NOT NULL DEFAULT '00:00:00',
  `aed_time_sat_start` time NOT NULL DEFAULT '00:00:00',
  `aed_time_sat_end` time NOT NULL DEFAULT '00:00:00',
  `aed_time_sun_start` time NOT NULL DEFAULT '00:00:00',
  `aed_time_sun_end` time NOT NULL DEFAULT '00:00:00',
  `aed_available_mon` tinyint(1) NOT NULL DEFAULT 0,
  `aed_available_tue` tinyint(1) NOT NULL DEFAULT 0,
  `aed_available_wed` tinyint(1) NOT NULL DEFAULT 0,
  `aed_available_thur` tinyint(1) NOT NULL DEFAULT 0,
  `aed_available_fri` tinyint(1) NOT NULL DEFAULT 0,
  `aed_available_sat` tinyint(1) NOT NULL DEFAULT 0,
  `aed_available_sun` tinyint(1) NOT NULL DEFAULT 0,
  `aed_signage` text DEFAULT NULL,
  `aed_make` text DEFAULT NULL,
  `aed_model` text DEFAULT NULL,
  `aed_assettag` text DEFAULT NULL,
  `aed_cemark` tinyint(1) NOT NULL DEFAULT 0,
  `aed_serialnumber` text DEFAULT NULL,
  `aed_batterystatus` text DEFAULT NULL,
  `aed_manufacturedate` date DEFAULT NULL,
  `aed_battery_manufacturedate` date NULL,
  `aed_registered` tinyint(1) DEFAULT 0,
  `aed_pads1_type` tinyint(1) DEFAULT 0,
  `aed_pads1_expiry` date DEFAULT NULL,
  `aed_pads2_type` tinyint(1) DEFAULT 0,
  `aed_pads2_expiry` date DEFAULT NULL,
  `aed_pads3_type` tinyint(1) DEFAULT 0,
  `aed_pads3_expiry` date DEFAULT NULL,
  `aed_pads4_type` tinyint(1) DEFAULT 0,
  `aed_pads4_expiry` date DEFAULT NULL,
  `box_locked` tinyint(1) DEFAULT 0,
  `box_assettag` text DEFAULT NULL,
  `box_accesscode` text DEFAULT NULL,
  `box_power` tinyint(1) DEFAULT 3,
  `box_rescuereadykit` tinyint(1) DEFAULT 0,
  `aed_servicecontract` tinyint(1) NULL DEFAULT 0,
  `otherinfo` text DEFAULT NULL,
  `loggedby` int(11) NOT NULL,
  `logged` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`aed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_0900_ai_ci;


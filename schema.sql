-- --------------------------------------------------------
-- Host:                         mysql.adire.co.uk
-- Server version:               5.7.11-log - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table bigprimes.client
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` varchar(36) NOT NULL,
  `user` varchar(36) NOT NULL,
  `name` varchar(40) NOT NULL,
  KEY `client_id` (`client_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.dispatch
CREATE TABLE IF NOT EXISTS `dispatch` (
  `client_id` varchar(40) NOT NULL,
  `time_sent` int(11) NOT NULL,
  `wu_id` varchar(45) NOT NULL,
  KEY `client_id_wu_id` (`client_id`,`wu_id`),
  KEY `wu_id` (`wu_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.fibonacci_numbers
CREATE TABLE IF NOT EXISTS `fibonacci_numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` longtext NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.global
CREATE TABLE IF NOT EXISTS `global` (
  `key` varchar(32) NOT NULL,
  `value` varchar(32) NOT NULL,
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.numberCache
CREATE TABLE IF NOT EXISTS `numberCache` (
  `number` char(255) NOT NULL DEFAULT '',
  `isPrime` tinyint(4) NOT NULL DEFAULT '0',
  `factors` longtext NOT NULL,
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.perfect_numbers
CREATE TABLE IF NOT EXISTS `perfect_numbers` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `perfect` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.primeblocks
CREATE TABLE IF NOT EXISTS `primeblocks` (
  `primeblocks_id` char(36) NOT NULL,
  `starting_prime` varchar(45) NOT NULL,
  `number_of_primes` int(10) unsigned NOT NULL,
  `bits_per_halfdiff` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`primeblocks_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.primeNumbers
CREATE TABLE IF NOT EXISTS `primeNumbers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `n` bigint(20) unsigned NOT NULL,
  `2` tinyint(3) unsigned NOT NULL,
  `3` tinyint(3) unsigned NOT NULL,
  `4` tinyint(3) unsigned NOT NULL,
  `5` tinyint(3) unsigned NOT NULL,
  `6` tinyint(3) unsigned NOT NULL,
  `7` tinyint(3) unsigned NOT NULL,
  `8` tinyint(3) unsigned NOT NULL,
  `9` tinyint(3) unsigned NOT NULL,
  `10` tinyint(3) unsigned NOT NULL,
  `11` tinyint(3) unsigned NOT NULL,
  `12` tinyint(3) unsigned NOT NULL,
  `13` tinyint(3) unsigned NOT NULL,
  `14` tinyint(3) unsigned NOT NULL,
  `15` tinyint(3) unsigned NOT NULL,
  `16` tinyint(3) unsigned NOT NULL,
  `17` tinyint(3) unsigned NOT NULL,
  `18` tinyint(3) unsigned NOT NULL,
  `19` tinyint(3) unsigned NOT NULL,
  `20` tinyint(3) unsigned NOT NULL,
  `21` tinyint(3) unsigned NOT NULL,
  `22` tinyint(3) unsigned NOT NULL,
  `23` tinyint(3) unsigned NOT NULL,
  `24` tinyint(3) unsigned NOT NULL,
  `25` tinyint(3) unsigned NOT NULL,
  `26` tinyint(3) unsigned NOT NULL,
  `27` tinyint(3) unsigned NOT NULL,
  `28` tinyint(3) unsigned NOT NULL,
  `29` tinyint(3) unsigned NOT NULL,
  `30` tinyint(3) unsigned NOT NULL,
  `31` tinyint(3) unsigned NOT NULL,
  `32` tinyint(3) unsigned NOT NULL,
  `33` tinyint(3) unsigned NOT NULL,
  `34` tinyint(3) unsigned NOT NULL,
  `35` tinyint(3) unsigned NOT NULL,
  `36` tinyint(3) unsigned NOT NULL,
  `37` tinyint(3) unsigned NOT NULL,
  `38` tinyint(3) unsigned NOT NULL,
  `39` tinyint(3) unsigned NOT NULL,
  `40` tinyint(3) unsigned NOT NULL,
  `41` tinyint(3) unsigned NOT NULL,
  `42` tinyint(3) unsigned NOT NULL,
  `43` tinyint(3) unsigned NOT NULL,
  `44` tinyint(3) unsigned NOT NULL,
  `45` tinyint(3) unsigned NOT NULL,
  `46` tinyint(3) unsigned NOT NULL,
  `47` tinyint(3) unsigned NOT NULL,
  `48` tinyint(3) unsigned NOT NULL,
  `49` tinyint(3) unsigned NOT NULL,
  `50` tinyint(3) unsigned NOT NULL,
  `51` tinyint(3) unsigned NOT NULL,
  `52` tinyint(3) unsigned NOT NULL,
  `53` tinyint(3) unsigned NOT NULL,
  `54` tinyint(3) unsigned NOT NULL,
  `55` tinyint(3) unsigned NOT NULL,
  `56` tinyint(3) unsigned NOT NULL,
  `57` tinyint(3) unsigned NOT NULL,
  `58` tinyint(3) unsigned NOT NULL,
  `59` tinyint(3) unsigned NOT NULL,
  `60` tinyint(3) unsigned NOT NULL,
  `61` tinyint(3) unsigned NOT NULL,
  `62` tinyint(3) unsigned NOT NULL,
  `63` tinyint(3) unsigned NOT NULL,
  `64` tinyint(3) unsigned NOT NULL,
  `65` tinyint(3) unsigned NOT NULL,
  `66` tinyint(3) unsigned NOT NULL,
  `67` tinyint(3) unsigned NOT NULL,
  `68` tinyint(3) unsigned NOT NULL,
  `69` tinyint(3) unsigned NOT NULL,
  `70` tinyint(3) unsigned NOT NULL,
  `71` tinyint(3) unsigned NOT NULL,
  `72` tinyint(3) unsigned NOT NULL,
  `73` tinyint(3) unsigned NOT NULL,
  `74` tinyint(3) unsigned NOT NULL,
  `75` tinyint(3) unsigned NOT NULL,
  `76` tinyint(3) unsigned NOT NULL,
  `77` tinyint(3) unsigned NOT NULL,
  `78` tinyint(3) unsigned NOT NULL,
  `79` tinyint(3) unsigned NOT NULL,
  `80` tinyint(3) unsigned NOT NULL,
  `81` tinyint(3) unsigned NOT NULL,
  `82` tinyint(3) unsigned NOT NULL,
  `83` tinyint(3) unsigned NOT NULL,
  `84` tinyint(3) unsigned NOT NULL,
  `85` tinyint(3) unsigned NOT NULL,
  `86` tinyint(3) unsigned NOT NULL,
  `87` tinyint(3) unsigned NOT NULL,
  `88` tinyint(3) unsigned NOT NULL,
  `89` tinyint(3) unsigned NOT NULL,
  `90` tinyint(3) unsigned NOT NULL,
  `91` tinyint(3) unsigned NOT NULL,
  `92` tinyint(3) unsigned NOT NULL,
  `93` tinyint(3) unsigned NOT NULL,
  `94` tinyint(3) unsigned NOT NULL,
  `95` tinyint(3) unsigned NOT NULL,
  `96` tinyint(3) unsigned NOT NULL,
  `97` tinyint(3) unsigned NOT NULL,
  `98` tinyint(3) unsigned NOT NULL,
  `99` tinyint(3) unsigned NOT NULL,
  `100` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `n` (`n`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.prime_q
CREATE TABLE IF NOT EXISTS `prime_q` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prime` char(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prime_UNIQUE` (`prime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.sumOfDigits
CREATE TABLE IF NOT EXISTS `sumOfDigits` (
  `digits` bigint(20) NOT NULL,
  `sum` bigint(20) NOT NULL,
  `count` bigint(20) NOT NULL,
  KEY `digits` (`digits`),
  KEY `count` (`count`),
  KEY `sum` (`sum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(36) NOT NULL,
  `name` varchar(40) NOT NULL,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.wu
CREATE TABLE IF NOT EXISTS `wu` (
  `wu_id` varchar(36) NOT NULL,
  `generated` int(11) NOT NULL,
  `start` varchar(20) NOT NULL,
  `to` varchar(20) NOT NULL,
  `technique` varchar(6) CHARACTER SET latin1 NOT NULL,
  `size` int(11) NOT NULL,
  `state` enum('New','Crunching','Needs Validating','Validating','Needs Processing') NOT NULL DEFAULT 'New',
  `time_sent` int(11) DEFAULT NULL,
  `time_received` int(11) DEFAULT NULL,
  `time_sent_validation` int(11) DEFAULT NULL,
  `time_received_validation` int(11) DEFAULT NULL,
  `sent_to_client` varchar(40) DEFAULT NULL,
  `validation_client` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`wu_id`),
  KEY `timesent_generated_idx` (`generated`) COMMENT 'For selecting the best unsent workunit for wuget. Also usable by queue populator for counting unsent results.',
  KEY `state` (`state`) USING BTREE,
  KEY `client_id_state_idx` (`sent_to_client`,`state`),
  KEY `state_time_generated_idx` (`state`,`generated`),
  KEY `live_running_totals_idx` (`state`,`sent_to_client`,`validation_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table bigprimes.wu_result
CREATE TABLE IF NOT EXISTS `wu_result` (
  `client_id` varchar(40) NOT NULL,
  `wu_id` varchar(45) NOT NULL,
  `time_received` int(11) NOT NULL,
  `time_taken_ms` int(11) NOT NULL,
  `work_done` bigint(11) NOT NULL,
  `s3location` varchar(80) NOT NULL,
  `validation` tinyint(1) NOT NULL,
  KEY `client_id_wu_id` (`client_id`,`wu_id`) USING BTREE,
  KEY `wu_id` (`wu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;




CREATE DATABASE `history`;

CREATE TABLE `history`.`history` (
	`history_hash` VARCHAR(40) NOT NULL,
	`username` VARCHAR(64) NOT NULL,
	`hostname` VARCHAR(64) NOT NULL,
	`command` TEXT NOT NULL,
	`count` INT(11) UNSIGNED NOT NULL DEFAULT '1',
	`timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`history_hash`),
	INDEX `timestamp` (`timestamp`)
) ENGINE=InnoDB;

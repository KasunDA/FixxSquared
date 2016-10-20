-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'users'
-- 
-- ---

DROP TABLE IF EXISTS `users`;
		
CREATE TABLE `users` (
  `user_id` INTEGER NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `user_type` INTEGER NOT NULL DEFAULT 0 COMMENT '0 = student, 1 = Fixx, 2 = admin',
  `email_address` VARCHAR NULL,
  `password_hash` VARCHAR NULL DEFAULT NULL,
  `password_salt` VARCHAR NULL DEFAULT NULL,
  `residence_hall` VARCHAR NULL DEFAULT NULL,
  `room` VARCHAR NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
);

-- ---
-- Table 'tickets'
-- 
-- ---

DROP TABLE IF EXISTS `tickets`;
		
CREATE TABLE `tickets` (
  `ticket_id` INTEGER NOT NULL AUTO_INCREMENT,
  `user_requesting_id` INTEGER NOT NULL,
  `user_completing_id` INTEGER NULL DEFAULT NULL,
  `status` INTEGER NOT NULL DEFAULT 0 COMMENT '0 = not acknowledged, 1 = acknowledged, 2 = being resolved, 3 = closed',
  `summary` VARCHAR NOT NULL,
  `request_date` DATETIME NOT NULL,
  `completion_time_estimated` TIME NOT NULL DEFAULT '48:00:00',
  `completion_time_actual` TIME NULL DEFAULT NULL,
  `feedback_rating` INTEGER NOT NULL DEFAULT 5,
  `feedback_comment` VARCHAR NULL DEFAULT NULL,
  PRIMARY KEY (`ticket_id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `tickets` ADD FOREIGN KEY (user_requesting_id) REFERENCES `users` (`user_id`);
ALTER TABLE `tickets` ADD FOREIGN KEY (user_completing_id) REFERENCES `users` (`user_id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `tickets` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `users` (`user_id`,`user_type`,`email_address`,`password_hash`,`password_salt`,`residence_hall`,`room`) VALUES
-- ('','','','','','','');
-- INSERT INTO `tickets` (`ticket_id`,`user_requesting_id`,`user_completing_id`,`status`,`summary`,`request_date`,`completion_time_estimated`,`completion_time_actual`,`feedback_rating`,`feedback_comment`) VALUES
-- ('','','','','','','','','','');
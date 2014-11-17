DROP TABLE IF EXISTS `login`.`student_exam`,`login`.`users`,`login`.`user_type`,`login`.`exam_schedule`,`login`.`exam_type`;

CREATE TABLE IF NOT EXISTS `login`.`user_type` (
`id` INT NOT NULL AUTO_INCREMENT,
`type` VARCHAR(20),
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

CREATE TABLE IF NOT EXISTS `login`.`users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_account_type` INT NOT NULL DEFAULT '1',
  `user_has_avatar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if user has a local avatar, 0 if not',
  `user_rememberme_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_provider_type` text COLLATE utf8_unicode_ci,
  `user_facebook_uid` bigint(20) unsigned DEFAULT NULL COMMENT 'optional - facebook UID',
  `red_id` INT NOT NULL,
  `first_name` VARCHAR(20) NOT NULL,
  `middle_name` VARCHAR(20) NOT NULL,
  `last_name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `red_id` (`red_id`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `user_facebook_uid` (`user_facebook_uid`),
  CONSTRAINT `user_account_type` FOREIGN KEY 
  (`user_account_type`) REFERENCES `login`.`user_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';


CREATE TABLE IF NOT EXISTS `login`.`exam_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

CREATE TABLE IF NOT EXISTS `login`.`exam_schedule` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `exam_type` INT NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `seats` INT ZEROFILL NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  `semester` VARCHAR(10) NOT NULL,
  `year` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `exam_type_idx` (`exam_type` ASC),
  CONSTRAINT `exam_type`
    FOREIGN KEY (`exam_type`)
    REFERENCES `login`.`exam_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';


CREATE TABLE IF NOT EXISTS `login`.`student_exam` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `red_id` INT NOT NULL,
  `exam_schedule` INT NOT NULL,
  `score` FLOAT NOT NULL,
  `pass` TINYINT(1) NULL,
  PRIMARY KEY (`id`),
  INDEX `red_id_idx` (`red_id` ASC),
  INDEX `exam_schedule_idx` (`exam_schedule` ASC),
  CONSTRAINT `red_id`
    FOREIGN KEY (`red_id`)
    REFERENCES `login`.`users` (`red_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `exam_schedule`
    FOREIGN KEY (`exam_schedule`)
    REFERENCES `login`.`exam_schedule` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

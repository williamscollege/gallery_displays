/**
 * Project: Gallery Displays
 * Purpose: DB Creation and Maintenance Script
 * Author: David Keiser-Clark, Williams College

SAVE FOR TESTING ONLY:
	USE `gallery_displays`;

	DROP TABLE `galleries`;
	DROP TABLE `monitors`;
	DROP TABLE `log_events`;

	DELETE FROM `galleries`;
	DELETE FROM `monitors`;
	DELETE FROM `log_events`;

	SELECT * FROM `galleries`;
	SELECT * FROM `monitors`;
	SELECT * FROM `log_events`;
*/

# ----------------------------
# IMPORTANT: Select which database you wish to create and run this script against
# ----------------------------
# Database for Development work
CREATE SCHEMA IF NOT EXISTS `gallery_displays`;
USE `gallery_displays`;

# ----------------------------
# IMPORTANT: For local workstation testing, create web user and enter [DB_NAME, DB_USER, DB_PASS] credentials into "authentication.cfg.php" file.
# ----------------------------
-- CREATE USER 'some_dev_username'@'localhost' IDENTIFIED BY 'some_pass_phrase';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON gallery_displays.* TO 'some_dev_username'@'localhost';
-- /* CAREFUL!: DROP USER 'some_dev_username'@'localhost'; */

-- Get a list of MySQL user accounts
-- SELECT * FROM mysql.user;

# ----------------------------
# setup database tables
# ----------------------------

CREATE TABLE IF NOT EXISTS `galleries` (
	`gallery_id`   INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`gallery_name` VARCHAR(255) NULL,
	`created_at`   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at`   TIMESTAMP    NULL,
	`flag_delete`  BIT(1)       NOT NULL DEFAULT 0,
	INDEX `gallery_id` (`gallery_id`),
	INDEX `gallery_name` (`gallery_name`),
	INDEX `created_at` (`created_at`),
	INDEX `updated_at` (`updated_at`),
	INDEX `flag_delete` (`flag_delete`)
)
	ENGINE = innodb
	DEFAULT CHARACTER SET = utf8
	COLLATE utf8_general_ci
	COMMENT = 'Each gallery represents a distinct exhibition space or other type of display area.';

CREATE TABLE IF NOT EXISTS `monitors` (
	`monitor_id`     INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`gallery_id`     INT          NOT NULL DEFAULT 0,
	`monitor_name`   VARCHAR(255) NOT NULL,
	`image_filename` VARCHAR(255) NOT NULL,
	`created_at`     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at`     TIMESTAMP    NULL,
	`flag_delete`    BIT(1)       NOT NULL DEFAULT 0,
	INDEX `monitor_id` (`monitor_id`),
	INDEX `gallery_id` (`gallery_id`),
	INDEX `monitor_name` (`monitor_name`),
	INDEX `image_filename` (`image_filename`),
	INDEX `created_at` (`created_at`),
	INDEX `updated_at` (`updated_at`),
	INDEX `flag_delete` (`flag_delete`)
)
	ENGINE = innodb
	DEFAULT CHARACTER SET = utf8
	COLLATE utf8_general_ci
	COMMENT = 'Monitors belong to a parent gallery grouping. Each monitor has one associated image.';

CREATE TABLE IF NOT EXISTS `log_events` (
	`log_event_id`             INT UNSIGNED  NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`gallery_id`               INT           NOT NULL DEFAULT 0,
	`monitors`                 VARCHAR(255)  NOT NULL,
	`images`                   VARCHAR(255)  NOT NULL,
	`flag_success`             TINYINT(1) UNSIGNED    DEFAULT 1,
	`event_action`             VARCHAR(255)  NULL,
	`event_action_id`          BIGINT(10) UNSIGNED    DEFAULT NULL,
	`event_action_target_type` VARCHAR(255)  NULL,
	`event_note`               VARCHAR(2000) NULL,
	`event_dataset`            VARCHAR(2000) NULL,
	`event_filepath`           VARCHAR(1000) NULL,
	`user_agent_string`        VARCHAR(1000) NULL,
	`event_datetime`           TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
	INDEX `log_event_id` (`log_event_id`)
)
	ENGINE = innodb
	DEFAULT CHARACTER SET = utf8
	COLLATE utf8_general_ci
	COMMENT = 'Logs events such as user submissions of images for monitors, as well as any trapped errors.';
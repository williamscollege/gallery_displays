USE `gallery_displays`;
/*
	DROP TABLE `galleries`;
	DROP TABLE `monitors`;
	DROP TABLE `images`;
	DROP TABLE `log_events`;
	DROP TABLE `log_images`;

	DELETE FROM `galleries`;
	DELETE FROM `monitors`;
	DELETE FROM `images`;
	DELETE FROM `log_events`;
	DELETE FROM `log_images`;

	SELECT * FROM `galleries`;
	SELECT * FROM `monitors`;
	SELECT * FROM `images`;
	SELECT * FROM `log_events`;
	SELECT * FROM `log_images`;
*/

/*CAREFUL - CREATE TEST DATA FOR DEVELOPMENT - NOT ON PROD SERVER!*/
/*galleries*/
INSERT INTO `galleries` VALUES (1, 'sawyer', CURDATE(), NULL, 0);
INSERT INTO `galleries` VALUES (2, 'wcma', CURDATE(), NULL, 0);

/*monitors*/
INSERT INTO `monitors` VALUES (10, 1, 'sawyer_monitor_1', CURDATE(), NULL, 0);
INSERT INTO `monitors` VALUES (11, 2, 'wcma_monitor_1', CURDATE(), NULL, 0);
INSERT INTO `monitors` VALUES (12, 2, 'wcma_monitor_2', CURDATE(), NULL, 0);

UPDATE `monitors` SET flag_delete = TRUE WHERE monitor_id = 11;

/*images*/
INSERT INTO `images` VALUES (100, 10, 'bulldozer_b.jpg', CURDATE(), NULL, 0);
INSERT INTO `images` VALUES (101, 10, 'earth-eaters-europe-Germany3.jpg', CURDATE(), NULL, 0);
INSERT INTO `images` VALUES (102, 11, '25ukraine2_cnd-superJumbo-2048width.jpg', CURDATE(), NULL, 0);
INSERT INTO `images` VALUES (103, 11, 'uyuni-bolivia-train-graveyard-infinitahighway-br-getty.jpg', CURDATE(), NULL, 0);
INSERT INTO `images` VALUES (104, 11, 'rowboat-full.jpg', CURDATE(), NULL, 0);
INSERT INTO `images` VALUES (105, 12, 'c-starwars-2.jpg', CURDATE(), NULL, 0);
INSERT INTO `images` VALUES (106, 12, 'nyc.jpg', CURDATE(), NULL, 0);

/*log_images*/
INSERT INTO `log_images` VALUES (1000, 1, 10, 100, 'sawyer_monitor_1', 'bulldozer_b.jpg', CURDATE(), 0);
INSERT INTO `log_images` VALUES (1001, 2, 12, 105, 'wcma_monitor_2', 'c-starwars-2.jpg', CURDATE(), 0);
INSERT INTO `log_images` VALUES (1002, 2, 12, 106, 'wcma_monitor_2', 'nyc.jpg', CURDATE(), 0);

/*log_events*/
-- INSERT INTO `log_events` VALUES (2000, 1, 10, 100, 'sawyer_monitor_1', 'bulldozer_b.jpg', CURDATE(), 0);


USE `gallery_displays`;
/*
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

/*CAREFUL - CREATE TEST DATA FOR DEVELOPMENT - NOT ON PROD SERVER!*/
/*galleries*/
INSERT INTO `galleries` VALUES (1, 'sawyer', CURDATE(), NULL, 0);
INSERT INTO `galleries` VALUES (2, 'wcma', CURDATE(), NULL, 0);

/*monitors*/
INSERT INTO `monitors` VALUES (10, 1, 'sawyer_monitor_1', 'bulldozer_b.jpg', CURDATE(), NULL, 0);
INSERT INTO `monitors` VALUES (11, 1, 'sawyer_monitor_2', 'earth-eaters-europe-Germany3.jpg', CURDATE(), NULL, 0);
INSERT INTO `monitors` VALUES (12, 2, 'wcma_monitor_1', 'c-starwars-2.jpg', CURDATE(), NULL, 0);
INSERT INTO `monitors` VALUES (13, 2, 'wcma_monitor_2', 'uyuni-bolivia-train-graveyard-infinitahighway-br-getty.jpg', CURDATE(), NULL, 0);
INSERT INTO `monitors` VALUES (14, 2, 'wcma_monitor_3', 'rowboat-full.jpg', CURDATE(), NULL, 0);

UPDATE `monitors` SET flag_delete = TRUE WHERE monitor_id = 13;

/*TODO*/
/*log_events*/
-- INSERT INTO `log_events` VALUES (2000, 1, 10, 100, 'sawyer_monitor_1', 'bulldozer_b.jpg', CURDATE(), 0);


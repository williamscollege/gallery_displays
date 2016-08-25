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
	SELECT * FROM `log_events` ORDER BY `log_event_id` DESC;
*/

/*CAREFUL - CREATE TEST DATA ONLY FOR DEVELOPMENT - NOT ON PROD SERVER!*/
/*galleries*/
INSERT INTO `galleries` VALUES (1, 'sawyer', CURTIME(), NULL, 0);
INSERT INTO `galleries` VALUES (2, 'wcma', CURTIME(), NULL, 0);

/*monitors*/
INSERT INTO `monitors` VALUES (10, 1, 'sawyer_monitor_1', 'bulldozer_b.jpg', CURTIME(), NULL, 0);
INSERT INTO `monitors` VALUES (11, 1, 'sawyer_monitor_2', 'earth-eaters-europe-Germany3.jpg', CURTIME(), NULL, 0);
INSERT INTO `monitors` VALUES (12, 2, 'wcma_monitor_1', 'c-starwars-2.jpg', CURTIME(), NULL, 0);
INSERT INTO `monitors` VALUES (13, 2, 'wcma_monitor_2', 'uyuni-bolivia-train-graveyard-infinitahighway-br-getty.jpg', CURTIME(), NULL, 0);
INSERT INTO `monitors` VALUES (14, 2, 'wcma_monitor_3', 'rowboat-full.jpg', CURTIME(), NULL, 0);

UPDATE `monitors` SET flag_delete = TRUE WHERE monitor_id = 13;

/*log_events*/
INSERT INTO `log_events` VALUES (300, 1, 1, 'update_image_filenames', 'Successfully updated monitors.image_filename', '{"sawyer_monitor_1":"bulldozer_b.jpg","sawyer_monitor_2":"earth-eaters-europe-Germany3.jpg"}', '/GITHUB/gallery_displays/process_requests.php', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', CURTIME());


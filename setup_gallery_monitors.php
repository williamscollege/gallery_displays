<?php
	/**
	 * Project: Gallery Displays
	 * Purpose: File Overview
	 * select * from monitors
	 * do directory scan of images directory
	 * sync db with directory scan of images folder: add or remove image directories in database to synchronize both
	 * set a default image_filename for each monitor
	 * enable the setup person (ie security guard) to identify each monitor from a list of available options (HTML links on page)
	 * selecting a monitor will set that browser to pull images intended only for that monitor
	 * Author: David Keiser-Clark, Williams College
	 */

	// ***************************
	// required files
	// ***************************
	require_once(dirname(__FILE__) . '/app_setup.php');


	# TODO - Consider putting this directory/database synchronization into another file, to enable it to periodically run silently
	// fetch galleries
	$galleries = Gallery::getAllFromDb([], $DB);

	// read directory contents to create dynamic list of exhibition and monitor options
	$array_directories = [];
	if ($handle = opendir(dirname(__FILE__) . APP_IMAGES_DIR)) {
		//echo "Directory handle: $handle\n<br/><br/>";
		while (FALSE !== ($directory_name = readdir($handle))) {
			if ($directory_name != "." && $directory_name != "..") {
				// store value in array
				array_push($array_directories, $directory_name);
			}
		}
		closedir($handle);
	}

	// fetch monitors
	$all_monitors = Monitor::getAllFromDb([], $DB);

	if (DEBUG_APP) {
		util_prePrintR($galleries);
		util_prePrintR($array_directories);
		util_prePrintR($all_monitors);
	}

	// do new directories exist?
	foreach ($array_directories as $directory) {
		$flag_directory = FALSE;

		// check if directory exists in db
		foreach ($all_monitors as $monitor) {
			if ($monitor->monitor_name == $directory) {
				// found directory match in db
				$flag_directory = TRUE;
			}
		}

		// directory does not exist in db
		if (!$flag_directory) {

			// check if this record was deleted (flag_delete = TRUE)
			$deactivated_monitor = Monitor::getOneFromDb(['monitor_name' => $directory, 'flag_delete' => TRUE], $DB);

			// update or create record
			if ($deactivated_monitor->matchesDb) {
				// update record
				$deactivated_monitor->flag_delete    = 0;
				$deactivated_monitor->image_filename = set_default_image_for_monitor($directory);
				$deactivated_monitor->updated_at     = util_currentDateTimeString_asMySQL();
				$deactivated_monitor->updateDb();

				if (!$deactivated_monitor->matchesDb) {
					// update failed
					$evt_action = "error_db_update";
					$evt_note   = "database error: could not reactivate pre-existing monitor record";
					util_createEventLog($monitor->gallery_id, FALSE, $evt_action, $evt_note, print_r(json_encode($directory), TRUE), $DB);
					display_error($evt_note);
					exit;
				}

				// log event
				$evt_action = "reactivate_monitor";
				$evt_note   = "Successfully reactivated monitor record " . $directory;
				util_createEventLog($deactivated_monitor->gallery_id, TRUE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);

				if (DEBUG_APP) {
					echo $evt_note;
				}
			}
			else {
				// create record

				// check if we need to create a gallery (parent group) for this new monitor
				$directory_prefix = strchr($directory, "_", -1); // fetch prefix of directory (example: "wcma" is prefix of "wcma_monitor_1")
				$new_gallery      = Gallery::getOneFromDb(['gallery_name' => $directory_prefix], $DB);

				if (!$new_gallery->matchesDb) {
					// check if this record was deleted (flag_delete = TRUE) because the gallery is not a live record
					$deactivated_gallery = Gallery::getOneFromDb(['gallery_name' => $directory_prefix, 'flag_delete' => TRUE], $DB);

					// update or create record
					if ($deactivated_gallery->matchesDb) {
						// update record
						$deactivated_gallery->flag_delete = 0;
						$deactivated_gallery->updated_at  = util_currentDateTimeString_asMySQL();
						$deactivated_gallery->updateDb();

						if (!$deactivated_gallery->matchesDb) {
							// update failed
							$evt_action = "error_db_update";
							$evt_note   = "database error: could not reactivate pre-existing gallery record";
							util_createEventLog($monitor->gallery_id, FALSE, $evt_action, $evt_note, print_r(json_encode($directory), TRUE), $DB);
							display_error($evt_note);
							exit;
						}

						// log event
						$evt_action = "reactivate_gallery";
						$evt_note   = "Successfully reactivated gallery record " . $directory_prefix;
						util_createEventLog($deactivated_gallery->gallery_id, TRUE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);

						if (DEBUG_APP) {
							echo $evt_note;
						}
					}
					else {
						// create record
						$new_gallery               = Gallery::createNewGallery($DB);
						$new_gallery->gallery_name = $directory_prefix;
						$new_gallery->updateDb();

						if (!$new_gallery->matchesDb) {
							// update failed
							$evt_action = "error_db_create";
							$evt_note   = "database error: could not create gallery record";
							util_createEventLog($new_gallery->gallery_id, FALSE, $evt_action, $evt_note, print_r(json_encode($directory), TRUE), $DB);
							display_error($evt_note);
							exit;
						}

						// log event
						$evt_action = "create_gallery";
						$evt_note   = "Successfully created gallery record: " . $directory_prefix;
						util_createEventLog($new_gallery->gallery_id, TRUE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);

						if (DEBUG_APP) {
							echo $evt_note;
						}
					}

				}
				// create record
				$new_monitor                 = Monitor::createNewMonitor($DB);
				$new_monitor->gallery_id     = $new_gallery->gallery_id;
				$new_monitor->monitor_name   = $directory;
				$new_monitor->image_filename = set_default_image_for_monitor($directory);
				$new_monitor->updateDb();

				if (!$new_monitor->matchesDb) {
					// update failed
					$evt_action = "error_db_create";
					$evt_note   = "database error: could not create monitor record";
					util_createEventLog($new_monitor->gallery_id, FALSE, $evt_action, $evt_note, print_r(json_encode($directory), TRUE), $DB);
					display_error($evt_note);
					exit;
				}

				// log event
				$evt_action = "create_monitor";
				$evt_note   = "Successfully created monitor record: " . $directory;
				util_createEventLog($new_gallery->gallery_id, TRUE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);

				if (DEBUG_APP) {
					echo $evt_note;
				}
			}
		}
	}

	// NOW, DO THE REVERSE PROCESS
	# fetch galleries
	$galleries = Gallery::getAllFromDb([], $DB);

	# fetch monitors
	$all_monitors = Monitor::getAllFromDb([], $DB);

	// have any directories been removed?
	foreach ($all_monitors as $monitor) {
		$flag_db_monitor_name = FALSE;

		// check if db_monitor_name exists in directory structure
		foreach ($array_directories as $directory) {
			if ($monitor->monitor_name == $directory) {
				// found monitor_name match with actual directory
				$flag_db_monitor_name = TRUE;
			}
		}

		// db_monitor_name does not exist in directory structure
		if (!$flag_db_monitor_name) {
			// soft-delete this record as it no longer matches, or represents, the actual directory structure
			// update record
			$monitor->flag_delete = 1;
			$monitor->updated_at  = util_currentDateTimeString_asMySQL();
			$monitor->updateDb();

			if (!$monitor->matchesDb) {
				// update failed
				$evt_action = "error_delete_monitor";
				$evt_note   = "database error: could not delete monitor record";
				util_createEventLog($monitor->gallery_id, FALSE, $evt_action, $evt_note, print_r(json_encode($monitor->monitor_name), TRUE), $DB);
				display_error($evt_note);
				exit;
			}

			// log event
			$evt_action = "delete_monitor";
			$evt_note   = "Successfully deleted monitor record: " . $monitor->monitor_name;
			util_createEventLog($monitor->gallery_id, TRUE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo "Setup - " . LANG_APP_NAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo LANG_APP_NAME; ?>">
	<meta name="author" content="<?php echo LANG_AUTHOR_NAME; ?>">
	<meta charset="utf-8">
	<!-- CSS: Framework -->
	<!-- CSS: Plugins -->
	<link rel="stylesheet" href="<?php echo PATH_JQUERYUI_CSS; ?>" />
	<link rel="stylesheet" href="<?php echo APP_ROOT_PATH; ?>/css/custom.css" type="text/css" media="all">
	<!-- jQuery: Framework -->
	<script src="<?php echo PATH_JQUERY_JS; ?>"></script>
	<!-- jQuery: Plugins -->
	<!-- local JS -->
</head>
<body class="setup_theme">

<h1>Setup: Please identify this monitor from the galleries below:</h1>

<?php
	// fetch galleries
	$galleries = Gallery::getAllFromDb([], $DB);

	foreach ($galleries as $gallery) {
		// load monitors for this gallery
		$gallery->loadMonitors();

		// only display a gallery group if it contains active monitors
		if (count($gallery->monitors) > 0){
			// display gallery group
			echo "<div style=\"width:100%; float:left\">";
			echo "<h2 class=\"uppercase\">" . $gallery->gallery_name . "</h2>";

			// display monitors within each gallery
			foreach ($gallery->monitors as $monitor) {
				echo "<div class=\"icon_monitor\">";
				echo "<p class=\"icon_monitor_text\"><a href=\"" . APP_FOLDER . "/index.php?id=" . $monitor->monitor_id . "\" title=\"" . $monitor->monitor_name . "\"/>" . $monitor->monitor_name . "</a></p>";
				echo "</div>";
			}
			echo '</div>';
		}
	}
?>

</body>
</html>

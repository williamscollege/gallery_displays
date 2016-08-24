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


	# TODO - Consider putting this directory scan stuff into another file, to enable it to periodically run silently

	# fetch galleries
	$galleries = Gallery::getAllFromDb([], $DB);

	# read directory contents to create dynamic list of exhibition and monitor options
	$array_directories = [];
	if ($handle = opendir(dirname(__FILE__) . '/images/')) {
		//echo "Directory handle: $handle\n<br/><br/>";
		while (FALSE !== ($directory_name = readdir($handle))) {
			if ($directory_name != "." && $directory_name != "..") {
				// store value in array
				array_push($array_directories, $directory_name);
			}
		}
		closedir($handle);
	}

	# fetch monitors
	$all_monitors = Monitor::getAllFromDb([], $DB);

	if (DEBUG_APP) {
		util_prePrintR($galleries);
		util_prePrintR($array_directories);
		util_prePrintR($all_monitors);
	}

	# check: are there new directories?
	foreach ($array_directories as $directory) {
		$flag_name_exists = FALSE;
		// check if directory exists in db
		foreach ($all_monitors as $monitor) {
			if ($monitor->monitor_name == $directory) {
				// found match in db
				$flag_name_exists = TRUE;
			}
		}
		if (!$flag_name_exists) {
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
					// update record failed
					$evt_note = "database error: could not update monitor record";

					// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
					// TODO: util_createEventLog($USER->user_id, FALSE, $action, $primaryID, "monitor_id", $results["notes"], print_r(json_encode($_REQUEST), TRUE), $DB);
					exit;
				}

				// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
				$evt_note = "Successfully updated monitor record " . $directory . "<br />";
				// TODO: util_createEventLog($USER->user_id, TRUE, $action, $primaryID, "monitor_id", $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
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
							// update record failed
							$evt_note = "database error: could not update gallery record";

							// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
							// TODO: util_createEventLog($USER->user_id, FALSE, $action, $primaryID, "gallery_id", $results["notes"], print_r(json_encode($_REQUEST), TRUE), $DB);
							exit;
						}

						// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
						$evt_note = "Successfully updated gallery record: " . $directory_prefix . "<br/>";
						// TODO: util_createEventLog($USER->user_id, TRUE, $action, $primaryID, "gallery_id", $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
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
							// update record failed
							$evt_note = "database error: could not create gallery record";

							// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
							// TODO: util_createEventLog($USER->user_id, FALSE, $action, $primaryID, "gallery_id", $results["notes"], print_r(json_encode($_REQUEST), TRUE), $DB);
							exit;
						}

						// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
						$evt_note = "Successfully created gallery record: " . $directory_prefix . "<br/>";
						// TODO: util_createEventLog($USER->user_id, TRUE, $action, $primaryID, "gallery_id", $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
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
					// update record failed
					$evt_note = "database error: could not create monitor record";

					// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
					// TODO: util_createEventLog($USER->user_id, FALSE, $action, $primaryID, "monitor_id", $results["notes"], print_r(json_encode($_REQUEST), TRUE), $DB);
					exit;
				}

				// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
				$evt_note = "Successfully created monitor record: " . $directory . "<br/>";
				// TODO: util_createEventLog($USER->user_id, TRUE, $action, $primaryID, "monitor_id", $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
				if (DEBUG_APP) {
					echo $evt_note;
				}
			}
		}
	}

	// TODO - DO REVERSE PROCESS (of above) TO SET ANY MISSING FOLDERS TO BE SOFT DELETED

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
<body style="background-color: mediumpurple; margin: 0 10px;">

<h1>Setup: Please identify this monitor from the galleries below:</h1>

<?php
	// fetch galleries
	$galleries = Gallery::getAllFromDb([], $DB);

	foreach ($galleries as $gallery) {
		// load monitors for this gallery
		$gallery->loadMonitors();

		// display gallery group
		echo "<div style=\"width:100%; float:left\">";
		echo "<h2 class=\"uppercase\">" . $gallery->gallery_name . "</h2>";

		// display monitors within each gallery
		foreach ($gallery->monitors as $monitor) {
			echo "<div class=\"background_monitor\">";
			echo "<p class=\"monitor_text\"><a href=\"" . APP_FOLDER . "/index.php?id=" . $monitor->monitor_id . "\" title=\"" . $monitor->monitor_name . "\"/>" . $monitor->monitor_name . "</a></p>";
			echo "</div>";
		}
		echo '</div>';
	}
?>

</body>
</html>

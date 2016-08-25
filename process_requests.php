<?php
	/**
	 * Project: Gallery Displays
	 * Purpose: Fetch image from db based on querystring integer
	 * Author: David Keiser-Clark, Williams College
	 */


	// ***************************
	// required files
	// ***************************
	require_once(dirname(__FILE__) . '/app_setup.php');


	$monitors = Monitor::getAllFromDb([], $DB);

	if (DEBUG_APP) {
		echo "<h2>gettype:</h2>";
		util_prePrintR(gettype($_REQUEST));
		echo "<h2>form values:</h2>";
		util_prePrintR($_REQUEST);
		echo "<h2>all monitors:</h2>";
		util_prePrintR($monitors);
	}

	// basic security: iterate through form elements to confirm that input names match known monitors in db
	foreach ($_REQUEST as $input_name => $input_value) {
		if (DEBUG_APP) {
			echo "input_name: " . $input_name . "<br/>";
			echo "input_value: " . $input_value . "<br/>";
		}

		// set default condition
		$flag_exists = FALSE;

		// cycle through all known subdirectory names
		foreach ($monitors as $element) {
			if ($input_name == $element->monitor_name) {
				// update flag
				$flag_exists = TRUE;
			}
		}
		// check name: expected to be existing directory name within DB, else abort
		if (!$flag_exists) {
			$evt_action = "error_directory_name";
			$evt_note   = "error: unexpected directory name. exiting.";
			util_createEventLog(0, FALSE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
			display_error($evt_note);
			exit;
		}
		// check value: expected to be image extension, else abort
		if (!preg_match("/.jpg|.png|.gif/i", $input_value)) {
			$evt_action = "error_image_type";
			$evt_note   = "error: unexpected image type. exiting.";
			util_createEventLog(0, FALSE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
			display_error($evt_note);
			exit;
		}
	}


	// iterate through form values: update the image for each named monitor in db
	foreach ($_REQUEST as $input_name => $input_value) {
		// expected params: monitor_name, image_name
		$new_image = Monitor::getOneFromDb(['monitor_name' => $input_name], $DB);

		$new_image->image_filename = $input_value;
		$new_image->updated_at     = util_currentDateTimeString_asMySQL();
		$new_image->updateDb();

		if (!$new_image->matchesDb) {
			// update failed
			$evt_action = "error_db_update";
			$evt_note   = "database error: could not update the image_filename (" . $input_value . ") for monitor_id (" . $new_image->monitor_id . ")";
			util_createEventLog($new_image->gallery_id, FALSE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
			display_error($evt_note);
			exit;
		}
	}

	// log event
	$evt_action = "update_image_filenames";
	$evt_note   = "Successfully updated monitors.image_filename";
	util_createEventLog($new_image->gallery_id, TRUE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);

	if (DEBUG_APP) {
		util_prePrintR($evt_note);
	}


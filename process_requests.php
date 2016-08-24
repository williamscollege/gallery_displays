<?php
	/**
	 * File Overview:
	 * fetch image from db based on querystring integer
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

	// basic security: cycle through each named form element
	foreach ($_REQUEST as $input_name => $input_value) {
		if (DEBUG_APP) {
			echo "input_name: " . $input_name . "<br/>";
			echo "input_value: " . $input_value . "<br/>";
		}

		$last_monitor_name = $input_name;

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
			echo "Error: unexpected directory name! exiting.";
			exit;
		}
		// check value: expected to be image extension, else abort
		if (!preg_match("/.jpg|.png|.gif/i", $input_value)) {
			display_error("Unexpected value received. exiting.");
			exit;
		}
	}

	// iterate through form values: update the image for each named monitor in db
	foreach ($_REQUEST as $input_name => $input_value) {
		// expected params: monitor_name, image_name
		$new_image = Monitor::getOneFromDb(['monitor_name' => $input_name], $DB);

		$new_image->image_filename = $input_value;
		$new_image->updated_at  = util_currentDateTimeString_asMySQL();
		$new_image->updateDb();

		if (!$new_image->matchesDb) {
			// update record failed
			$evt_note = "database error: could not update the image_filename for this monitor record";

			// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
			// TODO: util_createEventLog(gallery_id, FALSE, $action, $primaryID, "monitor_id", $results["notes"], print_r(json_encode($_REQUEST), TRUE), $DB);
			exit;
		}
	}

	// create event log. [requires: flag_success(bool), event_action(varchar), event_action_id(int), event_action_target_type(varchar), event_note(varchar), event_dataset(varchar)]
	//	$evt_note = "Successfully updated monitor record<br />";
	// TODO: util_createEventLog(gallery_id, TRUE, $action, $primaryID, "monitor_id", $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
	if (DEBUG_APP) {
		//	echo $evt_note;
	}


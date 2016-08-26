<?php
	/**
	 * Project: Gallery Displays
	 * Purpose: Fetch image from db based on querystring integer
	 * Purpose: Return rendered image HTML
	 * Author: David Keiser-Clark, Williams College
	 */

	// ***************************
	// required files
	// ***************************
	require_once(dirname(__FILE__) . '/app_setup.php');


	// required: querystring value
	if ((isset($_REQUEST['id'])) && (is_numeric($_REQUEST['id']) && ($_REQUEST['id'] > 0))) {
		$monitor_id = $_REQUEST['id'];
		if (DEBUG_APP) {
			echo "fetch_image.php: monitor_id = " . $monitor_id;
		}
	}
	else {
		// need to identify this monitor from available options
		$evt_action = "error_lacks_querystring";
		$evt_note   = "error: lacks querystring. exiting.";
		util_createEventLog(0, FALSE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);
		header("location: setup_gallery_monitors.php");
		exit;
	}

	// get image for this monitor
	$monitor = Monitor::getOneFromDb(['monitor_id' => $monitor_id], $DB);

	if (DEBUG_APP) {
		util_prePrintR($monitor);
	}

	// check for valid returned object
	if(!$monitor->matchesDb){
		$evt_action = "error_object_missing";
		$evt_note   = "error: object missing. exiting.";
		util_createEventLog(0, FALSE, $evt_action, $evt_note, print_r(json_encode($_REQUEST), TRUE), $DB);

		// force a redirect using javascript to prevent the same error from occurring again
		echo "FISH<script>window.location = \"setup_gallery_monitors.php\";</script>";
		exit;
	}

	// output result
	echo "<img src=\"" . APP_FOLDER . APP_IMAGES_DIR . $monitor->monitor_name . "/" . $monitor->image_filename . "\" alt=\"\" title=\"\" />";






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
		header("location: setup_gallery_monitors.php");
		exit;
	}


	// get image for this monitor
	$monitor = Monitor::getOneFromDb(['monitor_id' => $monitor_id], $DB);

	if (DEBUG_APP) {
		util_prePrintR($monitor);
	}

	// output image path
	echo "<img src=\"" . APP_FOLDER . "/images/" . $monitor->monitor_name . "/" . $monitor->image_filename . "\" alt=\"" . $monitor->image_filename . "\" title=\"" . $monitor->image_filename . "\" />";


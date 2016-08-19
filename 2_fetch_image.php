<?php

	// Start new or resume existing session
	session_start();


	// ***************************
	// set variables
	// ***************************
	$debug = FALSE;

	// debugging
	if ($debug) {
		echo "<h2>Session variables:</h2>";
		echo "MONITOR_1 = " . $_SESSION["MONITOR_1"] . "<br />";
		echo "MONITOR_2 = " . $_SESSION["MONITOR_2"] . "<br />";
		echo "MONITOR_3 = " . $_SESSION["MONITOR_3"] . "<br />";
	}

	if ((isset($_REQUEST['monitor'])) && (is_numeric($_REQUEST['monitor']) && ($_REQUEST['monitor'] > 0))) {
		$monitor = $_REQUEST['monitor'];
		if ($debug) {
			echo "monitor = " . $monitor;
			exit;
		}
	}
	else {
		// display error and exit
		display_error("Unexpected querystring value. exiting.");
		exit;
	}


	switch ($monitor) {
		case 1:
			# output image path from session variable
			echo '<img src="wcma_monitor_1/' . $_SESSION["MONITOR_1"] . '" alt="" title="" />';
			break;
		case 2:
			# output image path from session variable
			echo '<img src="wcma_monitor_2/' . $_SESSION["MONITOR_2"] . '" alt="" title="" />';
			break;
		case 3:
			# output image path from session variable
			echo '<img src="wcma_monitor_3/' . $_SESSION["MONITOR_3"] . '" alt="" title="" />';
			break;
		default:
			echo "error";
			break;
	}

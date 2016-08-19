<?php

	// ***************************
	// set variables
	// ***************************
	$debug = FALSE;

	// debugging output
	if ($debug) {
		echo "<h2>show input from iPad</h2>";
		echo "<pre>";
		print_r($_REQUEST);
		echo "</pre>";
	}

	// ***************************
	// basic security
	// ***************************
	// require only expected image extension, else abort
	if (!preg_match("/.jpg|.png/i", $_REQUEST["monitor_1"])) {
		display_error("Unexpected value received. exiting.");
		exit;
	}
	if (!preg_match("/.jpg|.png/i", $_REQUEST["monitor_2"])) {
		display_error("Unexpected value received. exiting.");
		exit;
	}
	if (!preg_match("/.jpg|.png/i", $_REQUEST["monitor_3"])) {
		display_error("Unexpected value received. exiting.");
		exit;
	}

	// require a maximum expected string length is exceeded, else abort
	if (strlen($_REQUEST["monitor_1"]) > 100 || strlen($_REQUEST["monitor_2"]) > 100 || strlen($_REQUEST["monitor_3"]) > 100) {
		display_error("Unexpected value received. exiting.");
		exit;
	}

	// ***************************
	// Accept form values of expected format
	// Update server variables
	// todo - ADD security and paramaratize, and log values
	// todo - ADD ability to spinup additional monitors, or steps on how to add manually
	// ***************************

	// Start new or resume existing session
	session_start();
	$_SESSION["MONITOR_1"] = $_REQUEST["monitor_1"];
	$_SESSION["MONITOR_2"] = $_REQUEST["monitor_2"];
	$_SESSION["MONITOR_3"] = $_REQUEST["monitor_3"];

echo 'fish';

	$i = 4;
	$_SESSION["MONITOR_".$i] = "swim david swim";
	echo "MONITOR_4 = " . $_SESSION["MONITOR_4"] . "<br />";

	// debugging output
	if ($debug) {
		echo "<hr/><h2>Session variables:</h2>";
		echo "MONITOR_1 = " . $_SESSION["MONITOR_1"] . "<br />";
		echo "MONITOR_2 = " . $_SESSION["MONITOR_2"] . "<br />";
		echo "MONITOR_3 = " . $_SESSION["MONITOR_3"] . "<br />";
	}


<?php
	/**
	 * Project: Gallery Displays
	 * Purpose: Enable one or more monitors to update their display with independent content based on user choices
	 * Purpose: Super easy to add new, distinct exhibitions in other locations
	 * Instructions: see 0_readme.txt
	 * Author: David Keiser-Clark, Williams College
	 */


	require_once(dirname(__FILE__) . '/app_setup.php');


	// TODO
	// Every X seconds, retrieve image for this monitor based on url querystring and previously updated session variables
	// instructions needed on how to add additional monitors (shell script to create new files
	// array to set how many monitors (config file)
	// logs - create logs of files chosen per each monitor_x.php file
	// define root path for server usage
	// update 0_readme.txt
	// sync multiple monitors to run "updates" based on time of webserver (or Atomic Clock) to have all in same rotation pattern
	// - THIS ONE: http://stackoverflow.com/questions/9254730/get-current-time-of-webserver
	// -
	// - https://www.experts-exchange.com/questions/21731051/Trying-to-get-Atomic-Time-via-PHP-or-Javascript.html
	// - maybe wait until seconds reach 00 (once, twice?), or: how long does it take to push restart on 5 Chrome Stick monitors?
	// - http://www.kloth.net/software/timesrv1.php
	// REMOVE unused code from util.php
	// TODO - use db_linked.class.php and convert procedural to oop classes

	require_once("util.php");

	// ***************************
	// CONFIG VALUES
	// ***************************
	define('DELAY_SECONDS', 3);

	// required: querystring value
	if ((isset($_REQUEST['monitor'])) && (is_numeric($_REQUEST['monitor']) && ($_REQUEST['monitor'] > 0))) {
		$gallery_display = $_REQUEST['monitor'];
		// echo "monitor_id = " . $gallery_display; exit; // debugging
	}
	else {
		// need to identify this monitor from available options
		header("location: 1_identify_monitor.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo LANG_APP_NAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo LANG_APP_NAME; ?>">
	<meta name="author" content="<?php echo LANG_AUTHOR_NAME; ?>">
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="7200"> <!-- refresh the whole thing every 2 hours to pick up any structural changes -->
	<!-- CSS: Framework -->
	<!-- CSS: Plugins -->
	<link rel="stylesheet" href="<?php echo PATH_JQUERYUI_CSS; ?>" />
	<link rel="stylesheet" href="<?php echo APP_ROOT_PATH; ?>/css/custom.css" type="text/css" media="all">
	<!-- jQuery: Framework -->
	<script src="<?php echo PATH_JQUERY_JS; ?>"></script>
	<!-- jQuery: Plugins -->
	<!-- local JS -->

	<script>
		$(window).resize(function () {
			if ((window.fullScreen) || (window.innerWidth == screen.width && window.innerHeight == screen.height)) {
				$("html").css("overflow", "hidden");
			}
			else {
				$("html").css("overflow", "auto");
			}
		});

		$(document).ready(function () {
			// trigger the function when the page loads
			$(window).resize();

			// force ajax to fetch new image from server every X seconds, if one exists
			function fetchImage() {
				$('#showImage').load('fetch_image.php?monitor=<?php echo $gallery_display; ?>', function () {
					$(this).unwrap();
				});
			}

			var delay_seconds_as_ms = <?php echo DELAY_SECONDS;?> *
			1000;
			setInterval(fetchImage, delay_seconds_as_ms);
		});
	</script>
</head>
<body>
<?php
	// ***************************
	// image content
	// ***************************
	echo "<div id=\"showImage\"></div>";
?>
</body>
</html>

<?php
	/**
	 * Project: Gallery Displays
	 * Purpose: Enable one or more monitors to update their display with independent content based on user choices
	 * Purpose: Super easy to add new, distinct exhibitions in other locations
	 * Instructions: see readme.txt
	 * Author: David Keiser-Clark, Williams College
	 */


	require_once(dirname(__FILE__) . '/app_setup.php');


	// ***************************
	// set variables
	// ***************************
	define('DELAY_SECONDS', 3);


	// required: querystring value
	if ((isset($_REQUEST['id'])) && (is_numeric($_REQUEST['id']) && ($_REQUEST['id'] > 0))) {
		$monitor_id = $_REQUEST['id'];
		if (DEBUG_APP) {
			echo "index.php: monitor_id = " . $monitor_id;
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
		//
		$(window).resize(function () {
			if ((window.fullScreen) || (window.innerWidth == screen.width && window.innerHeight == screen.height)) {
				// fullscreen mode: hide the scrollbars
				$("html").css("overflow", "hidden");
			}
			else {
				// not fullscreen: show scrollbars as per usual
				$("html").css("overflow", "auto");
			}
		});

		$(document).ready(function () {
			// trigger the function when the page loads
			$(window).resize();

			// load new image from server every X seconds, if one exists
			function fetchImage() {
				$('#showImage').load('fetch_image.php?id=<?php echo $monitor_id; ?>', function () {
					$(this).unwrap();
				});
			}

			// set delay interval as milliseconds
			var delay_seconds_as_ms = <?php echo DELAY_SECONDS;?> *
			1000;
			setInterval(fetchImage, delay_seconds_as_ms);
		});
	</script>
</head>
<body>
<?php
	// show image content
	echo "<div id=\"showImage\"></div>";
?>
</body>
</html>

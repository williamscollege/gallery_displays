<?php
	/**
	 * Project: Gallery Displays
	 * Purpose: File Overview
	 * Documentation:
	 * 1) This application expects the following name-value pairs to be submitted as a single form.
	 * 2) The hidden INPUT NAME must exactly match the image subdirectory name.
	 * ** standard format: "gallery_monitor_number" (examples: sawyer_monitor_1, sawyer_monitor_2, wcma_monitor_1, wcma_monitor_2, wcma_monitor_3)
	 * ** the gallery name is derrived from the format above.
	 * ** you must use underscores in your images subdirectory names
	 * ** the trailing value of your images subdirectory names must be an integer (a number)
	 * 3) The hidden INPUT VALUE must be the filename (including extension) of the requested image
	 * ** standard format: "image_filename.extension" (examples: c-starwars-2.jpg, Yoda_SWSB.png)
	 * Author: David Keiser-Clark, Williams College
	 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gallery Displays</title>
	<style type="text/css">
		.simulation_div_outer {
			width: 100%;
			height: 220px;
			padding: 10px;
			border: solid black 1px;
		}

		.simulation_div_inner {
			width: 25%;
			float: left;
		}

		h3 {
			margin: 0;
		}
	</style>
</head>
<body>
<!-- DEMO #1 -->
<form name="demo1" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="wcma_monitor_1" value="20140808-OUTDOORS-slide-33A9-superJumbo.jpg" />
	<input type="hidden" name="wcma_monitor_2" value="c-starwars-2.jpg" />
	<input type="hidden" name="wcma_monitor_3" value="ELLIS-1-obit-superJumbo.jpg" />

	<div class="simulation_div_outer">
		<h3>WCMA iPad demo #1</h3>
		<div class="simulation_div_inner">
			<p align="center"><input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large" /></p>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_1</strong><br />
			<img src="images/wcma_monitor_1/20140808-OUTDOORS-slide-33A9-superJumbo.jpg" alt="" title="" width="100" /><br />
			<small>20140808-OUTDOORS-slide-33A9-superJumbo.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_2</strong><br />
			<img src="images/wcma_monitor_2/c-starwars-2.jpg" alt="" title="" width="100" /><br />
			<small>c-starwars-2.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_3</strong><br />
			<img src="images/wcma_monitor_3/ELLIS-1-obit-superJumbo.jpg" alt="" title="" width="100" /><br />
			<small>ELLIS-1-obit-superJumbo.jpg</small>
		</div>
	</div>
</form>

<!-- DEMO #2 -->
<form name="demo2" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="wcma_monitor_1" value="c-starwars-2.jpg" />
	<input type="hidden" name="wcma_monitor_2" value="JamesMacGregorBurns-Home-WtownMA.jpg" />
	<input type="hidden" name="wcma_monitor_3" value="motivational_Moraine_Lake_BIG.jpg" />

	<div class="simulation_div_outer">
		<h3>WCMA iPad demo #2</h3>
		<div class="simulation_div_inner">
			<p align="center"><input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large" /></p>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_1</strong><br />
			<img src="images/wcma_monitor_1/c-starwars-2.jpg" alt="" title="" width="100" /><br />
			<small>c-starwars-2.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_2</strong><br />
			<img src="images/wcma_monitor_2/JamesMacGregorBurns-Home-WtownMA.jpg" alt="" title="" width="100" /><br />
			<small>JamesMacGregorBurns-Home-WtownMA.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_3</strong><br />
			<img src="images/wcma_monitor_3/motivational_Moraine_Lake_BIG.jpg" alt="" title="" width="100" /><br />
			<small>motivational_Moraine_Lake_BIG.jpg</small>
		</div>
	</div>
</form>

<!-- DEMO #3 -->
<form name="demo3" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="wcma_monitor_1" value="nyc.jpg" />
	<input type="hidden" name="wcma_monitor_2" value="Yoda_SWSB.png" />
	<input type="hidden" name="wcma_monitor_3" value="uyuni-bolivia-train-graveyard-infinitahighway-br-getty.jpg" />

	<div class="simulation_div_outer">
		<h3>WCMA iPad demo #3</h3>
		<div class="simulation_div_inner">
			<p align="center"><input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large" /></p>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_1</strong><br />
			<img src="images/wcma_monitor_1/nyc.jpg" alt="" title="" width="100" /><br />
			<small>nyc.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_2</strong><br />
			<img src="images/wcma_monitor_2/Yoda_SWSB.png" alt="" title="" width="100" /><br />
			<small>Yoda_SWSB.png</small>
		</div>
		<div class="simulation_div_inner">
			<strong>wcma_monitor_3</strong><br />
			<img src="images/wcma_monitor_3/uyuni-bolivia-train-graveyard-infinitahighway-br-getty.jpg" alt="" title="" width="100" /><br />
			<small>uyuni-bolivia-train-graveyard-infinitahighway-br-getty.jpg</small>
		</div>
	</div>
</form>


<!-- DEMO #4 -->
<form name="demo4" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="sawyer_monitor_1" value="bulldozer_b.jpg" />
	<input type="hidden" name="sawyer_monitor_2" value="wall_fellowship_1280.jpg" />

	<div class="simulation_div_outer">
		<h3>Sawyer iPad demo #4</h3>
		<div class="simulation_div_inner">
			<p align="center"><input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large" /></p>
		</div>
		<div class="simulation_div_inner">
			<strong>sawyer_monitor_1</strong><br />
			<img src="images/sawyer_monitor_1/bulldozer_b.jpg" alt="" title="" width="100" /><br />
			<small>bulldozer_b.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<strong>sawyer_monitor_2</strong><br />
			<img src="images/sawyer_monitor_2/wall_fellowship_1280.jpg" alt="" title="" width="100" /><br />
			<small>wall_fellowship_1280.jpg</small>
		</div>
	</div>
</form>

<!-- DEMO #5 -->
<form name="demo5" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="sawyer_monitor_1" value="summer005.sJPG_950_2000_0_75_0_50_50.jpg" />
	<input type="hidden" name="sawyer_monitor_2" value="wisscasset-maine.jpg" />

	<div class="simulation_div_outer">
		<h3>Sawyer iPad demo #5</h3>
		<div class="simulation_div_inner">
			<p align="center"><input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large" /></p>
		</div>
		<div class="simulation_div_inner">
			<strong>sawyer_monitor_1</strong><br />
			<img src="images/sawyer_monitor_1/summer005.sJPG_950_2000_0_75_0_50_50.jpg" alt="" title="" width="100" /><br />
			<small>summer005.sJPG_950_2000_0_75_0_50_50.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<strong>sawyer_monitor_2</strong><br />
			<img src="images/sawyer_monitor_2/wisscasset-maine.jpg" alt="" title="" width="100" /><br />
			<small>wisscasset-maine.jpg</small>
		</div>
	</div>
</form>

</body>
</html>

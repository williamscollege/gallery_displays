<?php
	/**
	 * Project: Gallery Displays
	 * Purpose: File Overview
	 * Documentation:
	 * 1) This application expects the following name-value pairs to be submitted as a single form.
	 * 2) The hidden INPUT NAME must exactly match the image subdirectory name.
	 * ** standard format: "gallery_monitor_number" (examples: sawyer_monitor_1, sawyer_monitor_2, demo_monitor_1, demo_monitor_2, demo_monitor_3)
	 * ** the gallery name is derrived from the format above.
	 * ** you must use underscores in your images subdirectory names
	 * ** the trailing value of your images subdirectory names must be an integer (a number)
	 * ** a separate thumbnails directory exists if you want to place thumbnails (i.e. for your ios app) online
	 * 3) The hidden INPUT VALUE must be the filename (including extension) of the requested image
	 * ** standard format: "image_filename.extension" (examples: 62_91.jpg, 62_32_17_F_b.jpg)
	 * Author: David Keiser-Clark, Williams College
	 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gallery Displays</title>
	<style type="text/css">
		body {
			margin: 5px;
			padding: 0;
			background-color: #8AB840;
		}

		.simulation_div_outer {
			width: 100%;
			height: 160px;
			padding: 10px;
			border: solid black 1px;
			background-color: whitesmoke;
		}

		.simulation_div_inner {
			width: 16%;
			float: left;
		}

		h3 {
			margin: 0;
		}
	</style>
</head>
<body>
<h1>DEMO: Accesson Number Project</h1>

<form name="demo1" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="demo_monitor_1" value="62_91.jpg" />
	<input type="hidden" name="demo_monitor_2" value="62_91.jpg" />
	<input type="hidden" name="demo_monitor_3" value="60_36_2_a.jpg" />
	<input type="hidden" name="demo_monitor_4" value="60_33_J.jpg" />
	<input type="hidden" name="demo_monitor_5" value="60_33_J.jpg" />

	<div class="simulation_div_outer">
		<div class="simulation_div_inner">
			<h3>iPad demo: DEMO</h3><br />
			<p align="center">
				<input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large; background-color: deeppink;" /></p>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_1</em><br />
			<img src="thumbnails/demo/62_91.jpg" /><br />
			<small>62_91.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_2</em><br />
			<img src="thumbnails/demo/62_91.jpg" /><br />
			<small>62_91.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_3</em><br />
			<img src="thumbnails/demo/60_36_2_a.jpg" /><br />
			<small>60_36_2_a.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_4</em><br />
			<img src="thumbnails/demo/60_33_J.jpg" /><br />
			<small>60_33_J.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_5</em><br />
			<img src="thumbnails/demo/60_33_J.jpg" /><br />
			<small>60_33_J.jpg</small>
		</div>
	</div>
</form>

<form name="demo2" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="demo_monitor_1" value="60_33_J.jpg" />
	<input type="hidden" name="demo_monitor_2" value="60_33_J.jpg" />
	<input type="hidden" name="demo_monitor_3" value="60_39_2_C_a.jpg" />
	<input type="hidden" name="demo_monitor_4" value="60_39_4_a.jpg" />
	<input type="hidden" name="demo_monitor_5" value="62_32_17_F_b.jpg" />

	<div class="simulation_div_outer">
		<div class="simulation_div_inner">
			<h3>iPad demo: DEMO</h3><br />
			<p align="center">
				<input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large; background-color: deeppink;" /></p>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_1</em><br />
			<img src="thumbnails/demo/60_33_J.jpg" /><br />
			<small>60_33_J.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_2</em><br />
			<img src="thumbnails/demo/60_33_J.jpg" /><br />
			<small>60_33_J.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_3</em><br />
			<img src="thumbnails/demo/60_39_2_C_a.jpg" /><br />
			<small>60_39_2_C_a.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_4</em><br />
			<img src="thumbnails/demo/60_39_4_a.jpg" /><br />
			<small>60_39_4_a.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_5</em><br />
			<img src="thumbnails/demo/62_32_17_F_b.jpg" /><br />
			<small>62_32_17_F_b.jpg</small>
		</div>
	</div>
</form>

<form name="demo3" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="demo_monitor_1" value="60_39_4_a.jpg" />
	<input type="hidden" name="demo_monitor_2" value="62_32_17_F_b.jpg" />
	<input type="hidden" name="demo_monitor_3" value="60_33_F.jpg" />
	<input type="hidden" name="demo_monitor_4" value="62_91.jpg" />
	<input type="hidden" name="demo_monitor_5" value="62_91.jpg" />

	<div class="simulation_div_outer">
		<div class="simulation_div_inner">
			<h3>iPad demo: DEMO</h3><br />
			<p align="center">
				<input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large; background-color: deeppink;" /></p>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_1</em><br />
			<img src="thumbnails/demo/60_39_4_a.jpg" /><br />
			<small>60_39_4_a.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_2</em><br />
			<img src="thumbnails/demo/62_32_17_F_b.jpg" /><br />
			<small>62_32_17_F_b.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_3</em><br />
			<img src="thumbnails/demo/60_33_F.jpg" /><br />
			<small>60_33_F.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_4</em><br />
			<img src="thumbnails/demo/62_91.jpg" /><br />
			<small>62_91.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>demo_monitor_5</em><br />
			<img src="thumbnails/demo/62_91.jpg" /><br />
			<small>62_91.jpg</small>
		</div>
	</div>
</form>

<h1>Sawyer CET: People, Places and Things</h1>

<form name="sawyer1" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="sawyer_monitor_1" value="bulldozer_b.jpg" />
	<input type="hidden" name="sawyer_monitor_2" value="motivational_Moraine_Lake.jpg" />
	<input type="hidden" name="sawyer_monitor_3" value="Mo-20141118-lens-reynolds.jpg" />

	<div class="simulation_div_outer">
		<div class="simulation_div_inner">
			<h3>iPad demo: Sawyer</h3><br />
			<p align="center">
				<input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large; background-color: deeppink;" /></p>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_1</em><br />
			<img src="thumbnails/sawyer/bulldozer_b.jpg" /><br />
			<small>bulldozer_b.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_2</em><br />
			<img src="thumbnails/sawyer/motivational_Moraine_Lake.jpg" /><br />
			<small>motivational_Moraine_Lake.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_3</em><br />
			<img src="thumbnails/sawyer/Mo-20141118-lens-reynolds.jpg" /><br />
			<small>Mo-20141118-lens-reynolds.jpg</small>
		</div>
	</div>
</form>

<form name="sawyer2" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="sawyer_monitor_1" value="summer005.s.jpg" />
	<input type="hidden" name="sawyer_monitor_2" value="wisscasset-maine.jpg" />
	<input type="hidden" name="sawyer_monitor_3" value="motivational_Moraine_Lake.jpg" />

	<div class="simulation_div_outer">
		<div class="simulation_div_inner">
			<h3>iPad demo: Sawyer</h3><br />
			<p align="center">
				<input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large; background-color: deeppink;" /></p>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_1</em><br />
			<img src="thumbnails/sawyer/summer005.s.jpg" /><br />
			<small>summer005.s.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_2</em><br />
			<img src="thumbnails/sawyer/wisscasset-maine.jpg" /><br />
			<small>wisscasset-maine.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_3</em><br />
			<img src="thumbnails/sawyer/motivational_Moraine_Lake.jpg" /><br />
			<small>motivational_Moraine_Lake.jpg</small>
		</div>
	</div>
</form>

<form name="sawyer3" action="process_requests.php" method="post" style="padding: 5px;">
	<input type="hidden" name="sawyer_monitor_1" value="earth-eaters-europe-Germany3.jpg" />
	<input type="hidden" name="sawyer_monitor_2" value="earth-eaters-europe-Germany4.jpg" />
	<input type="hidden" name="sawyer_monitor_3" value="uyuni-bolivia-train-graveyard-getty.jpg" />

	<div class="simulation_div_outer">
		<div class="simulation_div_inner">
			<h3>iPad demo: Sawyer</h3><br />
			<p align="center">
				<input type="submit" id="submit_button" value="Submit" style="font-weight: bold; font-size: xx-large; background-color: deeppink;" /></p>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_1</em><br />
			<img src="thumbnails/sawyer/earth-eaters-europe-Germany3.jpg" /><br />
			<small>earth-eaters-europe-Germany3.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_2</em><br />
			<img src="thumbnails/sawyer/earth-eaters-europe-Germany4.jpg" /><br />
			<small>earth-eaters-europe-Germany4.jpg</small>
		</div>
		<div class="simulation_div_inner">
			<em>sawyer_monitor_3</em><br />
			<img src="thumbnails/sawyer/uyuni-bolivia-train-graveyard-getty.jpg" /><br />
			<small>uyuni-bolivia-train-graveyard-getty.jpg</small>
		</div>
	</div>
</form>

</body>
</html>

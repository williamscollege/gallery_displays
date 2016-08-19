<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gallery Displays</title>
</head>
<body>

<!--
	Documentation: Expected form values
	- image file name
	- IGNORE - output device type: (monitor, ipad, mobile)
	- IGNORE - image orientation (horizontal, vertical)
-->

<form action="4_process_requests.php" method="post">
	<input type="hidden" name="monitor_1" value="20140808-OUTDOORS-slide-33A9-superJumbo.jpg|" /><br />
	<input type="hidden" name="monitor_2" value="c-starwars-2.jpg" /><br />
	<input type="hidden" name="monitor_3" value="ELLIS-1-obit-superJumbo.jpg" /><br />

	<div style="width: 500px; height: 300px; padding:25px; border: solid black 1px;">
		<h2>Mock iPad: user A submits selections</h2>
		<div style="width: 150px; float: left">
			<strong>monitor 1</strong><br />
			<img src="images/wcma_monitor_1/20140808-OUTDOORS-slide-33A9-superJumbo.jpg" alt="" title="" width="100" /><br />
			20140808-OUTDOORS-slide-33A9-superJumbo.jpg
		</div>
		<div style="width: 150px; float: left">
			<strong>monitor 2</strong><br />
			<img src="images/wcma_monitor_2/c-starwars-2.jpg" alt="" title="" width="100" /><br />
			c-starwars-2.jpg
		</div>
		<div style="width: 150px; float: left">
			<strong>monitor 3</strong><br />
			<img src="images/wcma_monitor_3/ELLIS-1-obit-superJumbo.jpg" alt="" title="" width="100" /><br />
			ELLIS-1-obit-superJumbo.jpg
		</div>
	</div>
	<div style="width: 600px;  height: 100px; clear: both;">
		<p align="center"><input type="submit" id="submit_button" value="Submit" /></p>
	</div>
</form>

</body>
</html>

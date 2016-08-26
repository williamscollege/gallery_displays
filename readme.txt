TODO 1) REMOVE unused code from util.php

TODO 2) sync multiple monitors to run "updates" based on time of webserver (or Atomic Clock) to have all in same rotation pattern OR use small time frame as refresh integer
 - THIS ONE: http://stackoverflow.com/questions/9254730/get-current-time-of-webserver
 - https://www.experts-exchange.com/questions/21731051/Trying-to-get-Atomic-Time-via-PHP-or-Javascript.html
 - maybe wait until seconds reach 00 (once, twice?), or: how long does it take to push restart on 5 Chrome Stick monitors?
 - http://www.kloth.net/software/timesrv1.php

-----------------------------------
Summary
-----------------------------------

User Proofing (Pretty Failsafes)
	-
	fullscreen view includes:
	- scrollbars are hidden
	- cursor is hidden
	- images display no hover information (alt/title)

Image Preparation

	Image Folders
	- Standard naming and sizes

Requirements
	- mysql database named 'gallery_displays'. (the script will create the database)
	- configuration settings: authentication.cfg.php
	- web server and permission to create new image subdirectories and upload images
	- Chrome Sticks: plus one USB keyboard (Apple keyboards have a handy USB port for a USB mouse) to configure your Chrome Sticks
	- monitors or ipads or any kind of device that has an Internet connection (vertical or horizontal)



-----------------------------------
Gallery Displays
-----------------------------------
	This application enables any number of monitors to display content based on continuously updated user submissions.
	Images can be displayed in Full Screen mode with any sized monitor in any orientation.
	For setup, just put your desired output images into the corresponding monitor-images-# folder.

	Originally designed for use in a museum exhibition gallery, it could also be used in other environments including:
	weather or energy usage data display, athletic department photo streams, information technology or computer science displays.


-----------------------------------
Image Preparation
-----------------------------------
	Resolution of each image should match, exactly, the monitor it will be displayed on. Example: 1920px by 1080px, 1080px by 1920px
	Each gallery image folder will correspond to a monitor within that gallery
	Image folder naming convention: gallery_monitor_number
	Examples:
		sawyer_monitor_1
		sawyer_monitor_2
		wcma_monitor_1
		wcma_monitor_2
		wcma_monitor_3
	Images must be one of the following types: .jpg|.png|.gif

	 * Documentation:
	 * 1) This application expects the following name-value pairs to be submitted as a single form.
	 * 2) The hidden INPUT NAME must exactly match the image subdirectory name.
	 * ** standard format: "gallery_monitor_number" (examples: sawyer_monitor_1, sawyer_monitor_2, wcma_monitor_1, wcma_monitor_2, wcma_monitor_3)
	 * ** the gallery name is derrived from the format above.
	 * ** you must use underscores in your images subdirectory names
	 * ** the trailing value of your images subdirectory names must be an integer (a number)
	 * ** a separate thumbnails directory exists if you want to place thumbnails (i.e. for your ios app) online
	 * 3) The hidden INPUT VALUE must be the filename (including extension) of the requested image
	 * ** standard format: "image_filename.extension" (examples: c-starwars-2.jpg, Yoda_SWSB.png)


-----------------------------------
How to add (or remove) additional gallery monitors
-----------------------------------
	This application will dynamically read, write and synchronize image subdirectories to the database, and vice versa.
	This means all you have to do is add or remove image directories to match what you want to display in your gallery.


-----------------------------------
Initial Configurations to Chrome Stick OS
-----------------------------------
	Assumption: All Chrome Sticks are running on same google account name
		If yes: make the settings below on any one device and they will propagate to all devices using same google account name
		If not: you will need to do the steps below on each Chrome Stick, as each will have its own distinct google account name

	Settings: Advanced: On startup: Select "Open a specific page or set of pages"
		URL = https://apps.williams.edu/gallery_displays/

		This base url will automatically:
			- sync db with directory scan of images folder
			- enable the setup person (ie security guard) to identify each monitor from a list of available options

	How to disable default Chrome OS Sleep Mode
		Add app "Keep Awake" and set to "Sun" mode to enable monitor and OS to remain awake at all times

	How to enable vertical monitor display orientation with a Chrome Stick:
		Right click on your picture. Select Settings: Device: Device Settings: Manage Displays: Orientation: 270 degrees

-----------------------------------
Maintenance
-----------------------------------
	Monitor should have HDMI port with Chrome Stick plugged in, and both connected to power source.
	Plug in USB keyboard/mouse into bottom of Chrome Stick
	Enter Google account credentials
	Open Chrome
	Press F11 to enter full-screen mode
		(Windows keyboard: F11 key)
		(Mac keyboard: fn + F11 key)

-----------------------------------
How to add another monitor and related images
-----------------------------------


-----------------------------------
General Information
-----------------------------------
- written in PHP using object oriented programming, PDO, and a tiny MySQL backend database
- detailed log files based on user actions, both submissions and trapped errors
- log files include submitted form (JSON), filepath, and browser information

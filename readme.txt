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
	Resolution of each image should match, exactly, the monitor it will be displayed on.
	Each gallery image folder will correspond to a monitor within that gallery
	Image folder naming convention: gallery_monitor_number
	Examples:
		sawyer_monitor_1
		sawyer_monitor_2
		wcma_monitor_1
		wcma_monitor_2
		wcma_monitor_3
	Images must be one of the following types: .jpg|.png|.gif


-----------------------------------
How to add additional gallery monitors
-----------------------------------


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




# Gallery Displays

#### AUTHORS
* Web application, database: David Keiser-Clark (dwk2@williams.edu), Office for Information Technology, Williams College
* IOS application: Duane Bailey, Professor of Computer Science (bailey@williams.edu), Williams College

## SCREENSHOT
* TODO: Add photos after installation
* [Gallery Displays: view screenshot](http://www.screencast.com/ "Gallery Displays")

## DESCRIPTION
Enable a guest to select images from an iPad and display them on any number of display monitors mounted in an exhibition gallery. 
The web application processes the iPad's HTTPS posts, logs them to a database (say: "analytics") and queues images to display on their respective monitors.
HDMI-enabled monitors are powered by tiny Chromebits.
This may be used in a museum exhibition gallery, to display photo streams or random slideshows from fixed urls.
An easy future expansion could be to include the ability to display sequential photo streams or random slideshows. 
Possible uses: museum gallery exhibitions, weather or energy data usage displays, athletic photo streams, library displays, etc.

#### FEATURES
* Enable a person to select images from an iPad and display them on any number of display monitors mounted in the exhibition gallery
* The iPad app is called ______ and it displays a faceted image thumbnail gallery
* Images are displayed in Full Screen mode on any size of monitor in portrait or landscape mode
* Additional galleries or monitors are easily added, or removed, from the exhibition
* Full Screen mode enables scrollbars and cursor to remain hidden and images display no hover information (alt, title)
* Prevent Chromebit from entering Power Save mode by installing "Keep Awake" Chrome app
* Throttle monitor refresh to occur at desired rate (i.e. every 3 seconds)
* Web application logs submissions (monitor/image groups (stored as JSON), filepath, browser information, and datetime stamp) plus any trapped errors
* Web application includes a debug mode, simply goto authentication.cfg.php file, set: DEBUG_APP = TRUE;
* Web application: PHP with classes (OOP), abstracted PDO, configuration file, MySQL database
* IOS application includes ...
* TODO: Create galleries.delay_seconds integer field with default=3. Change manually; would enable different galleries to have independent refresh rates
* TODO: Create galleries.display_mode (user or random) varchar(255) field with default='user'. Change manually; would enable different display modes

#### SECURITY GUARDS: HOW TO RESET MONITORS
* Turn on power source for monitor and attached Chromebit
* Insert USB keyboard/mouse into ASUS Chromebit Stick
* Sign in to your Chromebit with Google password (defaults to previously used account)
* Open Chrome browser: Click on bookmark "Gallery Displays"
* Browser: Identify this monitor by clicking the corresponding link below
* Browser: Enable Full Screen mode: Windows keyboard: F11 key; Mac keyboard: fn + F11 keys

#### SETUP: IMAGES/FOLDERS
* Server: Create subdirectories on server in "/images/" folder to correspond with monitors, using naming convention: "gallery_monitor_number"
* Requirement: subdirectory names must use underscores to separate the gallery name and the monitor number (integer)
* Examples: demo_monitor_1, demo_monitor_2, demo_monitor_3, sawyer_monitor_1, sawyer_monitor_2, sawyer_monitor_3
* Photoshop: Image prep: Crop images to exactly fit their intended monitor. Allowable image types: .jpg|.png|.gif
* Example for horizontal orientation: 1920px by 1080px (72dpi). Example for vertical orientation: 1080px by 1920px (72dpi)
* Thumbnail images: a separate "/thumbnails/" subdirectory exists for your ios app; no requirements exist for this directory or contained images
* Server: Upload images to each subdirectory; ensure that the image orientation matches the monitor orientation
* The web application will dynamically read, write and synchronize image subdirectories to the database, and vice versa
* You simply add or remove image directories and the web application will list them as available gallery monitors

#### INITIAL SETUP: WEBSITE
* Upload "/gallery_displays/" directory to your host server
* Update configuration settings: authentication.cfg.php

#### INITIAL SETUP: DATABASE
* Install Database: Run the included MySQL script "/db_setup/schema_gallery_displays.sql" to create the database, tables, fields, indexes

#### INITIAL SETUP: CHROMEBIT
* Insert ASUS Chromebit Stick into monitor's HDMI port
* Turn on power source for monitor and attached Chromebit
* Insert USB keyboard/mouse into ASUS Chromebit Stick
* Chrome OS Setup: Select a network. Continue.
* Sign in to your Chromebit with Google username/password (TIP: use same Google account for each Chromebit to propagate browser settings to Chromebits)
* Right-click on lower left of desktop to open Settings
* Settings: Disable Bluetooth
* Settings: Device: Device Settings: Manage Displays: Orientation: X degrees (Standard=Horizontal, 270=Vertical)
* Settings: Show advanced settings: On startup: Select "Open a specific page or set of pages": Set pages: https://www.institution.edu/gallery_displays/
* Close Settings
* Open Chrome browser: If a bookmark does not already exist for the default page, create one for the security guards; name the bookmark "Gallery Displays"
* Browser: Install "Keep Awake" app from Chrome Web Store, set to "Sun" mode to enable Chromebit to remain awake (default: sleep = 10 minutes)
* Note: You may need to enable this app on each Chromebit device
* Browser: Identify this monitor by clicking the corresponding link below
* Browser: Enable Full Screen mode: Windows keyboard: F11 key; Mac keyboard: fn + F11 keys

#### VIEW DEMO
* Follow the setup above; set your gallery monitors from one of the two provided default galleries
* Using a smartphone, go to: https://www.institution.edu/gallery_displays/simulation.php
* This page is a "simulation" of how the IOS app works, after a user had selected their images and is then ready to submit them to the server
* Press the corresponding submit button; your monitors should update to reflect this submission

#### IOS APP (EXPECTED VALUES)
* The web application expects "process_requests.php" to receive an array of name/value pairs sent from the IOS App as HTTP Request variables
* Requirement: The INPUT NAME must exactly match the targeted image subdirectory, and the value must match an existing image
* Example:
* &lt;form action="https://www.institution.edu/gallery_displays/process_requests.php" method="post" &gt;
* &lt;input type="hidden" name="demo_monitor_1" value="60_39_4_a.jpg" /&gt;
* &lt;input type="hidden" name="demo_monitor_2" value="62_32_17_F_b.jpg" /&gt;
* &lt;input type="hidden" name="demo_monitor_3" value="60_33_F.jpg" /&gt;

#### SERVER DEPENDENCIES
* install: Apache, PHP 5.2 (or higher), MySQL 5x, phpMyAdmin, emacs
* enable PHP modules: PDO, curl, mbyte, dom
* access: sudo access, mysql root access

#### HARDWARE DEPENDENCIES
* ASUS Chromebit Sticks
* WiFi Internet connection
* HDMI monitors
* Two electrical outlets per monitor: one for the monitor, one for the Chromebit
* One USB keyboard with USB port (i.e. Mac keyboard) for mouse to access your Chromebits is handy

#### LICENSE
* Copyright (c) 2016 David Keiser-Clark
* Dual licensed under the MIT and GPL licenses.
* Free as in Bacon.

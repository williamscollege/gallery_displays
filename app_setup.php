<?php
	session_start();

	require_once(dirname(__FILE__) . '/authentication.cfg.php');
	require_once(dirname(__FILE__) . '/lang.cfg.php');
	require_once(dirname(__FILE__) . '/classes/ALL_CLASS_INCLUDES.php');
	require_once(dirname(__FILE__) . '/util.php');

	// Create database connection object
	$DB = util_createDbConnection();


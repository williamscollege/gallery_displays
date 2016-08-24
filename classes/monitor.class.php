<?php
	require_once(dirname(__FILE__) . '/db_linked.class.php');

	class Monitor extends Db_Linked {
		public static $fields = array('monitor_id', 'gallery_id', 'monitor_name', 'image_filename', 'created_at', 'updated_at', 'flag_delete');
		public static $primaryKeyField = 'monitor_id';
		public static $dbTable = 'monitors';
		public static $entity_type_label = 'monitor';


		public function __construct($initsHash) {
			parent::__construct($initsHash);

			// now do custom stuff
			// e.g. automatically load all accessibility info associated with this object
			// $this->flag_workflow_published = false;
			// $this->flag_workflow_validated = false;
		}

		// static factory function to populate new object with desired base values
		public static function createNewMonitor($dbConnection) {
			return new Monitor([
				'monitor_id'   => 'NEW',
				'gallery_id'   => 0,
				'monitor_name' => '',
				'image_filename' => '',
				'created_at'   => util_currentDateTimeString_asMySQL(),
				'updated_at'   => NULL,
				'flag_delete'  => 0,
				'DB'           => $dbConnection
			]);
		}

//		public function clearCaches() {
//
//		}

		/* static functions */

		public static function cmp($a, $b) {
			if ($a->monitor_name == $b->monitor_name) {
				if ($a->monitor_name == $b->monitor_name) {
					return 0;
				}
				return ($a->monitor_name < $b->monitor_name) ? -1 : 1;
			}
			return ($a->monitor_name < $b->monitor_name) ? -1 : 1;
		}


		/* public functions */
/*
		// cache provides data while eliminating unnecessary DB calls
		public function cacheImages() {
			if (!$this->images) {
				$this->loadImages();
			}
		}

		// load explicitly calls the DB (generally called indirectly from related cache fxn)
		public function loadImages() {
			$this->images = [];
			$this->images = Image::getAllFromDb(['monitor_id' => $this->monitor_id], $this->dbConnection);
			usort($this->images, 'Image::cmp');
		}*/

	}

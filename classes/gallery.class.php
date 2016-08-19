<?php
	require_once(dirname(__FILE__) . '/db_linked.class.php');

	class Gallery extends Db_Linked {
		public static $fields = array('gallery_id', 'gallery_name', 'created_at', 'updated_at', 'flag_delete');
		public static $primaryKeyField = 'gallery_id';
		public static $dbTable = 'galleries';
		public static $entity_type_label = 'gallery';


		public $monitors;

		public function __construct($initsHash) {
			parent::__construct($initsHash);

			// now do custom stuff
			// e.g. automatically load all accessibility info associated with this object
			// $this->flag_workflow_published = false;
			// $this->flag_workflow_validated = false;

			$this->refreshFromDb();
			$this->monitors          = array();
		}

		// static factory function to populate new object with desired base values
		public static function createNewGallery($dbConnection) {
			return new Gallery([
				'gallery_id'   => 'NEW',
				'gallery_name' => '',
				'created_at'   => util_currentDateTimeString_asMySQL(),
				'updated_at'   => util_currentDateTimeString_asMySQL(),
				'flag_delete'  => 0,
				'DB'           => $dbConnection
			]);
		}

		public function clearCaches() {
			$this->monitors = array();
		}

		/* static functions */

		public static function cmp($a, $b) {
			if ($a->gallery_name == $b->gallery_name) {
				if ($a->gallery_name == $b->gallery_name) {
					return 0;
				}
				return ($a->gallery_name < $b->gallery_name) ? -1 : 1;
			}
			return ($a->gallery_name < $b->gallery_name) ? -1 : 1;
		}


		/* public functions */

		// cache provides data while eliminating unnecessary DB calls
		public function cacheMonitors() {
			if (!$this->monitors) {
				$this->loadMonitors();
			}
		}

		// load explicitly calls the DB (generally called indirectly from related cache fxn)
		public function loadMonitors() {
			$this->monitors = [];
			$this->monitors = Monitor::getAllFromDb(['gallery_id' => $this->gallery_id], $this->dbConnection);
			usort($this->monitors, 'Monitor::cmp');
		}

	}

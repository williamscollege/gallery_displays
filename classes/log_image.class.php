<?php
	require_once(dirname(__FILE__) . '/db_linked.class.php');

	class LogImage extends Db_Linked {
		public static $fields = array('log_image_id', 'gallery_id', 'monitor_id', 'image_id', 'monitor_name', 'image_filename', 'created_at', 'flag_delete');
		public static $primaryKeyField = 'log_image_id';
		public static $dbTable = 'log_images';
		public static $entity_type_label = 'log_image';


		public function __construct($initsHash) {
			parent::__construct($initsHash);

			// now do custom stuff
			// e.g. automatically load all accessibility info associated with this object
			// $this->flag_workflow_published = false;
			// $this->flag_workflow_validated = false;

		}

		// static factory function to populate new object with desired base values
		public static function createNewLogImage($gallery_id, $monitor_id, $image_id, $monitor_name, $image_filename, $flag_delete, $dbConnection) {
			return new LogImage(['DB' => $dbConnection
				, 'gallery_id'       => $gallery_id
				, 'monitor_id'       => $monitor_id
				, 'image_id'         => $image_id
				, 'monitor_name'     => $monitor_name
				, 'image_filename'   => $image_filename
				, 'flag_delete'      => $flag_delete
				// 'user_agent_string'        => substr($_SERVER["HTTP_USER_AGENT"], 0, 990)    // truncate to avoid exceeding db field limit
			]);
		}

		public function clearCaches() {

		}

		/* static functions */

		public static function cmp($a, $b) {
			if ($a->log_image_id == $b->log_image_id) {
				if ($a->log_image_id == $b->log_image_id) {
					return 0;
				}
				return ($a->log_image_id < $b->log_image_id) ? -1 : 1;
			}
			return ($a->log_image_id < $b->log_image_id) ? -1 : 1;
		}


	}


<?php
	require_once(dirname(__FILE__) . '/db_linked.class.php');

	class Image extends Db_Linked {
		public static $fields = array('image_id', 'monitor_id', 'image_filename', 'created_at', 'updated_at', 'flag_delete');
		public static $primaryKeyField = 'image_id';
		public static $dbTable = 'images';
		public static $entity_type_label = 'image';


		public function __construct($initsHash) {
			parent::__construct($initsHash);

			// now do custom stuff
			// e.g. automatically load all accessibility info associated with this object
			// $this->flag_workflow_published = false;
			// $this->flag_workflow_validated = false;
		}

		public function clearCaches() {

		}

		/* static functions */

		public static function cmp($a, $b) {
			if ($a->monitor_id == $b->monitor_id) {
				if ($a->monitor_id == $b->monitor_id) {
					return 0;
				}
				return ($a->monitor_id < $b->monitor_id) ? -1 : 1;
			}
			return ($a->monitor_id < $b->monitor_id) ? -1 : 1;
		}


		/* public functions */

		// returns: a very basic HTML representation of the object
		/*public function renderHTML($flag_linked = FALSE) {
			$enclosed = htmlentities($this->monitor_id, ENT_QUOTES, 'UTF-8');

			if ($flag_linked) {
				$enclosed = '<img src="' . APP_ROOT_PATH . '/'. htmlentities($this->image_filename, ENT_QUOTES, 'UTF-8') . '" alt="" title="" />';
				//$enclosed = '<a href="' . APP_ROOT_PATH . '/app_code/enrollment.php?enrollment_id=' . htmlentities($this->enrollment_id, ENT_QUOTES, 'UTF-8') . '">' . $enclosed . '</a>';
			}

			return '<div class="rendered-object" data-for-image_id="' . htmlentities($this->image_id, ENT_QUOTES, 'UTF-8') . '">' . $enclosed . '</div>';
		}*/

	}

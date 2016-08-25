<?php
	require_once(dirname(__FILE__) . '/db_linked.class.php');

	class LogEvent extends Db_Linked {
		public static $fields = array('log_event_id', 'gallery_id', 'flag_success', 'event_action', 'event_note', 'event_dataset', 'event_filepath', 'user_agent_string', 'event_datetime');
		public static $primaryKeyField = 'log_event_id';
		public static $dbTable = 'log_events';
		public static $entity_type_label = 'log_event';


		public function __construct($initsHash) {
			parent::__construct($initsHash);

			// now do custom stuff
			// e.g. automatically load all accessibility info associated with this object
			// $this->flag_workflow_published = false;
			// $this->flag_workflow_validated = false;

		}

		// static factory function to populate new object with desired base values
		public static function createNewEventLog($gallery_id, $flag_success, $event_action, $event_note, $event_dataset, $dbConnection) {
			return new LogEvent(['DB' => $dbConnection
				, 'log_event_id'      => 'NEW'
				, 'gallery_id'        => $gallery_id
				, 'flag_success'      => $flag_success
				, 'event_action'      => $event_action
				, 'event_note'        => substr($event_note, 0, 1990)                   // truncate to avoid exceeding db field limit
				, 'event_dataset'     => substr($event_dataset, 0, 1990)                // truncate to avoid exceeding db field limit
				, 'event_filepath'    => substr($_SERVER["REQUEST_URI"], 0, 990)        // truncate to avoid exceeding db field limit
				, 'user_agent_string' => substr($_SERVER["HTTP_USER_AGENT"], 0, 990)    // truncate to avoid exceeding db field limit
				// , 'action_datetime'       => (new DateTime())->format('Y-m-d H:i:s')
			]);
		}

		public function clearCaches() {

		}

		/* static functions */

		public static function cmp($a, $b) {
			if ($a->log_event_id == $b->log_event_id) {
				if ($a->log_event_id == $b->log_event_id) {
					return 0;
				}
				return ($a->log_event_id < $b->log_event_id) ? -1 : 1;
			}
			return ($a->log_event_id < $b->log_event_id) ? -1 : 1;
		}


	}


<?php

namespace WP_Checklist\hook_actions;

defined( 'ABSPATH' ) || exit;

class Actions {


	protected $tasks = array();

	public function __construct() {

		$this->tasks = get_option( 'wp_ml_todo' );

	}

	protected function add_todo() {

		if ( isset( $_POST['wp_ml_todo'] ) ) {

			$todo       = $_POST['wp_ml_todo'];
			$date_added = date( 'Y-m-d' );
			$id         = date( 'ymdhis' );

			$task[ $id ] = array( $todo, $date_added, 'pending' );

			if ( ! empty( $this->tasks ) ) {
				foreach ( $this->tasks as $task_id => $meta ) {
					$task[ $task_id ] = $meta;
				}
			}

			update_option( 'wp_ml_todo', $task );
		}
	}

	protected function remove_todo() {

		if ( isset( $_GET['remove'] ) ) {

			$task_id = $_GET['task_id'];

			unset( $this->tasks[ $task_id ] );

			update_option( 'wp_ml_todo', ! empty( $this->tasks ) ? $this->tasks : '' );

			wp_safe_redirect( admin_url() );
			exit;
		}

	}

	protected function complete_todo() {

		if ( isset( $_GET['complete'] ) ) {

			$task_id = $_GET['task_id'];

			$this->tasks[ $task_id ][2] = 'completed';

			update_option( 'wp_ml_todo', $this->tasks );

			wp_safe_redirect( admin_url() );
			exit;
		}
	}
}



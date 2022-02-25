<?php

namespace WP_Checklist\hook_actions;

defined( 'ABSPATH' ) || exit;

class Actions {

	/**
	 * hold task array
	 *
	 * @var array
	 */
	protected $tasks = array();

	/**
	 * get all task on inst
	 */
	public function __construct() {

		$this->tasks = get_option( 'wp_ml_todo' ) ?: array();

	}

	/**
	 * Create new todo
	 *
	 * @return void
	 */
	protected function add_todo() {

		if ( ! isset( $_POST['wp_ml_todo'] ) ) {
			return;
		}

		$todo       = $_POST['wp_ml_todo'];
		$date_added = date( 'Y-m-d' );
		$id         = date( 'ymdhis' );

		$this->tasks[ $id ] = array( $todo, $date_added, 'pending' );

		update_option( 'wp_ml_todo', $this->tasks );
	}

	/**
	 * remove todo from array
	 *
	 * @return void
	 */
	protected function remove_todo() {

		if ( ! isset( $_GET['remove'] ) ) {
			return;
		}

		$task_id = $_GET['task_id'];

		unset( $this->tasks[ $task_id ] );

		update_option( 'wp_ml_todo', ! empty( $this->tasks ) ? $this->tasks : '' );

		wp_safe_redirect( admin_url() );
		exit;
	}

	/**
	 * set todo as complete
	 *
	 * @return void
	 */
	protected function complete_todo() {

		if ( ! isset( $_GET['complete'] ) ) {
			return;
		}

		$task_id = $_GET['task_id'];

		$this->tasks[ $task_id ][2] = 'completed';

		update_option( 'wp_ml_todo', $this->tasks );

		wp_safe_redirect( admin_url() );
		exit;
	}
}



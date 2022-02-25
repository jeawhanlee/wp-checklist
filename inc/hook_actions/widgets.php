<?php

namespace WP_Checklist\hook_actions;

defined( 'ABSPATH' ) || exit;

class Widgets extends \WP_Checklist\hook_actions\Actions {

	/**
	 * display widget on admin dashboard
	 *
	 * @return void
	 */
	public function wp_ml_dashboard_widgets() {

		// create a custom dashboard widget
		return wp_add_dashboard_widget(
			'dashboard_todolist',
			'Your Checklist',
			array( $this, 'wp_ml_list_display' ),
			array( $this, 'wp_ml_list_setup' )
		);
	}

	/**
	 * display todo list on default
	 *
	 * @return void
	 */
	public function wp_ml_list_display() {

		// display todos
		return $this->display_todo( $this->tasks );

	}

	/**
	 * controller call back for performing
	 * todo actions (add, remove, mark as complete)
	 *
	 * @return void
	 */
	public function wp_ml_list_setup() {

		// add todo
		$this->add_todo();

		// remove todo
		$this->remove_todo();

		// complete todo
		$this->complete_todo();

		// display todos
		return $this->display_todo( $this->tasks, true );
	}

	/**
	 * require html view for displaying todos
	 * with check for config mode
	 *
	 * @param array   $tasks
	 * @param boolean $config
	 * @return void
	 */
	public function display_todo( array $tasks, $config = false ) {

		include_once CONFIG['app_path'] . 'view/todos.php';

		echo trim( ob_get_clean() );

	}

	/**
	 * execute plugin
	 *
	 * @return void
	 */
	public function wp_ml_execute() {
		add_action( 'wp_dashboard_setup', array( $this, 'wp_ml_dashboard_widgets' ) );
	}
}



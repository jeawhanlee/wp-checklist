<?php

namespace WP_Checklist\hook_actions;

defined( 'ABSPATH' ) || exit;

class Widgets extends \WP_Checklist\hook_actions\Actions {


	public function wp_ml_dashboard_widgets() {

		// create a custom dashboard widget
		return wp_add_dashboard_widget(
			'dashboard_todolist',
			'Your Checklist',
			array( $this, 'wp_ml_list_display' ),
			array( $this, 'wp_ml_list_setup' )
		);
	}

	public function wp_ml_list_display() {

		// display todos
		return $this->display_todo( $this->tasks );

	}

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

	public function display_todo( $tasks, $config = false ) {

		include_once CONFIG['app_path'] . 'view/todos.php';

		echo trim( ob_get_clean() );

	}
}



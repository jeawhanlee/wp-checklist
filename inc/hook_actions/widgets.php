<?php

namespace WP_Checklist\hook_actions;

defined( 'ABSPATH' ) || exit;

class Widgets extends \WP_Checklist\hook_actions\Actions{

    private $tasks = '';

    public function __construct() {

        $this->tasks = get_option( 'wp_ml_todo' );
        
    }

    public function wp_ml_dashboard_widgets() {

        //create a custom dashboard widget
        return wp_add_dashboard_widget( 
                    'dashboard_todolist',
                    'Your Checklist', 
                    [$this, 'wp_ml_list_display'],
                    [$this, 'wp_ml_list_setup']
                );
    }

    public function wp_ml_list_display() {
    
        // display todos
        return $this->display_todo( $this->tasks );

    }

    public function wp_ml_list_setup() {

        // add todo
        $this->add_todo( $this->tasks );

        // remove todo
        $this->remove_todo( $this->tasks );

        // complete todo
        $this->complete_todo( $this->tasks );

        // display todos
        return $this->display_todo( $this->tasks, true );
    }

    public function display_todo( $tasks, $config = false ) {
  
        require_once CONFIG['app_path'] . 'view/todos.php';

    }
}



<?php

namespace WP_Checklist;

defined( 'ABSPATH' ) || exit;

ob_start();

class wp_ml_todo_list extends \WP_Checklist\hook_actions\Widgets {

    public function wp_ml_execute(){
        add_action( 'wp_dashboard_setup', [ $this, 'wp_ml_dashboard_widgets' ] );
    }
}


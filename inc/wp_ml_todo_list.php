<?php

namespace WP_Checklist;

require_once __DIR__.'/inc/hook_actions/widgets.php';

class wp_ml_todo_list{
    public static function wp_ml_execute(){
        add_action( 'wp_dashboard_setup', 'wp_ml_dashboard_widgets' );
    }
}




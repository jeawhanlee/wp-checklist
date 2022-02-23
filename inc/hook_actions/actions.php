<?php

namespace WP_Checklist\hook_actions;

defined( 'ABSPATH' ) || exit;

class Actions{

    protected function add_todo( $tasks ) {

        if( isset( $_POST['wp_ml_todo'] ) ){

            $todo = $_POST['wp_ml_todo'];
            $date_added = date("Y-m-d");
            $id = date('ymdhis');
    
            $task[$id] = [ $todo, $date_added, "pending" ];
    
            if( !empty( $tasks ) ){
                $tasks = $tasks;
    
                foreach( $tasks as $task_id => $meta ) {
                    $task[$task_id] = $meta;
                }
            }
    
            update_option( 'wp_ml_todo', $task );
        }
    }

    protected function remove_todo( $tasks ) {

        if( isset( $_GET['remove'] ) ){

            $task_id = $_GET['task_id'];
    
            $tasks = (array) $tasks;
            unset( $tasks[$task_id] );
    
            $tasks = !empty( $tasks ) ?  $tasks : '';
            
            update_option( 'wp_ml_todo', $tasks );
    
            wp_safe_redirect( admin_url() );
            exit;
        }

    }

    protected function complete_todo( $tasks ) {

        if( isset( $_GET['complete'] ) ){

            $task_id = $_GET['task_id'];
    
            $tasks = (array) $tasks;
            $tasks[$task_id][2] = 'completed';
    
            $tasks = $tasks;
            update_option( 'wp_ml_todo', $tasks );
    
            wp_safe_redirect( admin_url() );
            exit;
        }
    }
}



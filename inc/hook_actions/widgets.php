<?php

function wp_ml_dashboard_widgets() {
 
    //create a custom dashboard widget
    wp_add_dashboard_widget( 
        'dashboard_todolist',
        'Create your new task', 
        'wp_ml_list_display',
        'wp_ml_list_setup'
    );
 
}

function wp_ml_list_display() {
    $tasks = get_option( 'wp_ml_todo' );

    if( !empty( $tasks ) ) {
        $tasks = explode(',', $tasks);
        
        echo '<ul>';
        foreach( $tasks as $task ) {
        ?>  
            <li><?php echo ucwords( $task ) ?></li>
        <?php
        }
        echo '</ul>';
    }
    else {
        echo '<p>No task added</p>';
    }
}

function wp_ml_list_setup() {
    $option = get_option( 'wp_ml_todo' );

    if( isset( $_POST['wp_ml_todo'] ) ){
        $todo = $_POST['wp_ml_todo'];

        if( !empty( $option ) ){
            $todo = "$option, $todo";
        }

        update_option( 'wp_ml_todo', $todo );
    }
?>
    <input type="text" name="wp_ml_todo" placeholder="Add a Task" style="margin-bottom:10px;" />
<?php
}
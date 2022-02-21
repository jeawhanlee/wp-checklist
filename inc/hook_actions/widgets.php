<?php
ob_start();

function wp_ml_dashboard_widgets() {
 
    //create a custom dashboard widget
    wp_add_dashboard_widget( 
        'dashboard_todolist',
        'Your Checklist', 
        'wp_ml_list_display',
        'wp_ml_list_setup'
    );
 
}

function wp_ml_list_display() {
    $tasks = get_option( 'wp_ml_todo' );

    // display todos
    display_todo( $tasks );
}

function wp_ml_list_setup() {
    $tasks = get_option( 'wp_ml_todo' );

    // add todo
    add_todo( $tasks );

    // remove todo
    remove_todo( $tasks );

    // complete todo
    complete_todo( $tasks );
    
    display_todo( $tasks, true );
}

function add_todo( $tasks ) {

    if( isset( $_POST['wp_ml_todo'] ) ){

        $todo = $_POST['wp_ml_todo'];
        $date_added = date("Y-m-d");
        $id = date('ymdhis');

        $task[$id] = [ $todo, $date_added, "pending" ];

        if( !empty( $tasks ) ){
            $tasks = json_decode( $tasks, true );

            foreach( $tasks as $task_id => $meta ) {
                $task[$task_id] = $meta;
            }
        }
        
        $task = json_encode( $task );

        update_option( 'wp_ml_todo', $task );
    }
}

function remove_todo( $tasks ){

    if( isset( $_GET['remove'] ) ){

        $task_id = $_GET['task_id'];

        $tasks = json_decode( $tasks, true );
        unset( $tasks[$task_id] );

        $tasks = !empty( $tasks ) ? json_encode( $tasks ) : '';
        update_option( 'wp_ml_todo', $tasks );

        wp_safe_redirect( admin_url() );
        exit;
    }
}

function complete_todo( $tasks ){
    if( isset( $_GET['complete'] ) ){

        $task_id = $_GET['task_id'];

        $tasks = json_decode( $tasks, true );
        $tasks[$task_id][2] = 'completed';

        $tasks = json_encode( $tasks );
        update_option( 'wp_ml_todo', $tasks );

        wp_safe_redirect( admin_url() );
        exit;
    }
}

function display_todo( string $tasks, $config = false ){

    if( !empty( $tasks ) ) {
        $tasks = json_decode( $tasks, true );
        
        echo '<ul>';
        foreach( $tasks as $task_id => $meta ) {
            $task_entity = explode('-', $task);
            $date = date_create( $meta[1] );
        ?>  
            <li>
                <strong <?php echo $meta[2] == 'completed' ? 'style="text-decoration:line-through"' : '' ?> ><?php echo ucwords( $meta[0] ) ?></strong>
                <br />
                <small><?php echo date_format( $date, 'd/m/Y' ) ?></small> | 
                <?php if( $config ): ?> 
                    <a href="<?php echo admin_url() ?>?edit=dashboard_todolist&complete=true&task_id=<?php echo $task_id ?>#dashboard_todolist" style="color:green">Mark as complete</a> | 
                    <a href="<?php echo admin_url() ?>?edit=dashboard_todolist&remove=true&task_id=<?php echo $task_id ?>#dashboard_todolist" style="color:red">Remove</a>
                <?php else: ?>
                    <small><?php echo ucfirst($meta[2]) ?></small>
                <?php endif ?>
            </li>
        <?php
        }
        echo '</ul>';
    }
    else {
        echo '<p>No task added</p>';
    }

    // display form if config
    if( $config ) {
        echo '<input type="text" name="wp_ml_todo" placeholder="Add a new task" style="margin-bottom:10px;width:100%" />';
    }
}
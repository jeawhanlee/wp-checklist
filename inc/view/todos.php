<?php

defined( 'ABSPATH' ) || exit;

if( !empty( $tasks ) ) {
    $tasks = (array) $tasks;
    
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
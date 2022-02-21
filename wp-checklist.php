<?php

/*
Plugin Name: WP-Checklist
Plugin URI: http://wordpress.org
Description: A Simple Plugin for creating a todo list.
Version: 1.0
Author: Michael Lee
Author URI: http://wordpress.org
License: GPLv2
*/
 
defined( 'ABSPATH' ) || exit;

require __DIR__ . '/vendor/autoload.php';

WP_Checklist\wp_ml_todo_list::wp_ml_execute();
?>
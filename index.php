<?php

/*
Plugin Name: Schemati
Description: Schemati Settings
Plugin URI: https://schemamarkapp.com/
Author: Shay Ohayon
Author URI: https://schemamarkapp.com/
Version: 4.3.3
*/

require_once __DIR__."/load.php";

require_once ('updater.php');
if ( is_admin() ) {
    new updater( __FILE__, true, 'enea5', "schemamarkapp" );
}

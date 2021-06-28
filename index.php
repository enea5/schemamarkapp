<?php

/*
Plugin Name: Schemati
Description: Schemati Settings
Plugin URI: https://schemamarkapp.com/
Author: Shay Ohayon
Author URI: https://schemamarkapp.com/
Version: 4.3
*/

require_once __DIR__."/load.php";
require_once( 'updater.php' );
if ( is_admin() ) {
    new BFIGitHubPluginUpdater( __FILE__, 'enea5', "schemamarkapp" );
}

<?php
// Define path and URL to the ACF plugin.
define('MY_ACF_PATH', __DIR__ . '/../includes/acf-pro/');
define('MY_ACF_URL', plugin_dir_url(dirname(__FILE__) ) . '/includes/acf-pro/');

function schema_markapp_plugins_loaded()
{
    if (class_exists('ACF')) {
        return;
    }
    include_once(MY_ACF_PATH . 'acf.php');

// Customize the url setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url($url)
    {
        return MY_ACF_URL;
    }

// (Optional) Hide the ACF admin menu item.
//    add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
//    function my_acf_settings_show_admin($show_admin)
//    {
//        return false;
//    }
}

add_action('plugins_loaded', 'schema_markapp_plugins_loaded');

function schema_markapp_acf_post_fields()
{
    foreach(get_declared_classes() as $class){
        if(is_subclass_of($class, '\PostFields')) {
            /** @var PostFields $fields */
            $fields = new $class;
            $fields->initAcf();

        }
    }
}

add_action('acf/init', 'schema_markapp_acf_post_fields');


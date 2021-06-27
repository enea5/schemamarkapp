<?php
add_action('admin_menu', 'my_seo_settings_add_admin_menu');


function my_seo_settings_add_admin_menu()
{
    add_menu_page('General', 'Schema Markapp', 'manage_options', 'my_seo_settings', GeneralSettings::registerAdminMenu());
    add_submenu_page('my_seo_settings', 'Article', 'Article', 'manage_options', 'my_seo_settings_options_page_article', ArticleSettings::registerAdminMenu());
    add_submenu_page('my_seo_settings', 'About Page', 'About Page', 'manage_options', 'my_seo_settings_options_page_about_page', AboutPageSettings::registerAdminMenu());
    add_submenu_page('my_seo_settings', 'Contact Page', 'Contact Page', 'manage_options', 'my_seo_settings_options_page_contact_page', ContactPageSettings::registerAdminMenu());
    add_submenu_page('my_seo_settings', 'Local Business', 'Local Business', 'manage_options', 'my_seo_settings_options_page_local_business', LocalBusinessSettings::registerAdminMenu());
    add_submenu_page('my_seo_settings', 'Person', 'Person', 'manage_options', 'my_seo_settings_options_page_person', PersonSettings::registerAdminMenu());
	add_submenu_page('my_seo_settings', 'Author', 'Author', 'manage_options', 'my_seo_settings_options_page_author', AuthorSettings::registerAdminMenu());
	add_submenu_page('my_seo_settings', 'Publisher', 'Publisher', 'manage_options', 'my_seo_settings_options_page_publisher', PublisherSettings::registerAdminMenu());
    add_submenu_page('my_seo_settings', 'Product', 'Product', 'manage_options', 'my_seo_settings_options_page_product', ProductSettings::registerAdminMenu());
    add_submenu_page('my_seo_settings', 'CheckTool', 'CheckTool', 'manage_options', 'my_seo_settings_options_page_check_tool', 'my_seo_settings_options_page_check_tool');
    add_submenu_page('my_seo_settings', 'License', 'License', 'manage_options', 'my_seo_settings_options_page_license', 'my_seo_settings_options_page_license');
}

function schema_markapp_custom_styles($hook)
{
    if ($hook == 'toplevel_page_my_seo_settings' || strpos($hook, 'schema-markapp_page_my_seo_settings') === 0) {
        wp_enqueue_style('schema_markapp_admin.css', plugins_url('assets/admin.css', __FILE__));
    }
}

add_action('admin_enqueue_scripts', 'schema_markapp_custom_styles');

// These files must be included first
require_once __DIR__ . '/settings/PostFields.php';
require_once __DIR__ . '/settings/GenericSettings.php';

foreach (glob(__DIR__ . '/settings/*.php') as $snippet) {
    require_once $snippet;
}

if (!defined('DOING_AJAX')) {
    foreach (get_declared_classes() as $class) {
        if (is_subclass_of($class, 'GenericSettings')) {
            /** @var GenericSettings $settings */
            call_user_func([$class, 'register']);
        }
    }
}
<?php
require_once __DIR__ . '/lb_helper.php';
require_once __DIR__ . '/license.php';

include __DIR__ . '/settings.default.php';

$my_seo_settings_license_options = get_option('my_seo_settings_license');
$my_seo_settings_local_business_options = get_option('my_seo_settings_local_business');
$my_seo_settings_person_options = get_option('my_seo_settings_person');
$my_seo_settings_product_options = get_option('my_seo_settings_product');
$my_seo_settings_contact_page_options = get_option('my_seo_settings_contact_page');
$my_seo_settings_about_page_options = get_option('my_seo_settings_about_page');
$my_seo_settings_article_options = get_option('my_seo_settings_article');
$my_seo_settings_author_options = get_option('my_seo_settings_author');
$my_seo_settings_publisher_options = get_option('my_seo_settings_publisher');
$my_seo_settings_options = get_option('my_seo_settings_general');


require_once __DIR__ . '/settings.php';

if (!validate_schemamarksapp_license()) {
    return;
}
require_once __DIR__ . '/snippets/GenericSchema.php';

foreach (glob(__DIR__ . '/snippets/traits/*.php') as $snippet) {
    require_once $snippet;
}

foreach (glob(__DIR__ . '/snippets/*.php') as $snippet) {
    require_once $snippet;
}
		if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}
$generalSettings = GeneralSettings::instance()->getOptions();
add_action($generalSettings['generate_json_ld_fpwebpage_hook_short_code'], function() {
    foreach(get_declared_classes() as $class){
        if(is_subclass_of($class, 'GenericSchema')) {
            /** @var GenericSchema $schema */
            $schema = new $class;
            if ($schema->mustRenderOnPage()) $schema->render();

        }
    }
});

require_once __DIR__ . '/sidebar/sidebar.php';
require_once __DIR__ . ( '/updater.php' );
if ( is_admin() ) {
    new BFIGitHubPluginUpdater( __FILE__, 'enea5', "schemamarkapp" );
}
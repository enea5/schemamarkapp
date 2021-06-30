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

$pluginList = get_option( 'active_plugins' );
$plugin = 'nicepage/nicepage.php'; 
if ( in_array( $plugin , $pluginList ) &&  $generalSettings['generate_json_ld_fpwebpage_hook_short_code'] === 'wp_body_open' ) {
    add_action('wp_footer', 'add_script_schema_to_body');
    
    function add_script_schema_to_body() {
    ?>
        <script type="text/javascript">
            function move_from_footer_to_top() {
                var ele = document.getElementsByClassName('schemati');                
                var temp = document.getElementById('query-monitor-css');
                var body = document.getElementsByTagName('body');
                var arr_text = [];
                if (body.length > 0 && ele.length > 0) {
                    var i = 0;
                    while(ele[0]) {                     
                        arr_text[i] = ele[0].text                       
                        console.log(ele[0]);
                        ele[0].remove();
                        i++;
                    }

                    for (i = 0; i < arr_text.length; i++) {
                        var element = document.createElement('script');
                        element.className = 'schemati';
                        element.type = 'application/ld+json';
                        element.innerHTML = arr_text[i];
                        document.body.prepend(element);
                    }

                } else {
                    setTimeout(function(){ move_from_footer_to_top(); }, 500);
                }
            }
            move_from_footer_to_top();
        </script>
    <?php
    }

    $generalSettings['generate_json_ld_fpwebpage_hook_short_code'] = 'wp_footer';
}
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
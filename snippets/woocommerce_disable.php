<?php
function remove_output_structured_data() {
    $my_seo_settings_product_options = get_option('my_seo_settings_product');
    if (isset($my_seo_settings_product_options['woocommerce_disable']) &&
        trim($my_seo_settings_product_options['woocommerce_disable'])) {
        remove_action('wp_footer', array(WC()->structured_data, 'output_structured_data'), 10);
    }
}
add_action( 'init', 'remove_output_structured_data' );
<?php
if (get_option('my_seo_settings_local_business') === null) {
    update_option('my_seo_settings_local_business', [
        'generate_json_ld_localbusiness' => '0',
		'generate_json_ld_localbusiness_related_page' => '',
    ]);
}

if (get_option('my_seo_settings_publisher') === null) {
    update_option('my_seo_settings_publisher', [
        'generate_json_ld_publisher' => '0'
    ]);
}

if (get_option('my_seo_settings_author') === null) {
    update_option('my_seo_settings_author', [
        'generate_json_ld_author' => '0'
    ]);
}

if (get_option('my_seo_settings_person') === null) {
    update_option('my_seo_settings_person', [
        'generate_json_ld_person' => '0',
    ]);
}

if (get_option('my_seo_settings_product') === null) {
    update_option('my_seo_settings_product', [
        'generate_json_ld_product' => '0',
    ]);
}
if (get_option('my_seo_settings_faq') === null) {
    update_option('my_seo_settings_faq', [
        'generate_json_ld_faq' => '0',
    ]);
}
if (get_option('my_seo_settings_contact_page') === null) {
    update_option('my_seo_settings_contact_page', [
        'generate_json_ld_contact_page' => '1',
		'generate_json_ld_contact_page_related_page' => '',
    ]);
}
if (get_option('my_seo_settings_about_page') === null) {
    update_option('my_seo_settings_about_page', [
        'generate_json_ld_about_page' => '1',
		'generate_json_ld_about_page_related_page' => '',
    ]);
}

if (get_option('my_seo_settings_general') === null) {
    update_option('my_seo_settings_general', [
        'generate_json_ld_fpwebpage' => '1',
        'generate_json_ld_webpage' => '1',
        'generate_json_ld_recipe' => '0',
        'generate_json_ld_fpwebpage_hook_short_code' => 'wp_body_open',
        'generate_json_ld_fpwebpage_menu' => '',
        'generate_json_ld_fpwebpage_fmenu' => '',
        'generate_json_ld_fpwebpage_name' => '',
        'generate_json_ld_fpwebpage_optype' => 'Organization',
		'generate_json_ld_author' => '',
		'generate_search_bar' => '',
    ]);
}

if (get_option('my_seo_settings_article') === null) {
    update_option('my_seo_settings_article', [
        'generate_json_ld' => '0',
        'generate_json_ld_optype' => 'Organization',
        'generate_json_ld_artype' => 'Article',
        'generate_json_ld_logo_url' => '',
    ]);
}
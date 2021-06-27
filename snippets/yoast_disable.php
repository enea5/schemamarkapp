<?php
$my_seo_settings_options = GeneralSettings::instance()->getOptions();
if (trim($my_seo_settings_options['yoast_disable']) === '1') {
    add_filter('wpseo_json_ld_output', '__return_false');
}
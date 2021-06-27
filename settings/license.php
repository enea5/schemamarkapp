<?php

add_action( 'admin_init', 'my_seo_settings_license_init' );
function my_seo_settings_license_init(){

    register_setting( 'mySEOPluginLicense', 'my_seo_settings_license' );

    add_settings_section(
        'my_seo_settings_pluginPage_section',
        __( '', 'my_seo_settings' ),
        null,
        'mySEOPluginLicense'
    );

    add_settings_field(
        'license_client',
        __( 'Client', 'my_seo_settings' ),
        'license_client_render',
        'mySEOPluginLicense',
        'my_seo_settings_pluginPage_section'
    );

    add_settings_field(
        'license_code',
        __( 'License Code', 'my_seo_settings' ),
        'license_code_render',
        'mySEOPluginLicense',
        'my_seo_settings_pluginPage_section'
    );

}

function my_seo_settings_options_page_license(  ) {
    ?>
    <h1>Schema Mark App License</h1>
    <?php settings_errors(); ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields( 'mySEOPluginLicense' );
        do_settings_sections( 'mySEOPluginLicense' );
        submit_button("Activate License");
        ?>
        <?php
        ?>
    </form>
    <?php
}


function license_code_render(  ) {
    global $my_seo_settings_license_options;
    ?>
    <input type='text' name='my_seo_settings_license[license_code]' value='<?php echo $my_seo_settings_license_options['license_code']; ?>'>
    <?php if (validate_schemamarksapp_license()) : ?>
        <p class="license-status-valid">License is valid</p>
    <?php else : ?>
        <p class="license-status-invalid">License is invalid</p>
    <?php endif;
}


function license_client_render(  ) {
    global $my_seo_settings_license_options;
    ?>
    <input type='text' name='my_seo_settings_license[license_client]' value='<?php echo $my_seo_settings_license_options['license_client']; ?>'>
    <?php
}
<?php

class SchemaMarkapp_LicenseMessage
{
    private $appName = 'Schema Mark App';
    private $message = '';
    private $cta = '';

    public function __construct($message, $cta)
    {
        $this->message = $message;
        $this->cta = $cta;
    }

    public function message()
    {
        printf(
            '<div class="notice notice-error"><p><strong>%s</strong> %s <a href="%s">%s</a></p></div>',
            $this->appName,
            $this->message,
            get_admin_url() . 'admin.php?page=my_seo_settings_options_page_license',
            $this->cta
        );
    }
}

function validate_schemamarksapp_license()
{
    $my_seo_settings_license_options = get_option('my_seo_settings_license');

    $license_code = $my_seo_settings_license_options['license_code'] ?? '';
    $license_client = $my_seo_settings_license_options['license_client'] ?? '';
    $is_license_active = ($my_seo_settings_license_options['license_active'] ?? '') === md5($license_client . ':' . $license_code);

    if ($license_code == '') {
        $licenseMessage = new SchemaMarkapp_LicenseMessage('Please activate your copy of the plugin', 'Activate Now');
        add_action('admin_notices', [$licenseMessage, 'message']);

        return false;
    }

    $api = new LicenseBoxAPI();
    if (!$is_license_active && is_admin()) {
        $status = $api->activate_license($license_code, $license_client);

        if ($status['status'] != true) {
            $licenseMessage = new SchemaMarkapp_LicenseMessage('License activation has failed. ' . $status['message'], 'Update your license key');
            add_action('admin_notices', [$licenseMessage, 'message']);

            return false;
        }

        $is_license_active = $my_seo_settings_license_options['license_active'] = md5($license_client . ':' . $license_code);
        update_option('my_seo_settings_license', $my_seo_settings_license_options);
    }

    if (!$is_license_active) {
        return false;
    }

    $res = $api->verify_license(true);

    if ($res['status'] != true) {
        $my_seo_settings_license_options['license_active'] = false;
        update_option('my_seo_settings_license', $my_seo_settings_license_options);

        if (is_admin()) {
            $licenseMessage = new SchemaMarkapp_LicenseMessage('License validaton has failed.', 'Update your license key');
            add_action('admin_notices', [$licenseMessage, 'message']);
        }

        return false;
    }

    return true;
}

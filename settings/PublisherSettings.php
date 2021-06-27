<?php

class PublisherSettings extends GenericSettings
{
    protected $adminTitle = 'Publisher Schema';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';
    protected $name = 'Publisher';
    protected $settingsGroup = 'mySEOPluginPublisherPage';

    public function initSettingsPage()
    {
        $this->_addSection('publisherdetails', __( 'Publisher Details', 'my_seo_settings' ));

        $this->_addCheckboxField('generate_json_ld_publisher', __( 'Publisher Schema', 'my_seo_settings' ));
    }
}

<?php


class ContactPageSettings extends GenericSettings
{
    protected $adminTitle = 'Contact Page Schema';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';
    protected $name = 'contact_page';
    protected $settingsGroup = 'mySEOPluginContactPagePage';

    public function initSettingsPage()
    {
        $this->_addCheckboxField('generate_json_ld_contact_page', __( 'Contact Page Schema', 'my_seo_settings' ));
        $this->_addPagesDropdown('generate_json_ld_contact_page_related_page', __( 'Select the websites contact page', 'my_seo_settings' ));
        $this->_addInputField('generate_json_ld_contact_page_copyright_year', __( 'Copyright Year - most common - current year', 'my_seo_settings' ));    }

}
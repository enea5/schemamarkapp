<?php

class AboutPageSettings extends GenericSettings
{
    protected $name = 'about_page';
    protected $settingsGroup = 'mySEOPluginAboutPagePage';
    protected $adminTitle = 'About Page Schema';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';

    public function initSettingsPage()
    {
        // admin sections
        $this->_addSection('contacts', __('Legal contacts', 'my_seo_settings'));
        $this->_addSection('social', __('Social Profiles', 'my_seo_settings'));
        $this->_addSection('copyright', __('Copyright', 'my_seo_settings'));
        $this->_addSection('location', __('Location', 'my_seo_settings'));
        $this->_addSection('speciality', __('Speciality', 'my_seo_settings'));

        // default section fields
        $this->_addCheckboxField('generate_json_ld_about_page', __('About Page Schema', 'my_seo_settings'));
        $this->_addPagesDropdown('generate_json_ld_about_page_related_page', __('Select the Website About page', 'my_seo_settings'));

        // Contacts
        $this->_addInputField('generate_json_ld_about_page_contacttype', __('Contact Type', 'my_seo_settings'), 'contacts');
        $this->_addInputField('generate_json_ld_about_page_telephone', __('Telephone', 'my_seo_settings'), 'contacts');
        $this->_addInputField('generate_json_ld_about_page_email', __('Email', 'my_seo_settings'), 'contacts');
        $this->_addInputField('generate_json_ld_about_page_area_served', __('Area served', 'my_seo_settings'), 'contacts');
        $this->_addInputField('generate_json_ld_about_page_brand', __('Brand - recommended if applicable', 'my_seo_settings'), 'contacts');
        // Social
        $this->initSocialFields('social');

        // Copyright
        $this->_addInputField('generate_json_ld_about_page_copyright_year', __('Website Copyright Year - must common, current year', 'my_seo_settings'), 'copyright');

        // Location
        $this->_addInputField('generate_json_ld_about_page_related_link', __('Related Link', 'my_seo_settings'), 'location');

        // textarea
        $this->_addTextareaField('generate_json_ld_about_page_speciality_description', __('Speciality Description', 'my_seo_settings'), 'location');
        $this->_addInputField('generate_json_ld_about_page_speciality_name', __('Speciality Name', 'my_seo_settings'), 'speciality');
    }

    protected function initSocialFields($section = '')
    {
        $this->_addInputField('generate_json_ld_about_page_facebook', __('Social Media link', 'my_seo_settings'), $section);
        $this->_addInputField('generate_json_ld_about_page_instagram', __('Social Media link', 'my_seo_settings'), $section);
        $this->_addInputField('generate_json_ld_about_page_twitter', __('Social Media link', 'my_seo_settings'), $section);
        $this->_addInputField('generate_json_ld_about_page_linkedin', __('Social Media link', 'my_seo_settings'), $section);
        $this->_addInputField('generate_json_ld_about_page_podcast', __('Social Media link', 'my_seo_settings'), $section);
    }

    public function initSidebarSettingsPage($schemaClass)
    {
        switch ($schemaClass) {
            case WebPageSchema::class:
                $this->initSocialFields();
                break;

            default:
                parent::initSidebarSettingsPage($schemaClass);
        }
    }


}
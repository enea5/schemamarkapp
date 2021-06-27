<?php

class AuthorSettings extends GenericSettings
{
    protected $adminTitle = 'Author Schema';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';
    protected $name = 'Author';
    protected $settingsGroup = 'mySEOPluginAuthorPage';

    public function initSettingsPage()
    {
        $this->_addSection('authoraldetails', __( 'Authoral Details', 'my_seo_settings' ));
        $this->_addSection('additionaldetails', __( 'Additional Details', 'my_seo_settings' ));
        $this->_addSection('professional',  __( 'Professional Details', 'my_seo_settings' ));
        $this->_addSection('location',  __( 'Location', 'my_seo_settings' ));

        $this->_addCheckboxField('generate_json_ld_author', __( 'Author Schema', 'my_seo_settings' ));

        $this->_addInputField('generate_json_ld_author_image', __( 'Image URL', 'my_seo_settings' ), 'authoraldetails');
        $this->_addInputField('generate_json_ld_author_given_name', __( 'Given Name', 'my_seo_settings' ), 'authoraldetails');
        $this->_addInputField('generate_json_ld_author_family_name', __( 'Family Name', 'my_seo_settings' ), 'authoraldetails');
        $this->_addInputField('generate_json_ld_author_gender', __( 'Gender', 'my_seo_settings' ), 'authoraldetails');

        $this->_addInputField('generate_json_ld_author_height', __( 'Height', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_author_description', __( 'Description', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_author_knowslanguage', __( 'Knowns Language', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_author_memberof', __( 'Member Of', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_author_nationality', __( 'Nationality', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_author_spouse', __( 'Spouse', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_author_email', __( 'Email', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_author_telephone', __( 'Telephone', 'my_seo_settings' ), 'additionaldetails');

        $this->_addInputField('generate_json_ld_author_job_title', __( 'Job Title', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_worksfor', __( 'Works for', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_place_name', __( 'Work Place Name', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_place_sameas', __( 'Work Place SameAs', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_work_address_street_address', __( 'Work Place Street Address', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_work_address_address_locality', __( 'Work Place Locality', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_work_address_address_region', __( 'Work Place Region', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_work_address_postal_code', __( 'Work Place Postal Code', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_work_address_address_country', __( 'Work Place Country', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_author_location_street_address', __( 'Location Street Address', 'my_seo_settings' ), 'professional');

        // Location
        $this->_addInputField('generate_json_ld_author_location_address_locality', __( 'Location Address Locality', 'my_seo_settings' ), 'location');
        $this->_addInputField('generate_json_ld_author_location_address_region', __( 'Location Address Region', 'my_seo_settings' ), 'location');
        $this->_addInputField('generate_json_ld_author_location_postal_code', __( 'Location Address Postal Code', 'my_seo_settings' ), 'location');
        $this->_addInputField('generate_json_ld_author_location_address_country', __( 'Location Address Country', 'my_seo_settings' ), 'location');
    }
}
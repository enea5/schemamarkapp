<?php


class PersonSettings extends GenericSettings
{
    protected $adminTitle = 'Person Schema';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';
    protected $name = 'person';
    protected $settingsGroup = 'mySEOPluginPersonPage';

    public function initSettingsPage()
    {
        $this->_addSection('personaldetails', __( 'Personal Details', 'my_seo_settings' ));
        $this->_addSection('additionaldetails', __( 'Additional Details', 'my_seo_settings' ));
        $this->_addSection('professional',  __( 'Professional Details', 'my_seo_settings' ));
        $this->_addSection('location',  __( 'Location', 'my_seo_settings' ));

        $this->_addCheckboxField('generate_json_ld_person', __( 'Person Schema', 'my_seo_settings' ));
        $this->_addPagesDropdown('generate_json_ld_person_related_page', __( 'Related page', 'my_seo_settings' ));

        $this->_addInputField('generate_json_ld_person_image', __( 'Image URL', 'my_seo_settings' ), 'personaldetails');
        $this->_addInputField('generate_json_ld_person_given_name', __( 'Given Name', 'my_seo_settings' ), 'personaldetails');
        $this->_addInputField('generate_json_ld_person_family_name', __( 'Family Name', 'my_seo_settings' ), 'personaldetails');
        $this->_addInputField('generate_json_ld_person_gender', __( 'Gender', 'my_seo_settings' ), 'personaldetails');

        $this->_addInputField('generate_json_ld_person_height', __( 'Height', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_person_description', __( 'Description', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_person_knowslanguage', __( 'Knowns Language', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_person_memberof', __( 'Member Of', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_person_nationality', __( 'Nationality', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_person_spouse', __( 'Spouse', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_person_email', __( 'Email', 'my_seo_settings' ), 'additionaldetails');
        $this->_addInputField('generate_json_ld_person_telephone', __( 'Telephone', 'my_seo_settings' ), 'additionaldetails');

        $this->_addInputField('generate_json_ld_person_job_title', __( 'Job Title', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_worksfor', __( 'Works for', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_place_name', __( 'Work Place Name', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_place_sameas', __( 'Work Place SameAs', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_work_address_street_address', __( 'Work Place Street Address', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_work_address_address_locality', __( 'Work Place Locality', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_work_address_address_region', __( 'Work Place Region', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_work_address_postal_code', __( 'Work Place Postal Code', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_work_address_address_country', __( 'Work Place Country', 'my_seo_settings' ), 'professional');
        $this->_addInputField('generate_json_ld_person_location_street_address', __( 'Location Street Address', 'my_seo_settings' ), 'professional');

        // Location
        $this->_addInputField('generate_json_ld_person_location_address_locality', __( 'Location Address Locality', 'my_seo_settings' ), 'location');
        $this->_addInputField('generate_json_ld_person_location_address_region', __( 'Location Address Region', 'my_seo_settings' ), 'location');
        $this->_addInputField('generate_json_ld_person_location_postal_code', __( 'Location Address Postal Code', 'my_seo_settings' ), 'location');
        $this->_addInputField('generate_json_ld_person_location_address_country', __( 'Location Address Country', 'my_seo_settings' ), 'location');
    }
}
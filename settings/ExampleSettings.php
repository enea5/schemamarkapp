<?php
/**
 * INSTRUCTIONS
 *
 *
 */
class ExampleSettings extends GenericSettings
{
    /**
     * Schema settings will be stored in the database under this option group name
     * Make sure it has unique name across all wordpress plugins
     *
     * WARNING: Changing this value will reset this schema settings to empty values
     *
     * @var string
     */
    protected $name = 'placeholder_page';

    /**
     * ACF Fields Group Name
     * Make sure it is unique within the plugin, and among other wordpress plugins
     *
     * @var string
     */
    protected $settingsGroup = 'schemamarkappPlaceholderPage';


    /**
     * Title of your new admin page
     *
     * @var string
     */
    protected $adminTitle = 'Example Schema';

    /**
     * ACF section name
     *
     * Doesn't need to be unique outside of single admin page
     */
    protected $defaultSection = 'default'; // set up name for the default section


    public function initSettingsPage()
    {
        // admin sections
        // $this->_addSection('section_identifier', __('Section 1', 'my_seo_settings'));

        /*
         * Adds fields to default section
         */
        $this->_addCheckboxField('generate_json_ld_about_page', __('About Page Schema', 'my_seo_settings'));

        /*
         * Adds fields to Section 1
         * Examples show how various field types can be added
         */
        // $this->_addInputField('phone_number', __('Phone number', 'my_seo_settings'), 'section_identifier');
        // $this->_addTextareaField('route_description', __('Route description', 'my_seo_settings'), 'section_identifier');
        // $this->_addCheckboxField('free_access', __('Free access', 'my_seo_settings'), 'section_identifier');


        /*
         * Custom fields can be added as well
         * We will use ACF API to add link element field here
         *
         * IMPORTANT: uncomment renderExternalLink function to make it fully functional
         */

        // $this->_addCustomField('external_link', __('External URL', 'my_seo_settings'), [$this, 'renderExternalLink'], 'section_identifier');
    }

//    public function renderExternalLink($field, $formField, $formValue) {
//        $options = $this->getOptions();
//        $value = $options[$field];
//
//        echo "<a href=\"#\">${value}</a>";
// OR
//        echo "<a href=\"#\">${formValue}</a>";
//    }
}
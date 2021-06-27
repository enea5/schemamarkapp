<?php
/**
 * INSTRUCTIONS
 *
 *
 */
class GeneralSettings extends GenericSettings
{
    /**
     * Schema settings will be stored in the database under this option group name
     * Make sure it has unique name across all wordpress plugins
     *
     * WARNING: Changing this value will reset this schema settings to empty values
     *
     * @var string
     */
    protected $name = 'general';

    /**
     * ACF Fields Group Name
     * Make sure it is unique within the plugin, and among other wordpress plugins
     *
     * @var string
     */
    protected $settingsGroup = 'mySEOPluginGeneralPage';


    /**
     * Title of your new admin page
     *
     * @var string
     */
    protected $adminTitle = 'Schemati Settings';

    /**
     * ACF section name
     *
     * Doesn't need to be unique outside of single admin page
     */
    const DEFAULT_SECTION = 'default'; // set up name for the default section


    public function initSettingsPage()
    {
        // admin sections
        $this->_addSection('schemas', __('Schemas', 'my_seo_settings'));
        $this->_addSection('special', __('Thematic Schemas', 'my_seo_settings'));
        $this->_addSection('front_page', __('General Settings', 'my_seo_settings'));
        $this->_addSection('compatibility', __('Compatibility', 'my_seo_settings'));

        /*
         * Adds fields to default section
         */
        $this->_addSchemaTagLocation('generate_json_ld_fpwebpage_hook_short_code', __('Schema Tag Location', 'my_seo_settings'), 'front_page');
        $this->_addInputField('generate_json_ld_fpwebpage_name', __('Website Title', 'my_seo_settings'), 'front_page');
		$this->_addInputField('generate_json_ld_fpwebpage_inlanguage', __('Website Language', 'my_seo_settings'), 'front_page');
        // Schemas
        $this->_addCheckboxField('generate_json_ld_fpwebpage', __('WebPage Schema for Home Page', 'my_seo_settings'), 'schemas');
        $this->_addCheckboxField('generate_json_ld_webpage', __('WebPage Schema for Pages', 'my_seo_settings'), 'schemas');
        $this->_addCheckboxField('generate_json_ld_posts', __('WebPage Schema for Posts', 'my_seo_settings'), 'schemas');
        $this->_addMenuDropbox('generate_json_ld_fpwebpage_menu', __('WPHeader Schema', 'my_seo_settings'), 'schemas');
        $this->_addMenuDropbox('generate_json_ld_fpwebpage_fmenu', __('WPFooter Schema', 'my_seo_settings'), 'schemas');
		$this->_addInputField('generate_json_ld_logo_url', __( 'Logo URL', 'my_seo_settings'), 'schemas');

        // Special
        $recipeHint = 'On individual post editing page Recipe specific fields will appear. When filled in they would show up in a Recipe schema on the page.';
        $faqHint = 'FAQ questions and answers are being added manually. go to the each page/post editor you would like to add - this schema must be enabled to take effect';

        $this->_addCheckboxField('generate_json_ld_recipe', __('Recipe Schema', 'my_seo_settings'), 'special', $recipeHint);
        $this->_addCheckboxField('generate_json_ld_faq', __('FAQ Schema', 'my_seo_settings'), 'special', $faqHint);
        $this->_addCustomField('generate_json_ld_person_schema', __('Person Schema', 'my_seo_settings'), [$this, '_renderPersonSchemaField'], 'special');
        $this->_addCustomField('generate_json_ld_product_schema', __('Product Schema', 'my_seo_settings'), [$this, '_renderProductSchemaField'], 'special');
        $this->_addCustomField('generate_json_ld_contact_page_schema', __('Contact Page Schema', 'my_seo_settings'), [$this, '_renderContactPageSchemaField'], 'special');
        $this->_addCustomField('generate_json_ld_about_page_schema', __('About Page Schema', 'my_seo_settings'), [$this, '_renderAboutPageSchemaField'], 'special');
		$this->_addCheckboxField('search_bar', __('Search Bar - Does the website have a search bar?', 'my_seo_settings'), 'compatibility');
		$this->_addCheckboxField('generate_json_ld_author', __( 'Author Schema', 'my_seo_settings'), [$this, '_renderAuthorPageSchemaField'], 'special' );
        $this->_addCheckboxField('yoast_disable', __('Yoast schema Off', 'my_seo_settings'), 'compatibility');
    }

    public function initSidebarSettingsPage($schemaClass) {
        switch($schemaClass) {
            case HeaderSchema::class:
                $this->_addMenuDropbox('generate_json_ld_fpwebpage_menu', __('Navigation', 'my_seo_settings'), '');
                break;
            case FooterSchema::class:
                $this->_addMenuDropbox('generate_json_ld_fpwebpage_fmenu', __('Footer Schema', 'my_seo_settings'), '');
                break;

            case WebPageSchema::class:
                $this->_addCheckboxField('generate_json_ld_fpwebpage', __('WebPage Schema for Home Page', 'my_seo_settings'));
                $this->_addSchemaTagLocation('generate_json_ld_fpwebpage_hook_short_code', __('Schema Tag Location', 'my_seo_settings'), '');
                $this->_addInputField('generate_json_ld_fpwebpage_name', __('Website Name', 'my_seo_settings'));
				$this->_addCheckboxField('generate_json_ld_author', __( 'Author Schema', 'my_seo_settings' ));
                break;
        }
    }

    private function _addMenuDropbox($field, $title, $section)
    {
        $menuItems = [
            '' => '- Not selected -',
        ];
        $menuItems = array_merge($menuItems, get_registered_nav_menus());
        $hint = '<p>Markup up the website menu -  Recommedned! - Please select menu to enable schema.Homepage schema must be enabled.</p>';
        $this->_addDropdownField($field, $title, $menuItems, $section, $hint);
    }

    public function _renderPersonSchemaField()
    {
        printf('<a href="%s">%s</a>', admin_url('admin.php?page=my_seo_settings_options_page_person'), __('Manage person schema...', 'my_seo_settings'));
    }

    public function _renderProductSchemaField()
    {
        printf('<a href="%s">%s</a>', admin_url('admin.php?page=my_seo_settings_options_page_product'), __('Manage product schema...', 'my_seo_settings'));
        print('<p class="field-description">Manage schema for WooCommerce products</p>');
    }

    public function _renderContactPageSchemaField()
    {
        printf('<a href="%s">%s</a>', admin_url('admin.php?page=my_seo_settings_options_page_contact_page'), __('Manage contact page schema...', 'my_seo_settings'));
    }

    public function _renderAboutPageSchemaField()
    {
        printf('<a href="%s">%s</a>', admin_url('admin.php?page=my_seo_settings_options_page_about_page'), __('Manage about page schema...', 'my_seo_settings'));
    }

    private function _addSchemaTagLocation($field, $title, $section)
    {
        $taglocations = [
			'wp_head' => __('Header', 'my_seo_settings'),
            'wp_body_open' => __('Body', 'wmy_seo_settings'),
            'wp_footer' => __('Footer', 'my_seo_settings'),
        ];
        $this->_addDropdownField($field, $title, $taglocations, $section);
    }	
}
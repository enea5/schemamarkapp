<?php

class ProductSettings extends GenericSettings
{
    protected $adminTitle = 'WooCommerce Product Schema';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';
    protected $name = 'prodict';
    protected $settingsGroup = 'mySEOPluginProductPage';

    public function initSettingsPage()
    {
        $this->_addCheckboxField('generate_json_ld_product', __( 'Product Schema', 'my_seo_settings' ));
        $this->_addToggleDropdown('woocommerce_hooks', __( 'Woocommerce Extra Fields (Brand, MPN)', 'my_seo_settings' ));
        $this->_addToggleDropdown('woocommerce_disable', __( 'Disable Woocommerce build-in schema', 'my_seo_settings' ));
    }

    protected function _addToggleDropdown($field, $title, $section = '', $hint = '')
    {
        $items = [
            '1' => 'On',
            '0' => 'Off'
        ];

        $this->_addDropdownField($field, $title, $items, $section, $hint);
    }


}
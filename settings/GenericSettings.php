<?php

class GenericSettings
{
    protected $adminTitle = '';
    protected $name = '';
    protected $settingsGroup = '';
    protected $defaultSection = 'default';

    protected static $instance;

    final public static function instance()
    {
        return static::$instance ?? new static();
    }

    final public static function register()
    {
        add_action('admin_init', [static::instance(), 'initAdmin']);
    }

    final public static function registerAdminMenu()
    {
        return function () {
            static::instance()->renderAdminPage();
        };
    }

    final public function renderAdminPage()
    {
        print("<h1>{$this->adminTitle}</h1>");
        $this->_printAdminPageDescription();
        settings_errors();
        print("<form action='options.php' method='post'>");
        settings_fields($this->settingsGroup);
        do_settings_sections($this->settingsGroup);
        submit_button();
        print("</form>");
    }

    final public function renderSidebarForm()
    {
        do_settings_sections($this->settingsGroup);
        $GLOBALS['wp_settings_sections'] = [];
        $GLOBALS['wp_settings_fields'] = [];
    }

    public function initSidebarSettingsPage($schemaClass)
    {
        $this->initSettingsPage();
    }

    /**
     * @return mixed|array
     * @throws Exception
     */
    final public function getOptions()
    {
        if ($this->name == '') {
            throw new \Exception('$name must be set to non-empty string');
        }

        return get_option($this->getOptionName());
    }

    final public function initDefaultSection() {
        add_settings_section(
            $this->defaultSection,
            __('', 'my_seo_settings'),
            function() {},
            $this->settingsGroup
        );
    }

    final public function initAdmin()
    {
        register_setting($this->settingsGroup, $this->getOptionName());
        $this->initDefaultSection();
        $this->initSettingsPage();
    }

    public function initSettingsPage()
    {
        throw new \Exception('initSettingsPage() must be overwritten in a child class');
    }

    final protected function _addSection($section, $title, $hint = '')
    {
        add_settings_section(
            $this->_sectionFdn($section),
            $title,
            function() use ($hint) {
                echo $hint;
            },
            $this->settingsGroup
        );
    }

    /**
     * @return string
     */
    final protected function getOptionName(): string
    {
        return 'my_seo_settings_' . $this->name;
    }

    final protected function _addCustomField($field, $title, $callable, $section = '')
    {
        add_settings_field(
            $field,
            $title,
            function () use ($field, $callable) {
                $options = $this->getOptions();
                $formField = $this->getOptionName() . '[' . $field . ']';
                $formValue = $options[$field] ?? '';

                call_user_func($callable, $field, $formField, $formValue);
            },
            $this->settingsGroup,
            $section != '' ? $this->_sectionFdn($section) : $this->defaultSection
        );
    }

    final protected function _addInputField($field, $title, $section = '', $hint = '')
    {
        add_settings_field(
            $field,
            $title,
            function () use ($field, $hint) {
                $this->_renderInputField($field, $hint);
            },
            $this->settingsGroup,
            $section != '' ? $this->_sectionFdn($section) : $this->defaultSection
        );
    }

    private function _renderInputField($field, $hint)
    {
        $options = $this->getOptions();
        $value = $options[$field] ?? '';
        echo "<input style=\"width: 30%;\" type='text' name='{$this->getOptionName()}[$field]' value='$value'>";
        $this->_renderHint($hint);
    }

    final protected function _addTextareaField($field, $title, $section = '', $hint = '')
    {
        add_settings_field(
            $field,
            $title,
            function () use ($field, $hint) {
                $this->_renderTextareaField($field, $hint);
            },
            $this->settingsGroup,
            $section != '' ? $this->_sectionFdn($section) : $this->defaultSection
        );
    }

    private function _renderTextareaField($field, $hint)
    {
        $options = $this->getOptions();
        echo "<textarea style='width: 50%;' name='{$this->getOptionName()}[$field]'>${options[$field]}</textarea>";
        $this->_renderHint($hint);
    }

    final protected function _addCheckboxField($field, $title, $section = '', $hint = '')
    {
        add_settings_field(
            $field,
            $title,
            function () use ($field, $hint) {
                $this->_renderCheckboxField($field, $hint);
            },
            $this->settingsGroup,
            $section != '' ? $this->_sectionFdn($section) : $this->defaultSection
        );
    }

    private function _renderCheckboxField($field, $hint)
    {
        $options = $this->getOptions();
        $checked = checked($options[$field] ?? false, true, false);
        echo "<input type='hidden' name='{$this->getOptionName()}[$field]' value='0'>";
        echo "<input type='checkbox' name='{$this->getOptionName()}[$field]' $checked value='1'> Enable";
        $this->_renderHint($hint);
    }

    final protected function _addDropdownField($field, $title, $items, $section = '', $hint = '')
    {
        $section = $section != '' ? $this->_sectionFdn($section) : $this->defaultSection;
        add_settings_field(
            $field,
            $title,
            function () use ($field, $items, $hint) {
                $this->_renderDropdownField($field, $items, $hint);
            },
            $this->settingsGroup,
            $section
        );
    }

    private function _renderDropdownField($field, $items, $hint)
    {
        $options = $this->getOptions();
        $formField = $this->getOptionName() . '[' . $field . ']';
        $formValue = $options[$field] ?? '';

        echo "<select id=\"$field\" name=\"$formField\">";
        foreach ($items as $id => $value) {
            $selected = trim($formValue) == $id ? "selected" : '';
            echo "<option value=\"$id\" $selected>$value</option>";
        }
        echo '</select>';
        $this->_renderHint($hint);
    }

    /**
     * @param $section
     * @return string
     */
    final protected function _sectionFdn($section): string
    {
        return "my_seo_settings_${section}_section";
    }

    /**
     * @param $hint
     */
    final protected function _renderHint($hint)
    {
        if ($hint) {
            echo '<p class="field-description">' . $hint . '</p>';
        }
    }

    final protected function _addPagesDropdown($field, $title)
    {
        $items = [
            '' => '- Not selected -'
        ];
        foreach (get_pages() as $page) {
            $items[$page->ID] = $page->post_title;
        }
        $this->_addDropdownField($field, $title, $items);
    }

    protected function _printAdminPageDescription()
    {
        return '';
    }
}
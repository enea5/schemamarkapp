<?php

class ArticleSettings extends GenericSettings
{
    protected $name = 'article';
    protected $settingsGroup = 'mySEOPluginArticlePage';
    protected $adminTitle = 'Article Schema';
    protected $defaultSection = 'my_seo_settings_pluginPage_section';


    public function initSettingsPage()
    {
        $this->_addCheckboxField('generate_json_ld', __('Article', 'my_seo_settings'));
        $this->_addArticleTypeField('generate_json_ld_artype', __('Article Type', 'my_seo_settings'));
    }

    private function _addArticleTypeField($field, $title)
    {
        $items = [
            'AdvertiserContentArticle' => 'AdvertiserContentArticle',
            'NewsArticle' => 'NewsArticle',
            'Report' => 'Report',
            'SatiricalArticle' => 'SatiricalArticle',
            'ScholarlyArticle' => 'ScholarlyArticle',
            'SocialMediaPosting' => 'SocialMediaPosting',
            'TechArticle' => 'TechArticle',
			'Article' => 'Article'
        ];

        $this->_addDropdownField($field, $title, $items);
    }
}
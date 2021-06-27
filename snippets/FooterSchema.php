<?php
class FooterSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        global $post;

        return $post !== null && Markapp_Schema_Matcher::isFooter($post);
    }

    public function schema()
    {
        global $my_seo_settings_options;

        $data = [];


        $menu_elements = [];
        $menu_name = $my_seo_settings_options["generate_json_ld_fpwebpage_fmenu"]; //footer menu slug
        $locations = get_nav_menu_locations();
        if (
            $locations && isset($locations[ $menu_name ]) && $locations[ $menu_name ] != 0
        ) {
            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            foreach ($menu_items as $menu) {
                $menu_elements[] = ["@type" =>["SiteNavigationElement","WPFooter"], "name" => $menu->title, "url" => $menu->url, "@id" => "schema:SiteNavigationElement"];
            }
        }

        $data["@context"]  = "http://schema.org";
        $data["@type"] = "WebPageElement";
		$data["@id"] = "schema:WebPageElement";
		$data["name"] = "WebpageElement";
		$data["isPartOf"] = [
		"@type" => "WebPage",
		"@id" => "schema:WebPage"
		];
			
        if (!empty($menu_elements)) {
            $data["hasPart"] = [$menu_elements];
        }

        return $data;
    }

    public function settings() {
        $settings = GeneralSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();
    }


}
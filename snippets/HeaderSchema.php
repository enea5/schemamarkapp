<?php
class HeaderSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        global $post;

        return $post != null && Markapp_Schema_Matcher::isHeader($post);
    }

    public function schema()
    {
        global $my_seo_settings_options;
        global $post;
        $data = [];

        $menu_elements = [];

        $menu_name = $my_seo_settings_options["generate_json_ld_fpwebpage_menu"]; //menu slug
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            foreach ($menu_items as $menu) {
                $menu_elements[] = ["@type" => ["SiteNavigationElement","WPHeader"], "name" => $menu->title, "url" => $menu->url, "@id" => "schema:SiteNavigationElement"];
            }
        }

        $data["@context"]  = "http://schema.org";
        $data["@type"] = "WebPageElement";
		$data["@id"] = "schema:WebPageElement";
		$data["name"] = "WebpageElement";			
        if (!empty($menu_elements)) {
            $data["hasPart"] = $menu_elements;					
        }
        if (Markapp_Schema_Matcher::isSearch($post)) {
            $search[] = [
                    "@type" => "SearchAction",
                    "@id" => "schema:SearchAction",
                    "target" => home_url() . '/?s={search_term_string}',
                    "query-input" => "required name=search_term_string"];
            $data["potentialAction"] = $search; 
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

<?php
	
	trait NavigationTrait
	{
	    /**
	     * @param array $general_options
	     * @return array
	     */
	    protected function buildHeaderMenu(): array
	    {
	        $general_options = GeneralSettings::instance()->getOptions();
	
	        $hmenu_elements = [];
	
	        $menu_name = $general_options["generate_json_ld_fpwebpage_menu"]; //menu slug
	        if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
	            $menu = wp_get_nav_menu_object($locations[$menu_name]);
	            $menu_items = wp_get_nav_menu_items($menu->term_id);
	            foreach ($menu_items as $menu) {
	                $hmenu_elements[] = ["@type" => ["SiteNavigationElement","WPHeader"], "name" => $menu->title, "url" => $menu->url, "@id" => "schema:SiteNavigationElement"];
	            }
	        }
	
	        $part =[
	            "@type" => "WebPageElement",
	            "@id" => "schema:WebPageElement",
	            "name" => $general_options["generate_json_ld_fpwebpage_name"] ?? null,
	            "url" => home_url(add_query_arg(null, null)),
				"@graph" => [$hmenu_elements]
	
	
	        ];
	
	        return $part;
	    }
	
	    /**
	     * @param array $general_options
	     * @return array
	     */
	    protected function buildFooterMenu(): array
	    {
	        $general_options = GeneralSettings::instance()->getOptions();
	
	        $fmenu_elements = [];
	        $menu_name = $general_options["generate_json_ld_fpwebpage_fmenu"]; //footer menu slug
	        $locations = get_nav_menu_locations();
	        if (
	            $locations && isset($locations[$menu_name]) && $locations[$menu_name] != 0
	        ) {
	            $menu = wp_get_nav_menu_object($locations[$menu_name]);
	            $menu_items = wp_get_nav_menu_items($menu->term_id);
	            foreach ($menu_items as $menu) {
	                $fmenu_elements[] = ["@type" => ["SiteNavigationElement","WPFooter"], "name" => $menu->title, "url" => $menu->url, "@id" => "schema:SiteNavigationElement"];
	            }
	        }
	
	        return [
	            "@type" => "WebPageElement",
	            "@id" => "schema:WebPageElement",
	            "name" => $general_options["generate_json_ld_fpwebpage_name"] ?? null,
	            "url" => home_url(add_query_arg(null, null)),
				"@graph" => [$fmenu_elements]
	
	
	        ];
	    }
	
	    /**
	     * @param array $webpageEntity
	     * @return array
	     * @throws Exception
	     */
	    protected function buildHasPart(array $webpageEntity): array
	    {
	        $general_options = GeneralSettings::instance()->getOptions();
	        $parts = [];
	
	        $headerItems = $this->buildHeaderMenu($general_options);
	        if (count($headerItems) > 0) {
	            $parts[] = [
	                "@type" => "WPHeader",
	                "@id" => "schema:WPHeader",
	                "name" => $general_options["generate_json_ld_fpwebpage_name"] ?? null,
	                "url" => home_url(add_query_arg(null, null)),
					"@graph" => [$headerItems]
	
	
	            ];
	        }
	
	        $footerItems = $this->buildFooterMenu($general_options);
	        if (count($footerItems) > 0) {
	            $parts[] = [
	                "@type" => "WPFooter",
	                "@id" => "schema:WPFooter",
	                "name" => $general_options["generate_json_ld_fpwebpage_name"] ?? null,
	                "url" => home_url(add_query_arg(null, null)),
					"@graph" => [$footerItems]
	
	
	            ];
	        }
	        if (count($parts) > 0) {
	             $webpageEntity[]= $parts;
	
	
	        }
	
	        return $webpageEntity;
	    }
	}
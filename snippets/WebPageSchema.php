<?php
class WebPageSchema extends GenericSchema
{
    use NavigationTrait;

    public function mustRenderOnPage()
    {
        global $post;

        return $post !== null && (Markapp_Schema_Matcher::isSubPage($post) || Markapp_Schema_Matcher::isFrontPage($post));
    }

    public function schema()
    {
        global $my_seo_settings_options;
        global $post;
        global $my_seo_settings_author_options;
        global $authors;
        global $my_seo_settings_about_page_options;
        global $my_seo_settings_article_options;

        
        $ancestors = ma_get_page_ancestors($post);
        $breadcrumbs = [];
        foreach ($ancestors as $i => $p) {
            // Docs: https://developers.google.com/search/docs/data-types/breadcrumb
            $breadcrumbs[] = [
                "@type" => "ListItem",
                "position" => ($i + 1),
                "@id" => "schema:ListItem",
                "name" => get_the_title($p),
                "item" => get_permalink($p)
                ];
        }
        $options = GeneralSettings::instance()->getOptions();
        $publisher = PublisherSettings::instance()->getOptions();
		$authors = AuthorSettings::instance()->getOptions();
        

        $data = [];
        $data["@context"] = "http://schema.org";
        $data["@type"] = "WebPage";
        $data["@id"] = "schema:WebPage";
        $data["url"] = home_url(add_query_arg(null, null));
        $data["inLanguage"] = [
                "@type" => "Language",
            "@id" => "schema:Language",
                "name" => $my_seo_settings_options["generate_json_ld_fpwebpage_inlanguage"] ?? null
            ];
		$data["speakable"] = [
                '@type' => 'SpeakableSpecification',
                "@id" => "schema:SpeakableSpecification",
                'xpath' => [
                    "/html/head/title", "/html/head/meta[@name='description']/@content",
                ]
            ];
		$data["about"] = [
			"@type" => "CreativeWork",
			"@id" => "schema:CreativeWork",
			"name" => get_the_title(),
			"description" => get_the_excerpt()];
        $data["datePublished"] = get_the_date('c');
        $data["dateModified"] = get_the_modified_date('c');
        $data["description"] = get_the_excerpt(55);
        $data["speakable"] = [
                '@type' => 'SpeakableSpecification',
                "@id" => "schema:SpeakableSpecification",
                'xpath' => [
                    "/html/head/title", "/html/head/meta[@name='description']/@content",
                ]
            ];
         $data["isPartOf"] = [
                "@type" => "WebSite",
                "@id" => "schema:WebSite",
                "url" => home_url(),
                "name" => $my_seo_settings_options["generate_json_ld_fpwebpage_name"] ?? null
                ];
		 $data["hasPart"] = [
        "@type" => "WebPageElement",
        "@id" => "schema:WebPageElement"];

        if (!Markapp_Schema_Matcher::isFrontPage($post)) {
            $mainEntity[] = array(
                "@type" => "BreadcrumbList",
                "name" => "BreadcrumbList",
                "@id" => "schema:BreadcrumbList",
                "numberOfItems" => count($breadcrumbs),
                "itemListElement" => $breadcrumbs
            );
            $data["breadcrumb"] = $mainEntity;                  
        }

        if (Markapp_Schema_Matcher::isAuthor($post)) {   
            $authors = [];
            $authors["@type"] = "Person";
            $authors["@id"] = "schema:Person";
            $authors["email"] = $my_seo_settings_author_options["generate_json_ld_author_email"] ?? null;
            $authors["gender"] = $my_seo_settings_author_options["generate_json_ld_author_gender"] ?? null;
            $authors["familyName"] = $my_seo_settings_author_options["generate_json_ld_author_family_name"] ?? null;
            $authors["givenName"] = $my_seo_settings_author_options["generate_json_ld_author_given_name"] ?? null;
            $authors["jobTitle"] = $my_seo_settings_author_options["generate_json_ld_author_job_title"] ?? null;
            $authors["height"] = $my_seo_settings_author_options["generate_json_ld_author_height"] ?? null;
            $authors["knowsLanguage"] = $my_seo_settings_author_options["generate_json_ld_author_knowslanguage"] ?? null;
            $authors["memberOf"] = $my_seo_settings_author_options["generate_json_ld_author_memberof"] ?? null;
            $authors["nationality"] = $my_seo_settings_author_options["generate_json_ld_author_nationality"] ?? null;
            $authors["spouse"] = $my_seo_settings_author_options["generate_json_ld_author_spouse"] ?? null;
            $authors["telephone"] = $my_seo_settings_author_options["generate_json_ld_author_telephone"] ?? null;
            $authors["workLocation"] =  [
                "@type" => "Place",
                "name" => $my_seo_settings_author_options["generate_json_ld_author_place_name"] ?? null,
                "sameAs" => $my_seo_settings_author_options["generate_json_ld_author_place_sameas"] ?? null,
                "address" => array(
                    "@type" => "PostalAddress",
                    "streetAddress" => $my_seo_settings_author_options["generate_json_ld_author_work_address_street_address"] ?? null,
                    "addressLocality" => $my_seo_settings_author_options["generate_json_ld_author_work_address_address_locality"] ?? null,
                    "addressRegion" => $my_seo_settings_author_options["generate_json_ld_author_work_address_address_region"] ?? null,
                    "postalCode" => $my_seo_settings_author_options["generate_json_ld_author_work_address_postal_code"] ?? null,
                    "addressCountry" => $my_seo_settings_author_options["generate_json_ld_author_work_address_address_country"] ?? null
                )
            ];
            $authors["worksFor"] = [
            "@type" => "Organization",
            "@id" => "schema:Organization"];
            $authors["description"] = $my_seo_settings_author_options["generate_json_ld_author_description"] ?? null;
            $authors["image"] = array(
                "@type"  => "ImageObject",
				"@id" => "schema:ImageObject",
                 "url" => $my_seo_settings_author_options["generate_json_ld_author_image"] ?? null
            );
            $authors["address"] = [
                "@type" => "PostalAddress",
				"@id" => "PostalAddress",
                "streetAddress" => $my_seo_settings_author_options["generate_json_ld_author_location_street_address"] ?? null,
                "addressLocality" => $my_seo_settings_author_options["generate_json_ld_author_location_address_locality"] ?? null,
                "addressRegion" => $my_seo_settings_author_options["generate_json_ld_author_location_address_region"] ?? null,
                "postalCode" => $my_seo_settings_author_options["generate_json_ld_author_location_postal_code"] ?? null,
                "addressCountry" => $my_seo_settings_author_options["generate_json_ld_author_location_address_country"] ?? null
            ];

            $data["author"] = $authors;
        }
	    if (Markapp_Schema_Matcher::isPublisher($post)) {
            
            $publishers = [];
            $publishers["@type"] = "Organization";
            $publishers["@id"] = "schema:Organization";
            $publishers["url"] = home_url(add_query_arg(null, null));
            $publishers["name"] = get_bloginfo('name');
            $publishers["sameAs"] = array(
                        $my_seo_settings_about_page_options['generate_json_ld_about_page_facebook'] ?? null,
                        $my_seo_settings_about_page_options['generate_json_ld_about_page_twitter'] ?? null,
                        $my_seo_settings_about_page_options['generate_json_ld_about_page_instagram'] ?? null,
                        $my_seo_settings_about_page_options['generate_json_ld_about_page_linkedin'] ?? null
                    );
             $publishers["logo"] = array(
                        "@type" => "ImageObject",
                        "url" => $my_seo_settings_options['generate_json_ld_logo_url'] ?? null,
                        "@id" => "schema:ImageObject",
                    );
            $data["publisher"] = $publishers;
            
        }
        
        return $data;
        
    }
        
    public function settings()
    {
        $settings = GeneralSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();

        $settings = AboutPageSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();
        
        $settings = AuthorSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();
        
        $settings = PublisherSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();
    }
}
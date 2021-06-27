<?php
class PersonSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        global $post;

        return $post !== null && Markapp_Schema_Matcher::isPersonPage($post);
    }

    public function schema()
    {
        global $my_seo_settings_person_options;

        $datap = [];


        $datap["@context"] = "http://schema.org";
        $datap["@type"] = "Person";
        $datap["@id"] = "schema:Person";
		$datap["name"] =  "Person";
        $datap["email"] = $my_seo_settings_person_options['generate_json_ld_person_email'] ?? null;
        $datap["gender"] =  $my_seo_settings_person_options['generate_json_ld_person_gender'] ?? null;
        $datap["familyName"] =  $my_seo_settings_person_options['generate_json_ld_person_family_name'] ?? null;
        $datap["givenName"] =  $my_seo_settings_person_options['generate_json_ld_person_given_name'] ?? null;
        $datap["jobTitle"] =  $my_seo_settings_person_options['generate_json_ld_person_job_title'] ?? null;
        $datap["height"] =  $my_seo_settings_person_options['generate_json_ld_person_height'] ?? null;
        $datap["knowsLanguage"] =  $my_seo_settings_person_options['generate_json_ld_person_knowslanguage'] ?? null;
        $datap["memberOf"] =  $my_seo_settings_person_options['generate_json_ld_person_memberof'] ?? null;
        $datap["nationality"] =  $my_seo_settings_person_options['generate_json_ld_person_nationality'] ?? null;
        $datap["spouse"] =  $my_seo_settings_person_options['generate_json_ld_person_spouse'] ?? null;
        $datap["telephone"] =  $my_seo_settings_person_options['generate_json_ld_person_telephone'] ?? null;
        $datap["workLocation"] =  [
            "@type" => "Place",
            "name" => $my_seo_settings_person_options['generate_json_ld_person_place_name'] ?? null,
            "sameAs" => $my_seo_settings_person_options['generate_json_ld_person_place_sameas'] ?? null,
            "address" => array(
                "@type" => "PostalAddress",
                "streetAddress" => $my_seo_settings_person_options['generate_json_ld_person_work_address_street_address'] ?? null,
                "addressLocality" => $my_seo_settings_person_options['generate_json_ld_person_work_address_address_locality'] ?? null,
                "addressRegion" => $my_seo_settings_person_options['generate_json_ld_person_work_address_address_region'] ?? null,
                "postalCode" => $my_seo_settings_person_options['generate_json_ld_person_work_address_postal_code'] ?? null,
                "addressCountry" => $my_seo_settings_person_options['generate_json_ld_person_work_address_address_country'] ?? null
            )
        ];

        $datap["worksFor"] = [
		"@type" => "Organization",
		"@id" => "schema:Organization"];
        $datap["description"] = $my_seo_settings_person_options['generate_json_ld_person_description'] ?? null;
        $datap["image"] = array(
            "@type"  => "ImageObject",
            "url"    => $my_seo_settings_person_options['generate_json_ld_person_image'] ?? null
        );
        $datap["address"] = [
            "@type" => "PostalAddress",
            "streetAddress" => $my_seo_settings_person_options['generate_json_ld_person_location_street_address'] ?? null,
            "addressLocality" => $my_seo_settings_person_options['generate_json_ld_person_location_address_locality'] ?? null,
            "addressRegion" => $my_seo_settings_person_options['generate_json_ld_person_location_address_region'] ?? null,
            "postalCode" => $my_seo_settings_person_options['generate_json_ld_person_location_postal_code'] ?? null,
            "addressCountry" => $my_seo_settings_person_options['generate_json_ld_person_location_address_country'] ?? null
        ];
		$data["isPartOf"] = [
			"@type" => "Webpage",
			"@id" => "schema:WebPage",
			"url" => "schema:WebPage"];

        return $datap;
    }

    public function settings()
    {
        $settings = PersonSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();
    }
}
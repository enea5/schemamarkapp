<?php
class ContactPageSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        global $post;

        return $post != null && Markapp_Schema_Matcher::isContactPage($post);
    }

    public function schema()
    {
        global $my_seo_settings_contact_page_options;
		global $my_seo_settings_about_page_options;

        $data = [];

        $data["@context"] = "http://schema.org";
        $data["@type"] = "ContactPage";
        $data["@id"] = "schema:ContactPage";
		$data["name"] = "Contact Page";
		$data["about"] = [
			"@type" => "CreativeWork",
			"@id" => "schema:CreativeWork",
			"name" => get_the_title(),
			"description" => get_the_excerpt(55)];
		$data["isPartOf"] = [
			"@type" => "Webpage",
			"@id" => "schema:WebPage",
			"url" => "schema:WebPage"];
		$data["primaryImageOfPage"] = [
			"@type"  => "ImageObject",
				"@id" => "schema:ImageObject",
                "url" => get_the_post_thumbnail_url()
		];
		$data["lastReviewed"] = get_the_modified_date( 'c' );
		$data["reviewedBy"] = [
			"@type" => "Organization",
			"@id" => "schema:Organization"
		];
		$data["specialty"] = ["@type"  => "Specialty",
				"@id" => "schema:Specialty",
                "description" => $my_seo_settings_about_page_options['generate_json_ld_about_page_speciality_description'] ?? null,
                "name" => $my_seo_settings_about_page_options['generate_json_ld_about_page_speciality_name'] ?? null];
        return $data;
    }

    public function settings()
    {
        $settings = ContactPageSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();
    }
}
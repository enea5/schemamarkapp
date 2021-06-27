<?php
class RecommendationSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        return false; // comment this out to enable schema

        global $post;

        return $post !== null && Markapp_Schema_Matcher::isFrontPage($post);
    }

    public function schema()
    {
        global $my_seo_settings_options;

        $data = [];

        $data["@context"] = "http://schema.org";
        $data["@type"] = "Webpage";
        $data["@id"] = "schema:Webpage";
        $data["url"] = home_url(add_query_arg(null, null));
        $data["name"] = $my_seo_settings_options["generate_json_ld_recommendation_name"] ?? null;
        $data["about"] = $my_seo_settings_options["generate_json_ld_recommendation_about"] ?? null;
        $data["abstract"] = $my_seo_settings_options["generate_json_ld_recommendation_abstract"] ?? null;
        $data["category"] = $my_seo_settings_options["generate_json_ld_recommendation_category"] ?? null;
        $data["itemReviewed"] = $my_seo_settings_options["generate_json_ld_recommendation_itemReviewed"] ?? null;
        $data["reviewAspect"] = $my_seo_settings_options["generate_json_ld_recommendation_reviewAspect"] ?? null;
        $data["reviewBody"] = $my_seo_settings_options["generate_json_ld_recommendation_reviewBody"] ?? null;
        $data["reviewRating"] = $my_seo_settings_options["generate_json_ld_recommendation_reviewRating"] ?? null;
        $data["dateCreated"] = $my_seo_settings_options["generate_json_ld_recommendation_dateCreated"] ?? null;
        $data["headline"] = $my_seo_settings_options["generate_json_ld_recommendation_headline"] ?? null;
        $data["inLanguage"] = $my_seo_settings_options["generate_json_ld_recommendation_inLanguage"] ?? null;
        $data["isFamilyFriendly"] = $my_seo_settings_options["generate_json_ld_recommendation_isFamilyFriendly"] ?? null;
        $data["teaches"] = $my_seo_settings_options["generate_json_ld_recommendation_teaches"] ?? null;
        $data["keywords"] = $my_seo_settings_options["generate_json_ld_recommendation_keywords"] ?? null;
        $data["description"] = $my_seo_settings_options["generate_json_ld_recommendation_description"] ?? null;

        return $data;
    }

}

<?php
class ProductSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        global $post;

        return $post !== null && Markapp_Schema_Matcher::isWoocommerceProduct($post);
    }

    public function schema()
    {
        global $post;
        global $my_seo_settings_product_options;
        $data = [];

        $product =  (new WC_Product_Factory())->get_product($post->ID);

        $data["@context"] = "http://schema.org";
        $data["@id"] =  "schema:Product";
        $data["@type"] = "Product";
        $data["name"] = get_the_title();
        $data["image"] = array(
            "@type" => "ImageObject",
            "url" => get_the_post_thumbnail_url());
        $data["ProductID"] = get_post_meta($product->id, "_schema_markup_product_product_id", true);
        $data["audience"] = get_post_meta($product->id, "_schema_markup_product_audience", true);
        $data["color"] = get_post_meta($product->id, "_schema_markup_product_color", true);
        $data["depth"] = $product->get_length();
        $data["height"] = $product->get_height();
        $data["model"] = get_post_meta($product->id, "_schema_markup_product_model", true);
        $data["weight"] = $product->get_weight();
        $data["width"] = $product->get_width();
        $data["brand"] = [
            "@type" => "Brand",
			"@id" => "schema:Brand",
            "name" => get_post_meta($product->id, "_schema_markup_product_brand", true)
        ];
        $data["sku"] = $product->sku;
        $data["offers"] = [
            "@id" =>  "schema:OfferForPurchase"
        ];
        $data["mpn"] = get_post_meta($product->id, "_schema_markup_product_mpn", true);
        $data["gtin"] = get_post_meta($product->id, "_schema_markup_product_gtin", true);
        $data["review"] = [
            "@type" => "Review",
			"@id" => "schema:Review",
            "author" => get_post_meta($product->id, "_schema_markup_product_review_author", true),
            "reviewRating" => [
                "@type" => "Rating",
				"@id" => "schema:Rating",
                "ratingValue" => get_post_meta($product->id, "_schema_markup_product_review_rating_value", true),
                "bestRating" => get_post_meta($product->id, "_schema_markup_product_review_best_rating", true)
            ]];
        $data["description"] = get_the_excerpt();
        $data["aggregateRating"] = [
            "@type" => "AggregateRating",
			"@id" => "schema:AggregateRating",
            "ratingValue" => get_post_meta($product->id, "_schema_markup_product_aggregate_rating_value", true),
            "bestRating" => "",
            "worstRating" => "",
            "ratingCount" => "",
            "reviewCount" => get_post_meta($product->id, "_schema_markup_product_aggregate_review_count", true)
        ];

        return $data;
    }

    public function settings()
    {
        $settings = ProductSettings::instance();
        $settings->initDefaultSection();
        $settings->initSidebarSettingsPage(get_class($this));
        $settings->renderSidebarForm();
    }
}
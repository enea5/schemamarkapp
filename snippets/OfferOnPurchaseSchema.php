<?php
class OfferOnPurchaseSchema extends GenericSchema
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

        $offer = [];


        $product =  (new WC_Product_Factory())->get_product($post->ID);

        $offer["@context"]      = "http://schema.org";
		$offer["@type"] = "OfferForPurchase";
        $offer["@id"] =  "schema:OfferForPurchase";
        $offer["itemOffered"] = [
            "@id" =>  "schema:Product"
        ];
        $offer["price"] = $product->get_price();
        $offer["priceCurrency"] = get_option('woocommerce_currency');
        $offer["sku"] = $product->sku;
        $offer["mpn"] = get_post_meta($product->id, "_schema_markup_product_mpn", true);
        $offer["priceValidUntil"] = get_post_meta($product->id, "_schema_markup_product_price_valid_until", true);
        $offer["availability"] = "http://schema.org/InStock";
        $offer["itemCondition"] = "http://schema.org/NewCondition";

        return $offer;
    }

}

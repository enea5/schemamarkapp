<?php

class Markapp_Schema_Matcher
{
    public static function isFrontPage(\WP_Post $post = null)
    {
        if ($post === null) {
            return false;
        }


        $my_seo_settings_options = get_option('my_seo_settings_general');

        // is_front_page doesn't work here properly, if there is a better way to do this check, please do
        return (int)get_option( 'page_on_front' ) === $post->ID
            && $my_seo_settings_options['generate_json_ld_fpwebpage'] === '1';
    }

    public static function isHeader(\WP_Post $post)
    {
        $options = get_option('my_seo_settings_general');
        $menu_name = $options["generate_json_ld_fpwebpage_menu"];
        $locations = get_nav_menu_locations();

        return static::isFrontPage($post) && $post->post_type == 'page' OR 'post'
            && isset($locations[$menu_name]);
    }
    public static function isSearch(\WP_Post $post)
    {
        $options = get_option('my_seo_settings_general');
        return $options['search_bar'] === '1';
        
        // return static::isFrontPage($post) && $post->post_type == 'page' OR 'post';
    }
    
    public static function isFooter(\WP_Post $post)
    {
        $options = get_option('my_seo_settings_general');
        $menu_name = $options["generate_json_ld_fpwebpage_fmenu"];
        $locations = get_nav_menu_locations();

        return static::isFrontPage($post) && $post->post_type == 'page' OR 'post'
            && isset($locations[$menu_name]);
    }

    public static function isAboutPage(\WP_Post $post)
    {
        $my_seo_settings_about_page_options = get_option('my_seo_settings_about_page');

        return $post->ID == $my_seo_settings_about_page_options['generate_json_ld_about_page_related_page']
            && $my_seo_settings_about_page_options['generate_json_ld_about_page'] === '1';
    }
    
    public static function isContactPage(\WP_Post $post)
    {
        $my_seo_settings_contact_page_options = get_option('my_seo_settings_contact_page');

        return $post->ID == $my_seo_settings_contact_page_options['generate_json_ld_contact_page_related_page']
            && $my_seo_settings_contact_page_options['generate_json_ld_contact_page'] === '1';
    }

    public static function isSubPage(\WP_Post $post)
    {
        $my_seo_settings_options = get_option('my_seo_settings_general');

        return !self::isFrontPage($post) && ( ( $post->post_type == 'page' && $my_seo_settings_options['generate_json_ld_webpage'] === '1' ) || $my_seo_settings_options['generate_json_ld_posts'] === '1' );
    }
    
    public static function isAuthor(\WP_Post $post)
    {
        $my_seo_settings_author_options = get_option('my_seo_settings_author');
        return $my_seo_settings_author_options['generate_json_ld_author'] === '1';
    }
    
    public static function isPublisher(\WP_Post $post)
    {
        $my_seo_settings_publisher_options = get_option('my_seo_settings_publisher');
        
        return $my_seo_settings_publisher_options['generate_json_ld_publisher'] === '1';
    }
    
    public static function isFAQPage(\WP_Post $post)
    {
        $my_seo_settings_options = get_option('my_seo_settings_general');
        return $my_seo_settings_options['generate_json_ld_faq'] === '1';
    }

    public static function isLocalBusinessPage(\WP_Post $post)
    {
        $my_seo_settings_local_business_options = get_option('my_seo_settings_local_business');

        return $post->ID == $my_seo_settings_local_business_options['generate_json_ld_localbusiness_related_page']
            && $my_seo_settings_local_business_options['generate_json_ld_localbusiness'] == 1;
    }

    public static function isPersonPage(\WP_Post $post)
    {
        $my_seo_settings_person_options = get_option('my_seo_settings_person');

        return $post->ID == $my_seo_settings_person_options['generate_json_ld_person_related_page']
            && $my_seo_settings_person_options['generate_json_ld_person'] == 1;
    }

    public static function isRecipe(\WP_Post $post)
    {
        $my_seo_settings_recipe_options = get_option('my_seo_settings_general');

        return $my_seo_settings_recipe_options['generate_json_ld_recipe'] == 1 &&
            $post->post_type == 'post';
    }

    public static function isArticle(\WP_Post $post)
    {
        $my_seo_settings_article_options = get_option('my_seo_settings_article');

        return $post->post_type == 'post' && $my_seo_settings_article_options['generate_json_ld'] === '1';
    }

    public static function isWoocommerceProduct(\WP_Post $post)
    {
        if (!class_exists('WC_Product_Factory')) {
            return false;
        }

        $product = (new WC_Product_Factory())->get_product($post->ID);
        $my_seo_settings_product_options = get_option('my_seo_settings_product');

        return !!$product
            && $my_seo_settings_product_options['generate_json_ld_product'] === '1';
    }
}

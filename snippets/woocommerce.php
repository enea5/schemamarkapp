<?php
//
// Do not load these hooks if woocommerce integration is disabled
//
$my_seo_settings_product_options = get_option('my_seo_settings_product');
if (!trim($my_seo_settings_product_options['woocommerce_hooks'])) {
    return; //
}

add_action( 'woocommerce_product_options_general_product_data', 'schema_markup_custom_general_fields' );
add_action( 'woocommerce_process_product_meta', 'schema_markup_save_custom_general_fields' );
add_action( 'woocommerce_product_after_variable_attributes', 'schema_markup_custom_variable_fields', 10, 3 );
add_action( 'woocommerce_save_product_variation', 'schema_markup_save_custom_variable_fields', 10, 1 );
function schema_markup_custom_general_fields()
{
    global $woocommerce, $post;
    echo '<div id="schema_markup_attr" class="options_group">';
    //ob_start();

    //Brand field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_brand',
            'label'       => __( 'Brand', 'woocommerce' ),
            'desc_tip'    => 'true',
            'type'      => 'text',
            'value' 	  =>  get_post_meta( $post->ID, '_schema_markup_product_brand', true ),
            'description' => __( 'Enter the product Brand here.', 'woocommerce' )
        )
    );
    echo '</div>';
    echo '<div id="schema_markup_attr" class="options_group show_if_simple show_if_external">';

    //MPN Field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_mpn',
            'label'       => __( 'MPN', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter the manufacturer product number', 'woocommerce' ),
        )
    );
    //Audience Field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_audience',
            'label'       => __( 'audience', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter Target Audience', 'woocommerce' ),
        )
    );
    //Color Field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_color',
            'label'       => __( 'color', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter Product color', 'woocommerce' ),
        )
    );
    //Product ID
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_product_id',
            'label'       => __( 'Product ID', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter product ID', 'woocommerce' ),
        )
    );
    //Product Model
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_model',
            'label'       => __( 'Product Model', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter product Model', 'woocommerce' ),
        )
    );
    //Product Price Valid Until
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_price_valid_until',
            'label'       => __( 'Price Valid Until', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'enter date for price valid until', 'woocommerce' ),
        )
    );
    //Product review rating value
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_review_rating_value',
            'label'       => __( 'Review Rating Value', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter review rating value-not recommended by Google', 'woocommerce' ),
        )
    );
    //product review best rating
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_review_best_rating',
            'label'       => __( 'Review Rating Best Value', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter review rating best value-not recommended by Google', 'woocommerce' ),
        )
    );
    //Product aggregate review rating value
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_aggregate_rating_value',
            'label'       => __( 'Aggregate Rating Value', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter Aggregate rating value-not recommended by Google', 'woocommerce' ),
        )
    );
    //Product aggregate review count
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_aggregate_review_count',
            'label'       => __( 'Aggregate Review Count', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter Aggregate Review Count value', 'woocommerce' ),
        )
    );
    //Product review author
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_review_author',
            'label'       => __( 'Review Author', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter Review Author', 'woocommerce' ),
        )
    );

    //Global Trade Item Number (GTIN) Field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_product_gtin',
            'label'       => __( 'GTIN', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Global Trade Item Number (GTIN) here.', 'woocommerce' ),
        )
    );

    //Optimized product custom title Field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_optimized_title',
            'label'       => __( 'Optimized title', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter a optimized product title.', 'woocommerce' ),
        )
    );
    echo '</div>';
}

function schema_markup_save_custom_general_fields($post_id)
{

    $woocommerce_brand 	= $_POST['_schema_markup_product_brand'];
    $woocommerce_mpn 	= $_POST['_schema_markup_product_mpn'];
    $audience 	= $_POST['_schema_markup_product_audience'];
    $color 	= $_POST['_schema_markup_product_color'];
    $product_id = $_POST['_schema_markup_product_product_id'];
    $product_model = $_POST['_schema_markup_product_model'];
    $price_valid_until 	= $_POST['_schema_markup_product_price_valid_until'];
    $review_rating_value  = $_POST['_schema_markup_product_review_rating_value'];
    $review_best_rating  = $_POST['_schema_markup_product_review_best_rating'];
    $aggregate_rating_value  = $_POST['_schema_markup_product_aggregate_rating_value'];
    $aggregate_review_count  = $_POST['_schema_markup_product_aggregate_review_count'];
    $review_author  = $_POST['_schema_markup_product_review_author'];
    $woocommerce_gtin 	= $_POST['_schema_markup_product_gtin'];
    $woocommerce_title 	= $_POST['_schema_markup_optimized_title'];
    if(isset($woocommerce_brand))
        update_post_meta( $post_id, '_schema_markup_product_brand', esc_attr($woocommerce_brand));
    if(isset($woocommerce_mpn))
        update_post_meta( $post_id, '_schema_markup_product_mpn', esc_attr($woocommerce_mpn));
    if(isset($audience))
        update_post_meta( $post_id, '_schema_markup_product_audience', esc_attr($audience));
    if(isset($color))
        update_post_meta( $post_id, '_schema_markup_product_color', esc_attr($color));
    if(isset($product_id))
        update_post_meta( $post_id, '_schema_markup_product_product_id', esc_attr($product_id));
    if(isset($product_model))
        update_post_meta( $post_id, '_schema_markup_product_model', esc_attr($product_model));
    if(isset($price_valid_until))
        update_post_meta( $post_id, '_schema_markup_product_price_valid_until', esc_attr($price_valid_until));
    if(isset($review_rating_value))
        update_post_meta( $post_id, '_schema_markup_product_review_rating_value', esc_attr($review_rating_value));
    if(isset($review_best_rating))
        update_post_meta( $post_id, '_schema_markup_product_review_best_rating', esc_attr($review_best_rating));
    if(isset($aggregate_rating_value))
        update_post_meta( $post_id, '_schema_markup_product_aggregate_rating_value', esc_attr($aggregate_rating_value));
    if(isset($aggregate_review_count))
        update_post_meta( $post_id, '_schema_markup_product_aggregate_review_count', esc_attr($aggregate_review_count));
    if(isset($review_author))
        update_post_meta( $post_id, '_schema_markup_product_review_author', esc_attr($review_author));
    if(isset($woocommerce_gtin))
        update_post_meta( $post_id, '_schema_markup_product_gtin', esc_attr($woocommerce_gtin));
    if(isset($woocommerce_title))
        update_post_meta( $post_id, '_schema_markup_optimized_title', esc_attr($woocommerce_title));
}

function schema_markup_custom_variable_fields( $loop, $variation_id, $variation ) {

    // Variation Brand field
    woocommerce_wp_text_input(
        array(
            'id'       => '_schema_markup_variable_brand['.$loop.']',
            'label'       => __( '<br>Brand', 'woocommerce' ),
            'placeholder' => 'Parent Brand',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Brand here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_brand', true),
            'wrapper_class' => 'form-row-full',
        )
    );
    // Variation MPN field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_mpn['.$loop.']',
            'label'       => __( '<br>MPN', 'woocommerce' ),
            'placeholder' => 'Manufacturer Product Number',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product UPC here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_mpn', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    //Audience Field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_audience',
            'label'       => __( 'audience', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter Target Audience', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_audience', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    //Color Field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_color',
            'label'       => __( 'color', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter Product color', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_color', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    //Product ID
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_product_id',
            'label'       => __( 'Product ID', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter product ID', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_product_id', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    //Product Model
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_model',
            'label'       => __( 'Product Model', 'woocommerce' ),
            'desc_tip'    => 'true',
            'description' => __( 'Enter product Model', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_model', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    // Variation Price Valid Until field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_price_valid_until['.$loop.']',
            'label'       => __( '<br>Price Valid Until', 'woocommerce' ),
            'placeholder' => 'Price Valid Until',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Price Valid Until here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_price_valid_until', true),
            'wrapper_class' => 'form-row-first',
        )
    );

    // Variation Review Rating Value field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_prodcut_review_rating_value['.$loop.']',
            'label'       => __( '<br>Review Rating Value', 'woocommerce' ),
            'placeholder' => 'Review Rating Value - NOT RECOMMENDED BY GOOGLE',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Review rating value here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_review_rating_value', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    // Variation Review Best Rating Value field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_review_best_rating['.$loop.']',
            'label'       => __( '<br>Review Best Rating Value', 'woocommerce' ),
            'placeholder' => 'Review Best Rating Value - NOT RECOMMENDED BY GOOGLE',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Best Review rating value here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_review_best_rating', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    // Variation Aggregate Rating Value field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_aggregate_rating_value['.$loop.']',
            'label'       => __( '<br>Aggregate Rating Value', 'woocommerce' ),
            'placeholder' => 'Aggregate Rating Value - NOT RECOMMENDED BY GOOGLE',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Aggregate rating value here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_aggregate_rating_value', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    // Variation Aggregate Review Count field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_aggregate_review_count['.$loop.']',
            'label'       => __( '<br>Aggregate Review Count', 'woocommerce' ),
            'placeholder' => 'Aggregate Review Count - NOT RECOMMENDED BY GOOGLE',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Aggregate review count here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_aggregate_review_count', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    // Variation Review Author field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_product_review_author['.$loop.']',
            'label'       => __( '<br>Review Author', 'woocommerce' ),
            'placeholder' => 'Review Author - NOT RECOMMENDED BY GOOGLE',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product Review author here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_product_review_author', true),
            'wrapper_class' => 'form-row-first',
        )
    );
    // Variation GTIN field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_variable_gtin['.$loop.']',
            'label'       => __( '<br>GTIN', 'woocommerce' ),
            'placeholder' => 'GTIN',
            'desc_tip'    => 'true',
            'description' => __( 'Enter the product GTIN here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_gtin', true),
            'wrapper_class' => 'form-row-last',
        )
    );

    // Variation optimized title field
    woocommerce_wp_text_input(
        array(
            'id'          => '_schema_markup_optimized_title['.$loop.']',
            'label'       => __( '<br>Optimized title', 'woocommerce' ),
            'placeholder' => 'Opt title',
            'desc_tip'    => 'true',
            'description' => __( 'Enter a optimized product title here.', 'woocommerce' ),
            'value'       => get_post_meta($variation->ID, '_schema_markup_optimized_title', true),
            'wrapper_class' => 'form-row-last',
        )
    );
}

function schema_markup_save_custom_variable_fields( $post_id ) {

    if (isset( $_POST['variable_sku'] ) ) {
        $variable_sku          = $_POST['variable_sku'];
        $variable_post_id      = $_POST['variable_post_id'];

        $max_loop = max( array_keys( $_POST['variable_post_id'] ) );
        for ( $i = 0; $i <= $max_loop; $i++ ) {
            if ( ! isset( $variable_post_id[ $i ] ) ) {
                continue;
            }
            // Brand Field
            $_brand = $_POST['_schema_markup_variable_brand'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_brand[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_brand', stripslashes( $_brand[$i]));
            }
            // MPN Field
            $_mpn = $_POST['_schema_markup_variable_mpn'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_mpn[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_mpn', stripslashes( $_mpn[$i]));
            }
            // Audience
            $_pad = $_POST['_schema_markup_variable_product_audience'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_pad[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_audience', stripslashes( $_pad[$i]));
            }
            // Color
            $_pco = $_POST['_schema_markup_variable_product_color'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_pco[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_color', stripslashes( $_pco[$i]));
            }
            // Product ID
            $_pid = $_POST['_schema_markup_variable_product_product_id'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_pid[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_product_id', stripslashes( $_pid[$i]));
            }
            // Product Model
            $_pmo = $_POST['_schema_markup_variable_product_model'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_pmo[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_model', stripslashes( $_pmo[$i]));
            }

            $_pvu = $_POST['_schema_markup_product_variable_price_valid_until'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_pvu[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_price_valid_until', stripslashes( $_pvu[$i]));
            }
            //Review Rating Value
            $_rrv = $_POST['_schema_markup_product_variable_review_rating_value'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_rrv[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_review_rating_value', stripslashes( $_rrv[$i]));
            }
            //Review Best Rating Value
            $_rbv = $_POST['_schema_markup_variable_product_review_best_rating'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_rbv[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_review_best_rating', stripslashes( $_rbv[$i]));
            }
            //Aggregate Rating Value
            $_arv = $_POST['_schema_markup_product_variable_aggregate_rating_value'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_arv[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_aggregate_rating_value', stripslashes( $_arv[$i]));
            }

            //Aggregate Review Count
            $_arc = $_POST['_schema_markup_product_variable_aggregate_review_count'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_arc[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_aggregate_review_count', stripslashes( $_arc[$i]));
            }

            //Review Author
            $_pra = $_POST['_schema_markup_product_variable_review_author'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_pra[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_product_review_author', stripslashes( $_pra[$i]));
            }

            // GTIN Field
            $_gtin = $_POST['_schema_markup_variable_gtin'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_gtin[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_gtin', stripslashes( $_gtin[$i]));
            }
            // Optimized title Field
            $_opttitle = $_POST['_schema_markup_optimized_title'];
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_opttitle[$i] ) ) {
                update_post_meta( $variation_id, '_schema_markup_optimized_title', stripslashes( $_opttitle[$i]));
            }

        }

    }
}

add_action( 'woocommerce_product_bulk_edit_end', 'schema_markapp_woocommerce_bulk_edit_input' );

function schema_markapp_woocommerce_bulk_edit_input() {
    $bulkEditFields = [
        '_schema_markup_product_brand' => __( 'Brand', 'woocommerce' ),
        '_schema_markup_product_mpn' => __( 'MPN', 'woocommerce' ),
        '_schema_markup_product_gtin' => __( 'GTIN', 'woocommerce' ),
        '_schema_markup_optimized_title' => __( 'Optimized title', 'woocommerce' ),
        '_schema_markup_product_audience' => __( 'audience', 'woocommerce' ),
        '_schema_markup_product_color' => __( 'color', 'woocommerce' ),
        '_schema_markup_product_product_id' => __( 'Product ID', 'woocommerce' ),
        '_schema_markup_product_model' => __( 'Product Model', 'woocommerce' ),
        '_schema_markup_product_price_valid_until' => __( 'Price Valid Until', 'woocommerce' ),
        '_schema_markup_product_review_rating_value' => __( 'Review Rating Value', 'woocommerce' ),
        '_schema_markup_product_review_best_rating' => __( 'Review Best Rating Value', 'woocommerce' ),
        '_schema_markup_product_aggregate_rating_value' => __( 'Aggregate Rating Value', 'woocommerce' ),
        '_schema_markup_product_aggregate_review_count' => __( 'Aggregate Review Count', 'woocommerce' ),
        '_schema_markup_product_review_author' => __( 'Review Author', 'woocommerce' ),
    ];

    foreach ($bulkEditFields as $key => $label) {
        printf('<div class="inline-edit-group">' .
            '<label class="alignleft">' .
            '<span class="title">' . $label . '</span>' .
            '<span class="input-text-wrap">' .
                '<select class="change_to" name="'.$key.'_change">' .
                    '<option value="">' . __( '— No change —', 'woocommerce' ) . '</option>' .
                    '<option value="1">' . __( 'Change to:', 'woocommerce' ) . '</option>' .
                '</select>' .
            '</span>' .
            '</label>' .
            '<label class="change-input">' .
                '<input type="text" name="'. $key . '" class="text" placeholder="' . __( 'Enter new value', 'woocommerce' ) . '" value="" />' .
            '</label>' .
            '</div>');
    }
}

add_action( 'woocommerce_product_bulk_edit_save', 'schema_markapp_woocommerce_bulk_edit_save' );

function schema_markapp_woocommerce_bulk_edit_save( $product ) {
    $product_id = $product->get_id();
    foreach ($_REQUEST as $key => $value) {
        if (strpos($key, '_schema_markup_') === 0 && $_REQUEST[$key . '_change'] === "1") {
            update_post_meta( $product_id, $key, wc_clean( $value ) );
        }
    }
}

function schema_markup_search_join( $join ) {
    global $wpdb;
    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'schema_markup_search_join' );

function schema_markup_search_where( $where ) {
    global $pagenow, $wpdb;
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }
    return $where;
}
add_filter( 'posts_where', 'schema_markup_search_where' );

function schema_markup_search_distinct( $where ) {
    global $wpdb;
    if ( is_search() ) {
        return "DISTINCT";
    }
    return $where;
}
add_filter( 'posts_distinct', 'schema_markup_search_distinct' );
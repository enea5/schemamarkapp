<?php

define("MY_SEO_SCHEMA_ITEMS_PER_PAGE", 30);


function schema_markapp_compatibility_error() {
    echo '<div class="notice notice-error"><p><strong>Schema Markapp</strong> cURL is not availble. This tool requires cURL PHP extension to operate.</p></div>';
}

function schema_markapp_checktool_assets($hook) {
    if( $hook != 'schema-markapp_page_my_seo_settings_options_page_check_tool') {
        return;
    }
    wp_enqueue_style( 'schema_markapp_checktool.css', plugins_url('assets/checktool.css', dirname(__FILE__)) );
    wp_enqueue_script('markapp-checktool-script', plugins_url('assets/checktool.js', dirname(__FILE__)), ['jquery']);

    if (!function_exists('curl_init')) {
        add_action('admin_notices', 'schema_markapp_compatibility_error');
    }
}

add_action( 'admin_enqueue_scripts', 'schema_markapp_checktool_assets' );

function my_seo_settings_options_page_check_tool()
{
    global $title;

    ?>



    <div class="wrap">
        <h1><?php echo $title; ?></h1>
        <br/>
        <div class="tab">
            <button class="tablinks" onclick="switchTab(event, 'general-schema')" id="defaultOpen">General</button>
            <button class="tablinks" onclick="switchTab(event, 'local_business-schema')">Local Business</button>
            <button class="tablinks" onclick="switchTab(event, 'person-schema')">Person</button>
            <button class="tablinks" onclick="switchTab(event, 'contact_page-schema')">Contact Page</button>
            <button class="tablinks" onclick="switchTab(event, 'about_page-schema')">About Page</button>
            <button class="tablinks" onclick="switchTab(event, 'product-schema')">Product</button>
            <button class="tablinks" onclick="switchTab(event, 'external-schema')">External Schema</button>
        </div>

        <div id="general-schema" class="tabcontent">
            <h3>General</h3>
            <div class="generaltab">
                <button class="generaltablinks" onclick="switchGeneralTab(event, 'generate_json_ld_fpwebpage-schema', 'generate_json_ld_fpwebpage')" id="defaultTabOpen">Front Page WebPage Schema</button>
                <button class="generaltablinks" onclick="switchGeneralTab(event, 'generate_json_ld_webpage-schema', 'generate_json_ld_webpage')">WebPage Schema</button>
                <button class="generaltablinks" onclick="switchGeneralTab(event, 'generate_json_ld_recipe-schema', 'generate_json_ld_recipe')">Recipe & Article & FAQ Schemas</button>
            </div>
            <div id="generate_json_ld_fpwebpage-schema" class="generaltabcontent">
                <div id="generate_json_ld_fpwebpage-schema-details"></div>
            </div>
            <div id="generate_json_ld_webpage-schema" class="generaltabcontent">
                <div id="generate_json_ld_webpage-schema-details"></div>
            </div>
            <div id="generate_json_ld_recipe-schema" class="generaltabcontent">
                <label for="generate_json_ld_recipe-url">Post URL</label>
                <input type="text" id="generate_json_ld_recipe-url" style="width: 50%;">
                <button type="button" id="check-generate_json_ld_recipe">Check</button>
                <br/>
                <br/>
                <div id="generate_json_ld_recipe-schema-details-table">
                    <table style="width: 100%;" border="1">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="40%">Title</th>
                            <th width="50%">URL</th>
                        </tr>
                        </thead>
                        <tbody class="posts-table-tbody">
                        <?php
                        global $wpdb;
                        $offset = ( 1 * MY_SEO_SCHEMA_ITEMS_PER_PAGE ) - MY_SEO_SCHEMA_ITEMS_PER_PAGE;
                        $query = 'SELECT ID, post_title, guid FROM '.$wpdb->prefix.'posts where post_type="post" and post_status="publish"';

                        $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
                        $total = $wpdb->get_var( $total_query );

                        $total = ceil($total / MY_SEO_SCHEMA_ITEMS_PER_PAGE);

                        $results = $wpdb->get_results( $query.' ORDER BY id DESC LIMIT '. $offset.', '. MY_SEO_SCHEMA_ITEMS_PER_PAGE, OBJECT );

                        foreach ($results as $post) {
                            echo "<tr>";
                            echo     "<td>".$post->ID."</td>";
                            echo     "<td>".$post->post_title."</td>";
                            echo     "<td>".$post->guid."</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                        if($total > 1){
                            echo '<br><br><div class="pagination">
	  <a href="#" class="posts-fetch-page" page-id="1">&laquo;</a>';
                            for ($i=1; $i <= $total; $i++) {
                                echo '<a href="#" class="posts-fetch-page posts-page-'.$i.' '.($i == "1" ? "active-page" :"").'" page-id="'.$i.'">'.$i.'</a>';
                            }
                            echo '<a href="#" class="posts-fetch-page" page-id="'.$total.'">&raquo;</a></div>';
                        }
                        ?>
                </div>
                <br/>
                <div id="generate_json_ld_recipe-schema-details">

                </div>

            </div>
        </div>

        <div id="local_business-schema" class="tabcontent">
            <h3>Local Business</h3>
            <div id="local_business-schema-details"></div>
        </div>

        <div id="person-schema" class="tabcontent">
            <h3>Person</h3>
            <div id="person-schema-details"></div>
        </div>

        <div id="contact_page-schema" class="tabcontent">
            <h3>Contact Page</h3>
            <div id="contact_page-schema-details"></div>
        </div>

        <div id="about_page-schema" class="tabcontent">
            <h3>About Page</h3>
            <div id="about_page-schema-details"></div>
        </div>

        <div id="product-schema" class="tabcontent">
            <h3>Product</h3>
            <label for="product-url">Product URL</label>
            <input type="text" id="product-url" style="width: 50%;">
            <button type="button" id="check-product_url">Check</button>
            <br/>
            <br/>
            <div id="product-schema-details-table">
                <table style="width: 100%;" border="1">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="40%">Title</th>
                        <th width="50%">URL</th>
                    </tr>
                    </thead>
                    <tbody class="products-table-tbody">
                    <?php
                    global $wpdb;
                    $offset = ( 1 * MY_SEO_SCHEMA_ITEMS_PER_PAGE ) - MY_SEO_SCHEMA_ITEMS_PER_PAGE;
                    $query = 'SELECT ID, post_title, guid FROM '.$wpdb->prefix.'posts where post_type="product" and post_status="publish"';

                    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
                    $total = $wpdb->get_var( $total_query );

                    $total = ceil($total / MY_SEO_SCHEMA_ITEMS_PER_PAGE);

                    $results = $wpdb->get_results( $query.' ORDER BY id DESC LIMIT '. $offset.', '. MY_SEO_SCHEMA_ITEMS_PER_PAGE, OBJECT );

                    foreach ($results as $post) {
                        echo "<tr>";
                        echo     "<td>".$post->ID."</td>";
                        echo     "<td>".$post->post_title."</td>";
                        echo     "<td>".$post->guid."</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                    if($total > 1){
                        echo '<br><br><div class="pagination">
	  <a href="#" class="products-fetch-page" page-id="1">&laquo;</a>';
                        for ($i=1; $i <= $total; $i++) {
                            echo '<a href="#" class="products-fetch-page products-page-'.$i.' '.($i == "1" ? "active-page" :"").'" page-id="'.$i.'">'.$i.'</a>';
                        }
                        echo '<a href="#" class="products-fetch-page" page-id="'.$total.'">&raquo;</a></div>';
                    }
                    ?>
            </div>
            <br/>
            <div id="product-schema-details"></div>
        </div>

        <div id="external-schema" class="tabcontent">
            <h3>View Schema on any website by URL  Competitors Research Tool</h3>
            <label for="external-url">URL</label>
            <input type="text" id="external-url" style="width: 50%;">
            <button type="button" id="check-external_url">Check</button>
            <br/>
            <div id="external-schema-details"></div>
        </div>
    </div>

    <?php
}


function my_seo_settings_options_page_check_tool_get_html($url)
{
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $output=curl_exec($ch);
    if (curl_errno($ch)) {
        echo curl_error($ch);
        return '';
    }

    curl_close($ch);
    return $output;
}

function my_seo_settings_options_page_check_tool_external_check() {
    $html = my_seo_settings_options_page_check_tool_get_html($_POST['url']);
    $items = explode('type="application/ld+json">', $html);
    unset($items[0]);
    foreach ($items as $item) {
        $item = explode("</script>", $item)[0];
        $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
        if(!$name)
            continue;
        echo "<h3>".$name."</h3>";
        $item = json_decode($item, true);
        echo "<pre style='white-space: pre-wrap !important;'>";
        $item = schema_markapp_filter_json_schema($item);
        echo json_encode($item, JSON_PRETTY_PRINT);
        echo "</pre>";
    }
    die();
}

add_action('wp_ajax_my_seo_settings_options_page_check_tool_external_check', 'my_seo_settings_options_page_check_tool_external_check' );

function my_seo_settings_options_page_check_tool_general_generate_json_ld_fpwebpage() {
    global $my_seo_settings_options;
    if(checked( $my_seo_settings_options['generate_json_ld_fpwebpage'], 1, false )){
        $html = my_seo_settings_options_page_check_tool_get_html(site_url("/"));
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(strtolower($name) != "creativework")
                continue;
            $item = json_decode($item, true);
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
            break;
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}

function my_seo_settings_options_page_check_tool_general_generate_json_ld_webpage() {
    global $my_seo_settings_options;
    if(checked( $my_seo_settings_options['generate_json_ld_webpage'], 1, false )){
        $html = my_seo_settings_options_page_check_tool_get_html(site_url('/schemamarkapp_test_link/'));
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(strtolower($name) != "creativework")
                continue;
            $item = json_decode($item, true);
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
            break;
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}

function my_seo_settings_options_page_check_tool_general_generate_json_ld_recipe_article() {
    global $my_seo_settings_options;
    if(checked( $my_seo_settings_options['generate_json_ld_recipe'], 1, false )){

        $html = my_seo_settings_options_page_check_tool_get_html($_POST['url']);
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(!in_array(strtolower($name), ["recipe", "creativework", "faqpage"]))
                continue;
            $item = json_decode($item, true);
            echo "<h3>".ucfirst($name)."</h3>";;
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}


function my_seo_settings_options_page_check_tool_generate_product() {
    global $my_seo_settings_product_options;
    if(checked( $my_seo_settings_product_options['generate_json_ld_product'], 1, false )){
        $html = my_seo_settings_options_page_check_tool_get_html($_POST['url']);
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(strtolower($name) != 'product')
                continue;
            $item = json_decode($item, true);
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}

function my_seo_settings_options_page_check_tool_generate_json_ld_localbusiness() {
    global $my_seo_settings_local_business_options;
    if(checked( $my_seo_settings_local_business_options['generate_json_ld_localbusiness'], 1, false )){
        $html = my_seo_settings_options_page_check_tool_get_html(get_permalink( $my_seo_settings_local_business_options['generate_json_ld_localbusiness_related_page'] ));
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(strtolower($name) != "localbusiness")
                continue;
            $item = json_decode($item, true);
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
            break;
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}

function my_seo_settings_options_page_check_tool_generate_json_ld_person() {
    global $my_seo_settings_person_options;
    if(checked( $my_seo_settings_person_options['generate_json_ld_person'], 1, false )){
        $html = my_seo_settings_options_page_check_tool_get_html(get_permalink( $my_seo_settings_person_options['generate_json_ld_person_related_page']));
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(strtolower($name) != "person")
                continue;
            $item = json_decode($item, true);
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
            break;
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}

function my_seo_settings_options_page_check_tool_generate_json_ld_aboutpage() {
    global $my_seo_settings_about_page_options;
    if(checked( $my_seo_settings_about_page_options['generate_json_ld_about_page'], 1, false )){
        $html = my_seo_settings_options_page_check_tool_get_html(get_permalink( $my_seo_settings_about_page_options['generate_json_ld_about_page_related_page']));
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(strtolower($name) != "aboutpage")
                continue;
            $item = json_decode($item, true);
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
            break;
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}

function my_seo_settings_options_page_check_tool_generate_json_ld_contactpage() {
    global $my_seo_settings_contact_page_options;
    if(checked( $my_seo_settings_contact_page_options['generate_json_ld_contact_page'], 1, false )){
        $html = my_seo_settings_options_page_check_tool_get_html(get_permalink( $my_seo_settings_contact_page_options['generate_json_ld_contact_page_related_page']));
        $items = explode('type="application/ld+json">', $html);
        unset($items[0]);
        foreach ($items as $item) {
            $item = explode("</script>", $item)[0];
            $name = explode('",', explode('"@type":"', $item)[1] ?? '')[0];
            if(strtolower($name) != "contactpage")
                continue;
            $item = json_decode($item, true);
            echo "<pre style='white-space: pre-wrap !important;'>";
            $item = schema_markapp_filter_json_schema($item);
            echo json_encode($item,  JSON_PRETTY_PRINT);
            echo "</pre>";
            break;
        }
    } else {
        echo "<p>Schema not enabled</p>";
    }

    die();
}

function my_seo_settings_options_page_check_tool_fetch_posts() {
    $page = $_POST['page'];
    global $wpdb;
    $offset = ( $page * MY_SEO_SCHEMA_ITEMS_PER_PAGE ) - MY_SEO_SCHEMA_ITEMS_PER_PAGE;
    $query = 'SELECT ID, post_title, guid FROM '.$wpdb->prefix.'posts where post_type="post" and post_status="publish"';
    $results = $wpdb->get_results( $query.' ORDER BY id DESC LIMIT '. $offset.', '. MY_SEO_SCHEMA_ITEMS_PER_PAGE, OBJECT );
    foreach ($results as $post) {
        echo "<tr>";
        echo     "<td>".$post->ID."</td>";
        echo     "<td>".$post->post_title."</td>";
        echo     "<td>".$post->guid."</td>";
        echo "</tr>";
    }
    die();
}

function my_seo_settings_options_page_check_tool_fetch_products() {
    $page = $_POST['page'];
    global $wpdb;
    $offset = ( $page * MY_SEO_SCHEMA_ITEMS_PER_PAGE ) - MY_SEO_SCHEMA_ITEMS_PER_PAGE;
    $query = 'SELECT ID, post_title, guid FROM '.$wpdb->prefix.'posts where post_type="product" and post_status="publish"';
    $results = $wpdb->get_results( $query.' ORDER BY id DESC LIMIT '. $offset.', '. MY_SEO_SCHEMA_ITEMS_PER_PAGE, OBJECT );
    foreach ($results as $post) {
        echo "<tr>";
        echo     "<td>".$post->ID."</td>";
        echo     "<td>".$post->post_title."</td>";
        echo     "<td>".$post->guid."</td>";
        echo "</tr>";
    }
    die();
}

function schema_markapp_filter_json_schema($schema)
{
    if (isset($schema['@context'])) {
        unset($schema['@context']);
    }

    if (isset($schema['@graph'][0]['@id'])) {
        unset($schema['@graph'][0]['@id']);
    }

    return $schema;
}

function my_seo_settings_options_page_check_tool_general() {
    switch ($_POST['id']) {
        case 'generate_json_ld_fpwebpage':
            my_seo_settings_options_page_check_tool_general_generate_json_ld_fpwebpage();
            break;
        case 'generate_json_ld_webpage':
            my_seo_settings_options_page_check_tool_general_generate_json_ld_webpage();
            break;
        case 'generate_json_ld_recipe':
            my_seo_settings_options_page_check_tool_general_generate_json_ld_recipe_article();
            break;
        case 'generate_json_ld_localbusiness':
            my_seo_settings_options_page_check_tool_generate_json_ld_localbusiness();
            break;
        case 'generate_json_ld_person':
            my_seo_settings_options_page_check_tool_generate_json_ld_person();
            break;
        case 'generate_json_ld_contactpage':
            my_seo_settings_options_page_check_tool_generate_json_ld_contactpage();
            break;
        case 'generate_json_ld_aboutpage':
            my_seo_settings_options_page_check_tool_generate_json_ld_aboutpage();
            break;
        case 'product':
            my_seo_settings_options_page_check_tool_generate_product();
            break;
        case 'posts-fetch-page':
            my_seo_settings_options_page_check_tool_fetch_posts();
            break;
        case 'products-fetch-page':
            my_seo_settings_options_page_check_tool_fetch_products();
            break;
        default:
            # code...
            break;
    }
}

add_action('wp_ajax_my_seo_settings_options_page_check_tool_general', 'my_seo_settings_options_page_check_tool_general' );

<?php
define('SCHEMA_MARKAPP_SIDEBAR', true);

if (constant('SCHEMA_MARKAPP_SIDEBAR') !== true) {
    return;
}

/**
 * Adds menu item "Schema Markapp" to the admin bar visible on the public pages only
 * @param WP_Admin_Bar $admin_bar
 */
function register_schema_markapp_adminbar(\WP_Admin_Bar $admin_bar)
{
    global $post;

    if (!is_admin()) {
        $onclick = 'schema_markapp_toggle_not_supported();';

        if (!is_category()) {
            if (is_null($post)) {
                $onclick = 'schema_markapp_toggle_sidebar();';
            } else {
                $onclick = 'schema_markapp_toggle_sidebar(' . $post->ID . ');';
            }
        }

        $admin_bar->add_menu([
            'id' => 'schema-markapp',
            'title' => 'Schema Markapp',
            'href' => '#',
            'meta' => [
                'onclick' => $onclick . ' return false;'
            ]
        ]);

        $admin_bar->add_menu([
            'id' => 'schema-markapp-preview',
            'parent' => 'schema-markapp',
            'title' => 'View Schema',
            'href' => '#',
            'meta' => [
                'onclick' => 'schema_markapp_show_schema(); return false;'
            ]
        ]);
    }
}

/**
 * Includes CSS styles and JS scripts to render sidebar
 */
function schema_markapp_sidebar_assets()
{
    $pluginDirUrl = plugin_dir_url(dirname(__FILE__));

    wp_enqueue_style('markapp-editor-styles', "$pluginDirUrl/assets/markapp-editor.css");
    wp_enqueue_script('markapp-editor-script', "$pluginDirUrl/assets/markapp-editor.js", ['jquery']);
}


function schema_markapp_sidebar_template()
{
    global $post;
    if (current_user_can('edit_posts') && $post !== null) {
        $url = admin_url('admin-ajax.php?action=schema_markapp_sidebar&post_id=' . $post->ID);

        echo '<div id="schema-markapp-sidebar"><iframe src="' . $url . '" frameborder="0"></iframe></div>';
        ?>
        <div id="schema-markapp-preview-schema">
            <div class="schema-markapp-title-bar">
                <span>Schema Preview</span>
                <a href="#" class="preview-close">Close</a>
            </div>
            <div class="schema-markapp-code-wrap">

            </div>
        </div>
        <?php
    }
}

function schemamarkapp_get_schema_classes()
{
    $instances = [];
    foreach (get_declared_classes() as $class) {
        if (is_subclass_of($class, '\GenericSchema')) {
            $instances[] = new $class;
        }
    }

    return $instances;
}

function schemamarkapp_get_settings_classes()
{
    $instances = [];
    foreach (get_declared_classes() as $class) {
        if (is_subclass_of($class, '\GenericSettings')) {
            $instances[] = call_user_func([$class, 'instance']);
        }
    }

    return $instances;
}

add_action('wp_ajax_schema_markapp_sidebar', function () {
    query_posts('p=' . $_REQUEST['post_id'] . '&post_type=any');
    if (!have_posts()) {
        echo('No schemes available');
        wp_die();
    }
    the_post();

    global $post;


    include __DIR__ . '/sidebar.template.php';
    wp_die();
});

add_action('wp_ajax_schema_markapp_sidebar_save', function () {
    query_posts('p=' . $_REQUEST['post_id'] . '&post_type=any');
    the_post();

    foreach ($_POST as $group => $values) {
        if ($group === "acf") continue;
        $options = array_merge(get_option($group), $values);
        update_option($group, $options);
    }

    acf_save_post($_REQUEST['post_id']);


    wp_safe_redirect(admin_url('admin-ajax.php?action=schema_markapp_sidebar&post_id=' . $_REQUEST['post_id']));
    wp_die();
});

add_action('admin_bar_menu', 'register_schema_markapp_adminbar', 100);
add_action('wp_enqueue_scripts', 'schema_markapp_sidebar_assets');
add_action('wp_footer', 'schema_markapp_sidebar_template');
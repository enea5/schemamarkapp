<html>
<head>


    <link type="text/css" rel="stylesheet" href="<?= site_url() . '/wp-includes/css/dashicons.min.css' ?>"/>
    <link type="text/css" rel="stylesheet"
          href="<?= plugin_dir_url(dirname(__FILE__)) . 'assets/markapp-editor.css' ?>"/>
    <link type="text/css" rel="stylesheet" href="<?= MY_ACF_URL . 'assets/css/acf-global.css' ?>"/>
    <link type="text/css" rel="stylesheet" href="<?= MY_ACF_URL . 'assets/css/acf-input.css' ?>"/>
    <link type="text/css" rel="stylesheet" href="<?= MY_ACF_URL . 'pro/assets/css/acf-pro-input.css' ?>"/>
    <script src="<?= site_url() . '/wp-includes/js/jquery/jquery.js'?>"></script>
    <script src="<?= site_url() . '/wp-includes/js/jquery/ui/core.min.js'?>"></script>
    <script src="<?= site_url() . '/wp-includes/js/jquery/ui/widget.min.js'?>"></script>
    <script src="<?= site_url() . '/wp-includes/js/jquery/ui/mouse.min.js'?>"></script>
    <script src="<?= site_url() . '/wp-includes/js/jquery/ui/sortable.min.js'?>"></script>
    <script src="<?= site_url() . '/wp-includes/js/jquery/ui/draggable.min.js'?>"></script>
    <script src="<?= MY_ACF_URL . 'assets/js/acf-input.min.js'?>"></script>
    <script src="<?= MY_ACF_URL . 'pro/assets/js/acf-pro-input.min.js'?>"></script>
</head>
<body class="schema-markapp-body">
<form target="_self" action="<?= admin_url('admin-ajax.php?action=schema_markapp_sidebar_save&post_id=' . $post->ID) ?>"
      method="POST">
    <div class="sm-top-panel">
        <span class="sm-title">Schema Markapp</span>
        <button class="schema-regular schema-add">Add Schema</button>
        <button class="schema-primary schema-save" type="submit">Save</button>
        <button class="schema-close" style="padding: 0; margin-left: 10px;"><span class="dashicons dashicons-no-alt" style="vertical-align: middle"></span></button>
    </div>
    <?php
    /** @var \GenericSchema $schema */
    foreach (schemamarkapp_get_schema_classes() as $schema) : ?>
        <div class="sm-scheme">
            <div class="sm-scheme-name">
                <a href="#" class="sm-schema-show-fields"><?= get_class($schema) ?></a>
                <a href="#" class="sm-schema-disable-schema" title="Disable">
                <span class="dashicons dashicons-no-alt" style="vertical-align: middle"></span></a>
            </div>
            <div class="sm-scheme-option">
                <?php
                $schema->settings();

                /** @var \PostFields $fields */
                if ($fields = $schema->postfields()) {
                    if (is_array($fields)) {
                        foreach ($fields as $field) {
                            $field->render($post->ID);
                        }
                    }
                    else {
                        $fields->render($post->ID);
                    }
                }
                ?>
            </div>
        </div>

    <?php endforeach; ?>
</form>
</body>
</html>
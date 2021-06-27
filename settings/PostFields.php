<?php


abstract class PostFields
{
    abstract public function fieldGroup(): array;

    final public function initAcf()
    {
        acf_add_local_field_group($this->fieldGroup());
    }

    final public function render($postId)
    {
//        acf_render_block()
        echo '<div id="acf-schemati_faq_group" class="postbox " ><div class="inside">';
        $field_group = $this->fieldGroup();
        $fields = acf_get_fields( $field_group );
        acf_render_fields( $fields, $postId, 'div', $field_group['instruction_placement'] ?? 'label' );
        echo '</div></div>';
    }
}
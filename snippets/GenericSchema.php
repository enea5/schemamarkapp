<?php
abstract class GenericSchema
{
    /**
     * @return bool
     */
    public function mustRenderOnPage() {
        return false;
    }

    /**
     * @return array
     */
    public function schema() {
        return [];
    }

    /**
     * Renders script tag with json schema in it
     */
    final public function render() {
        echo '<script type="application/ld+json" class="schemati">' . wp_json_encode( $this->schema() ) . '</script>';
    }

    public function postfields()
    {
        return null;
    }

    public function settings() {}
}
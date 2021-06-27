<?php
class RatingPostFields extends PostFields
{
    public function fieldGroup(): array
    {
        return array(
            'key' => 'schema_markapp_rating_group',
            'title' => 'Schemati | Aggregate Rating',
            'fields' => array(
                array(
                    'key' => 'schema_markapp_rating_value',
                    'label' => 'Rating Value',
                    'name' => 'sm_ratingValue',
                    'type' => 'text',
                ),
                array(
                    'key' => 'schema_markapp_rating_count',
                    'label' => 'Rating Count',
                    'name' => 'sm_ratingCount',
                    'type' => 'text',
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                    ),
                ),
            ),
        );
    }
}
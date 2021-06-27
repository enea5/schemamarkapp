<?php

class NutritionPostFields extends PostFields
{
    public function fieldGroup(): array
    {
        return array(
            'key' => 'schema_markapp_nutrition_group',
            'title' => 'Schemati | Recipe Nutrition',
            'fields' => array(
                array(
                    'key' => 'schema_markapp_nutrition_calories',
                    'label' => 'Calories',
                    'name' => 'sm_calories',
                    'type' => 'text',
                ),
                array(
                    'key' => 'schema_markapp_nutrition_carbohydrate_content',
                    'label' => 'Carbohydrate Content',
                    'name' => 'sm_carbohydrateContent',
                    'type' => 'text',
                ),
                array(
                    'key' => 'schema_markapp_nutrition_protein_content',
                    'label' => 'Protein Content',
                    'name' => 'sm_proteinContent',
                    'type' => 'text',
                ), array(
                    'key' => 'schema_markapp_nutrition_fat_content',
                    'label' => 'Fat Content',
                    'name' => 'sm_fatContent',
                    'type' => 'text',
                ), array(
                    'key' => 'schema_markapp_nutrition_saturated_fat_content',
                    'label' => 'Saturated Fat Content',
                    'name' => 'sm_saturatedFatContent',
                    'type' => 'text',
                ), array(
                    'key' => 'schema_markapp_nutrition_cholesterol_content',
                    'label' => 'Cholesterol Content',
                    'name' => 'sm_cholesterolContent',
                    'type' => 'text',
                ), array(
                    'key' => 'schema_markapp_nutrition_sodium_content',
                    'label' => 'Sodium Content',
                    'name' => 'sm_sodiumContent',
                    'type' => 'text',
                ), array(
                    'key' => 'schema_markapp_nutrition_sugar_content',
                    'label' => 'Sugar Content',
                    'name' => 'sm_sugarContent',
                    'type' => 'text',
                ), array(
                    'key' => 'schema_markapp_nutrition_serving_size',
                    'label' => 'Serving Size',
                    'name' => 'sm_servingSize',
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
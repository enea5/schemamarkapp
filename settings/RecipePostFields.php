<?php

class RecipePostFields extends PostFields
{
    /**
     * @return array
     */
    public function fieldGroup(): array
    {
        return [
            'key' => 'schema_markapp_recipe_group',
            'title' => 'Schemati | Recipe Schema General',
            'fields' => [
                [
                    'key' => 'schema_markapp_recipe_yield',
                    'label' => 'Recipe Yield',
                    'name' => 'sm_recipeYield',
                    'type' => 'text',
                ],
                [
                    'key' => 'schema_markapp_recipe_preptime',
                    'label' => 'Prep Time',
                    'name' => 'sm_prepTime',
                    'type' => 'text',
                ],
                [
                    'key' => 'schema_markapp_recipe_cooktime',
                    'label' => 'Cook Time',
                    'name' => 'sm_cookTime',
                    'type' => 'text',
                ], [
                    'key' => 'schema_markapp_recipe_totaltime',
                    'label' => 'Total Time',
                    'name' => 'sm_totalTime',
                    'type' => 'text',
                ], [
                    'key' => 'schema_markapp_recipe_category',
                    'label' => 'Recipe Category',
                    'name' => 'sm_recipeCategory',
                    'type' => 'text',
                ], [
                    'key' => 'schema_markapp_recipe_cuisine',
                    'label' => 'Recipe Cuisine',
                    'name' => 'sm_recipeCuisine',
                    'type' => 'text',
                ], [
                    'key' => 'schema_markapp_recipe_keywords',
                    'label' => 'Keywords',
                    'name' => 'sm_keywords',
                    'type' => 'text',
                ], [
                    'key' => 'schema_markapp_recipe_author',
                    'label' => 'Author',
                    'name' => 'sm_author',
                    'type' => 'text',
                ], [
                    'key' => 'schema_markapp_recipe_language',
                    'label' => 'Language',
                    'name' => 'sm_recipeLanguage',
                    'type' => 'text',
                ]
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                    ],
                ],
            ],
        ];
    }
}
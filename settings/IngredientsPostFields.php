<?php

final class IngredientsPostFields extends PostFields
{
    const MAX_INGREDIENTS = 15;

    public function fieldGroup(): array
    {
        $fields = [];
        foreach (range(1, self::MAX_INGREDIENTS) as $i) {
            $fields[] = array(
                'key' => "schema_markapp_ingredient_$i",
                'label' => "Recipe Ingredient $i",
                'name' => "recipeIngredient$i",
                'type' => 'text',
            );
        }

        return [
            'key' => 'schema_markapp_ingredients_group',
            'title' => 'Schemati | Recipe Ingredients',
            'fields' => $fields,
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
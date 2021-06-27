<?php
class RecipeSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        global $post;

        return $post !== null && Markapp_Schema_Matcher::isRecipe($post);
    }

    public function schema()
    {
        global $my_seo_settings_options;

        $data = [];

        $data["@context"]      = "http://schema.org";
        $data["@type"]         = "Recipe";
        $data["id"] = "schema:Recipe";
        $data["name"]      = get_the_title();
        $data["description"] = get_the_excerpt();
        $data["datePublished"] = get_the_date( 'c' );
        $data["author"] = get_field('sm_author');
        $data["recipeYield"] = get_field('sm_recipeYield');
        $data["prepTime"] = get_field('sm_prepTime');
        $data["cookTime"] = get_field('sm_cookTime');
        $data["totalTime"] = get_field('sm_totalTime');

        $data["recipeIngredient"] = [];
        foreach(range(1,15) as $n) {

            $ingredient = get_field("schema_markapp_ingredient_$n");
            if ($ingredient) {
                $data["recipeIngredient"][] = $ingredient;
            }
        }

        $data["recipeInstructions"] = [
            "@type" => "ItemList",
            "itemListElement" => []
        ];

        // todo: Fix same way as in FAQ

        foreach(range(1,12) as $n) {
            $ingredient = get_field("schema_markapp_howto_step_$n");
            if ($ingredient) {
                $data["recipeInstructions"]["itemListElement"][] = $ingredient;
            }
        }

        $data["recipeCategory"] = get_field('sm_recipeCategory');
        $data["recipeCuisine"] = get_field('sm_recipeCuisine');
        $data["keywords"] = get_field('sm_keywords');
        if (!is_null(get_the_post_thumbnail_url())) {
            $data["image"] = array(
                "@type" => "ImageObject",
                "url" => get_the_post_thumbnail_url(),
            );
        }

        $data["nutrition"] = array(
            "@type" => "NutritionInformation",
            "calories"  => get_field('sm_calories'),
            "carbohydrateContent" =>  get_field('sm_carbohydrateContent'),
            "proteinContent"  => get_field('sm_proteinContent'),
            "fatContent"  => get_field('sm_fatContent'),
            "saturatedFatContent"  => get_field('sm_saturatedFatContent'),
            "cholesterolContent"  => get_field('sm_cholesterolContent'),
            "sodiumContent"  => get_field('sm_sodiumContent'),
            "sugarContent"  => get_field('sm_sugarContent'),
            "servingSize"  => get_field('sm_servingSize')
        );
        $data["aggregateRating"] = array(
            "@type" => "AggregateRating",
            "ratingValue"  => get_field('sm_ratingValue'),
            "ratingCount"   => get_field('sm_ratingCount')
        );

        $data["inLanguage"] = array(
            "@type" => "Language",
            "name" => get_field('sm_recipeLanguage')
        );
        $data["thumbnailUrl"] = get_the_post_thumbnail_url();

        return $data;
    }

    public function postfields()
    {
        return [
            new RecipePostFields(),
            new HowToPostFields(),
            new IngredientsPostFields(),
        ];
    }
}
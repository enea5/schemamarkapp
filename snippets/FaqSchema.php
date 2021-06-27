<?php

class FaqSchema extends GenericSchema
{
    public function mustRenderOnPage()
    {
        global $post;

        return $post !== null && Markapp_Schema_Matcher::isFAQPage($post);
    }

    public function schema()
    {
        $faqArr = [];

        if( have_rows('schema_markapp_faq_questions') ) {
            $mainEntity = array();
            while( have_rows('schema_markapp_faq_questions') ) {
                the_row();
                $question = get_sub_field('schema_markapp_faq_question');
                $answer = get_sub_field('schema_markapp_faq_answer');
                if (!$question || !$answer) continue;
                $faqArr[] = [
                    "@type" => "Question",
                    "name" => $question,
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => $answer
                    ]
                ];
            }

        }

       if (sizeof($faqArr) == 0)
            return null;
        $data["@context"] = "http://schema.org";
            $data["@type"] = "FAQPage";
            $data["@id"] = "schema:FAQPage";
            $data["inLanguage"] = array(
                "@type" => "Language",
				"@id" => "schema:Language",
                "name" => get_field('sm_FAQinlanguage')
            );
		$data["mainEntityOfPage"] = [
                "@type" => "WebPage",
                "@id" => "schema:WebPage"];
            $data["headline"] = get_field('sm_FAQHeadline');
            $data["keywords"] = get_field('sm_FAQkeywords');
            $data["mentions"] = get_field('sm_FAQmentions');
            $data["author"] = get_field('sm_FAQauthor');
            $data["creator"] = get_field('sm_FAQcreator');
			$data["mainEntity"] = [$faqArr];
        return $data;
    }

    public function postfields()
    {
        return new FaqPostFields();
    }
}
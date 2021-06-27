<?php

class FaqPostFields extends PostFields
{
    public function fieldGroup(): array
    {
        $field_group = [
            'key' => 'schema_markapp_faq_group',
            'title' => 'Schemati | FAQ',
            'fields' => $this->_fields(),
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page' and 'post',
                    ],
                ],
            ],
        ];

        return $field_group;
    }

    /**
     * @return array
     */
    protected function _fields(): array
    {
        return [
            [
                'key' => 'schema_markapp_faq_mentions',
                'label' => 'Mentions',
                'name' => 'sm_FAQmentions',
                'type' => 'text',
            ],
            [
                'key' => 'schema_markapp_faq_keywords',
                'label' => 'Keywords',
                'name' => 'sm_FAQkeywords',
                'type' => 'text',
            ],
            [
                'key' => 'schema_markapp_faq_author',
                'label' => 'Author Name',
                'name' => 'sm_FAQauthor',
                'type' => 'text',
            ],
            [
                'key' => 'schema_markapp_faq_creator',
                'label' => 'Creator Name',
                'name' => 'sm_FAQcreator',
                'type' => 'text',
            ],
            [
                'key' => 'schema_markapp_faq_language',
                'label' => 'Language',
                'name' => 'sm_FAQinlanguage',
                'type' => 'text',
            ],
            [
                'key' => 'schema_markapp_faq_headline',
                'label' => 'Headline',
                'name' => 'sm_FAQHeadline',
                'type' => 'text',
            ],
            [
                'key' => 'schema_markapp_faq_questions',
                'label' => 'Questions',
                'name' => 'sm_FAQquestions',
                'type' => 'repeater',
                'button_label' => 'Add Question',
                'min' => 1,
                'max' => 50,
                'sub_fields' => [
                    [
                        'key' => 'schema_markapp_faq_question',
                        'label' => 'FAQ Question',
                        'name' => 'question',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'schema_markapp_faq_answer',
                        'label' => 'FAQ Answer',
                        'name' => 'answer',
                        'type' => 'text',
                    ]
                ]
            ]
        ];
    }

}
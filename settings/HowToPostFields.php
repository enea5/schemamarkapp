<?php
class HowToPostFields extends PostFields
{
    public function fieldGroup(): array
    {
        return array(
            'key' => 'schema_markapp_howto_group',
            'title' => 'Schemati | "How to" Instruction Steps',
            'fields' => $this->_generateRepeaterFields(),
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

    /**
     * @return array
     */
    protected function _generateRepeaterFields(): array
    {
        $fields = [];
        foreach (range(1, 12) as $i) {
            $fields[] = [
                'key' => "schema_markapp_howto_step_name_$i",
                'label' => "#$i Step Name",
                'name' => "name$i",
                'type' => 'text',
            ];
            $fields[] = [
                'key' => "schema_markapp_howto_step_$i",
                'label' => "#$i Step Instruction",
                'name' => "HowToStep$i",
                'type' => 'text',
            ];
        }
        return $fields;
    }
}
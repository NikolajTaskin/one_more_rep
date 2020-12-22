<?php


namespace App\Views\Forms\Admin\Pizza;


use Core\Views\Form;

class PizzaBaseForm extends Form
{
    public function __construct() {
        parent::__construct([
            'fields' => [
                'name' => [
                    'label' => 'Komentuok <span style="color: red">*</span>',
                    'type' => 'textarea',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_comments_length'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Parašyk trumpą atsiliepimą...',
                        ],
                    ],
                ],
            ],
            // No buttons since they will be defined in Extends
        ]);
    }
}
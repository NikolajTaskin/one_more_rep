<?php

namespace App\Views\Forms\Common\Auth;

use Core\Views\Form;

class LoginForm extends Form
{
public function __construct()
{
    parent::__construct([
        'fields' => [
            'email' => [
                'label' => 'El. paštas <span style="color: red">*</span>',
                'type' => 'text',
                'validators' => [
                    'validate_field_not_empty',
                    'validate_email',
                    'validate_user_exist',
                ],
                'extra' => [
                    'attr' => [
                        'placeholder' => 'Įvesk el. paštą',
                    ],
                ],
            ],
            'password' => [
                'label' => 'Slaptažodis <span style="color: red">*</span>',
                'type' => 'password',
                'validators' => [
                    'validate_field_not_empty',
                ],
                'extra' => [
                    'attr' => [
                        'placeholder' => 'Įvesk slaptažodį',
                    ],
                ],
            ],
        ],
        'buttons' => [
            'login' => [
                'title' => 'PRISIJUNGTI',
            ],
        ],
        'validators' => [
            'validate_login' => [
                'email',
                'password',
            ]
        ]
    ]);
}
}
<?php

namespace App\Views\Forms\Common\Auth;

use Core\Views\Form;

class RegisterForm extends Form
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
                        'validate_user_unique',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'pvz.: mail@mail.lt',
                        ]
                    ]
                ],
                'user_name' => [
                    'label' => 'Vardas <span style="color: red">*</span>',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_real_name',
                        'validate_short_name',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Vardas',
                        ]
                    ]
                ],
                'user_surname' => [
                    'label' => 'Pavardė <span style="color: red">*</span>',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_real_name',
                        'validate_short_name',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Pavardė',
                        ]
                    ]
                ],
                'password' => [
                    'label' => 'Slaptažodis <span style="color: red">*</span>',
                    'type' => 'password',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_strong_password'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'pvz.: Sl*pT*Ž0d1sss',
                         ]
                    ]
                ],
                'password_repeat' => [
                    'label' => 'Pakartoti slaptažodį <span style="color: red">*</span>',
                    'type' => 'password',
                    'validators' => [
                        'validate_field_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Pakartok slaptažodį',
                        ]
                    ]
                ],
                'phonenumber' => [
                    'label' => 'Telefono numeris',
                    'type' => 'text',
                    'validators' => [
                        'validate_numeric',
                        'validate_phone_number'
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => '86 XXX XXXX',
                        ]
                    ]
                ],
                'address' => [
                    'label' => 'Gyvenamoji vieta',
                    'type' => 'text',
                    'validators' => [
//                        'validate_field_not_empty',
                    ],
                    'extra' => [
                        'attr' => [
                            'placeholder' => 'Gatvė, namo/buto nr., miestas',
                        ]
                    ]
                ],
            ],
            'buttons' => [
                'register' => [
                    'title' => 'Prisiregistruoti',
                ]
            ],
            'validators' => [
                'validate_fields_match' => [
                    'password',
                    'password_repeat'
                ]
            ]
        ]
    );

    }
}
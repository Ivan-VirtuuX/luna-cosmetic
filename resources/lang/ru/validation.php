<?php

return [
    'custom' => [
        'email' => [
            'unique' => 'Данный email уже используется',
        ],
        'password' => [
            'confirmed' => 'Пароли не совпадают',
        ],
    ],
    'min' => [
        'string' => 'Пароль менее :min символов',
    ],
];

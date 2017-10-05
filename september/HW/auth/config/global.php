<?php

$salt = sha1('salt');

return [
    'salt' => $salt,
    'users' => unserialize(file_get_contents($usersStorage)),
    'company' => 'Наша Компания',
    'pageIdParam' => 'page',
    'menu' => [
        [
            'id' => 'auth',
            'title' => 'Вход'
        ],
        [
            'id' => 'products',
            'title' => 'Продукция',
        ],
        [
            'id' => 'contacts',
            'title' => 'Контакты',
        ]
    ]
];
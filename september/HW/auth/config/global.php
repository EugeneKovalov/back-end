<?php

$salt = sha1('salt');

return [
    'salt' => $salt,
    'userPath' => 'config'.DS.'users.txt',
    'users' => unserialize(file_get_contents('config'.DS.'users.txt')),
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
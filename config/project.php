<?php

return [
    'admin' => [
        'prefix' => env('ADMIN_PREFIX', 'admin'),
        'roles' => [
            'admin' => 'admin',
        ],
    ],
    'user' => [
        'prefix' => env('USER_PREFIX', 'user'),
        'roles' => [
            'teacher' => 'teacher',
            'student'=> 'student'


        ],
    ],

];

?>

<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => $_ENV['DB_STRING'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8',
];

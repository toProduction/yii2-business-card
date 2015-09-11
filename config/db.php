<?php

return [
    'class'       => 'yii\db\Connection',
    'dsn'         => getenv('DB_DNS'),
    'username'    => getenv('DB_USERNAME'),
    'password'    => getenv('DB_PASSWORD'),
    'charset'     => 'utf8',
    'tablePrefix' => getenv('DB_TABLE_PREFIX'),
];

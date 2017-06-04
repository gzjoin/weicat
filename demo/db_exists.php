<?php

include '../vendor/autoload.php';

$database = new \Medoo\Medoo([
    // 必须配置项
    'database_type' => 'mysql',
<<<<<<< HEAD

=======
>>>>>>> 59bd969159dc080bd30195adae6fcfe3ee7752fc
    'database_name' => 'test',
    'server' => '119.23.44.233',
    'username' => 'weixin',
    'password' => '123456',
<<<<<<< HEAD

=======
>>>>>>> 59bd969159dc080bd30195adae6fcfe3ee7752fc
    'charset' => 'utf8',

       // 可选参数
    'port' => 3306,

    // 可选，定义表的前缀
    'prefix' => '',
<<<<<<< HEAD

=======
>>>>>>> 59bd969159dc080bd30195adae6fcfe3ee7752fc

    // 连接参数扩展, 更多参考 http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
<<<<<<< HEAD


$database->insert("account", [
    "user_name" => "foo",
    "email" => "foo@bar.com"
]);

=======

>>>>>>> 59bd969159dc080bd30195adae6fcfe3ee7752fc

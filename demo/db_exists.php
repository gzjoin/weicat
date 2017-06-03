<?php
<<<<<<< HEAD
include '../vendor/autoload.php';
=======
    include_once "./vendor/autoload.php";
>>>>>>> 5780b77a01820f559b1b7eb4457614f2e3d10e8d

$database = new \Medoo\Medoo([
    // 必须配置项
    'database_type' => 'mysql',
<<<<<<< HEAD
    'database_name' => 'test',
    'server' => '119.23.44.233',
    'username' => 'weixin',
    'password' => '123456',
    'charset' => 'utf8',

       // 可选参数
    'port' => 3306,

    // 可选，定义表的前缀
    'prefix' => '',
=======
    'database_name' => 'name',
    'server' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'charset' => 'utf8',

    // 可选参数
    'port' => 3306,

    // 可选，定义表的前缀
    'prefix' => 'PREFIX_',
>>>>>>> 5780b77a01820f559b1b7eb4457614f2e3d10e8d

    // 连接参数扩展, 更多参考 http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
<<<<<<< HEAD
dump($database);
=======

$database->insert("account", [
    "user_name" => "foo",
    "email" => "foo@bar.com"
]);
>>>>>>> 5780b77a01820f559b1b7eb4457614f2e3d10e8d

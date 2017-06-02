<?php
    include_once "./vendor/autoload.php";

$database = new \Medoo\Medoo([
    // 必须配置项
    'database_type' => 'mysql',
    'database_name' => 'name',
    'server' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'charset' => 'utf8',

    // 可选参数
    'port' => 3306,

    // 可选，定义表的前缀
    'prefix' => 'PREFIX_',

    // 连接参数扩展, 更多参考 http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

$database->insert("account", [
    "user_name" => "foo",
    "email" => "foo@bar.com"
]);

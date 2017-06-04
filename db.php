<?php
include './vendor/autoload.php';

$database = new \Medoo\Medoo([
    // 必须配置项
    'database_type' => 'mysql',
    'database_name' => 'test',
    'server' => '119.23.44.233',
    'username' => 'weixin',
    'password' => '123456',
    'charset' => 'utf8',


    'port' => 3306,

    // 可选，定义表的前缀
    'prefix' => '',

    // 连接参数扩展, 更多参考 http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
dump($database);
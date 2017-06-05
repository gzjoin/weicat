<?php

include "./wxModel.php";

$wxobj = new wxModel();
//菜单数据
$arr = array(
    'button' => array(
        array(
            "type" => "click",
            "name" => urlencode("图文列表"),
            "key" => "20000",
        ),
        array(
            "name" => urlencode("下拉菜单"),
            "sub_button" => array(
                array(
                    "type" => "click",
                    "name" => urlencode("关于我们"),
                    "key" => "30000",
                ),
                array(
                    "type" => "click",
                    "name" => urlencode("帮助信息"),
                    "key" => "40000",
                ),
                array(
                    "type" => "view",
                    "name" => urlencode("我的商城"),
                    "url" => "https://www.baidu.com",
                ),
            ),
        ),
        array(
            "type" => "view",
            "name" => urlencode("网易新闻"),
            "url" => "http://3g.163.com/",
        ),
    ),
);
$json = urldecode(json_encode($arr));
//访问接口

$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$wxobj->getAccessToken();

$res = $wxobj->getData($url,'POST', $json);

echo $res;
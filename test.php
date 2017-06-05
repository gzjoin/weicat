<?php

include './wxModel.php';
$model = new wxModel();
echo $model->getAccessToken();
    die;
    $poststr = <<<EOT
<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[image]]></MsgType>
 <PicUrl><![CDATA[this is a url]]></PicUrl>
 <MediaId><![CDATA[media_id]]></MediaId>
 <MsgId>1234567890123456</MsgId>
 </xml>
EOT;
//var_dump($poststr);

//file_put_contents("data.txt" , $poststr);

$postobj = simplexml_load_string($poststr, "SimpleXMLElement", LIBXML_NOCDATA);

//var_dump($postobj);

$tousername = $postobj->ToUserName;
$fromusername = $postobj->FromUserName;
$createtime = $postobj->CreateTime;
$msgtype = $postobj->MsgType;
$picurl = $postobj->PicUrl;
$mediatd = $postobj->MediaId;
$msgid = $postobj->MsgId;

$arr = array(
    array(
        'title' => "阿里纳斯：我建议总决赛不要赌詹姆斯失败 ",
        'date' => "2016-6-5",
        'url' => "https://bbs.hupu.com/19344563.html?from=hao123",
        'description' => "前奇才球星吉尔伯特-阿里纳斯表示千万不要赌骑士的勒布朗-詹姆斯失败。",
        'pucurl' => "https://c1.hoopchina.com.cn/uploads/star/event/images/170602/bmiddle-ca62b1324a1a4d01611be92d2084116c48641d4d.jpg?x-oss-process=image/resize,w_800/format,webp",
    ),
    array(
        'title' => "欧文：当时机成熟的时候，我会接过詹姆斯的衣钵",
        'date' => "2016-6-5",
        'url' => "https://bbs.hupu.com/19343597.html?from=hao123",
        'description' => "勒布朗-詹姆斯在他32岁时的表现，以及他连续第7次进入NBA总决赛",
        'pucurl' => "https://c1.hoopchina.com.cn/uploads/star/event/images/170602/bmiddle-4fc6dc224d3a79db736250dc7779ceea93c4386b.jpg?x-oss-process=image/resize,w_800/format,webp",
    ),
    array(
        'title' => "官方：凯里-欧文成为2K18封面人物 ",
        'date' => "2016-6-5",
        'url' => "https://bbs.hupu.com/19341846.html?from=hao123",
        'description' => "虎扑篮球6月1日讯 NBA 2K18官方宣布，骑士后卫凯里-欧文将成为2K18的封面人物",
        'pucurl' => "https://c1.hoopchina.com.cn/uploads/star/event/images/170601/bmiddle-31c9125ddb7e0489c0018addf4097ed23181d16c.jpg?x-oss-process=image/resize,w_800/format,webp",
    ),
);

$textTpl = <<<EOT
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>
</xml>

EOT;

//$str = "";
//foreach ($arr as $v) {
//    $str .= "<item>";
//        $str .= "<Title><![CDATA[".$v['title']."]]></Title>";
//        $str .= "<Description><![CDATA[".$v['description']."]]></Description>";
//        $str .= "<PicUrl><![CDATA[".$v['pucurl']."]]></PicUrl>";
//        $str .= "<Url><![CDATA[".$v['url']."]]></Url>";
//    $str .= "</item>";
//}
//
//$textTpl .= $str;
//$textTpl .= "</Articles></xml>";


$time = time();
$msgtype = 'image';
$nums = count($arr);
$Content = "欢迎来到微信开发的世界__gzjoin";
$mediaid = "fmTWnWW5y6gEcspIvrYfh5sMrHGJ1ocl8Zgf5PhUXfzY5JBRwt7hMNxWBXLHPcf2";
$res = sprintf($textTpl, $fromusername, $tousername, $time, $msgtype, $mediaid);

//var_dump($res);
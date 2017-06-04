<?php
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
var_dump($poststr);

file_put_contents("data.txt" , $poststr);

$postobj = simplexml_load_string($poststr, "SimpleXMLElement", LIBXML_NOCDATA);

var_dump($postobj);

$tousername = $postobj->ToUserName;
$fromusername = $postobj->FromUserName;
$createtime = $postobj->CreateTime;
$msgtype = $postobj->MsgType;
$picurl = $postobj->PicUrl;
$mediatd = $postobj->MediaId;
$msgid = $postobj->MsgId;


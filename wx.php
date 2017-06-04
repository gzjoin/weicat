<?php

//define your token
define("TOKEN", "weixin2017");
$wechatObj = new wxModel();

if (isset($_GET['echostr']))
{
    $wechatObj->valid();
}
else
{
    // 接收微信服务器发送过来的xml
    $wechatObj->responseMsg();
}

$wechatObj->valid();

class wxModel
{
    /*
     *  接口配置信息的验证
     * */
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    /*
     * 微信发送消息 ， 开发者服务型接收xml格式的数据
     * */
    public function responseMsg()
    {

        $postStr = file_get_contents("php://input");
        include './db.php';
        $data = array(
            'xml' => $postStr,
        );
        $database->insert('xml', $data);

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            /*
             * 接收微信服务器发送过来的数据 ，根据文本 ，图片 ， 等数据分类
             * */
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $tousername = $postobj->ToUserName;
            $fromusername = $postobj->FromUserName;
            $time = time();
            $msgtype = $postobj->MsgType;
            $Content = "欢迎来到微信开发的世界__gzjoin";


            //发现消息的xml模板
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
            $time = time();
            $msgtype = 'text';
            $Content = "欢迎来到微信开发的世界__gzjoin";
            $res = sprintf($textTpl, $fromusername, $tousername, $time, $msgtype, $Content);

        }else {
            echo "";
            exit;
        }
    }
    /*
     *  验证服务器地址的有效性
     * */
    private function checkSignature()
    {
        /*
        1）将token、timestamp、nonce三个参数进行字典序排序
        2）将三个参数字符串拼接成一个字符串进行sha1加密
        3）开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
         */
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];

        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;

        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>

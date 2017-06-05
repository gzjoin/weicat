<?php
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

            $tousername = $postObj->ToUserName;
            $fromusername = $postObj->FromUserName;
            $msgtype = $postObj->MsgType;
            $keyword = trim($postObj->Content);

            if ($msgtype == "text") {
                //判断用户传输过来的关键字 ， 根据关键字进行回复
                if ($keyword == "篮球") {

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
                                <ArticleCount>%s</ArticleCount>
                                <Articles>

EOT;
                    $str = "";
                    foreach ($arr as $v) {
                        $str .= "<item>";
                        $str .= "<Title><![CDATA[".$v['title']."]]></Title>";
                        $str .= "<Description><![CDATA[".$v['description']."]]></Description>";
                        $str .= "<PicUrl><![CDATA[".$v['pucurl']."]]></PicUrl>";
                        $str .= "<Url><![CDATA[".$v['url']."]]></Url>";
                        $str .= "</item>";
                    }

                    $textTpl .= $str;
                    $textTpl .= "</Articles></xml>";


                    $time = time();
                    $msgtype = 'news';
                    $nums = count($arr);
                    $res = sprintf($textTpl, $fromusername, $tousername, $time, $msgtype, $nums);
                    echo $res;
                }
                if ($keyword == "科比") {
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
                    $time = time();
                    $msgtype = 'image';
                    $mediaid = "doDrbIZfgBBapXnoqoZlkXkUCgpD5P7jkE9MzbFYG1MG1DSDxiU-VuYzGSk0JrAU";
                    $res = sprintf($textTpl, $fromusername, $tousername, $time, $msgtype, $mediaid);
                    echo $res;
                }

            }

            if ($msgtype == "event") {
                $event = $postObj->Event;
                //订阅
                if ($event == "subscribe") {
                    //订阅后发现消息的xml模板
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
                    $content = "欢迎来到微信开发的世界__gzjoin, 可以输入关键字查看往前内容！！ 如：科比 ， 篮球";
                    $res = sprintf($textTpl, $fromusername, $tousername, $time, $msgtype, $content);
                    echo $res;
                }
            }
            $time = time();
            $msgtype = $postObj->MsgType;
            $content = "欢迎来到微信开发的世界__gzjoin";

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
            $content = "欢迎来到微信开发的世界__gzjoin";
            $res = sprintf($textTpl, $fromusername, $tousername, $time, $msgtype, $content);
            echo $res;
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

    /*
     * curl 请求 ， 返回数据
     * */
    public function getData($url) {
        // 1. cURL初始化
        $ch = curl_init();

        // 2. 设置cURL选项
        /*
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        */
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // 3. 执行cURL请求
        $ret = curl_exec($ch);

        // 4. 关闭资源
        curl_close($ch);

        return $ret;
    }

    public function jsonToArray($json) {
        $arr = json_decode($json, 1);
        return $arr['access_token'];
    }

    public function getAccesstoken() {

        session_start();
        if ($_SESSION['access_token'] && (time()-$_SESSION['expire_time']) < 7000 ) {
            return $_SESSION['access_token'];
        } else {
            $appid = "wx499a9af85a5d4fe2";
            $appsecret = "952ce89ced50797636b73b44b04efce0";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;


            $access_token = $this->jsonToArray($this->getData($url));
            $_SESSION['access_token'] = $access_token;

            $_SESSION['expire_time'] = time();

            return $access_token;
        }
    }
}
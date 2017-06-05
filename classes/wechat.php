<?php
//define("TOKEN", "weixin");
// $wechatObj = new Wechat();
// $wechatObj->valid();
class Wechat
{

    public function valid()
    {
    	//echo 1;exit;
        $echoStr = isset($_GET["echostr"]) ? $_GET["echostr"] :false;

        //valid signature , option
        if($echoStr and $this->checkSignature()){
            echo $echoStr;
            exit;
        }
        #到此为止,如果没有验证信息过来.则是其他消息.比如,有人发送消息,或是有人关注,扫码等
        $this->responseMsg();

    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>
                            ";
           if($postObj->MsgType!='text')
           {
                 $msgType = "text";
                 $contentStr = "哦哟，我现在只认识字符！而您发的是".$postObj->MsgType;
                 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                 echo $resultStr;
             }
          if($keyword=="四六级")
            {
                $textTpl="<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>1</ArticleCount>
                            <Articles>
                                <item>
                                    <Title><![CDATA[%s]]></Title>
                                    <Description><![CDATA[%s]]></Description>
                                    <PicUrl><![CDATA[%s]]></PicUrl>
                                    <Url><![CDATA[%s]]></Url>
                                </item>
                            </Articles>
                        </xml>";
                $msgType = "news";
                $title = '四六级';
                $picurl = 'http://365jia.cn/uploads/13/0301/5130c2ff93618.jpg';
                $url = "http://israel.sinaapp.com/cet/index.php?openid=".$postObj->FromUserName;
                $description = "点击图片进去商品详情";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $title,$description,$picurl,$url);
                echo $resultStr;
            }
           if($keyword=="你")
            {
                $msgType = "text";
                $contentStr = "你是谁 为了谁~ ~ ~ ~ ~";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
	if($keyword=="开学季到了，傻逼们又回来了吧")
            {
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";   
                    $msgType = "text";
                    $contentStr = "傻逼们赶紧学习找工作";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
            }
	     if($keyword=="曾经的我们")
            {
                $textTpl="<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>1</ArticleCount>
                            <Articles>
                                <item>
                                    <Title><![CDATA[%s]]></Title>
                                    <Description><![CDATA[%s]]></Description>
                                    <PicUrl><![CDATA[%s]]></PicUrl>
                                    <Url><![CDATA[%s]]></Url>
                                </item>
                            </Articles>
                        </xml>";
                $msgType = "news";
                $title = '四六级';
                $picurl = 'http://60.205.231.89/psb.jpg';
                $url = "http://user.qzone.qq.com/853164272/4";
                $description = "点击图片进去商品详情";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $title,$description,$picurl,$url);
                echo $resultStr;
            }
	  if($keyword=="傻逼")
            {
                $msgType = "text";
                $contentStr = "你才是傻逼";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
	  }	
		else{
                echo "Input something...";
            }

        }
	else {
            echo "";
            exit;
        }
    }
    private function checkSignature()
    {
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



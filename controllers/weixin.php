<?php

/**
 * @brief Site
 * @class Site
 * @note
 */
class Weixin extends IController
{
    public $layout='';

    function init()
    {

    }


    function show()
    {
        echo 1;
	    // define("TOKEN", "weixin");
     //    $wechatObj = new wechat();
     //    $wechatObj->responseMsg();
    }


    // function start()
    // {
    //     define("TOKEN", "weixin");
    //     public $layout =  '';
    //     public function callback()
    //     {   //回调函数
    //         $wc_obj = new Weyouxi();//实例化微信功能
    //         $game_obj = new NumGame();//实例化游戏模块
    //         if(isset($_GET["echostr"]))
    //         {
    //             $returnStr = $wc_obj->valid();//如果是验证请求,则进行验证(此处会停止执行)
    //             echo $returnStr;
    //         }
    //         else if($_SERVER['REQUEST_METHOD'] == 'POST')
    //         {
    //         //此处理功能了
    //             $obj = $wc_obj->parsePostObj();//解析数据
    //             $cache_obj = new ICache();
    //             $cache_key = md5($obj->FromUser.'_num_game');
    //             $game_cache = $cache_obj->get($cache_key); //查看缓存中是否有游戏
    //             if($game_cache)
    //             {//如果游戏存在
    //                 $game_cache['num']++;
    //                 if($game_cache['num'] > $game_cache['count'])
    //                 {//超出游戏次数
    //                     echo $wc_obj->getResponseTxtMsg('那么问题就来了,治疗智障哪家强?');
    //                     $cache_obj->del($cache_key);//删除游戏状态
    //                     return;
    //                 }
    //                 else
    //                 {//合法游戏次数
    //                     $postContent = $obj->Content;
    //                     if(intval($postContent)<=0)
    //                     {//如果不是数字.且是游戏状态
    //                         echo $wc_obj->getResponseTxtMsg('请回复数字');
    //                         return;
    //                     }
    //                     else
    //                     {//如果是数字,游戏状态
    //                         $game_obj->setNum($game_cache['game_num']);
    //                         $rs=$game_obj->verifyNum($postContent);
    //                         $respose=array(//创建结果数组
    //                             '0'=>'恭喜,猜对了',
    //                             '1'=>'回复的数字过大',     //                             '2'=>'回复的数字过小',
    //                         );
    //                         echo $wc_obj->getResponseTxtMsg($respose[$rs]);//回复
    //                         if(!$rs)$cache_obj->del($cache_key);//回答正确,删除缓存 
    //                         $cache_obj->set($cache_key, $game_cache);//发一个数字,保存一次缓存
    //                         return; 
    //                     }//如果是数字,游戏状态 
    //                 }//合法游戏次数
    //             }
    //             else
    //             {//如果游戏未开始
    //                 if($obj->Content == '开始游戏')
    //                 {//创建游戏 数组
    //                     echo $wc_obj->getResponseTxtMsg('游戏开始,请回复1000到9999的数字');//回复 
    //                     $game_num = $game_obj->startGame();//获取随机数
    //                     $cache_data=array(
    //                         'num'=>'0',//第0次回答
    //                         'count'=>'10',//10次机会
    //                         'game_num'=>$game_num//游戏产生的数
    //                     );
    //                     $cache_obj->set($cache_key, $cache_data);//写入缓存
    //                 }
    //                 else
    //                 {//非游戏状态,且没有发开始游戏 
    //                     echo $wc_obj->getResponseTxtMsg('回复开始游戏,参与游戏!');//回复 
    //                 }
    //             }
    //         }
    //     }
    // }

    function startgame()
    {
        define("TOKEN", "weixin");
        public $layout =  '';
        public function callback()
        {   //回调函数
            $wc_obj = new Weyouxi();//实例化微信功能
            $game_obj = new NumGame();//实例化游戏模块
            if(isset($_GET["echostr"]))
            {
                $returnStr = $wc_obj->valid();//如果是验证请求,则进行验证(此处会停止执行)
                echo $returnStr;
            }
            else if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
            //此处理功能了
                $obj = $wc_obj->parsePostObj();//解析数据
                $game = new IModel('game');
                if($game)
                {
                    //如果游戏存在
                    $num = $game->query('select count(1) from iwebshop_game');
                    if($num > 10)
                    {
                        echo $wc_obj->getResponseTxtMsg('您的游戏次数已经用完了');
                        return;
                    }
                    else
                    {

                        $n
                        $game->setData($data);
                        $game->add();
                    }
                }
                else
                {//如果游戏未开始
                    if($obj->Content == '开始游戏')
                    {//创建游戏 数组
                        echo $wc_obj->getResponseTxtMsg('游戏开始,请回复1000到9999的数字');//回复 
                        $game_num = $game_obj->startGame();//获取随机数
                        $cache_data=array(
                            'num'=>'0',//第0次回答
                            'count'=>'10',//10次机会
                            'game_num'=>$game_num//游戏产生的数
                        );
                        $cache_obj->set($cache_key, $cache_data);//写入缓存
                    }
                    else
                    {//非游戏状态,且没有发开始游戏 
                        echo $wc_obj->getResponseTxtMsg('回复开始游戏,参与游戏!');//回复 
                    }
                }
            }
        }
    }
}

<?php
namespace Swiftx\Plugins\WeChat\Event;
use Swiftx\Plugins\WeChat\Message\News;

/**
 * 服务端校验接口
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
class Subscribe extends Common {

    /**
     * 创建事件对象
     * @param string $toUserName
     * @param string $fromUserName
     * @param string $createTime
     */
    public function __construct($toUserName=null, $fromUserName=null, $createTime=null){
        parent::__construct($toUserName, $fromUserName, $createTime);
    }

    /**
     * 事件名称
     * @return string
     */
    protected function _getName(){
        return 'Subscribe';
    }

    /**
     * 回复文本消息
     * @param string $content
     * @return string
     */
    public function ResponseText($content){
        $fromUsername = $this->_fromUserName;
        $toUsername = $this->_toUserName;
        $time = time();
        $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                    </xml>";
        $msgType = "text";//返回的数据类型
        return sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
    }

    /**
     * 回复图文消息
     * @param array $news
     * @return string
     */
    public function ResponseNews(array $news){
        if(!is_array($news)) return "";
        $itemTpl = "<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>";
        $itemStr = "";
        /** @var News $item */
        foreach ($news as $item)
            $itemStr .= sprintf($itemTpl, $item->Title, $item->Description, $item->Image, $item->Link);
        $xmlTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>%s</ArticleCount>
        <Articles>$itemStr</Articles>
        </xml>";
        $result = sprintf($xmlTpl, $this->_fromUserName, $this->_toUserName, time(), count($news));
        return $result;
    }

    /**
     * 默认事件
     * @return string
     */
    public function DefaultResponse(){


    }

}

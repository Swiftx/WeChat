<?php
namespace Swiftx\Plugins\WeChat;
use Swiftx\Plugins\WeChat\Event\Subscribe;
use Swiftx\Plugins\WeChat\Event\Validate;
use Swiftx\Plugins\WeChat\Message\Common as Message;
use Swiftx\Plugins\WeChat\Event\Common as Event;
use Swiftx\System\Object;
/**
 * 服务端接口
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 *
 * @property Event CurrentEvent 当前事件
 *
 */
class Server extends Object {

    /** @var Config 微信配置 */
    protected $config = null;

    /**
     * 系统构造
     * @param Config $config
     */
    public function __construct(Config $config){
        $this->config = $config;
    }

    /**
     * 监听事件
     * @param $event
     * @param $callback
     */
    public function Listen($event, $callback){

    }

    /**
     * 当前触发的事件
     * @return null|Event
     */
    protected function _getCurrentEvent(){
        if(isset($_GET['echostr']))
            return new Validate($_GET['echostr']);
        $PostData = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (empty($PostData)) return null;
        $PostData = simplexml_load_string($PostData, 'SimpleXMLElement', LIBXML_NOCDATA);
        $RX_TYPE = trim($PostData->MsgType);
        if ($RX_TYPE != "event") return null;
        $eventName = trim($PostData->Event);
        $eventName = '_make'.ucwords($eventName);
        return $this->$eventName($PostData);
    }

    /**
     * 用户关注事件
     * @param $PostData
     * @return Subscribe
     */
    protected function _makeSubscribe($PostData){
        $toUserName = trim($PostData->ToUserName);
        $fromUserName = trim($PostData->FromUserName);
        $createTime = trim($PostData->CreateTime);
        return new Subscribe($toUserName,$fromUserName,$createTime);
    }

    /**
     * 用户取消关注事件
     * @param $PostData
     * @return Subscribe
     */
    protected function _makeUnsubscribe($PostData){
        $toUserName = trim($PostData->ToUserName);
        $fromUserName = trim($PostData->FromUserName);
        $createTime = trim($PostData->CreateTime);
        return new Subscribe($toUserName,$fromUserName,$createTime);
    }

    /**
     * 用户扫码事件
     */
    protected function _makeSCAN(){

    }

    /**
     * 用户上报位置事件
     */
    protected function _makeLOCATION(){

    }

    /**
     * 用户自定义菜单点击事件
     */
    protected function _makeCLICK(){

    }

    /**
     * 点击菜单链接跳转事件
     */
    protected function _makeVIEW(){

    }

    /**
     * 校验Signature
     * @return bool
     */
    public function CheckSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = $this->config->Token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature )
            return true;
        else return false;
    }

}

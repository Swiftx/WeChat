<?php
namespace Swiftx\Plugins\WeChat;
use Swiftx\System\Object;
/**
 * 微信SDK配置
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2014-04-28
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 */
class Config extends Object {

    /** @var bool 调试模式 */
    public $Debug = false;

    /** @var string 应用编号 */
    public $AppID = null;

    /** @var string 应用密钥 */
    public $Secret = null;

    /** @var string 令牌 */
    public $Token = null;

    /** @var string 消息加解密密钥 */
    public $EncodingAESKey;

    /** @var string 消息加解密模式 */
    public $EncodingAESMode;

    /** @var callback 凭据保存方法 */
    protected $_saveAccessCallback;

    /** @var callback 凭据读取方法 */
    protected $_readAccessCallback;

    /** @var callback 凭据保存方法 */
    protected $_saveTicketCallback;

    /** @var callback 凭据读取方法 */
    protected $_readTicketCallback;

    /**
     * 凭据存储方法
     * @param callback $callback
     */
    public function SaveAccess($callback){
        $this->_saveAccessCallback = $callback;
    }

    /**
     * 凭据读取方法
     * @param callback $callback
     */
    public function ReadAccess($callback){
        $this->_readAccessCallback = $callback;
    }

    /**
     * 凭据存储方法
     * @param callback $callback
     */
    public function SaveTicket($callback){
        $this->_saveTicketCallback = $callback;
    }

    /**
     * 凭据读取方法
     * @param callback $callback
     */
    public function ReadTicket($callback){
        $this->_readTicketCallback = $callback;
    }

    /**
     * 调用保存AccessToken方法
     * @param Token $token
     */
    public function CallSaveAccessMethod(Token $token){
        call_user_func($this->_saveAccessCallback,$token);
    }

    /**
     * 调用读取本地AccessToken方法
     * @return Token
     */
    public function CallReadAccessMethod(){
        return call_user_func($this->_readAccessCallback);
    }

    /**
     * 调用保存JsSDKTicket方法
     * @param Ticket $token
     */
    public function CallSaveTicketMethod(Ticket $token){
        call_user_func($this->_saveTicketCallback,$token);
    }

    /**
     * 调用读取本地JsSDKTicket方法
     * @return Token
     */
    public function CallReadTicketMethod(){
        return call_user_func($this->_readTicketCallback);
    }

}

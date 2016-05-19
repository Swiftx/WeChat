<?php
namespace Swiftx\Plugins\WeChat;
use Swiftx\System\Object;

/**
 * JsSDK
 *
 * @author		胡永强  <odaytudio@gmail.com>
 * @since		2015-12-15
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 *
 * @property-read string $HttpSrc   脚本引入地址
 * @property-read string $HttpsSrc  脚本引入地址
 * @property-read string $PageUrl   页面Url地址
 * @property-read string $AppId     公众号的唯一标识
 * @property-read string $TimeStamp 生成签名的时间戳
 * @property-read string $NonceStr  生成签名的随机串
 * @property-read string $Signature 签名
 * @property-read array  $JsApiList 需要使用的JS接口列表
 */
class JsSdk extends Object {

    /** @var string  */
    protected $_page_url;
    /** @var int  */
    protected $_time_stamp;
    /** @var string  */
    protected $_nonce_str;
    /** @var string  */
    protected $_signature;
    /** @var array  */
    protected $_js_api_list;
    /** @var Client  */
    protected $_client;

    /**
     * 创建对象
     * @param Client $client
     * @param string $url
     * @param null|string $nonce
     * @param null|int $time
     */
    public function __construct(Client $client, $url, $nonce=null, $time=null){
        $this->_client = $client;
        if($nonce==null){
            $nonce = array_merge(range(0,9),range('a','z'),range('A','Z'));
            shuffle($nonce);
            $nonce = implode('',array_slice($nonce,0,16));
        }
        $this->_page_url = $url;
        $this->_nonce_str = $nonce;
        if($time==null) $time = time();
        $this->_time_stamp = $time;
        $this->_signature = static::CalculateSignature($nonce, $this->_client->JsApiTicket->Key, $time, $url);
    }

    /**
     * 签名生成算法
     * @param string $key
     * @param string $ticket
     * @param int $time
     * @param string $url
     * @return string
     */
    public static function CalculateSignature($key, $ticket,$time, $url){
        $str = 'jsapi_ticket='.$ticket.'&noncestr='.$key.'&timestamp='.$time.'&url='.$url;
        return sha1($str);
    }


    /**
     * 获取HttpSrc
     * @return string
     */
    protected function _getHttpSrc(){
        return 'http://resource.wx.qq.com/open/js/jweixin-1.0.0.js';
    }

    /**
     * 获取HttpsSrc
     * @return string
     */
    protected function _getHttpsSrc(){
        return 'https://resource.wx.qq.com/open/js/jweixin-1.0.0.js';
    }

    /**
     * 获取Src
     * @return string
     */
    protected function _getAppId(){
        return $this->_client->AppID;
    }

    /**
     * 获取生成时间戳
     * @return int|null
     */
    protected function _getTimeStamp(){
        return $this->_time_stamp;
    }

    /**
     * 生成签名的随机字符
     * @return null|string
     */
    protected function _getNonceStr(){
        return $this->_nonce_str;
    }

    /**
     * 签名内容
     * @return string
     */
    protected function _getSignature(){
        return $this->_signature;
    }

    /**
     *
     */
    protected function _getJsApiList(){

    }

}
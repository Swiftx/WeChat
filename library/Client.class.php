<?php
namespace Swiftx\Plugins\WeChat;
use Swiftx\Internet\Curl;
use Swiftx\Plugins\WeChat\Menu\Common;
use Swiftx\Plugins\WeChat\Menu\Group;
use Swiftx\Plugins\WeChat\Menu\View;
use Swiftx\System\Object;

/**
 * 客户端接口
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 *
 * @property Token AccessToken 调用凭据
 * @property Ticket JsApiTicket 调用凭据
 * @property string AppID 调用凭据
 *
 */
class Client extends Object {

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
     * 获取AppID
     * @return string
     */
    protected function _getAppID(){
        return $this->config->AppID;
    }

    /**
     * 生成JsSdk
     * @param string $url
     * @return JsSdk
     */
    public function JsSdk($url){
        return new JsSdk($this,$url);
    }

    /**
     * 创建菜单
     * @param array $menu
     * @return array
     */
    public function CreateMenu(array $menu){
        $responseData['button'] = array();
        foreach($menu as $group){
            if($group instanceof Group){
                $temp['name'] = $group->Name;
                $temp['sub_button'] = array();
                /** @var Common $button */
                foreach($group as $button){
                    $method = '_button'.$button->Type.'ToArray';
                    $temp['sub_button'][] = $this->$method($button);
                }
                $responseData['button'][] = $temp;
            } else {
                /** @var Common $group */
                $method = '_button'.$group->Type.'ToArray';
                $responseData['button'][]  = $this->$method($group);
            }
        }
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->AccessToken->Value;
        $res = $this->_httpsRequest($url, json_encode($responseData,JSON_UNESCAPED_UNICODE));
        return json_decode($res, true);
    }

    /**
     * 删除菜单
     * @return array
     */
    public function DeleteMenu(){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->AccessToken->Value;
        return Curl::SendJsonGet($url);
    }

    /**
     * 构造试图按钮参数数组
     * @param View $button
     * @return array
     */
    protected function _buttonViewToArray(View $button){
        $data['type'] = "view";
        $data['name'] = $button->Name;
        $data['url'] = $button->Url;
        if($button->Auth) {
            $data['url'] = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->config->AppID
                .'&redirect_uri='.$data['url'].'&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect';
        }
        return $data;
    }

    /**
     * 发送HTTPS请求
     * @param $url
     * @param null $data
     * @return mixed
     */
    protected function _httpsRequest($url, $data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /**
     * 获取Token方法
     * @return Token
     * @throws \Exception
     */
    protected function _getAccessToken(){
        /** @var Token $accessToken */
        static $accessToken = null;
        if($accessToken != null){
            if($accessToken->OverTime < time())
                return $accessToken;
            $apiUrl = 'https://api.weixin.qq.com/cgi-bin/token';
            $option['grant_type'] = 'client_credential';
            $option['appid'] = $this->config->AppID;
            $option['secret'] = $this->config->Secret;
            $result = Curl::SendJsonGet($apiUrl, $option);
            if(!isset($result['access_token']))
                throw new \Exception($result['errmsg'], $result['errcode']);
            $accessToken = new Token($result['access_token'],$result['expires_in']);
            $this->config->CallSaveAccessMethod($accessToken);
            return $accessToken;
        }
        $accessToken = $this->config->CallReadAccessMethod();
        if($accessToken != null) {
            if ($accessToken->OverTime < time())
                return $accessToken;
        }
        $apiUrl = 'https://api.weixin.qq.com/cgi-bin/token';
        $option['grant_type'] = 'client_credential';
        $option['appid'] = $this->config->AppID;
        $option['secret'] = $this->config->Secret;
        $result = Curl::SendJsonGet($apiUrl, $option);
        if(!isset($result['access_token']))
            throw new \Exception($result['errmsg'], $result['errcode']);
        $accessToken = new Token($result['access_token'],$result['expires_in']);
        $this->config->CallSaveAccessMethod($accessToken);
        return $accessToken;
    }

    /**
     * 获取AccessToken
     * @return Ticket
     */
    protected function _getJsApiTicket(){
        /** @var Ticket $jsSdkTicket */
        static $jsSdkTicket = null;
        if($jsSdkTicket != null){
            if($jsSdkTicket->OverTime < time())
                return $jsSdkTicket;
            $apiUrl = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket';
            $option['access_token'] = $this->AccessToken->Value;
            $option['type'] = 'jsapi';
            $result = Curl::SendJsonGet($apiUrl, $option);
            if($result['errcode'] == 0)
                return new Ticket($result['ticket'],$result['expires_in']);
            $this->config->CallSaveTicketMethod($jsSdkTicket);
            return $jsSdkTicket;
        }
        $jsSdkTicket = $this->config->CallReadAccessMethod();
        if($jsSdkTicket != null) {
            if ($jsSdkTicket->OverTime < time())
                return $jsSdkTicket;
        }
        $apiUrl = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket';
        $option['access_token'] = $this->AccessToken->Value;
        $option['type'] = 'jsapi';
        $result = Curl::SendJsonGet($apiUrl, $option);
        if($result['errcode'] == 0)
            return new Ticket($result['ticket'],$result['expires_in']);
        $this->config->CallSaveTicketMethod($jsSdkTicket);
        return $jsSdkTicket;
    }

}

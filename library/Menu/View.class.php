<?php
namespace Swiftx\Plugins\WeChat\Menu;
/**
 * 跳转URL页面按钮
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 *
 * @property string Url 链接地址
 * @property string Auth 页面授权
 *
 */
class View extends Common {

    /** @var string 链接地址 */
    protected $_url = null;

    /** @var bool 页面授权 */
    protected $_auth = false;

    /**
     * 查看按钮事件消息
     * @return string
     */
    protected function _getUrl(){
        return $this->_url;
    }

    /**
     * 设置按钮事件消息
     * @param string $value
     * @return string
     */
    protected function _setUrl($value){
        $this->_url = $value;
        return $value;
    }

    /**
     * 是否授权
     * @return bool
     */
    protected function _getAuth(){
        return $this->_auth;
    }

    /**
     * 授权设置
     * @param bool $value
     * @return bool
     */
    protected function _setAuth($value){
        $this->_auth = $value;
        return $value;
    }

    /**
     * 按钮类型
     * @return string
     */
    protected function _getType(){
        return 'View';
    }
}

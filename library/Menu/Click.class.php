<?php
namespace Swiftx\Plugins\WeChat\Menu;
/**
 * 自定义点击事件菜单
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
class Click extends Common {

    /** @var string 按钮事件消息 */
    protected $_message = null;

    /**
     * 查看按钮事件消息
     * @return mixed
     */
    protected function _getMessage(){
        return $this->_message;
    }

    /**
     * 设置按钮事件消息
     * @param $value
     * @return mixed
     */
    protected function _setMessage($value){
        $this->_message = $value;
        return $value;
    }

}

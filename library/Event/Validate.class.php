<?php
namespace Swiftx\Plugins\WeChat\Event;

/**
 * 服务端校验接口
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
class Validate extends Common {

    /**
     * 默认事件
     * @return string
     */
    public function DefaultResponse(){
        return $_GET['echostr'];
    }

    /**
     * 事件名称
     * @return string
     */
    protected function _getName(){
        return 'Validate';
    }
}

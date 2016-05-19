<?php
namespace Swiftx\Plugins\WeChat\Event;

/**
 * 服务端校验接口
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
class UnSubscribe extends Common {

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
        return 'UnSubscribe';
    }

    /**
     * 默认事件
     * @return string
     */
    public function DefaultResponse(){


    }

}


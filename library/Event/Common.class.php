<?php
namespace Swiftx\Plugins\WeChat\Event;
use Swiftx\System\Object;
/**
 * 事件基类
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-03-01
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 *
 * @property string Name 事件名称
 * @property string ToUserName 开发者微信号
 * @property string FromUserName 发送方OpenID
 * @property string CreateTime 创建时间
 *
 */
abstract class Common extends Object {

    /** @var string 开发者微信号 */
    protected $_toUserName = null;

    /** @var string 发送方OpenID */
    protected $_fromUserName = null;

    /** @var int 创建时间 */
    protected $_createTime = null;

    /**
     * 创建事件对象
     * @param string $toUserName
     * @param string $fromUserName
     * @param string $createTime
     */
    public function __construct($toUserName=null, $fromUserName=null, $createTime=null){
        $this->_toUserName = $toUserName;
        $this->_fromUserName = $fromUserName;
        $this->_createTime = $createTime;
    }

    /**
     * 默认事件
     * @return string
     */
    abstract public function DefaultResponse();

    /**
     * 事件名称
     * @return string
     */
    abstract protected function _getName();

}

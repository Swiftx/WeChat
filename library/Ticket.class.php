<?php
namespace Swiftx\Plugins\WeChat;
use Swiftx\System\Object;

/**
 * AccessToken
 *
 * @author		胡永强  <odaytudio@gmail.com>
 * @since		2015-12-15
 * @copyright	Copyright (c) 2014-2015 Swiftx Inc.
 *
 * @property-read string $Key
 * @property-read int $Expires
 * @property-read int $CreateTime
 * @property-read int $OverTime
 */
class Ticket extends Object {

    /** @var string  */
    protected $_key;
    /** @var int  */
    protected $_expires;
    /** @var int  */
    protected $_create_time;

    /**
     * 创建Ticket对象
     * @param string $key
     * @param int $expires
     * @param null $time
     */
    public function __construct($key, $expires, $time = null){
        $this->_key = $key;
        $this->_expires = $expires;
        if($time==null) $time = time();
        $this->_create_time = $time;
    }

    /**
     * 获取Key
     * @return string
     */
    protected function _getKey(){
        return $this->_key;
    }

    /**
     * 有效时间
     * @return int
     */
    protected function _getExpires(){
       return $this->_expires;
    }

    /**
     * 创建时间
     * @return int
     */
    protected function _getCreateTime(){
        return $this->_create_time;
    }

    /**
     * 过期时间
     * @return int
     */
    protected function _getOverTime(){
        return $this->_create_time+$this->_expires;
    }

}

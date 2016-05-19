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
 * @property-read string $Value
 * @property-read int $Expires
 * @property-read int $CreateTime
 * @property-read int $OverTime
 *
 */
class Token extends Object {

    /** @var string Token值 */
    protected $_value;
    /** @var int 有效时间 */
    protected $_expires;
    /** @var int 创建时间 */
    protected $_create_time;

    /**
     * 创建AccessToken对象
     * @param string $value
     * @param int $expires
     * @param null $time
     */
    public function __construct($value, $expires, $time = null){
        $this->_value = $value;
        $this->_expires = $expires;
        if($time==null) $time = time();
        $this->_create_time = $time;
    }

    /**
     * Token值
     * @return string
     */
    public function __toString(){
        return $this->Value;
    }

    /**
     * 获取Key
     * @return string
     */
    protected function _getValue(){
        return $this->_value;
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

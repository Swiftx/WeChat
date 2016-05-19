<?php
namespace Swiftx\Plugins\WeChat\Menu;
use Swiftx\System\Object;
/**
 * 自定义菜单基类
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 *
 * @property string Name 按钮名称
 * @property string Type 按钮类型
 */
abstract class Common extends Object {

    /** @var string 菜单名 */
    protected $_name = null;

    /**
     * 创建按钮
     * @param null|string $name
     */
    public function __construct($name = null){
        $this->_name = $name;
    }

    /**
     * 读取按钮名
     * @return string
     */
    protected function _getName(){
        return $this->_name;
    }

    /**
     * 设置按钮名
     * @param $value
     * @return mixed
     */
    protected function _setName($value){
        $this->_name = $value;
        return $value;
    }

    /**
     * 按钮类型
     * @return string
     */
    abstract protected function _getType();

}

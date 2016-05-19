<?php
namespace Swiftx\Plugins\WeChat\Menu;
use Swiftx\Tools\Debug;

/**
 * 扫码按钮
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
class Group extends Common implements \ArrayAccess,\Iterator {

    protected $_data = array();
    protected $_valid = false;

    /**
     * 数组查看一条分页数据
     * @param string $offset 列名
     * @return bool
     */
    public function offsetExists($offset){
        return array_key_exists($offset, $this->_data);
    }

    /**
     * 数组模式读取一行数据
     * @param string $offset 列名
     * @return mixed
     */
    public function offsetGet($offset){
        return $this->_data[$offset];
    }

    /**
     * 数组模式设置字段的值
     * @param string $offset 列名
     * @param $value $value 值
     * @return bool
     */
    public function offsetSet($offset, $value){
        if(empty($offset)) $this->_data[] = $value;
        else $this->_data[$offset] = $value;
    }

    /**
     * 对象数组模式删除方法,禁用！
     * @param string $offset 表全名
     */
    public function offsetUnset($offset){
        unset($this->_data[$offset]);
    }

    /**
     * 将迭代器的指针移向第一个元素。类似于数组操作函数reset()
     * @return bool
     */
    public function rewind(){
        reset($this->_data);
        $this->_valid = empty($this->_data)?false:true;
    }

    /**
     * 类似于数组操作函数current()。返回迭代的当前元素
     * @return array
     */
    public function current(){
        return current($this->_data);
    }

    /**
     * 返回当前迭代器元素的键名，类似于数组操作函数key()
     * @return string
     */
    public function key(){
        return key($this->_data);
    }

    /**
     * 将指针移向迭代器的下一个元素，类似于数组操作函数next()
     * @return null
     */
    public function next(){
        $this->_valid = (next($this->_data)===false)?false:true;
    }

    /**
     * 检测在执行了rewind()或是next()函数之后，当前值是否是一个有效的值
     * @return bool
     */
    public function valid(){
        return $this->_valid;
    }

    /**
     * 按钮类型
     * @return string
     */
    protected function _getType(){
        return 'Group';
    }
}

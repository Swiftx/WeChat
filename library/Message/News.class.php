<?php
namespace Swiftx\Plugins\WeChat\Message;
use Swiftx\System\Object;

/**
 * 图文消息
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-02-26
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 *
 * @property string Title 图文消息标题
 * @property string Description 图文消息描述
 * @property string Image 图片链接地址
 * @property string Link 文章链接地址
 *
 */
class News extends Object{

    /** @var string 图文消息标题  */
    protected $_title = null;

    /** @var string 图文消息描述 */
    protected $_description = null;

    /** @var string 图片链接地址 */
    protected $_image = null;

    /** @var string 文章链接地址 */
    protected $_link = null;

    /**
     * 读取标题
     * @return string
     */
    protected function _getTitle(){
        return $this->_title;
    }

    /**
     * 设置标题
     * @param $value
     * @return mixed
     */
    protected function _setTitle($value){
        $this->_title = $value;
        return $value;
    }

    /**
     * 读取消息描述
     * @return string
     */
    protected function _getDescription(){
        return $this->_description;
    }

    /**
     * 设置消息描述
     * @param $value
     * @return mixed
     */
    protected function _setDescription($value){
        $this->_description = $value;
        return $value;
    }

    /**
     * 读取图片URL地址
     * @return string
     */
    protected function _getImage(){
        return $this->_image;
    }

    /**
     * 设置图片URL
     * @param $value
     * @return mixed
     */
    protected function _setImage($value){
        $this->_image = $value;
        return $value;
    }

    /**
     * 读取链接地址
     * @return string
     */
    protected function _getLink(){
        return $this->_link;
    }

    /**
     * 设置链接地址
     * @param $value
     * @return mixed
     */
    protected function _setLink($value){
        $this->_link = $value;
        return $value;
    }

}

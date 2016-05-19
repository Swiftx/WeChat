<?php
namespace Swiftx\Plugins\WeChat\Receive;
/**
 * 图文消息类
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-03-01
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
class Image extends Common {

    /** @var string 链接地址 */
    public $Url = null;

    /** @var int 图片消息媒体id，可以调用多媒体文件下载接口拉取数据。  */
    public $Media = null;
    

}

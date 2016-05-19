<?php
namespace Swiftx\Plugins\WeChat\Receive;
/**
 * 语音消息类
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-03-01
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
class Voice extends Common {

    /** @var string 语音格式，如amr，speex等 */
    public $Format = null;

    /** @var int 图片消息媒体id，可以调用多媒体文件下载接口拉取数据。  */
    public $Media = null;
    

}

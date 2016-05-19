<?php
namespace Swiftx\Plugins\WeChat\Receive;
use Swiftx\System\Object;
/**
 * 消息基类
 * @author		Hismer <odaytudio@gmail.com>
 * @since		2016-03-01
 * @copyright	Copyright (c) 2014-2016 Swiftx Inc.
 */
abstract class Common extends Object {

    /** @var int 消息编号 */
    public $ID = null;

    /** @var string 开发者微信号 */
    public $ToUserName = null;

    /** @var string 发送方OpenID */
    public $FromUserName = null;

    /** @var int 创建时间 */
    public $CreateTime = null;

}

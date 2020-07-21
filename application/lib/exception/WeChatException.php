<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 5:23 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = '微信服务器接口调用失败';
    public $errorCode = 999;
}
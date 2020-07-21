<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 7:37 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期或无效Token';
    public $errorCode = 20000;
}
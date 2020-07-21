<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/21
 * Time: 1:43 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}
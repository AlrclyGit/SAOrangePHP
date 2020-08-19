<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/31
 * Time: 4:47 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10000;
}
<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 4:29 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}
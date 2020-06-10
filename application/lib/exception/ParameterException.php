<?php
/**
 * Name: 参数错误异常处理
 * User: 萧俊介
 * Date: 2020/6/10
 * Time: 3:05 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;

}
<?php
/**
 * Name: Banner异常处理
 * User: 萧俊介
 * Date: 2020/6/10
 * Time: 11:27 上午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;

class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的Banne不存在';
    public $errorCode = 40000;



}
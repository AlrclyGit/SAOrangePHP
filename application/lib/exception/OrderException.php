<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/8/3
 * Time: 11:55 上午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}
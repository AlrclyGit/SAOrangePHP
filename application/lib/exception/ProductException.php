<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 7:24 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '自定的商品不存在，请检查参数';
    public $errorCode = 20000;
}
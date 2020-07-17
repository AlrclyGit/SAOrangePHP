<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 8:03 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存在，请检查参数';
    public $errorCode = 50000;
}
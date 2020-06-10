<?php
/**
 * Name: 异常基本处理
 * User: 萧俊介
 * Date: 2020/6/10
 * Time: 11:24 上午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\exception;


class BaseException extends \Exception
{
    // HTTP 状态码
    public $code = 400;
    // 错误具体信息
    public $msg = '参数错误';
    // 自定义的错误码
    public $errorCode = 10000;

    /*
     *
     */
    public function __construct($params = [])
    {
        parent::__construct();
        if (!is_array($params)) {
            return false;
        } else {
            if (array_key_exists('code', $params)) {
                $this->code = $params['code'];
            }
            if (array_key_exists('msg', $params)) {
                $this->msg = $params['msg'];
            }
            if (array_key_exists('errorCode', $params)) {
                $this->errorCode = $params['errorCode'];
            }
        }
    }
}
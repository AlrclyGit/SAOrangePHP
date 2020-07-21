<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 12:49 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{

    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => '没有Code还想获取Token，想的美～'
    ];

}
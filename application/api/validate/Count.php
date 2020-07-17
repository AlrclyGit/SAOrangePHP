<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 7:08 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\validate;


class Count extends BaseValidate
{

    //
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];

    protected $message = [
        'count' => 'ID必须是正整数，并且小于15'
    ];

}
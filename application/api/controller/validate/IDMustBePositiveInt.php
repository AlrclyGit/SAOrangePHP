<?php
/**
 * Name: ID是否为正整数
 * User: 萧俊介
 * Date: 2020/6/5
 * Time: 4:46 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\validate;

class IDMustBePositiveInt extends BaseValidate
{

    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];

}
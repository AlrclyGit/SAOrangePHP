<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/8/19
 * Time: 3:03 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{

    protected $rule=[
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $message = [
        'page' => '分页参数必须为正整数',
        'size' => '分页参数必须为正整数'
    ];

}
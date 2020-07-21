<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/21
 * Time: 1:13 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{

    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty',
    ];

}
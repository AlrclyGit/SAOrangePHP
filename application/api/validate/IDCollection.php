<?php
/**
 * Name: ID必须为整型
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 4:01 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{

        protected $rule=[
            'ids' => 'require|checkIDs'
        ];

        protected $message = [
            'ids' => 'ids参数必须是以逗号分隔的多个正整树'
        ];

}
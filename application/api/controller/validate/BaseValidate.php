<?php
/**
 * Name: 验证服务
 * User: 萧俊介
 * Date: 2020/6/5
 * Time: 5:00 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\validate;


use app\lib\exception\ParameterException;
use think\Validate;

class BaseValidate extends Validate
{

    public function goCheck()
    {
        $params = input('param.');
        $result = $this->batch()->check($params);
        if (!$result) {
            throw new ParameterException([
                'msg' => $this->error
            ]);
        } else {
            return true;
        }
    }

    /*
     * ID必须是正整数
     */
    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return $field . '必须是正整数';
        }
    }

}
<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/8/3
 * Time: 11:08 上午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{

    protected $rule = [
        'products' => 'checkProducts'
    ];

    /*
     * 验证数组形式的数据
     */
    public function checkProducts($values)
    {
        if (!is_array($values)) {
            throw new ParameterException([
                'msg' => '商品列表必须为数组'
            ]);
        }
        if (empty($values)) {
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }
        foreach ($values as $value) {
            $this->checkProduct($value);
        }
        return true;
    }

    // 定义验证规则
    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger',
    ];

    /*
     * 在验证内调用父级验证，传入规则
     */
    protected function checkProduct($value)
    {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if (!$result) {
            throw new ParameterException([
                'msg' => '商品列表参数错误'
            ]);
        }
    }
}
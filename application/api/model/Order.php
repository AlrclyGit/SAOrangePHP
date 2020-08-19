<?php
/**
 * Name: 订单模型
 * User: 萧俊介
 * Date: 2020/8/10
 * Time: 3:20 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class Order extends BaseModel
{

    /*
     *
     */
    public static function getSummaryByUser($uid, $page, $size)
    {
        $pagingData = self::where('user_id', $uid)
            ->order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData;
    }

    /*
     *
     */
    public function getSnapItemsAttr($value)
    {
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }

    /*
     *
     */
    public function getSnapAddressAttr($value)
    {
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }

}
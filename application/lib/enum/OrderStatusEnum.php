<?php
/**
 * Name: 订单状态枚举
 * User: 萧俊介
 * Date: 2020/8/12
 * Time: 3:56 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\lib\enum;


class OrderStatusEnum
{
    // 待支付
    const UNPAID = 1;
    // 已支付
    const PAID = 2;
    // 已发货
    const DELIVERED = 3;
    // 已支付，但库存不足
    const PAID_BUT_OUT_OF = 4;
}
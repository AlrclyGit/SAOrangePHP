<?php
/**
 * Name: 微信支付回调服务
 * User: 萧俊介
 * Date: 2020/8/14
 * Time: 4:38 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\service;

use app\api\model\Order;
use app\api\model\Product;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class WxNotifyService extends \WxPayNotify
{

    /*
     * 支付成功回调方法
     */
    public function NotifyProcess($objData, $config, &$msg)
    {
        if ($objData['result_code'] == 'SUCCESS') { // 支付成功
            // 获取订单号
            $orderNo = $objData['out_trade_no'];
            Db::startTrans();
            try {
                // 通过订单号查询商品
                $order = Order::where('order_no', $orderNo)->find();
                if ($order->status == 1) { // 商品状态为未支付
                    // 检测商品库存状态
                    $service = new OrderService();
                    $stockStatus = $service->checkOrderStock($order->id);
                    if ($stockStatus['pass']) { // 通过库存检测
                        // 更新商品状态
                        $this->updateOrderStatus($order->id, true);
                        // 更新库存数量
                        $this->reduceStock($stockStatus);
                    } else { // 未通过库存检测
                        // 更新商品状态
                        $this->updateOrderStatus($order->id, false);
                    }
                }
                Db::commit();
                return true;
            } catch (Exception $ex) {
                Db::rollback();
                Log::error($ex);
                return false;
            }
        } else {
            return true;
        }
    }

    /*
     * 更新商品状态
     */
    private function updateOrderStatus($orderID, $success)
    {
        $statue = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
        $data = [
            'status' => $statue
        ];
        $where = [
            'id' => $orderID
        ];
        Order::update($data, $where);
    }

    /*
     * 更新库存数量
     */
    private function reduceStock($stockStatus)
    {
        foreach ($stockStatus['pStatusArray'] as $singlePStatus) {
            Product::where('id', $singlePStatus['id'])->setDec('stock', $singlePStatus['count']);
        }
    }


}
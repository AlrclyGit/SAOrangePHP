<?php
/**
 * Name: 支付服务
 * User: 萧俊介
 * Date: 2020/8/12
 * Time: 11:53 上午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\service;

use app\api\model\Order;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class PayService
{
    //
    private $orderID;
    private $orderNO;

    /*
     * 构造方法
     */
    function __construct($orderID)
    {
        if (!$orderID) {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
    }

    /*
     * 进行微信支付
     */
    public function pay()
    {
        // 检测支付来源数据的可靠性
        $this->checkOrderValid();
        // 检测库存信息
        $orderService = new OrderService();
        $statue = $orderService->checkOrderStock($this->orderID);
        if (!$statue['pass']) {
            return $statue;
        }
        // 发送预订单请求
        return $this->makeWxPreOrder($statue['orderPrice']);
    }

    /*
     * 发送预订单请求（拼装数组）
     */
    private function makeWxPreOrder($totalPrice)
    {
        // openid
        $openid = TokenService::getCurrentToKenVar('openid');
        if (!$openid) {
            throw new TokenException();
        }

        // 发送预订单请求
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNO);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        $wxOrderData->SetBody('橘子铺子');
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));
        //
        $config = new \WxPayConfig();
        //
        return $this->getPaySignature($config, $wxOrderData);
    }

    /*
     * 发送预订单请求（请求处理）
     */
    private function getPaySignature($config, $wxOrderData)
    {
        // 发送预定请求到微信
        $wxOrder = \WxPayApi::unifiedOrder($config, $wxOrderData);
        // 判定
        if ($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] != 'SUCCESS') { //预订单生成失败
            Log::record($wxOrder, 'error');
            Log::record('获取预订单失败', 'error');
            return null;
        } else { // 预订单生成成功
            // 写入通知参数
            $this->recordPreOrder($wxOrder);
            // 制作签名
            $signature = $this->sign($wxOrder);
            // 返回
            return $signature;
        }
    }

    /*
     * 签名方法
     */
    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());
        $jsApiPayData->SetNonceStr(getRandChar(4));
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');
        $config = new \WxPayConfig();
        $sign = $jsApiPayData->MakeSign($config);
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }

    /*
     * 写入通知参数
     */
    private function recordPreOrder($wxOrder)
    {
        $data = [
            'prepay_id' => $wxOrder['prepay_id']
        ];
        $where = [
            'id' => $this->orderID
        ];
        Order::update($data, $where);
    }


    /*
     * 检测支付来源数据的可靠性
     */
    private function checkOrderValid()
    {
        // 订单号根本不存在
        $order = Order::where('id', $this->orderID)->find();
        if (!$order) {
            throw new OrderException();
        }
        // 订单号和当前用户不匹配
        if (!TokenService::isValidOperate($order->user_id)) {
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errorCode' => 10003
            ]);
        }
        // 订单已支付
        if ($order->status != OrderStatusEnum::UNPAID) {
            throw new OrderException([
                'msg' => '订单已支付过啦',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        $this->orderNO = $order->order_no;
        return true;
    }
}
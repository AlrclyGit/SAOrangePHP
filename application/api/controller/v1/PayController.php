<?php
/**
 * Name: 支付控制器
 * User: 萧俊介
 * Date: 2020/8/12
 * Time: 11:44 上午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\service\WxNotifyService;
use app\api\service\PayService;
use app\api\validate\IDMustBePositiveInt;

class PayController extends BaseController
{

    // 前置操作
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    /*
     * 微信预付费订单接口
     */
    public function getPreOrder($id = '')
    {
        (new IDMustBePositiveInt())->goCheck();
        $payS = new PayService($id);
        return $payS->pay();
    }

    /*
     * 微信支付回调接口
     */
    public function receiveNotify()
    {
        $notify = new WxNotifyService();
        $config = new \WxPayConfig();
        $notify->Handle($config);
    }
}
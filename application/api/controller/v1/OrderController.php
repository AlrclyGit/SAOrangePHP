<?php
/**
 * Name: 订单控制器
 * User: 萧俊介
 * Date: 2020/7/31
 * Time: 4:57 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\model\Order;
use app\api\service\OrderService;
use app\api\service\TokenService;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;

class OrderController extends BaseController
{

    // 前置操作
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getDetail,getSummaryByUser']
    ];

    /*
     *
     */
    public function getSummaryByUser($page = 1, $size = 15)
    {
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $pagingOrders = Order::getSummaryByUser($uid, $page, $size);
        if ($pagingOrders->isEmpty()) {
            return [
                'data' => [],
                'current_page' => $pagingOrders->getCurrentPage()
            ];
        }
        $data = $pagingOrders->hidden(['snap_items', 'snap_address', 'prepay_id'])->toArray();
        return [
            'data' => $data,
            'current_page' => $pagingOrders->getCurrentPage()
        ];
    }

    /*
     * 订单记录详情
     */
    public function getDetail($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $orderDetail = Order::get($id);
        if (!$orderDetail) {
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }

    /*
     * 下单接口
     */
    public function placeOrder()
    {
        // 验证参数
        (new OrderPlace())->goCheck();
        //
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();

        $orderS = new OrderService();
        $status = $orderS->place($uid, $products);
        return $status;
    }

}
<?php
/**
 * Name: 地址控制器
 * User: 萧俊介
 * Date: 2020/7/21
 * Time: 1:11 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;

use app\api\model\User;
use app\api\service\TokenService;
use app\api\validate\AddressNew;
use app\lib\exception\UserException;

class AddressController extends BaseController
{

    // 前置操作
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];

    /*
     * 更新或者添加用户收货地址
     */
    public function createOrUpdateAddress()
    {
        // 实例化验证
        $validate = new AddressNew();
        // 参数合理性验证
        $validate->goCheck();
        // 获取当前用户UID
        $uid = TokenService::getCurrentUid();
        // 从 User 表获取用户
        $user = User::get($uid);
        if (!$uid) {
            throw new UserException();
        }
        // 排查非必要参数
        $dataArray = $validate->getDataByRule(input('post.'));
        // 获取关联地址是否存在
        $userAddress = $user->address;
        if (!$userAddress) { // 不存在添加操作
            $user->address()->save($dataArray);
        } else { // 存在更新操作
            $user->address->save($dataArray);
        }
        // 返回成功消息
        return SuccessMessage();
    }

}
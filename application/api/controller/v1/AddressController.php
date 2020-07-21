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
use app\api\service\Token;
use app\api\validate\AddressNew;
use app\lib\exception\UserException;

class AddressController extends BaseController
{

    /*
     *
     */
    public function createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate ->goCheck();
        //
        //
        $uid = Token::getCurrentUid();
        $user = User::get($uid);
        if (!$uid) {
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if (!$userAddress) {
            $user->address()->save($dataArray);
        } else {
            $user->address->save($dataArray);
        }
        return SuccessMessage();
    }

}
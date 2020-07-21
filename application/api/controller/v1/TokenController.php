<?php
/**
 * Name: Token控制器
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 12:48 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class TokenController extends BaseController
{

    /*
     *
     */
    public function getToken($code = '')
    {
        //
        (new TokenGet())->goCheck();
        //
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token' => $token
        ];
    }

}
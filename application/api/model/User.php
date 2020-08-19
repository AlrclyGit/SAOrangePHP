<?php
/**
 * Name: 用户信息模型
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 1:22 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class User extends BaseModel
{

    /*
     * 关联用户的收货地址表
     */
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }


    /*
     * 通过 OpenID 获取用户信息
     */
    public static function getByOpenID($openid)
    {
        $user = self::where('openid', $openid)->find();
        return $user;
    }




}
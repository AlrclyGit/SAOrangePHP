<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 1:22 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class User extends BaseModel
{

    /*
     *
     */
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }


    /*
     *
     */
    public static function getByOpenID($openid)
    {
        $user = self::where('openid', $openid)->find();
        return $user;
    }




}
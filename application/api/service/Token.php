<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 7:10 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{

    /*
     *
     */
    public static function generateToken()
    {
        $randChars = getRandChar(32);
        $timestamp = time();
        $salt = config('secure.token_salt');
        return md5($randChars . $timestamp . $salt);
    }

    /*
     *
     */
    public static function getCurrentToKenVar($key)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        } else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            } else {
                throw new Exception('尝试获取的Token变量不存在');
            }
        }
    }

    /*
     *
     */
    public static function getCurrentUid()
    {
        $uid = self::getCurrentToKenVar('uid');
        return $uid;
    }


}
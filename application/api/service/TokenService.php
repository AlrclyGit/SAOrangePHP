<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 7:10 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class TokenService
{

    /*
     * 获取一个随机的Token的Key
     */
    public static function generateToken()
    {
        $randChars = getRandChar(32);
        $timestamp = time();
        $salt = config('secure.token_salt');
        return md5($randChars . $timestamp . $salt);
    }

    /*
     * 获取用户某个Value
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
     * 获取用户Uid
     */
    public static function getCurrentUid()
    {
        $uid = self::getCurrentToKenVar('uid');
        return $uid;
    }

    /*
     * 权限验证方法（管理员和用户）
     */
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentToKenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    /*
     * 权限验证方法（用户）
     */
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentToKenVar('scope');
        if ($scope) {
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    /*
     * 检测传入的UID是否为当前用户
     */
    public static function isValidOperate($checkedUID)
    {
        if (!$checkedUID) {
            throw new Exception('检测UID时必须传入一个被检测的UID');
        }
        $currentOperateUID = self::getCurrentUid();
        if ($currentOperateUID == $checkedUID) {
            return true;
        }
        return false;
    }


}
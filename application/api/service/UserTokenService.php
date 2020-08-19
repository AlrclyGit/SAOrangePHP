<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/18
 * Time: 1:24 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\service;


use app\api\model\User;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

class UserTokenService extends TokenService
{

    protected $code;
    protected $wxAppID;
    protected $weAppSecret;
    protected $wxLoginUrl;

    /*
     *
     */
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->weAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppID, $this->weAppSecret, $this->code);
    }

    /*
     *
     */
    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }

    /*
     *
     */
    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];
        $user = User::getByOpenID($openid);
        if ($user) {
            $uid = $user->id;
        } else {
            $uid = $this->newUser($openid);
        }
        $cacheValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cacheValue);
        return $token;
    }

    /*
     *
     */
    private function saveToCache($cacheValue)
    {
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire_in = config('setting.token_expire_in');
        $request = cache($key, $value, $expire_in);
        if (!$request) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }

    /*
     *
     */
    private function prepareCachedValue($wxResult, $uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = ScopeEnum::User;
        return $cacheValue;
    }

    /*
     *
     */
    private function newUser($openid)
    {
        $user = User::create(['openid' => $openid]);
        return $user->id;
    }

    /*
     *
     */
    private function processLoginError($wxResult)
    {
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode']
        ]);
    }

}
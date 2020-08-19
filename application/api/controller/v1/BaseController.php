<?php
/**
 * Name: 通用控制器
 * User: 萧俊介
 * Date: 2020/6/5
 * Time: 4:22 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\service\TokenService;
use think\Controller;

class BaseController extends Controller
{

    /*
     * 权限验证方法（管理员和用户）
     */
    protected function checkPrimaryScope()
    {
        return TokenService::needPrimaryScope();
    }

    /*
     * 权限验证方法（用户）
     */
    protected function checkExclusiveScope()
    {
        return TokenService::needExclusiveScope();
    }


}
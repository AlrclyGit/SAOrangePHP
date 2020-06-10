<?php
/**
 * Name: Banner控制器
 * User: 萧俊介
 * Date: 2020/6/5
 * Time: 4:22 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\controller\model\Banner;
use app\api\controller\validate\IDMustBePositiveInt;

class BannerController extends BaseController
{

    /*
     * 获取指定id的banner信息Ø
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $banner = Banner::getBannerByID($id);
        return $banner;
    }

}
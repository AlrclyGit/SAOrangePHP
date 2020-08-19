<?php
/**
 * Name: Banner控制器
 * User: 萧俊介
 * Date: 2020/6/5
 * Time: 4:22 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\model\Banner;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\BannerMissException;

class BannerController extends BaseController
{

    /*
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     */
    public function getBanner($id)
    {
        // 参数合理性验证
        (new IDMustBePositiveInt())->goCheck();
        // 通过ID获取Banner
        $banner = Banner::getBannerByID($id);
        if($banner){
            return $banner;
        }else{
            throw new BannerMissException();
        }
    }

}
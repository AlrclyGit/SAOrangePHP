<?php
/**
 * Name: 专题控制器
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 3:49 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\model\Theme;
use app\api\validate\IDCollection;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ThemeException;

class ThemeController extends BaseController
{

    /*
     * 获取任意组合的专题信息
     * $url /theme?ids=id1,id2,id3
     * @return 一组theme模型
     */
    public function getSimpleList($ids = '')
    {
        //
        (new IDCollection())->goCheck();
        //
        $ids = explode(',', $ids);
        $result = Theme::with('topicImg,headImg')->select($ids);
        if ($result->isEmpty()) {
            throw new ThemeException();
        }
        return $result;
    }

    /*
     * 获取某一专题的商品信息
     * @url /theme:id
     */
    public function getComplexOne($id)
    {
        //
        (new IDMustBePositiveInt())->goCheck();
        //
        return Theme::getThemeWithProducts($id);
    }

}
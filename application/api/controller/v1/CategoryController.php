<?php
/**
 * Name: 商品分类控制器
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 7:48 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\model\Category;
use app\lib\exception\CategoryException;

class CategoryController extends BaseController
{

    /*
     * 获取商品分类
     */
    public function getAllCategories()
    {
        $categories = Category::all([], 'img');
        if($categories->isEmpty()){
            throw new CategoryException();
        }
        return $categories;
    }

}
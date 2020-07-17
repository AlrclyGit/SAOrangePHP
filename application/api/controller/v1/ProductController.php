<?php
/**
 * Name: 最近商品控制器
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 7:05 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\controller\v1;


use app\api\model\Product;
use app\api\validate\Count;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ProductException;

class ProductController extends BaseController
{

    /*
     *
     */
    public function getRecent($count = 15)
    {
        //
        (new Count())->goCheck();
        //
        $products = Product::getMostRecent($count);
        if ($products->isEmpty()) {
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }

    /*
     *
     */
    public function getAllInCategory($id)
    {
        //
        (new IDMustBePositiveInt())->goCheck();
        //
        $products = Product::getProductsByCategoryID($id);
        if ($products->isEmpty()) {
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }
}
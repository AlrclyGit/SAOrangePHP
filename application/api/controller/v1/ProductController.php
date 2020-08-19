<?php
/**
 * Name: 商品控制器
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
     * 获取最新商品
     */
    public function getRecent($count = 15)
    {
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
     * 获取某分类下的所有商品
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

    /*
     *
     */
    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $product = Product::getProductDetail($id);
        if (!$product) {
            throw new ProductException();
        } else {
            return $product;
        }
    }

    /*
     *
     */
    public function deleteOne($id){

    }

}
<?php
/**
 * Name: Product模型
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 3:50 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class Product extends BaseModel
{
    // 隐藏字段
    protected $hidden = ['topic_img_id', 'head_img_id', 'main_img_id', 'pivot', 'from', 'category_id', 'create_time', 'update_time', 'delete_time'];

    /*
     *
     */
    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    /*
     *
     */
    public static function getMostRecent($count)
    {
        return self::order('create_time DESC')
            ->limit($count)
            ->select();
    }

    /*
     *
     */
    public static function getProductsByCategoryID($categoryID)
    {
        return self::where('category_id',$categoryID)
            ->select();
    }

}
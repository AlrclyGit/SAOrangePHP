<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 3:50 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class Theme extends BaseModel
{

    // 隐藏字段
    protected $hidden = ['topic_img_id','head_img_id','create_time', 'update_time', 'delete_time'];

    /*
     *
     */
    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    /*
     *
     */
    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    /*
     *
     */
    public function products()
    {
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    /*
     *
     */
    public static function getThemeWithProducts($id)
    {
        return self::with('products,headImg,topicImg')->find($id);
    }

}
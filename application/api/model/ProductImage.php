<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/21
 * Time: 12:24 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class ProductImage extends BaseModel
{

    //
    protected $hidden = ['img_id','product_id', 'id', 'create_time', 'update_time', 'delete_time'];

    /*
     *
     */
    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }

}
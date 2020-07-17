<?php
/**
 * Name:
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 7:49 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class Category extends BaseModel
{

    // 隐藏字段
    protected $hidden = ['topic_img_id','create_time', 'update_time', 'delete_time'];

    /*
     * 关联img
     */
    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

}
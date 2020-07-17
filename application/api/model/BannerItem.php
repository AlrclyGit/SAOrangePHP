<?php
/**
 * Name: BannerItem模型
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 2:17 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class BannerItem extends BaseModel
{

    // 隐藏字段
    protected $hidden = ['id','img_id','banner_id','create_time','update_time','delete_time'];

    /*
     * 关联img
     */
    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }

}
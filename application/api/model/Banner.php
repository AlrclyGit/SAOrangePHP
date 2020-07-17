<?php
/**
 * Name: Banner模型
 * User: 萧俊介
 * Date: 2020/6/5
 * Time: 5:28 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class Banner extends BaseModel
{

    // 隐藏字段
    protected $hidden = ['create_time','update_time','delete_time'];

    /*
     * 关联BannerItem
     */
    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    /*
     * 通过ID获取Banner
     */
    public static function getBannerByID($id)
    {
        return self::with('items.img')->find($id);
    }

}
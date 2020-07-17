<?php
/**
 * Name: Image模型
 * User: 萧俊介
 * Date: 2020/7/17
 * Time: 2:29 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


class Image extends BaseModel
{

    // 隐藏字段
    protected $hidden = ['id', 'from', 'create_time', 'update_time', 'delete_time'];

    /*
     *
     */
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}
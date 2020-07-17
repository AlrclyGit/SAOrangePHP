<?php
/**
 * Name: 基本模型
 * User: 萧俊介
 * Date: 2020/6/5
 * Time: 5:31 下午
 * Created by SAOrangePHP制作委员会.
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{

    protected function prefixImgUrl($value, $data)
    {
        if ($data['from'] == 1) {
            $url = config('setting.img_prefix') . $value;
        } elseif ($data['from'] == 2) {
            $url = config('setting.oss_img_prefix') . $value;
        }
        return $url;
    }

}
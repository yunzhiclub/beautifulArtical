<?php

namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 16:54
 */
class Common {
    public static function saveHotel($name, $city, $starLevel, $remark) {
        $hotel = new Hotel();
        $hotel->name = $name;
        $hotel->city = $city;
        $hotel->star_level = $starLevel;
        $hotel->remark = $remark;
        return $hotel->save();
    }

    public static function saveAttraction($title, $content, $name, $meal, $car, $guide, $weight) {

    }

    public static function uploadImage($file) {
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            return $info->getSaveName();
        }else{
            return $file->getError();
        }
    }
}
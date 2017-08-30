<?php

namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 16:54
 * @uploadImage 上传文件
 * @param 需要上传的文件
 * @return 文件存储后的路径
 *
 * @saveHotel 保存酒店
 * @saveAttraction 保存景点
 */
class Common {
    public static function saveHotel($name, $city, $starLevel, $remark) {
        $hotel = new Hotel();
        $hotel->name = $name;
        $hotel->city = $city;
        $hotel->star_level = $starLevel;
        $hotel->remark = $remark;
        if(!$hotel->save()) {
            return $hotel->getError();
        } else {
            return $hotel;
        }
    }

    public static function saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id) {
        $attraction = new Attraction();
        $attraction->title = $title;
        $attraction->description = $content;
        $attraction->name = $name;
        $attraction->meal = $meal;
        $attraction->car = $car;
        $attraction->guide = $guide;
        $attraction->image = $image;
        $attraction->weight = Common::getAttractionWeight($article_id);
        $attraction->hotel_id = $hotel->id;
        $attraction->article_id = $article_id;
        if(!$attraction->save()) {
            return false;
        } else {
            return true;
        }
    }

    public static function getAttractionWeight($article_id) {
        $map = ['article_id' => $article_id];
        $attractions = Attraction::where($map)->select();
        return sizeof($attractions)+1;
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
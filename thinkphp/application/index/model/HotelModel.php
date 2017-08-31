<?php

namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 20:41
 */

class HotelModel {
    public function saveHotel($name, $city, $starLevel, $remark) {
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
}
<?php

namespace app\index\model;

use think\Model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 15:37
 */

class Attraction extends Model {
    public function saveAttraction($title, $content, $designation, $meal, $car, $guide, $image, $hotel, $articleId) {
        $this->title = $title;
        $this->description = $content;
        $this->designation = $designation;
        $this->meal = $meal;
        $this->car = $car;
        $this->guide = $guide;
        $this->image = $image;
        $this->weight = Attraction::where('article_id', '=', $articleId)->count()+1;
        $this->article_id = $articleId;

        if(!is_null($hotel)){
            $this->hotel_id = $hotel->id;
        }

        if(!$this->save()) {
            return false;
        } else {
            return true;
        }
    }

    public function updateAttraction($title, $content, $designation, $meal, $car, $guide, $image, $hotel, $articleId, $id) {
        $Attraction = Attraction::get($id);
        $Attraction->saveAttraction($title, $content, $designation, $meal, $car, $guide, $image, $hotel, $articleId);
    }

    public function deleteAttraction($id) {
        $Attraction = Attraction::get($id);
        $hotelId = $Attraction->hotel_id;

        Common::deleteImage('upload/'.$Attraction->image);
        if(!$Attraction->delete()) {
            return false;
        }
        if(!is_null($hotelId)) {
            $Hotel = new Hotel();
            if(!$Hotel->deleteHotel($hotelId)){
                return false;
            }
        }
        return true;
    }

    public function checkImageIsNull() {
        if(is_null($this->image)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getNullAttraction() {
        $Attraction = new Attraction();
        $Attraction->id = null;
        $Attraction->title = '';
        $Attraction->description = '';
        $Attraction->designation = '';
        $Attraction->meal = '';
        $Attraction->car = '';
        $Attraction->guide = '';
        $Attraction->image = null;
        return $Attraction;
    }
}
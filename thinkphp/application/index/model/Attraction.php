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
    public function saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id) {
        $this->title = $title;
        $this->description = $content;
        $this->designation = $name;
        $this->meal = $meal;
        $this->car = $car;
        $this->guide = $guide;
        $this->image = $image;
        $this->weight = Attraction::where('article_id', '=', $article_id)->count()+1;
        $this->article_id = $article_id;

        if(!is_null($hotel)){
            $this->hotel_id = $hotel->id;
        }

        if(!$this->save()) {
            return false;
        } else {
            return true;
        }
    }

    public function updateAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id, $id) {
        $attraction = Attraction::get($id);
        $attraction->saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id);
    }

    public function deleteAttraction($id) {
        $attraction = Attraction::get($id);
        $hotelId = $attraction->hotel_id;

        Common::deleteImage('upload/'.$attraction->image);
        if(!$attraction->delete()) {
            return false;
        }
        if(!is_null($hotelId)) {
            $hotel = new Hotel();
            if(!$hotel->deleteHotel($hotelId)){
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
        $attraction = new Attraction();
        $attraction->id = null;
        $attraction->title = '';
        $attraction->description = '';
        $attraction->designation = '';
        $attraction->meal = '';
        $attraction->car = '';
        $attraction->guide = '';
        $attraction->image = null;
        return $attraction;
    }
}
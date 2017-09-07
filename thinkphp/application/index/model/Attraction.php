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
    public function saveAttraction($title, $meal, $car, $guide, $hotel, $articleId, $materialId) {
        $this->title = $title;
        $this->meal = $meal;
        $this->car = $car;
        $this->guide = $guide;
        $this->weight = Attraction::where('article_id', '=', $articleId)->count()+1;
        $this->article_id = $articleId;
        $this->material_id = $materialId;

        if(!is_null($hotel)){
            $this->hotel_id = $hotel->id;
        }

        if(!$this->save()) {
            return false;
        } else {
            return true;
        }
    }

    public function updateAttraction($title, $meal, $car, $guide, $hotel, $articleId, $id) {
        $Attraction = Attraction::get($id);
        $Attraction->saveAttraction($title, $meal, $car, $guide, $hotel, $articleId);
    }

    public function deleteAttraction($id) {
        $Attraction = Attraction::get($id);
        $hotelId = $Attraction->hotel_id;

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

    public static function getNullAttraction() {
        $Attraction = new Attraction();
        $Attraction->id = null;
        $Attraction->title = '';
        $Attraction->meal = '';
        $Attraction->car = '';
        $Attraction->guide = '';
        return $Attraction;
    }

    public function getMaterial($id) {
        //返回关联的素材
        if(!is_null($id)) {
            return Material::get($id);
        } else {
            $Material = new Material();
            $Material->image = '';
            $Material->designation = '未选择素材';
            return $Material;
        }
    }
}
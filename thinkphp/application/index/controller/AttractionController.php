<?php

namespace app\index\controller;

use app\index\model\Common;
use think\Controller;
use think\Request;
use app\index\model\Hotel;
use app\index\model\Attraction;

/**
 * 
 * @authors 张喜硕
 */

class AttractionController extends Controller {
    
    public function add() {
        return $this->fetch();
    }

    public function save() {
        $title = Request::instance()->post('title');
        $content = Request::instance()->post('content');
        $name = Request::instance()->post('name');
        $meal = Request::instance()->post('meal');
        $car = Request::instance()->post('car');
        $guide = Request::instance()->post('guide');
        $weight = Request::instance()->post('weight');

        $hotelName = Request::instance()->post('hotelName');
        $hotelCity = Request::instance()->post('hotelCity');
        $hotelStarLevel = Request::instance()->post('hotelStarLevel');
        $hotelRemark = Request::instance()->post('hotelRemark');

        $file = request()->file('image');

        Common::saveAttraction($title, $content, $name, $meal, $car, $guide, $weight);
        Common::saveHotel($hotelName,$hotelCity,$hotelStarLevel,$hotelRemark);
        $image = Common::uploadImage($file);

    }
}
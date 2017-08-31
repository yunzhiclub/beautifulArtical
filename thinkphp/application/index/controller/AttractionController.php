<?php

namespace app\index\controller;

use app\index\model\AttractionModel;
use app\index\model\Common;
use app\index\model\HotelModel;
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
        $article_id = Request::instance()->param('id');
        $this->assign('attractionid',$article_id);
        return $this->fetch();
    }

    public function save() {
        $title = Request::instance()->post('title');
        $content = Request::instance()->post('content');
        $name = Request::instance()->post('name');
        $meal = Request::instance()->post('meal');
        $car = Request::instance()->post('car');
        $guide = Request::instance()->post('guide');

        $hotelName = Request::instance()->post('hotelName');
        $hotelCity = Request::instance()->post('hotelCity');
        $hotelStarLevel = Request::instance()->post('hotelStarLevel');
        $hotelRemark = Request::instance()->post('hotelRemark');

        $article_id = Request::instance()->param('id');

        $file = request()->file('image');

        if(is_null($file)) {
            return $this->error('请上传图片', url('add'));
        }

        $image = Common::uploadImage($file);

        $hotelModel = new HotelModel();
        $hotel = $hotelModel->saveHotel($hotelName,$hotelCity,$hotelStarLevel,$hotelRemark);

        $attractionModel = new AttractionModel();
        if(!$attractionModel->saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id)) {
            return $this->error('保存失败', url('add'));
        } else {
            return $this->success('保存成功', url('Article/secondadd'));
        }
    }
}
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
        $articleId = Request::instance()->param('articleId');
        $this->assign('articleId',$articleId);
        $this->assign('attraction',Attraction::getNullAttraction());
        $this->assign('hotel',Hotel::getNullHotel());
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

        // 酒店处理
        if($hotelName || $hotelCity || $hotelStarLevel || $hotelRemark) {
            $hotel = new Hotel();
            $hotel = $hotel->saveHotel($hotelName,$hotelCity,$hotelStarLevel,$hotelRemark);
        } else {
            $hotel = null;
        }

        // 图片处理
        $file = request()->file('image');
        if(is_null($file)) {
            return $this->error('请上传图片', url('add?id='.$article_id));
        }
        $image = Common::uploadImage($file);

        // 景点处理
        $attraction = new Attraction();
        if(!$attraction->saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $hotel, $article_id)) {
            return $this->error('保存失败', url('add?id='.$article_id));
        } else {
            return $this->success('保存成功', url('Article/secondadd?id='.$article_id));
        }
    }

    public function edit() {
        $articleId = Request::instance()->param('articleId');
        $attractionId = Request::instance()->param('attractionId');

        $attraction = Attraction::get($attractionId);

        if(!is_null($attraction->hotel_id)) {
            $hotel = Hotel::get($attraction->hotel_id);
        } else {
            $hotel = Hotel::getNullHotel();
        }

        $this->assign('articleId', $articleId);
        $this->assign('attraction', $attraction);
        $this->assign('hotel', $hotel);

        return $this->fetch('add');
    }
}
<?php

namespace app\index\controller;

use app\index\model\AttractionModel;
use app\index\model\Common;
use app\index\model\HotelModel;
use app\index\controller\IndexController;
use think\Request;
use app\index\model\Hotel;
use app\index\model\Attraction;

/**
 * 
 * @authors 张喜硕
 */

class AttractionController extends IndexController {
    
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

        $articleId = Request::instance()->param('articleId');

        // 酒店处理
        if($hotelName || $hotelCity || $hotelStarLevel || $hotelRemark) {
            $Hotel = new Hotel();
            $Hotel = $Hotel->saveHotel($hotelName,$hotelCity,$hotelStarLevel,$hotelRemark);
        } else {
            $Hotel = null;
        }

        // 图片处理
        $file = request()->file('image');
        if(is_null($file)) {
            return $this->error('请上传图片', url('add?id='.$articleId));
        }
        $image = Common::uploadImage($file);

        // 景点处理
        $attraction = new Attraction();
        if(!$attraction->saveAttraction($title, $content, $name, $meal, $car, $guide, $image, $Hotel, $articleId)) {
            return $this->error('保存失败', url('add?id='.$articleId));
        } else {
            return $this->success('保存成功', url('Article/secondadd?id='.$articleId));
        }
    }

    public function edit() {
        $articleId = Request::instance()->param('articleId');
        $attractionId = Request::instance()->param('attractionId');

        $Attraction = Attraction::get($attractionId);

        if(!is_null($Attraction->hotel_id)) {
            $Hotel = Hotel::get($Attraction->hotel_id);
        } else {
            $Hotel = Hotel::getNullHotel();
        }

        $this->assign('articleId', $articleId);
        $this->assign('attraction', $Attraction);
        $this->assign('hotel', $Hotel);

        return $this->fetch('add');
    }

    public function update() {
        // 获取URL
        $articleId = Request::instance()->param('articleId');
        $attractionId = Request::instance()->param('attractionId');
        $hotelId = Request::instance()->param('hotelId');

        // 获取数据
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

        // 酒店处理
        $Hotel = Hotel::getNullHotel();
        if($hotelName || $hotelCity || $hotelStarLevel || $hotelRemark) {
            if(!is_null($hotelId)) {
                $Hotel = $Hotel->updateHotel($hotelName, $hotelCity, $hotelStarLevel, $hotelRemark, $hotelId);
            } else {
                $Hotel = $Hotel->saveHotel($hotelName, $hotelCity, $hotelStarLevel, $hotelRemark);
            }
        } else {
            if(!is_null($hotelId)) {
                $Hotel->deleteHotel($hotelId);
            }
            $Hotel = null;
        }

        // 图片处理
        $Attraction = Attraction::get($attractionId);
        $file = request()->file('image');
        if(!is_null($file)) {
            Common::deleteImage('upload/'.$Attraction->image);
            $image = Common::uploadImage($file);
        } else {
            $image = $Attraction->image;
        }

        // 景点处理
        $Attraction = Attraction::getNullAttraction();
        $Attraction->updateAttraction($title, $content, $name, $meal, $car, $guide, $image, $Hotel, $articleId, $attractionId);

        return $this->success('更新成功',url('article/secondadd?id='.$articleId));
    }

    public function delete() {
        $attractionId = Request::instance()->param('attractionId');
        $articleId = Request::instance()->param('articleId');
        $Attraction = new Attraction();
        if(!$Attraction->deleteAttraction($attractionId)) {
            return $this->error('删除失败',url('article/secondadd?id='.$articleId));
        }
        return $this->success('删除成功',url('article/secondadd?id='.$articleId));
    }
}
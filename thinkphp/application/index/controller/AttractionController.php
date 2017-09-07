<?php

namespace app\index\controller;

use app\index\model\AttractionModel;
use app\index\model\Common;
use app\index\model\HotelModel;
use app\index\model\Material;
use app\index\service\Attractionservice;
use app\index\service\Materialservice;
use think\Request;
use app\index\model\Hotel;
use app\index\model\Attraction;

/**
 * 
 * @authors 张喜硕
 */

class AttractionController extends IndexController {
    protected $attractionService = null;
    protected $materialService = null;

    function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->attractionService = new Attractionservice();
        $this->materialService = new Materialservice();
    }

    public function add() {
        $articleId = Request::instance()->param('articleId');
        $this->assign('articleId',$articleId);
        $this->assign('attraction',Attraction::getNullAttraction());
        $this->assign('hotel',Hotel::getNullHotel());
        $this->assign('materials', $this->materialService->getAll());
        return $this->fetch();
    }

    public function save() {
        $title = Request::instance()->post('title');
        $meal = Request::instance()->post('meal');
        $car = Request::instance()->post('car');
        $guide = Request::instance()->post('guide');

        $hotelName = Request::instance()->post('hotelName');
        $hotelCity = Request::instance()->post('hotelCity');
        $hotelStarLevel = Request::instance()->post('hotelStarLevel');
        $hotelRemark = Request::instance()->post('hotelRemark');

        $articleId = Request::instance()->param('articleId');

        $materialId = Request::instance()->post('materialId');

        // 酒店处理
        if($hotelName || $hotelCity || $hotelStarLevel || $hotelRemark) {
            $Hotel = new Hotel();
            $Hotel = $Hotel->saveHotel($hotelName,$hotelCity,$hotelStarLevel,$hotelRemark);
        } else {
            $Hotel = null;
        }

        // 景点处理
        $Attraction = new Attraction();
        if(!$Attraction->saveAttraction($title, $meal, $car, $guide, $Hotel, $articleId, $materialId)) {
            return $this->error('保存失败', url('add?articleId='.$articleId));
        } else {
            return $this->success('保存成功', url('Article/secondadd?articleId='.$articleId));
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
        $this->assign('materials', $this->materialService->getAll());

        return $this->fetch('add');
    }

    public function update() {
        // 获取URL
        $articleId = Request::instance()->param('articleId');
        $attractionId = Request::instance()->param('attractionId');
        $hotelId = Request::instance()->param('hotelId');

        // 获取数据
        $title = Request::instance()->post('title');
        $meal = Request::instance()->post('meal');
        $car = Request::instance()->post('car');
        $guide = Request::instance()->post('guide');
        $hotelName = Request::instance()->post('hotelName');
        $hotelCity = Request::instance()->post('hotelCity');
        $hotelStarLevel = Request::instance()->post('hotelStarLevel');
        $hotelRemark = Request::instance()->post('hotelRemark');

        $materialId = Request::instance()->post('materialId');

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

        // 景点处理
        $Attraction = Attraction::getNullAttraction();
        $Attraction->updateAttraction($title, $meal, $car, $guide, $Hotel, $articleId, $attractionId , $materialId);

        return $this->success('更新成功',url('article/secondadd?articleId='.$articleId));
    }

    public function delete() {
        $attractionId = Request::instance()->param('attractionId');
        $articleId = Request::instance()->param('articleId');
        $Attraction = new Attraction();
        if(!$Attraction->deleteAttraction($attractionId)) {
            return $this->error('删除失败',url('article/secondadd?articleId='.$articleId));
        }
        return $this->success('删除成功',url('article/secondadd?articleId='.$articleId));
    }
}
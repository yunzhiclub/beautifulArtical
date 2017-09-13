<?php

namespace app\index\controller;

use app\index\model\AttractionModel;
use app\index\model\Common;
use app\index\model\HotelModel;
use app\index\model\Material;
use app\index\service\Attractionservice;
use app\index\service\HotelService;
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
    protected $hotelService = null;

    function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->attractionService = new Attractionservice();
        $this->materialService = new Materialservice();
        $this->hotelService = new HotelService();
    }

    public function add() {
        $articleId = Request::instance()->param('articleId');
        $attraction = new Attraction();
        $this->assign('articleId',$articleId);
        $this->assign('attraction',Attraction::getNullAttraction());
        $this->assign('hotels',$this->hotelService->getAll());
        $this->assign('materials', $this->materialService->getAll());
        return $this->fetch();
    }

    public function save() {
        $title = Request::instance()->post('title');
        $meal = Request::instance()->post('meal');
        $car = Request::instance()->post('car');
        $guide = Request::instance()->post('guide');

        $articleId = Request::instance()->param('articleId');

        $materialId = Request::instance()->post('materialId');

        $hotelId = Request::instance()->post('hotelId');

        // 景点处理
        $Attraction = new Attraction();
        if(!$Attraction->saveAttraction($title, $meal, $car, $guide, $hotelId, $articleId, $materialId)) {
            return $this->error('保存失败', url('add?articleId='.$articleId));
        } else {
            return $this->success('保存成功', url('Article/secondadd?articleId='.$articleId));
        }
    }

    public function edit() {
        $articleId = Request::instance()->param('articleId');
        $attractionId = Request::instance()->param('attractionId');

        $Attraction = Attraction::get($attractionId);

        $this->assign('articleId', $articleId);
        $this->assign('attraction', $Attraction);
        $this->assign('hotels', $this->hotelService->getAll());
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

        $materialId = Request::instance()->post('materialId');

        $hotelId = Request::instance()->post('hotelId');

        // 酒店处理
        $Hotel = Hotel::getNullHotel();

        // 图片处理
        $Attraction = Attraction::get($attractionId);

        // 景点处理
        $Attraction = Attraction::getNullAttraction();
        $Attraction->updateAttraction($title, $meal, $car, $guide, $hotelId, $articleId, $attractionId , $materialId);

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
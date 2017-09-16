<?php

namespace app\index\controller;

use app\index\model\Attraction;
use app\index\model\AttractionModel;
use app\index\model\Common;
use app\index\model\Hotel;
use app\index\model\HotelModel;
use app\index\model\Material;
use app\index\service\AttractionService;
use app\index\service\HotelService;
use app\index\service\Materialservice;
use think\Request;

/**
 * 
 * @authors 张喜硕
 */

class AttractionController extends IndexController {
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->attractionService = new AttractionService();
    }

    public function add() {
        $materials = Material::all();
        $hotels = Hotel::all();
        $articleId = Request::instance()->param('articleId');
        $this->assign('materials', $materials);
        $this->assign('hotels', $hotels);
        $this->assign('articleId', $articleId);
        $this->assign('attraction', $this->attractionService->getNullAttraction());
        return $this->fetch();
    }

    public function save() {
        $param = Request::instance();
        $articleId = Request::instance()->param('articleId');
        $message = $this->attractionService->saveAttraction($param);
        if($message['status'] == 'success') {
            return $this->success($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        } else {
            return $this->error($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        }
    }

    public function edit() {
        $articleId = Request::instance()->param('articleId');
        $attractionId = Request::instance()->param('attractionId');
        $attraction = Attraction::get($attractionId);
        $materials = Material::all();
        $hotels = Hotel::all();

        $this->assign('materials', $materials);
        $this->assign('hotels', $hotels);
        $this->assign('articleId', $articleId);
        $this->assign('attraction', $attraction);
        return $this->fetch('add');
    }

    public function update() {
        $param = Request::instance();
        $articleId = Request::instance()->param('articleId');
        $message = $this->attractionService->updateAttraction($param);
        if($message['status'] == 'success') {
            return $this->success($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        } else {
            return $this->error($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        }
    }

    public function delete() {
        $param = Request::instance();
        $articleId = Request::instance()->param('articleId');
        $message = $this->attractionService->deleteAttraction($param);
        if($message['status'] == 'success') {
            return $this->success($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        } else {
            return $this->error($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        }
    }
}
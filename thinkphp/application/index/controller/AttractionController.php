<?php

namespace app\index\controller;

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
        return $this->fetch();
    }

    public function save() {
        $param = Request::instance();
        $message = $this->attractionService->saveAttraction($param);
    }

    public function edit() {
    }

    public function update() {
    }

    public function delete() {
    }
}
<?php

namespace app\index\controller;

use app\index\model\Hotel;

/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/9/12
 * Time: 9:30
 */

class HotelController extends IndexController {
    public function index() {
        $pageSize = config('paginate.var_page');
        $hotels = Hotel::order('id desc')->paginate($pageSize);
        $this->assign('hotels', $hotels);
        return $this->fetch();
    }

    public function add() {
        return $this->fetch();
    }
}
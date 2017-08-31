<?php

namespace app\index\model;

use think\Model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 15:55
 */

class Hotel extends Model {
    public function saveHotel($name, $city, $starLevel, $remark) {
        $this->designation = $name;
        $this->city = $city;
        $this->star_level = $starLevel;
        $this->remark = $remark;
        if(!$this->save()) {
            return $this->getError();
        } else {
            return $this;
        }
    }
}
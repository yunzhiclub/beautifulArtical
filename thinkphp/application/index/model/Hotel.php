<?php

namespace app\index\model;

use think\Model;
use think\Db;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 15:55
 */

class Hotel extends Model {
	public function getHotelByCity($city) {
        $map = ['city' => $city];
        return Db::table('hotel')->where($map)->select();
    }
    // public function getHotelByCountry($country) {
    //     $map = ['country' => $country];
    //     return Db::table('hotel')->where($map)->select();    
    // }
    public function getHotelByCountry($country) {
        $map = ['country' => $country];
        return Hotel::get($map);
    }
    public function getHotelByStarLevel($starlevel) {
        $map = ['star_level' => $starlevel];
        return Db::table('hotel')->where($map)->select();    
    }

}
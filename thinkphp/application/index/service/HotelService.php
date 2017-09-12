<?php

namespace app\index\service;
use app\index\model\Article;
use app\index\model\Attraction;
use app\index\model\Hotel;

/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/9/12
 * Time: 9:37
 */

class HotelService {
    public function saveHotel($param) {

        $message = [];
        $message['message'] = '保存成功';
        $message['status']  = 'success';

        $hotel = new Hotel();
        $hotel->designation = $param->post('designation');
        $hotel->city = $param->post('city');
        $hotel->star_level = $param->post('star_level');
        $hotel->remark = $param->post('remark');

        if(!$hotel->save()) {
            $message['message'] = '保存失败';
            $message['status']  = 'error';
        }

        return $message;
    }

    public function updateHotel($param) {

        $message = [];
        $message['message'] = '保存成功';
        $message['status']  = 'success';

        $hotel = Hotel::get($param->param('hotelId'));
        $designation = $param->post('designation');
        $city = $param->post('city');
        $star_level = $param->post('star_level');
        $remark = $param->post('remark');

        if($hotel->designation == $designation && $hotel->city == $city && $hotel->star_level == $star_level && $hotel->remark == $remark) {
            $message['message'] = '酒店内容没有改变';
            return $message;
        }

        $hotel->designation = $designation;
        $hotel->city = $city;
        $hotel->star_level = $star_level;
        $hotel->remark = $remark;

        if(!$hotel->save()) {
            $message['message'] = '保存失败';
            $message['status'] = 'error';
            return $message;
        }

        return $message;
    }

    public function deleteHotel($param) {

        $message = [];
        $message['message'] = '删除成功';
        $message['status']  = 'success';

        $hotelId = $param->param('hotelId');
        $hotel = Hotel::get($hotelId);

        $attractions = Attraction::where('hotel_id','=',$hotelId)->select();
        if(sizeof($attractions) != 0) {
            $message['message'] = '该酒店已经被景点选中，无法删除';
            $message['status']  = 'error';
            return $message;
        }

        if(!$hotel->delete()) {
            $message['message'] = '删除失败';
            $message['status']  = 'error';
            return $message;
        }

        return $message;
    }

    public function getNullHotel() {
        $hotel = new Hotel();
        $hotel->id = null;
        $hotel->designation = '';
        $hotel->city = '';
        $hotel->star_level = '';
        $hotel->remark = '';
        return $hotel;
    }
}
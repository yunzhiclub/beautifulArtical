<?php
/**
 * Created by PhpStorm.
 * User: liming
 * Date: 17-9-7
 * Time: 上午8:37
 */

namespace app\index\service;


use app\index\model\Attraction;

class AttractionService {
    public function saveAttraction($param) {
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '保存成功';

        $trip = $param->post('trip');
        $date = $param->post('date');
        $guide = $param->post('guide');
        $meal = $param->post('meal');
        $car = $param->post('car');
        $materialIds = $param->post('materialId/a');
        $articleId = $param->param('articleId');
        $hotelId = $param->post('hotelId');

        $Attraction = new Attraction();
        $Attraction->trip = $trip;
        $Attraction->date = $date;
        $Attraction->guide = $guide;
        $Attraction->meal = $meal;
        $Attraction->car = $car;
        $Attraction->hotel_id = $hotelId;
        $Attraction->article_id = $articleId;

        if(!$Attraction->save()) {
            $message['status'] = 'error';
            $message['message'] = '保存失败';
        }

        return $message;
    }
}
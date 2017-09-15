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
        $description = $param->post('description');
        $meal = $param->post('meal');
        $car = $param->post('car');
        $materialIds = $param->post('materialId/a');
        $articleId = $param->param('articleId');
        $hotelId = $param->post('hotelId');

        $Attraction = new Attraction();
        $Attraction->trip = $trip;
        $Attraction->date = $date;
        $Attraction->guide = $guide;
        $Attraction->description = $description;
        $Attraction->meal = $meal;
        $Attraction->car = $car;
        $Attraction->hotel_id = $hotelId;
        $Attraction->article_id = $articleId;
        $Attraction->weight = Attraction::where('article_id', '=', $articleId)->max("weight")+1;

        if(!$Attraction->save()) {
            $message['status'] = 'error';
            $message['message'] = '保存失败';
        }

        if(!is_null($materialIds)) {
            if(!$Attraction->Materials()->saveAll($materialIds)) {
                $message['status'] = 'error';
                $message['message'] = '保存失败';
            }
        }

        return $message;
    }
}
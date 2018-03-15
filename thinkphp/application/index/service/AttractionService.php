<?php
/**
 * Created by PhpStorm.
 * User: liming
 * Date: 17-9-7
 * Time: 上午8:37
 */

namespace app\index\service;


use app\index\model\Attraction;
use app\index\model\Common;

class AttractionService {

    public function getNullAttraction($article_id) {
        $attraction = new Attraction();
        $attractionexist = Attraction::where("article_id",$article_id)->select();
        $length = sizeof($attractionexist);
        if ($length!=0) {
            $attraction->date =  date("Y-m-d",strtotime("+1 day",strtotime($attractionexist[$length-1]->date)));

        } else {
            $attraction->date = '';
        }
        $attraction->trip = '';
        $attraction->guide = '';
        $attraction->description = '';
        $attraction->meal = 'breakfast';
        $attraction->car = 'plane';
        $attraction->id = 0;
        $attraction->hotel_id = '';
        $attraction->image = '';
        return $attraction;
    }

    public function saveAttraction($param) {
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '保存成功';

        $trip  = $param->post('trip');
        $date  = $param->post('date');
        $guide = $param->post('guide');
        $description = $param->post('description');
        $meals = $param->post('meal/a');
        $cars  = $param->post('car/a');
        $materialIds = $param->post('materialId/a');
        $articleId   = $param->param('articleId');
        $hotelId     = $param->post('hotelId');
        $image       = request()->file('image');

        $Attraction = new Attraction();

        // 图片上传
        if (!empty($image)) {
            $imagePath = Common::uploadImage($image);
            $Attraction->image = json_encode($imagePath);
        } else {
            $Attraction->image = '';
        }

        $Attraction->trip = $trip;
        if (empty($date)) {
            $date = "0000-00-0";
        }
        $Attraction->date = $date;
        $Attraction->guide = $guide;
        $Attraction->description = $description;
        if(!is_null($meals)) {
            $Attraction->meal = json_encode($meals);
        }else {
            $Attraction->meal = '';
        }

        if (!is_null($cars)) {
            $Attraction->car = json_encode($cars);
        } else {
            $Attraction->car = '';
        }
        
        $Attraction->hotel_id   = $hotelId;
        $Attraction->article_id = $articleId;
        $Attraction->weight     = Attraction::where('article_id', '=', $articleId)->max("weight")+1;
        if(!$Attraction->validate(true)->save()) {
            $message['status']  = 'error';
            $message['message'] = $Attraction->getError();
            return $message;
        }

        if(!is_null($materialIds)) {
            if(!$Attraction->Materials()->saveAll($materialIds)) {
                $message['status']  = 'error';
                $message['message'] = '保存失败';
            }
        }

        return $message;
    }

    public function updateAttraction($param) {
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '更新成功';

        $attractionId = $param->param('attractionId');
        $trip  = $param->post('trip');
        $date  = $param->post('date');
        $guide = $param->post('guide');
        $description = $param->post('description');
        $meals = $param->post('meal/a');
        $cars  = $param->post('car/a');
        $materialIds = $param->post('materialId/a');
        $articleId   = $param->param('articleId/d');
        $hotelId     = $param->post('hotelId/d');
        $image       = request()->file('image');

        $Attraction = Attraction::get($attractionId);
        $ContrastAttraction = clone $Attraction;

        if (!empty($image)) {
            $imagePath = json_decode($Attraction->image);
            Common::deleteImage('upload/'.$imagePath);
            $imagePath = Common::uploadImage($image);
            $Attraction->image = json_encode($imagePath);
        }

        $Attraction->trip  = $trip;
        $Attraction->date  = $date;
        $Attraction->guide = $guide;
        $Attraction->description = $description;
        $Attraction->meal = json_encode($meals);
        $Attraction->car  = json_encode($cars);
        $Attraction->hotel_id   = $hotelId;
        $Attraction->article_id = $articleId;

        if(json_encode($Attraction) != json_encode($ContrastAttraction)) {
            if(!$Attraction->validate(true)->save()) {
                $message['status']  = 'error';
                $message['message'] = $Attraction->getError();
            }
        }

        $map = ['attraction_id' => $attractionId];
        if(false === $Attraction->AttractionMaterials()->where($map)->delete()) {
            $message['status']  = 'error';
            $message['message'] = '删除原始数据失败';
        }

        if(!is_null($materialIds)) {
            if(!$Attraction->Materials()->saveAll($materialIds)) {
                $message['status']  = 'error';
                $message['message'] = '更新失败';
            }
        }

        return $message;
    }

    public function deleteAttraction($attractionId) {
        $message = [];
        $message['status']  = 'success';
        $message['message'] = '删除成功';
        
        $Attraction = Attraction::get($attractionId);

        $map = ['attraction_id' => $attractionId];
        if(false === $Attraction->AttractionMaterials()->where($map)->delete()) {
            $message['status']  = 'error';
            $message['message'] = '删除失败';
        }

        if(!$Attraction->delete()) {
            $message['status']  = 'error';
            $message['message'] = '删除失败';
        } else {
            $imagePath = $Attraction->image;
            Common::deleteImage('upload/'.$imagePath);
        }

        return $message;
    }
}
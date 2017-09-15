<?php
/**
 * Created by PhpStorm.
 * User: liming
 * Date: 17-9-7
 * Time: 上午8:37
 */

namespace app\index\service;


class Attraction {
    public function saveAttraction($param) {
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '保存成功';

        $trip = $param->post('trip');
        $date = $param->post('date');
    }
}
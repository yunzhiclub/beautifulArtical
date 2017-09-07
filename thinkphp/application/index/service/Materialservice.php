<?php
/**
 * Created by PhpStorm.
 * User: liming
 * Date: 17-9-7
 * Time: 上午8:44
 */

namespace app\index\service;


use app\index\model\Material;

class Materialservice
{
    public function getAll() {
        $material = new Material();
        return $material->select();
    }
}
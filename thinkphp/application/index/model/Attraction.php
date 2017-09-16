<?php

namespace app\index\model;

use think\Model;
use app\index\model\Material;
use app\index\model\Hotel;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 15:37
 */

class Attraction extends Model {

    public function updateAttraction($title, $meal, $car, $guide, $hotelId, $articleId, $id, $materialId) {
        $Attraction = Attraction::get($id);
        $Attraction->saveAttraction($title, $meal, $car, $guide, $hotelId, $articleId, $materialId);
    }

    public function deleteAttraction($id) {
        $Attraction = Attraction::get($id);

        if(!$Attraction->delete()) {
            return false;
        }
        return true;
    }

    public function getMaterial($id) {
        //返回关联的素材
        if(!is_null($id)) {
            return Material::get($id);
        } else {
            $Material = new Material();
            $Material->image = '';
            $Material->designation = '未选择素材';
            $Material->content = '未选择素材';
            return $Material;
        }
    }
    public function getMainMaterial() {
        return Material::get($this->material_id);
    }
    public function getHotel() {
        return Hotel::get($this->hotel_id);
    }

    public function Materials() {
        return $this->belongsToMany('Material', 'attraction_material');
    }

    public function AttractionMaterials() {
        return $this->hasMany('AttractionMaterial');
    }
}
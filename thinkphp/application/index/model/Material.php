<?php
/**
 * Created by PhpStorm.
 * User: liming
 * Date: 17-9-7
 * Time: 上午8:41
 */

namespace app\index\model;


use think\Model;

class Material extends Model
{
    public function getIsChecked($attractionId) {
        $map['material_id'] = $this->id;
        $map['attraction_id'] = $attractionId;
        $attractionMaterial = AttractionMaterial::get($map);
        if(!is_null($attractionMaterial)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMaterialImages() {
        $images = json_decode($this->images);
        return $images;
    }
}
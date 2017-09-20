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

    public function getMealIsChecked($checkMeal) {
        $meals = json_decode($this->meal);
        if(!is_null($meals)) {
            foreach ($meals as $meal) {
                if($meal == $checkMeal) {
                    return true;
                }
            }
        } else {
            if($checkMeal == 'breakfast') {
                return true;
            }
        }
        return false;
    }

    public function getCheckedMaterial() {
        $map = ['attraction_id' => $this->id];
        $AttractionMaterials = AttractionMaterial::where($map)->select();
        $str = '';
        if(!is_null($AttractionMaterials)) {
            foreach ($AttractionMaterials as $AttractionMaterial) {
                $materialId = $AttractionMaterial->material_id;
                $material = Material::get($materialId);
                $str = $str.$material->designation.' ';
            }
        }
        return $str;
    }

    public function getHotelDesignation() {
        if(!is_null($this->hotel_id)) {
            return Hotel::get($this->hotel_id)->designation;
        } else {
            return '';
        }
    }

    public function getCar() {
        $car = $this->car;
        if($car == 'sevenToNineBusinessCar') {
            return '7-9座商务车';
        } else if($car == 'train') {
            return '火车';
        } else if($car == 'car') {
            return '汽车';
        } else if($car == 'plane') {
            return '飞机';
        }
    }

    public function getMeals() {
        $meals = json_decode($this->meal);
        $str = null;
        foreach ($meals as $meal) {
            if ($meal == 'breakfast') {
                $str = $str.'早餐 ';
            } else if ($meal == 'lunch') {
                $str = $str.'午餐 ';
            } else if ($meal == 'supper') {
                $str = $str.'晚餐';
            }
        }
        return $str;
    }

    public function Materials() {
        return $this->belongsToMany('Material', 'attraction_material');
    }

    public function AttractionMaterials() {
        return $this->hasMany('AttractionMaterial');
    }

    public function getMainMaterial() {
        return Material::get($this->material_id);
    }

    public function getMaterials() {
        
    }
}
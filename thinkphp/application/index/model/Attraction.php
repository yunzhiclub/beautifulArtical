<?php

namespace app\index\model;

use think\Model;
use app\index\model\Material;
use app\index\model\Hotel;

/**
 * 日程
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 15:37
 */
class Attraction extends Model
{
    protected $article = null;  // 对应的文章

    public function getMealIsChecked($checkMeal)
    {
        $meals = json_decode($this->meal);
        if (!is_null($meals)) {
            foreach ($meals as $meal) {
                if ($meal == $checkMeal) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getCheckedMaterial()
    {
        $map = ['attraction_id' => $this->id];
        $AttractionMaterials = AttractionMaterial::where($map)->select();
        $materials = [];
        if (!is_null($AttractionMaterials)) {
            foreach ($AttractionMaterials as $AttractionMaterial) {
                $materialId = $AttractionMaterial->material_id;
                $material = Material::get($materialId);
                array_push($materials, $material);
            }
        }
        return $materials;
    }

    public function getHotelDesignation()
    {
        if (!is_null($this->hotel_id)) {
            return Hotel::get($this->hotel_id)->designation;
        } else {
            return '';
        }
    }

    public function getCarIsChecked($checkCar)
    {
        $cars = json_decode($this->car);

        // 有用车字段，选择checked
        if (!is_null($cars)) {
            foreach ($cars as $car) {
                if ($car == $checkCar) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getCars()
    {
        $cars = json_decode($this->car);
        $msg = null;
        if (!is_null($cars)) {
            foreach ($cars as $car) {
                if ($car == 'plane') {
                    $msg = $msg . '飞机 ';
                } else if ($car == 'pickPlane') {
                    $msg = $msg . '接机 ';
                } else if ($car == 'sendPlane') {
                    $msg = $msg . '送机 ';
                } else if ($car == 'train') {
                    $msg = $msg . '火车 ';
                } else if ($car == 'ship') {
                    $msg = $msg . '轮渡 ';
                } else if ($car == 'allDayCar') {
                    $msg = $msg . '全天用车 ';
                } else if ($car == 'halfDayCar') {
                    $msg = $msg . '半天用车';
                }
            }
        }
        return $msg;
    }

    public function getMeals()
    {
        $meals = json_decode($this->meal);
        $str = null;
        if (!is_null($meals)) {
            foreach ($meals as $meal) {
                if ($meal == 'breakfast') {
                    $str = $str . '早餐 ';
                } else if ($meal == 'lunch') {
                    $str = $str . '午餐 ';
                } else if ($meal == 'supper') {
                    $str = $str . '晚餐 ';
                } else if ($meal == 'selfcare') {
                    $str = $str . '自理';
                }
            }
        }
        return $str;
    }

    public function Materials()
    {
        return $this->belongsToMany('Material', 'attraction_material');
    }

    public function AttractionMaterials()
    {
        return $this->hasMany('AttractionMaterial');
    }

    public function getMainMaterial()
    {
        return Material::get($this->material_id);
    }

    public function getMaterials()
    {
        $attractionMaterials = AttractionMaterial::where('attraction_id', '=', $this->id)->select();
        $materials = [];
        foreach ($attractionMaterials as $attractionMaterial) {
            if (!is_null($attractionMaterial->material_id)) {
                $material = Material::get($attractionMaterial->material_id);
                array_push($materials, $material);
            }
        }
        return $materials;
    }

    public function defaultCheck($param)
    {
        if ($param == 'add') {
            return true;
        } else {
            return false;
        }
    }

    public function getOneImage()
    {
        //获取当前的景点儿的素材
        $materials = $this->getMaterials();

        //获取当前第一个素材的第一张图片
        $image = "";
        if (!empty($materials)) {
            $images = $materials[0]->getMaterialImages;
            $image = $images[0];
        }

        //返回图片地址
        return $image;
    }

    /**
     * 获取日程的日期
     */
    public function getDate()
    {
        return $this->data['date'];
    }

    /**
     * 关联的文章 信息
     * @return null|Article
     * @throws \think\Exception\DbException
     * @author panjie
     */
    public function article()
    {
        if (is_null($this->article)) {
            if (isset($this->data['article_id'])) {
                $this->article = Article::get($this->article_id);
            }
        }

        return $this->article;
    }

    /**
     * 日期过滤器
     * @param $beginDate 开始日期
     * @param $order    顺序（比如第1天，则$order = 1)
     * @author panjie
     */
    static function getDateByBeginDateAndOrder($beginDate, $order)
    {
        $order--;
        $date = date('Y-m-d', strtotime($beginDate . ' + ' . $order . ' days'));
        echo $date;
    }
}
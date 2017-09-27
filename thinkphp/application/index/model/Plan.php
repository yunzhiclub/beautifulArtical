<?php
namespace app\index\model;

use think\Model;
use app\index\model\Detail;
use app\index\model\Common;

/**
 * 方案报价
 * @author 陈志高
 */
class Plan extends Model
{
    public function getPlanByArticleId($articleId) {
        return $this->where('article_id','=',$articleId)->select();
    }

    public function getDetail($type, $plan) {
        $Detail = new Detail();

        if (empty($plan->id)) {
            // 不存在id，细节字段置空
            $Detail->adult_unit_price = '';
            $Detail->child_unit_price = '';
            $Detail->total_price = '';
            $Detail->remark = '';

        } else if (empty($Detail->where('plan_id', $plan->id)->select())) {
            // plan存在，detail不存在
            $Detail->adult_unit_price = '';
            $Detail->child_unit_price = '';
            $Detail->total_price = '';
            $Detail->remark = '';
        } else {
            // 根据id和db_type获取细节
            $Detail = $Detail->where('plan_id', $plan->id)->where('db_type', $type)->find();
        }

        return $Detail;
    }
}
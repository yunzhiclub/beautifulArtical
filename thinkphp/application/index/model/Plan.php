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
        return $this->where('article_id','=',$articleId)->find();
    }

    public function getRelevantDetails() {
        $planId = $this->id;
        $details = Detail::where('plan_id', $planId)->select();
        return $details;
    }

//    public function getDetail($type, $plan) {
//        $Detail = new Detail();
//
//        if (empty($plan->id) || empty($Detail->where('plan_id', $plan->id)->select())) {
//            // 不存在id，细节字段置空
//            $Detail->adult_unit_price = '';
//            $Detail->child_unit_price = '';
//            $Detail->total_price = '';
//            $Detail->remark = '';
//
//        }  else {
//            // 根据id和db_type获取细节
//            $Detail = $Detail->where('plan_id', $plan->id)->where('db_type', $type)->find();
//            if (empty($Detail)) {
//                $Detail = new Detail();
//                $Detail->adult_unit_price = '';
//                $Detail->child_unit_price = '';
//                $Detail->total_price = '';
//                $Detail->remark = '';
//            }
//        }
//
//        return $Detail;
//    }

    /**
     * 克隆一个日程实体
     * @param  [type] $planId [description]
     * @return Plan
     * @author 陈志高 <[<1641088568@qq.com>]>
     */
    public function clonePlan($planId)
    {
        $originalPlan = Plan::get($planId);
        $clonedPlan = new Plan;
        $clonedPlan->adult_num = $originalPlan->adult_num;
        $clonedPlan->child_num = $originalPlan->child_num;
        $clonedPlan->currency = $originalPlan->currency;
        $clonedPlan->last_pay_time = $originalPlan->last_pay_time;
        $clonedPlan->total_cost = $originalPlan->total_cost;
        $clonedPlan->article_id = $originalPlan->article_id;
        $clonedPlan->save();
        return $clonedPlan;
    }
    /**
     * 根据id克隆日程
     * @param  [type] $planId [description]
     * @return Plan 
     * @author chenzhigao        
     */
    public function cloneById($planId) {
        $Plan = new Plan();
        return $Plan->clonePlan($planId);
    }
}
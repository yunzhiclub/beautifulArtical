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

    /**
     * 获取相关的报价方案信息
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * zhangxishuo
     */
    public function getRelevantDetails() {
        $planId = $this->id;
        $details = Detail::where('plan_id', $planId)->select();
        return $details;
    }

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
    public static function cloneById($id) {
        $Plan = new Plan();
        return $Plan->clonePlan($id);
    }
}
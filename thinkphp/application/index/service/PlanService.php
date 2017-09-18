<?php
namespace app\index\service;

use app\index\model\Common;
use app\index\model\Plan;
use think\Request;


class PlanService
{

	public function save($param)
	{
        // 初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '文章编辑成功！';
        $message['route'] = 'article/index';

        //获取到参数
        $articleId = $param->param('articleId/d');
        $data = $param->post();

        // $Plans = Plan::where('article_id','=',$articleId)->select();

        // if (!empty($Plans)) {
        //     // 更新
        //     if (PlanService::updateByType('plain',$articleId, $data, $data['plainAdultUnitPrice'], $data['plainChildUnitPrice'], $data['plainTotalPrice'], $data['plainRemark']) && PlanService::updateByType('visa', $articleId, $data, $data['visaAdultUnitPrice'], $data['childUnitPrice'], $data['visaTotalPrice'], $data['visaRemark']) && PlanService::updateByType('travel', $articleId, $data, $data['travelAdultUnitPrice'], $data['travelChildUnitPrice'], $data['travelTotalPrice'], $data['travelRemark']) && PlanService::updateByType('insurance', $articleId, $data, $data['insuranceAdultUnitPrice'], $data['insuranceChildUnitPrice'], $data['insuranceTotalPrice'], $data['insuranceRemark']))
        //         return $message;
        // }

        // 添加数据
        if (PlanService::saveOrUpdateByType('plain',$articleId, $data, $data['plainAdultUnitPrice'], $data['plainChildUnitPrice'], $data['plainTotalPrice'], $data['plainRemark']) && PlanService::saveOrUpdateByType('visa', $articleId, $data, $data['visaAdultUnitPrice'], $data['childUnitPrice'], $data['visaTotalPrice'], $data['visaRemark']) && PlanService::saveOrUpdateByType('travel', $articleId, $data, $data['travelAdultUnitPrice'], $data['travelChildUnitPrice'], $data['travelTotalPrice'], $data['travelRemark']) && PlanService::saveOrUpdateByType('insurance', $articleId, $data, $data['insuranceAdultUnitPrice'], $data['insuranceChildUnitPrice'], $data['insuranceTotalPrice'], $data['insuranceRemark'])) {
            return $message;
        } 

        $message['status'] = 'error';
        $message['message'] = '保存失败！';

        return $message;
	}
    public function edit($param) {
        // 初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '修改成功！';
        // 获取到参数
        $articleId = Request::instance()->param('id');
        $planid = $param->param('planId');
        $travelDate = $param->post('travelDate');
        $peopleNum = $param->post('peopleNum');
        $currency = $currency = $param->post('currency');
        $totalCost = $param->post('totalCost');
        $lastPayTime = $param->post('lastPayTime');
        // 获取已经存在的报价实体
        $Plan = Plan::get($planid);
        // 赋值
        $Plan->article_id = $articleId;
        $Plan->travel_date = $travelDate;
        $Plan->people_num = $peopleNum;
        $Plan->currency = $currency;
        $Plan->total_cost = $totalCost;
        $Plan->last_pay_time = $lastPayTime;

        // 添加数据
        if (!$Plan->save()) {
            $message['message'] = '方案报价未修改！';
        }

        $message['planId'] = $Plan->id;
        $message['id'] = $articleId;

        return $message;
    }
    public function editPlan($param) {
        // 获取方案id
        $planId = $param->param('planId/d');
        $Plan = Plan::get($planId);
        $DetailZhusu = $Plan->getDetailByType('zhusu');
        $DetailDijie = $Plan->getDetailByType('dijie');
        $articleId = $param->param('article_id/d');

        $message = [];
        $message['detailzhusu'] = $DetailZhusu;
        $message['detaildijie'] = $DetailDijie;

        $message['plan'] = $Plan;

        return $message;
    }
    public function deletePlan($param) {
        $planId = $param->param('planId/d');
        $Plan = Plan::get($planId);
        $DetailZhusu = $Plan->getDetailByType('zhusu');
        $DetailDijie = $Plan->getDetailByType('dijie');
        
        $dijieDelete = $DetailDijie->delete();
        $zhusuDelete = $DetailZhusu->delete();
        $planDelete = $Plan->delete();
        
        if($planDelete && $dijieDelete && $zhusuDelete){
            return true;
        }
            return false;
    }

    static public function saveOrUpdateByType($type, $articleId, $data, $adultUnitPrice, $childUnitPrice, $totalPrice, $remark) {
        $Plan = Plan::where('article_id', $articleId)->where('type', $type)->find();
        
        if (is_null($Plan)) {
            $Plan = new Plan();
        }
        $Plan->article_id = $articleId;
        $Plan->adult_num = $data['adultNum'];
        $Plan->child_num = $data['childNum'];
        $Plan->currency = $data['currency'];
        $Plan->total_cost = $data['totalCost'];
        $Plan->last_pay_time = $data['lastPayTime'];
        $Plan->type = $type;
        $Plan->adult_unit_price = $adultUnitPrice;
        $Plan->child_unit_price = $childUnitPrice;
        $Plan->total_price = $totalPrice;
        $Plan->remark = $remark;

        if ($Plan->save()) {
            return true;
        } else {
            return false;
        }
    }

    static public function updateByType($type, $articleId, $data, $adultUnitPrice, $childUnitPrice, $totalPrice, $remark) {
        // 根据article_id和type获取plan对象
        $Plan = Plan::where('article_id', $articleId)->where('type', $type)->find();
        
        $Plan->article_id = $articleId;
        $Plan->adult_num = (int)$data['adultNum'];
        $Plan->child_num = (int)$data['childNum'];
        $Plan->currency = $data['currency'];
        $Plan->total_cost = $data['totalCost'];
        $Plan->last_pay_time = $data['lastPayTime'];
        $Plan->type = $type;
        $Plan->adult_unit_price = $adultUnitPrice;
        $Plan->child_unit_price = $childUnitPrice;
        $Plan->total_price = $totalPrice;
        $Plan->remark = $remark;

        if ($Plan->save()) {
            return true;
        } else {
            return false;
        }
    }
}

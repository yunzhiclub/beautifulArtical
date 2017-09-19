<?php
namespace app\index\service;

use app\index\model\Common;
use app\index\model\Plan;
use think\Request;
use app\index\service\DetailService;

class PlanService
{
    public function addPlan()
    {
        $Plan = new Plan();

        // 为方案报价所有字段置空
        $Plan->adult_num = '';
        $Plan->child_num = '';
        $Plan->currency = '';
        $Plan->last_pay_time = '';
        $Plan->total_cost = '';

        return $Plan;
    }

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

        // 给plan的字段赋值
        $Plan = new Plan();
        $Plan->article_id = $articleId;
        $Plan->adult_num = $data['adultNum'];
        $Plan->child_num = $data['childNum'];
        $Plan->currency = $data['currency'];
        $Plan->last_pay_time = $data['lastPayTime'];
        $Plan->total_cost = $data['totalCost'];

        // 保存
        if (!$Plan->save()) {
            $message['status'] = 'error';
            $message['message'] = '保存失败！';

        } else {
            $plan = $Plan->where('article_id', $articleId)->find();
            $planId = $plan->id;

            $detailService = new DetailService();
            $message = $detailService->saveDetail($planId, $data);
        }

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

}

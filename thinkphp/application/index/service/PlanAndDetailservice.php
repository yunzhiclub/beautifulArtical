<?php
namespace app\index\service;

use app\index\model\Common;
use app\index\model\Detail;
use app\index\model\Plan;
use app\index\model\Article;
use think\Request;


class PlanAndDetailservice
{
	public function addPlanAndDetail($param)
	{
		//初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'Article/secondadd';
        $message['message'] = '添加成功，请继续完善文章详情';
        
        //获取到参数
        $Article = new Article();
		$articleId = Request::instance()->param('id');
		$planId = $param->param('id/d');
		$travelDate = $param->post('travelDate');
        $peopleNum = $param->post('peopleNum');
        $currency = $param->post('currency');
        $totalCost = $param->post('totalCost');
        $lastPayTime = $param->post('lastPayTime');
        $dijie_remark = $param->post('dijie_remark');
        $dijie_number = $param->post('dijie_number');
        $dijie_frequency = $param->post('dijie_frequency');
        $dijie_unitPrice = $param->post('dijie_unitPrice');
        $dijie_totalPrice = $param->post('dijie_totalPrice');
        $zhusu_remark = $param->post('zhusu_remark');
        $zhusu_number = $param->post('zhusu_number');
        $zhusu_frequency = $param->post('zhusu_frequency');
        $zhusu_unitPrice = $param->post('zhusu_unitPrice');
        $zhusu_totalPrice = $param->post('zhusu_totalPrice');

        $message['articleId'] = $articleId;

        // 实例化一个空的方案报价
        $Plan = new Plan();
        $Plan->article_id = $articleId;
		$Plan->travel_date = $travelDate;
        $Plan->people_num = $peopleNum;
        $Plan->currency = $currency;
        $Plan->total_cost = $totalCost;
        $Plan->last_pay_time = $lastPayTime;

        // 添加数据
        if (!$Plan->save()) {
            return $this->error('数据添加错误：' . $Plan->getError());
        }

        $this->saveDetail($dijie_remark, $Plan, 'dijie', $dijie_number, $dijie_frequency, $dijie_unitPrice, $dijie_totalPrice);
        $this->saveDetail($zhusu_remark, $Plan, 'zhusu', $zhusu_number, $zhusu_frequency, $zhusu_unitPrice, $zhusu_totalPrice);

        return $message;

	}

    public function saveDetail($remark, $Plan, $type, $number, $frequency, $unitPrice, $totalPrice) 
    {
		$Detail = new Detail();
		$Detail->remark = $remark;
		$Detail->plan_id = $Plan->id;
		$Detail->type = $type;
		$Detail->number = $number;
		$Detail->frequency = $frequency;
		$Detail->unit_price = $unitPrice;
		$Detail->total_price = $totalPrice;
		if (!$Detail->save()) {
            return $this->error('数据添加错误：' . $Detail->getError());
        }
	}
}

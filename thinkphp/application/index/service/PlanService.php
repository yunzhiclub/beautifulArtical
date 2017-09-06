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
        $message['message'] = '保存成功！';


        //获取到参数
        $articleId = $param->param('articleId/d');
        $travelDate = $param->post('travelDate');
        $peopleNum = $param->post('peopleNum');
        $currency = $param->post('currency');
        $totalCost = $param->post('totalCost');
        $lastPayTime = $param->post('lastPayTime');

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
            $message['message'] = '方案报价未保存成功！';;
        }

        $message['planId'] = $Plan->id;
        $message['articleId'] = $articleId;

        return $message;
	}

}

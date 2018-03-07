<?php
namespace app\index\service;

use app\index\model\Common;
use app\index\model\Plan;
use think\Request;
use app\index\service\DetailService;

class PlanService
{
    // 保存方案报价
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

        // 获取参数及POST数据信息
        $articleId = $param->param('articleId/d');
        $data = $param->post();

        // 更新文章标题及摘要
        $title = $data['title'];
        $summery = $data['summery'];
        ArticleService::updateArticleByIdAndTitleAndSummery($articleId, $title, $summery);

        $Plan = Plan::where('article_id', $articleId)->find();
        if (empty($Plan)) {
            $Plan = new Plan();
        }

        // 给plan的字段赋值
        $Plan->article_id = $articleId;
        $Plan->adult_num = $data['adultNum'];
        $Plan->child_num = $data['childNum'];
        $Plan->currency = $data['currency'];
        $Plan->last_pay_time = $data['lastPayTime'];
        $Plan->total_cost = $data['totalCost'];

        // 保存
        if ($Plan->validate(true)->save() === false ) {
            $message['status'] = 'error';
            $message['message'] = '保存失败:' . $Plan->getError();

        } else {
            $plan = $Plan->where('article_id', $articleId)->find();
            $planId = $plan->id;

            $detailService = new DetailService();
            $message = $detailService->saveDetail($planId, $data);
        }

        return $message;
	}
}

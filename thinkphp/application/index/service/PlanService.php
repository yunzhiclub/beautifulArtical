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
        $Plan->id = null;
        $Plan->adult_num = 0;
        $Plan->child_num = 0;
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
        $subtitle = $data['subtitle']; 
        $summery = $data['summery'];
        $beginDate = $data['begin_date'];
        ArticleService::updateArticleByIdAndSubtitleAndTitleAndSummeryAndBeginDate($articleId,$title,$subtitle,$summery,$beginDate);

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
            $message['message'] = '保存成功';
            $plan = $Plan->where('article_id', $articleId)->find();
            $planId = $plan->id;

            $data['totalPrice'] = $data['totalCost'];

            // 格式化数据
            $details = $this->getDetailServiceByPostData($data);
            $detailService = new DetailService();
            try {
                $detailService->saveDetail($planId, $details);
            } catch (\Exception $e) {
                $message['message'] = '保存出行详情失败, 请确认是否删除了detail表中的db_type字段';
            }
        }

        return $message;
	}

    /**
     * 格式化数据
     * @param $postData
     * @return array
     * @author panjie
     */
	private function getDetailServiceByPostData($postData) {
        
        $result = [];   
        if(array_key_exists('designation', $postData)) {
            foreach ($postData['designation'] as $key => $designation) {
                $detail = [];
                $detail['designation'] = $designation;
                $detail['adultUnitPrice'] = $postData['adultUnitPrice'][$key];
                $detail['childUnitPrice'] = $postData['childUnitPrice'][$key];
                $detail['remark'] = $postData['remark'][$key];
                array_push($result, $detail);
            } 
        }
        return $result;
    }
}

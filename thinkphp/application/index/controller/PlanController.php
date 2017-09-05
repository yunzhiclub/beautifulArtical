<?php
namespace app\index\controller;
use app\index\controller\IndexController;
use think\Request;
use app\index\model\Plan;
use app\index\model\Article;


class PlanController extends IndexController
{

	public function index()
	{
		$plans = Plan::paginate(); 
		$this->assign('plans', $plans); 
		return $this->fetch();
	}


	public function add()
	{
        return $this->fetch();	
	}

	public function save()
	{
        //文章id
        $Request = Request::instance();
        $Plan = new Plan();
        $Plan->travel_date = $Request->post('travelDate');
        $Plan->people_num = $Request->post('peopleNum');
        $Plan->currency = $Request->post('currency');
        $Plan->total_cost = $Request->post('totalCost');
        $Plan->last_pay_time = $Request->post('lastPayTime');
        // 添加数据
        if (!$Plan->save()) {
            return $this->error('数据添加错误：' . $Plan->getError());
        }
        return $this->success('success', url('Detail/index'));
	}


}
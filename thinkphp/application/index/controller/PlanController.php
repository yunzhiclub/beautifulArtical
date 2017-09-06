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
        $request = Request::instance();
        $Plan = new Plan();
        $Plan->travel_date = $request->post('travelDate');
        $Plan->people_num = $request->post('peopleNum');
        $Plan->currency = $request->post('currency');
        $Plan->total_cost = $request->post('totalCost');
        $Plan->last_pay_time = $request->post('lastPayTime');
        // 添加数据
        if (!$Plan->save()) {
            return $this->error('数据添加错误：' . $Plan->getError());
        }
        return $this->success('success', url('Detail/index'));
	}
}
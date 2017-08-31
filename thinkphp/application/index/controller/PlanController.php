<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\Plan;


class PlanController extends Controller
{
	public function index()
	{
		$plans = Plan::paginate(); 
		$this->assign('plans', $plans); 
		return $this->fetch();
	}
	public function add()
	{
		// 获取所有的方案报价信息
		$plans = Plan::all();
		$this->assign('plans',$plans);
		return $this->fetch();

	}
	public function save()
	{

		//文章id
        $Request = Request::instance();
        $Plan = new Plan();
        $Plan->travelDate = $Request->post('travleDate');
        $Plan->travelDate = $Request->post('travleDate');
        $plan->peopleNum = $Request->post('peopleNum');
        $plan->currency = $Request->post('currency');
        $plan->totalCost = $Request->post('totalCost');
        $plan->lastPayTime = $Request->post('lastPayTime');
        // 添加数据
        if (!$Plan->save()) {
            return $this->error('数据添加错误：' . $Plan->getError());
        }

        return $this->success('操作成功', url('../Detail/add'));

	}


}
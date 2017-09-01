<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\model\Detail;
use app\index\model\Plan;


class DetailController extends Controller
{

	public function index()
	{

	}

	public function add()
	{
        return $this->fetch();
	}


	public function save()
	{

		$data = Request::instance()->post();
		$Plan = new Plan();
		$Plan->travel_date = $data['travelDate'];
        $Plan->people_num = $data['peopleNum'];
        $Plan->currency = $data['currency'];
        $Plan->total_cost = $data['totalCost'];
        $Plan->last_pay_time = $data['lastPayTime'];
		// 添加数据
        if (!$Plan->save()) {
            return $this->error('数据添加错误：' . $Plan->getError());
        }

		
		// 实例化明细信息
		$Detail = new Detail();
		$Detail->remark = $data['dijie_remark'];
		$Detail->plan_id = $Plan->id;
		$Detail->type = $data['dijie_type'];
		$Detail->number = $data['dijie_number'];
		$Detail->frequency = $data['dijie_frequency'];
		$Detail->unit_price = $data['dijie_unitPrice'];
		$Detail->total_price = $data['dijie_totalPrice'];
		// 添加数据
        if (!$Detail->save()) {
            return $this->error('数据添加错误：' . $Detail->getError());
        }

		$Detail1 = new Detail();
		$Detail1->remark = $data['zhusu_remark'];
		$Detail1->plan_id = $Plan->id;
		$Detail1->type = $data['zhusu_type'];
		$Detail1->number = $data['zhusu_number'];
		$Detail1->frequency = $data['zhusu_frequency'];
		$Detail1->unit_price = $data['zhusu_unitPrice'];
		$Detail1->total_price = $data['zhusu_totalPrice'];
		// 添加数据
        if (!$Detail1->save()) {
            return $this->error('数据添加错误：' . $Detail->getError());
        }
        return $this->success('success', url('Article/secondadd?planId='.$Plan->id));
	}
}
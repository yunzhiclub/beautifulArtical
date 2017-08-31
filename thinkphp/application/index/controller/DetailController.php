<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\model\Detail;


class DetailController extends Controller
{
	public function index()
	{
		$details = Detail::paginate(); 
		$this->assign('details', $details); 
		return $this->fetch();
	}
	public function add()
	{
		// 获取所有的明细信息
		$details = Detail::all();
		$this->assign('details',$details);
		return $this->fetch();

	}
	public function save()
	{
		// 实例化请求信息
		$Request = Request::instance();

		// 实例化明细信息
		$Detail = new Detail();
		$Detail->type = $Request->post('type');
		$Detail->number = $Request->post('number');
		$Detail->frequency = $Request->post('frequency');
		$Detail->unitPrice = $Request->post('unitPrice');
		$Detail->totalPrice = $Request->post('totalPrice');
		$Detail->remark = $Request->post('remark');
		$Detail->lastPayTime = $Request->post('lastPayTime');
		// 添加数据
        if (!$Detail->save()) {
            return $this->error('数据添加错误：' . $Detail->getError());
        }

        return $this->success('操作成功', url('index'));
	}
}
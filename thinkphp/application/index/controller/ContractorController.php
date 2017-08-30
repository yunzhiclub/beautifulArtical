<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Contractor;
use think\Request;

/**
 * @author 朴世超
 */
class ContractorController extends Controller
{
	public function add()
	{
		return $this->fetch();
	}
	public function save()
	{
		// 接收表单数据
		$postData = Request::instance()->post();
		$Contractor = new Contractor;

		$Contractor->name = $postData['name'];
		$Contractor->phone = $postData['phone'];
		$Contractor->fax = $postData['fax'];
		$Contractor->mobile = $postData['mobile'];
		$Contractor->email = $postData['email'];

		if ($Contractor->save()) {
			return $this->success('添加成功！',url('article/add'));
		}

		return $this->error('添加失败！');
	}
}
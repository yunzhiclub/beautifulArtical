<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Contractor;

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
		$Contractor = new Contractor;

		$Contractor->name = input('post.name');
		$Contractor->phone = input('post.phone');
		$Contractor->fax = input('post.fax');
		$Contractor->mobile = input('post.mobile');
		$Contractor->email = input('post.email');

		if ($Contractor->save()) {
			return $this->success('添加成功！');
		}

		return $this->error('添加失败！');
	}
}
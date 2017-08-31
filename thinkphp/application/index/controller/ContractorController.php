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
		$article_id = Request::instance()->param('id');
		$Contractor = new Contractor();
		if ($Contractor->saveContractor($postData, $article_id)) {
			return $this->success('保存成功！', url('article/secondadd'));
		}

		return $this->error('保存失败！');
	}
}
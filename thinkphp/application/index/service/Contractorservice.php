<?php
namespace app\index\service;

use app\index\Model\Contractor;

class Contractorservice
{
	public function saveOrUpdateContractor($param)
	{
		// 获取接收信息
		$data = $param->post();
		$articleId = $param->param('article_id');

		// 初始化返回信息
		$message = [];
		$message['status'] = 'success';
		$message['message'] = '保存成功！';
		$message['route'] = 'article/secondadd';
		$message['id'] = $articleId;

		// 实例化一个空对象
		$Contractor = new Contractor();

		if (!$Contractor->saveContractor($data,$articleId)) {
			// 保存失败
			$message['status'] = 'error';
			$message['message'] = '保存失败';
		}

		return $message;		
	}
}
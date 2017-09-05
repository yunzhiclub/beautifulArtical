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

	public function deleteContractor($param)
	{
        // 获取参数
		$id = $param->param('id');
		$articleId = $param->param('article_id');

		// 初始化返回信息
		$message = [];
		$message['message'] = '删除成功！';
		$message['status'] = 'success';
		$message['route'] = 'article/secondadd';
		$message['id'] = $articleId;

		// 获取定制师id为空
		if (is_null($id) || $id === 0) {
			$message['status'] = 'error';
			$message['message'] = '未获取到id';

		} else {
			// 获取定制师
			$Contractor = Contractor::get($id);

			// 获取定制师为空
			if (is_null($Contractor)) {
				$message['status'] = 'error';
				$message['message'] = '未获取到对象信息！';

			} else {
				// 删除失败
				if (!$Contractor->delete()) {
					$message['status'] = 'error';
					$message['message'] = '删除失败！';
				}
			}
		}
		
		return $message;
	}
	}
}
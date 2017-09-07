<?php
namespace app\index\service;

use app\index\Model\Contractor;

class Contractorservice
{
	public function saveOrUpdateContractor($param)
	{
		$data = $param->post();

		$message = [];
		$message['status'] = 'success';
		$message['message'] = '保存成功！';
		$message['route'] = 'contractor/index';

		$Contractor = new Contractor();

		if (!$Contractor->saveContractor($data)) {
			$message['status'] = 'error';
			$message['message'] = '保存失败';
		}

		return $message;		
	}

	public function deleteContractor($param)
	{
		// 初始化返回信息
		$message = [];
		$message['status'] = 'success';
		$message['message'] = '删除成功！';
		$message['route'] = 'index';

		// 接收数据
		$contractorId = $param->post('contractorId/d');

		// 订制师id为空
		if (is_null($contractorId) || $contractorId === 0) {
			$message['status'] = 'error';
			$message['message'] = '未获取到订制师';

		} else {
			// 获取所有此订制师用的文章
			$Article = new Article();
			$list = $Article->where('contractor_id', '=', $contractorId)->select();
			
			// 有文章用订制师，不能删除
			if (!is_null($list)) {
				$message['status'] = 'error';
				$message['message'] = '次订制师已被使用，不能删除！';

			} else {
				// 获取订制师对象
				$Contractor = Contractor::get($contractorId);

				// 订制师为空
				if (is_null($Contractor)) {
					$message['status'] = 'error';
					$message['message'] = '未获取到订制师';
				} else {

					if (!$Contractor->delete()) {
						$message['status'] = 'error';
						$message['message'] = '删除失败！';
					}
				}
			}
		}

		return $message;
	}
}
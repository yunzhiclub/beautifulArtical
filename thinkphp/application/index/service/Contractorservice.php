<?php
namespace app\index\service;

use app\index\model\Contractor;

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
}
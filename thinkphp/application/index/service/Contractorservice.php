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
	// 接受订制师id，并返回订制师的信息
	public function editContractor($param) {
		// 获取接受信息
		$contractorId = $param->param('contractorId/d');
		// 获取订制师实体
		$Contractor = Contractor::get($contractorId);
		// 获取订制师实体信息
		$message['contractor'] = $Contractor;
		// 返回信息
		return $message;
	}
	public function updateContractor($param) {
		// 获取接受信息
		$contractorId = $param->param('contractorId/d');

		$message = [];

		$Contractor = Contractor::get($contractorId);

		$Contractor->designation = $param->post('designation');
		$Contractor->fax = $param->post('fax');
		$Contractor->mobile = $param->post('mobile');
		$Contractor->phone = $param->post('phone');
		$Contractor->email = $param->post('email');

		if($Contractor->save()){
			$message['status'] = 'success';
			$message['message'] = '编辑成功！';
			$message['route'] = 'index';
		}else{
			$message['status'] = 'success';
			$message['message'] = '数据未编辑！';
			$message['route'] = 'index';
		}
		return $message;
	} 
}
<?php
namespace app\index\service;

use app\index\model\Detail;

class DetailService
{
	public function saveDetail($planId, $data)
	{
	    // 初始化返回信息
	    $message = [];
	    $message['status'] = 'success';
	    $message['message'] = '保存成功';
	    $message['route'] = 'article/index';

	    // 保存机票
		if (!$this->saveDetailByType($planId, 'plane', $data['planeAdultUnitPrice'], $data['planeChildUnitPrice'], $data['planeTotalPrice'], $data['planeRemark'])) {
		    $message['status'] = 'error';
		    $message['message'] = '机票保存失败';
		    return $message;
        }

        // 保存签证
        if (!$this->saveDetailByType($planId, 'visa', $data['visaAdultUnitPrice'], $data['visaChildUnitPrice'], $data['visaTotalPrice'], $data['visaRemark'])) {
            $message['status'] = 'error';
            $message['message'] = '签证保存失败';
            return $message;
        }

        // 保存旅游
        if (!$this->saveDetailByType($planId, 'tourism', $data['tourismAdultUnitPrice'], $data['tourismChildUnitPrice'], $data['tourismTotalPrice'], $data['tourismRemark'])) {
            $message['status'] = 'error';
            $message['message'] = '旅游保存失败';
            return $message;
        }

        // 保存保险
        if (!$this->saveDetailByType($planId, 'insurance', $data['insuranceAdultUnitPrice'], $data['insuranceChildUnitPrice'], $data['insuranceTotalPrice'], $data['insuranceRemark'])) {
            $message['status'] = 'error';
            $message['message'] = '保险保存失败';
            return $message;
        }

        return $message;
	}

	public function saveDetailByType($planId, $type, $adultUnitPrice, $childUnitPrice, $totalPrice, $remark)
	{
		$Detail = new Detail();
		$Detail->db_type = $type;
		$Detail->plan_id = $planId;
		$Detail->adult_unit_price = $adultUnitPrice;
		$Detail->child_unit_price = $childUnitPrice;
		$Detail->total_price = $totalPrice;
		$Detail->remark = $remark;

        if ($Detail->save()) {
            return true;
        } else {
            return false;
        }
	}
}
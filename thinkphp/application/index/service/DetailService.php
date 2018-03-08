<?php
namespace app\index\service;

use app\index\model\Detail;
use think\exception\DbException;

class DetailService
{
    public function saveDetail($planId, $data) {
        $message = $this->initSuccessMessage();

        try {
            $this->deleteDetail($planId);
            $this->persistDetail($planId, $data);
        } catch (DbException $e) {
            $message = $this->catchErrorMessage($e);
        }

        return $message;
    }

    public function initSuccessMessage() {
        return $this->buildMesssage('success', '保存成功', 'article/index');
    }

    public function catchErrorMessage($exception = null) {
        if (is_null($exception)) {
            $info = $exception->getData();
        } else {
            $info = '保存失败';
        }
        return $this->buildMesssage('error', $info, 'article/index');
    }

    public function buildMesssage($status, $info, $route) {
        $message = [];
        $message['status']  = $status;
        $message['message'] = $info;
        $message['route']   = $route;
        return $message;
    }

    public function persistDetail($planId, $details) {
        $designations = $details['designation'];
        $adultUnitPrices = $details['adultUnitPrice'];
        $childUnitPrices = $details['childUnitPrice'];
        $totalPrices = $details['totalPrice'];
        $remarks = $details['remark'];

        foreach ($designations as $key => $designation) {
            $detail = new Detail();
            $detail->designation = $designations[$key];
            $detail->adult_unit_price = $adultUnitPrices[$key];
            $detail->child_unit_price = $childUnitPrices[$key];
            $detail->total_price = $totalPrices[$key];
            $detail->remark = $remarks[$key];
            $detail->plan_id = $planId;
            if (false === $detail->save()) {
                throw new DbException('数据保存失败');
            }
        }
    }

    public function deleteDetail($planId) {
        $details = Detail::where('plan_id', $planId)->select();
        foreach ($details as $detail) {
            if (!$detail->delete()) {
                throw new DbException('原始数据删除失败');
            }
        }
    }

//	public function saveDetail($planId, $data)
//	{
//	    // 初始化返回信息
//	    $message = [];
//	    $message['status'] = 'success';
//	    $message['message'] = '保存成功';
//	    $message['route'] = 'article/index';
//
//	    $Detail = new Detail();
//	    // 保存机票
//        $result = $this->saveDetailByType($planId, 'plane', $data['planeAdultUnitPrice'], $data['planeChildUnitPrice'], $data['planeTotalPrice'], $data['planeRemark']);
//		if ($result['status'] === 'error') {
//		    $message['status'] = 'error';
//		    $message['message'] = '机票保存失败:' . $result['message'];
//		    return $message;
//        }
//
//        // 保存签证
//        $result = $this->saveDetailByType($planId, 'visa', $data['visaAdultUnitPrice'], $data['visaChildUnitPrice'], $data['visaTotalPrice'], $data['visaRemark']);
//        if ($result['status'] === 'error') {
//            $message['status'] = 'error';
//            $message['message'] = '签证保存失败:' . $result['message'];
//            return $message;
//        }
//
//        // 保存旅游
//        $result = $this->saveDetailByType($planId, 'tourism', $data['tourismAdultUnitPrice'], $data['tourismChildUnitPrice'], $data['tourismTotalPrice'], $data['tourismRemark']);
//        if ($result['status'] === 'error') {
//            $message['status'] = 'error';
//            $message['message'] = '旅游保存失败:' . $result['message'];
//            return $message;
//        }
//
//        // 保存保险
//        $result = $this->saveDetailByType($planId, 'insurance', $data['insuranceAdultUnitPrice'], $data['insuranceChildUnitPrice'], $data['insuranceTotalPrice'], $data['insuranceRemark']);
//        if ($result['status'] === 'error') {
//            $message['status'] = 'error';
//            $message['message'] = '保险保存失败:' . $result['message'];
//            return $message;
//        }
//
//        return $message;
//	}
//
//	public function saveDetailByType($planId, $type, $adultUnitPrice, $childUnitPrice, $totalPrice, $remark)
//	{
//	    $Detail = Detail::where('plan_id', $planId)->where('db_type', $type)->find();
//	    if (empty($Detail)) {
//	        $Detail = new Detail();
//        }
//		$Detail->db_type = $type;
//		$Detail->plan_id = $planId;
//		$Detail->adult_unit_price = $adultUnitPrice;
//		$Detail->child_unit_price = $childUnitPrice;
//		$Detail->total_price = $totalPrice;
//		if (empty($remark)) {
//            $Detail->remark = "无";
//        } else {
//		    $Detail->remark = $remark;
//        }
//        if ($Detail->validate(true)->save() === false) {
//            $message['status'] = 'error';
//            $message['message'] = $Detail->getError();
//        } else {
//            $message['status'] = 'success';
//        }
//
//        return $message;
//	}
}
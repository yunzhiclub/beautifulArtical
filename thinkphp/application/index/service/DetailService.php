<?php
namespace app\index\service;

use app\index\model\Common;
use app\index\model\Detail;
use think\Request;


class DetailService
{
	public function add($param, $planId)
	{
        // 初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '保存成功！';


        //获取到参数
        $articleId = $param->param('articleId/d');
        $dijieRemark = $param->post('dijie_remark');
        $dijieNumber = $param->post('dijie_number');
        $dijieFrequency = $param->post('dijie_frequency');
        $dijieUnitPrice = $param->post('dijie_unitPrice');
        $dijieTotalPrice = $param->post('dijie_totalPrice');
        $zhusuRemark = $param->post('zhusu_remark');
        $zhusuNumber = $param->post('zhusu_number');
        $zhusuFrequency = $param->post('zhusu_frequency');
        $zhusuUnitPrice = $param->post('zhusu_unitPrice');
        $zhusuTotalPrice = $param->post('zhusu_totalPrice');
        
        if($this->save($dijieRemark, $planId, 'dijie', $dijieNumber, $dijieFrequency, $dijieUnitPrice, $dijieTotalPrice) && $this->save($zhusuRemark, $planId, 'zhusu', $zhusuNumber, $zhusuFrequency, $zhusuUnitPrice, $zhusuTotalPrice)) {
            return  $message['message'] = '保存成功！';
        }
        
        $message['message'] = '保存失败';
        return $message;
	}
    
    // 方法的增加实现代码的简化
    public function save($remark, $planId, $type, $number, $frequency, $unit_price, $total_price) 
    {
		$Detail = new Detail();
		$Detail->remark = $remark;
		$Detail->plan_id = $planId;
		$Detail->type = $type;
		$Detail->number = $number;
		$Detail->frequency = $frequency;
		$Detail->unit_price = $unit_price;
		$Detail->total_price = $total_price;
		if (!$Detail->save()) {
            return false;
        }
        return true;
	}
}

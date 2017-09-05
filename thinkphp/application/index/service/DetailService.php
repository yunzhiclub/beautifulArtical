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
        $articleId = $param->param('id');
        $dijie_remark = $param->post('dijie_remark');
        $dijie_number = $param->post('dijie_number');
        $dijie_frequency = $param->post('dijie_frequency');
        $dijie_unitPrice = $param->post('dijie_unitPrice');
        $dijie_totalPrice = $param->post('dijie_totalPrice');
        $zhusu_remark = $param->post('zhusu_remark');
        $zhusu_number = $param->post('zhusu_number');
        $zhusu_frequency = $param->post('zhusu_frequency');
        $zhusu_unitPrice = $param->post('zhusu_unitPrice');
        $zhusu_totalPrice = $param->post('zhusu_totalPrice');
        
        if($this->save($dijie_remark, $planId, 'dijie', $dijie_number, $dijie_frequency, $dijie_unitPrice, $dijie_totalPrice) && $this->save($zhusu_remark, $planId, 'zhusu', $zhusu_number, $zhusu_frequency, $zhusu_unitPrice, $zhusu_totalPrice)) {
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
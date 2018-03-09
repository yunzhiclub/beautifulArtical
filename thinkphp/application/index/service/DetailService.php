<?php
namespace app\index\service;

use app\index\model\Detail;
use think\exception\DbException;

class DetailService
{
    /**
     * 保存报价所有方案
     * @param $planId
     * @param $array
     * @return array
     * zhangxishuo
     */
    public function saveDetail($planId, $array) {
        $message = $this->initSuccessMessage();                 // 初始化返回信息

        try {
            $this->deleteDetail($planId);                       // 删除旧的报价方案信息
            $this->persistDetail($planId, $array);               // 保存新的报价方案信息
        } catch (DbException $e) {
            $message = $this->catchErrorMessage($e);            // 捕获异常，修改提示信息
        }

        return $message;
    }

    /**
     * 初始化成功信息
     * @return array
     * zhangxishuo
     */
    public function initSuccessMessage() {
        return $this->buildMesssage('success', '保存成功', 'article/index');
    }

    /**
     * 构造异常信息
     * @param null $exception
     * @return array
     * zhangxishuo
     */
    public function catchErrorMessage($exception = null) {
        if (is_null($exception)) {
            $info = $exception->getData();                       // 获取异常中信息
        } else {
            $info = '保存失败';                                   // 否则设置失败信息
        }
        return $this->buildMesssage('error', $info, 'article/index');
    }

    /**
     * 构造返回值信息
     * @param $status
     * @param $info
     * @param $route
     * @return array
     * zhangxishuo
     */
    public function buildMesssage($status, $info, $route) {
        $message = [];
        $message['status']  = $status;
        $message['message'] = $info;
        $message['route']   = $route;
        return $message;
    }

    /**
     * 持久化报价方案信息
     * @param $planId
     * @param $details
     * @throws DbException
     * zhangxishuo
     */
    public function persistDetail($planId, $details) {
        /*
         * 循环保存信息
         */
        foreach ($details as $key => $_detail) {
            $detail = new Detail();
            $detail->designation      = $_detail['designation'];
            $detail->adult_unit_price = $_detail['adultUnitPrice'];
            $detail->child_unit_price = $_detail['childUnitPrice'];
            $detail->remark           = $_detail['remark'];
            $detail->plan_id          = $planId;
            if (false === $detail->save()) {
                throw new DbException('数据保存失败');     // 保存失败，抛出异常
            }
        }
        return;
    }

    /**
     * 删除旧的报价方案信息
     * @param $planId
     * @throws DbException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * zhangxishuo
     */
    public function deleteDetail($planId) {
        $details = Detail::where('plan_id', $planId)->select();       // 获取数据表中的报价方案信息
        foreach ($details as $detail) {
            if (!$detail->delete()) {
                throw new DbException('原始数据删除失败');           // 循环删除，错误时抛出异常
            }
        }
    }
}
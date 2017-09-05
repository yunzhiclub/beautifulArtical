<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\service\PlanService;
use app\index\service\DetailService;


class DetailController extends Controller
{
    // 实现方法的实例化
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->planService = new PlanService();
        $this->detailService = new DetailService();
    }

    // 增加界面
	public function add()
	{
		$articleId = Request::instance()->param('id/d');
		$this->assign('id', $articleId);
        return $this->fetch();
	}

    // add页面完成后触发事件
	public function save()
	{
		//接受参数
        $param = Request::instance();
        //调用service中的保存方法
        $message = $this->planService->save($param);
        
        // 保存数据
        if($this->detailService->add($param, $message['planId'])) {
            return $this->success($message['message'], url('Article/secondadd', ['id' =>$message['id']]));
        }
        
        return $this->error($message['message'], url('add', ['id' =>$message['id']]));
        
	}
}
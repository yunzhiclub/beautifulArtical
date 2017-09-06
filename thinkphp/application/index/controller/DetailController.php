<?php
namespace app\index\controller;
use think\Request;
use app\index\service\PlanService;
use app\index\service\DetailService;
use app\index\controller\IndexController;
use app\index\model\Detail;
use app\index\model\Plan;
use app\index\model\Article;
use app\index\service\PlanAndDetailservice;


class DetailController extends IndexController
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
		$articleId = Request::instance()->param('articleId/d');
		$this->assign('articleId', $articleId);
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
            return $this->success($message['message'], url('Article/secondadd', ['articleId' =>$message['articleId']]));
        }
        
        return $this->error($message['message'], url('add', ['articleId' =>$message['articleId']]));
        
	}
}
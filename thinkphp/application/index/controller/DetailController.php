<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\service\PlanService;
use app\index\service\DetailService;


class DetailController extends Controller
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->planService = new PlanService();
        $this->detailService = new DetailService();
    }

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
        $Plan = $this->planService->save($param);
        
        if($this->detailService->add($param,$Plan)) {
            return $this->success('添加成功，请继续完善文章详情', url('Article/secondadd'));
        }
        
        $this->error('数据添加错误：', url('add'));
        
	}
}
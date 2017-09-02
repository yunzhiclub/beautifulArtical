<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\model\Detail;
use app\index\model\Plan;
use app\index\model\Article;
use app\index\service\PlanAndDetailservice;


class DetailController extends Controller
{

	protected $planAndDetailService = null;

    //构造函数实例化ArticleService
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        //实例化服务层
        $this->planAndDetailService = new PlanAndDetailservice();
    }

    public function index()
	{
		$PageSize = config('paginate.var_page');
	    $details = Detail::order('id desc')->paginate($PageSize);
	    $this->assign('details', $details);
		return $this->fetch();
	}

	public function add()
	{
		$articleId = Request::instance()->param('id');
		$this->assign('id', $articleId);
        return $this->fetch();
	}

    // add页面完成后触发事件
	public function save()
	{
        $Article = new Article();
        $articleId = Request::instance()->param('id');
		//接受参数
        $param = Request::instance();
        //调用service中的保存方法
        $message =  $this->planAndDetailService->addPlanAndDetail($param);

        //返回相应的界面
        if ($message['status'] === 'success') {
            //跳转成功的界面
            $this->success($message['message'], url($message['route'], ['id' => $message['param']['id']]));
        } else {
            //跳转失败的界面
            $this->error($message['message'], url($message['route']));
        }
	}
}
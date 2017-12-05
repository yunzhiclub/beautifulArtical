<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\service\Loginservice;
use app\index\service\Articleservice;
use app\index\filter\Filter;

class IndexController extends Controller
{
	//构造函数实例化Loginservice
	function __construct(Request $request = null)
    {
    	 parent::__construct($request);

        //实例化服务层
        $this->loginService = new Loginservice();
        $this->articleService = new Articleservice();
        $this->filter = new Filter();
        // 验证用户是否登陆
        if (!$this->loginService->isLogin(Request::instance())) {
            return $this->error('请先登录！', url('Login/index'));
        }
    }
    // public function index()
    // {
    //     $pageSize = config('paginate.var_page');
    //     $articleTitle = Request::instance()->get('articleTitle');

    //     $articles = $this->articleService->searchArticle($articleTitle, $pageSize);

    //     $this->assign('filter', $this->filter);
    //     $this->assign('articles', $articles);
    //     return $this->fetch('article/index');
    // } 
}

<?php
namespace app\index\controller;

use app\index\model\Material;
use think\Request;
use app\index\controller\IndexController;
use app\index\service\Materialservice;

/**
 * 
 * @authors zhuchenshu
 * @date    2017-09-07 08:52:09
 * @version $Id$
 */

class MaterialController extends IndexController {
	protected $materialService = null;

    //构造函数实例化ArticleService
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        //实例化服务层
        $this->materialService = new Materialservice();
    }
    // 素材管理界面
    public function index() {
    	//取出配置信息
        $pageSize = config('paginate.var_page');
        $materials = Material::order('id desc')->paginate($pageSize);

        //将数据传给V层
        $this->assign('materials', $materials);

        //渲染
    	return $this->fetch();
    }
    // 添加界面
    public function add() {
    	return $this->fetch();
    }
    // 添加操作
    public function addOperate() {
    	//接受参数
        $param = Request::instance();

        //调用service中的保存方法
        $message =  $this->materialService->materialAdd($param);
    	// 返回保存的数据
    	//返回相应的界面
        if ($message['status'] === 'success') {
            //跳转成功的界面
            $this->success($message['message'], url($message['route']));

        } else {
            //跳转失败的界面
            $this->error($message['message'], url($message['route']));
        }
    }
    // 编辑操作
    public function edit() {
        // 接受参数
        $param = Request::instance();
        // 调用service中的编辑方法
        $message =  $this->materialService->materialEdit($param);
        // 传递素材信息到v层
        $this->assign('content', $message['content']);
        $this->assign('designation', $message['designation']);
        $this->assign('image', $message['image']);
        $this->assign('materialId', $message['materialId']);
        return $this->fetch();
    }
    // 更新操作
    public function update() {
        // 接收参数
        $param = Request::instance();
        // 传入s层执行更新
        $message = $this->materialService->materalUpdate($param);
        // 传回执行信息
        if ($message['status'] === 'success') {
            //跳转成功的界面
            $this->success($message['message'], url($message['route']));

        } else {
            //跳转失败的界面
            $this->error($message['message'], url($message['route']));
        }
    }
}
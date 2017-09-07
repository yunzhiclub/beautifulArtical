<?php
namespace app\index\controller;

use app\index\controller\IndexController;
use think\Request;
use app\index\model\Contractor;
use app\index\service\Contractorservice;

/**
 * @author 朴世超
 */
class ContractorController extends IndexController
{
	protected $contractorService = null;

	// 构造函数实例化Contractorservice
	function __construct(Request $requets = null)
	{
		parent::__construct($requets);
		// 实例化服务层
		$this->contractorService = new Contractorservice();
	}

	public function index() {
        $pageSize = config('paginate.var_page');
	    $contractors = Contractor::order('id desc')->paginate($pageSize);
	    $this->assign('contractors', $contractors);
	    return $this->fetch();
    }

	public function add()
	{
		return $this->fetch();
	}

	public function save()
	{
		$param = Request::instance();

		// 调用Service层保存方法
		$message = $this->contractorService->saveOrUpdateContractor($param);

		if ($message['status'] === 'success') {
			return $this->success($message['message'], url($message['route']));
		} else {
			return $this->error($message['message'], url($message['route']));
		}
	}
	// 编辑订制师信息
	public function edit() {
		// 从v层传来数据
		$param = Request::instance();
		// 送到s层处理数据
		$message = $this->contractorService->editContractor($param);
		// 将文章信息返回到v层
		$this->assign('contractor', $message['contractor']);
		// 返回编辑界面
		return $this->fetch();
	}
	// 更新订制师信息
	public function update() {
		// 从v层传来数据
		$param = Request::instance();
		// 送到s层处理数据
		$message = $this->contractorService->updateContractor($param); 
		// 返回相应的界面
		if ($message['status'] === 'success') {
			// 返回保存成功界面
			return $this->success($message['message'], url($message['route']));

		} else {
			// 返回保存失败界面
			return $this->error($message['message'], url($message['route']));
		}
	}
}
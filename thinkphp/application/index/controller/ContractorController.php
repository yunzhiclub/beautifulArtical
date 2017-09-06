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

	public function add()
	{
		// 获取文章id
		$articleId = Request::instance()->param('article_id');

		// 连接v层
		$this->assign('article_id', $articleId);

		// 返回添加界面
		return $this->fetch();
	}

	public function save()
	{
		// 接收数据
		$param = Request::instance();

		// 调用Service层保存方法
		$message = $this->contractorService->saveOrUpdateContractor($param);

		// 返回相应的界面
		if ($message['status'] === 'success') {
			// 返回保存成功界面
			return $this->success($message['message'], url($message['route'], ['id'=>$message['id']]));

		} else {
			// 返回保存失败界面
			return $this->error($message['message'], url($message['route'], ['id'=>$message['id']]));
		}
	}
    // 编辑定制师
	public function edit()
	{
		// 获取id
		$articleId = Request::instance()->param('article_id');
		$contractorId = Request::instance()->param('id');
		
		if (is_null($contractorId)) {
			return $this->error('未获取到ID');
		}

		// 根据id获取对象
		$Contractor = Contractor::get($contractorId);
		// 将对象传给v层
		$this->assign('Contractor', $Contractor);
		$this->assign('article_id', $articleId);
		// 就收返回数据
		return $this->fetch('index');
	}
    // 更新定制师
	public function update()
	{
		// 接收参数
		$param = Request::instance();

		// 调用Service层保存方法
		$message = $this->contractorService->saveOrUpdateContractor($param);

		// 返回保存结果
		if ($message['status'] === 'success') {
			// 返回保存成功界面
			return $this->success($message['message'], url($message['route'], ['id' =>$message['id']]));
		} else {
			// 返回保存失败界面
			return $this->error($message['message'], url($message['route'], ['id' =>$message['id']]));
		}
	}
	// 删除定制师
	public function delete()
	{
		// 接收数据
		$param = Request::instance();

		// 调用service层删除方法
		$message = $this->contractorService->deleteContractor($param);

		// 返回相应界面
		if ($message['status'] === 'success') {
			// 返回删除成功界面
			return $this->success($message['message'], url($message['route'], ['id'=>$message['id']]));

		} else {
			// 返回删除失败界面
			return $this->error($message['message'], url($message['route'], ['id' =>$message['id']]));
		}
	}
}
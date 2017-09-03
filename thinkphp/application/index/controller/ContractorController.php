<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Contractor;
use app\index\service\Contractorservice;

/**
 * @author 朴世超
 */
class ContractorController extends Controller
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
}
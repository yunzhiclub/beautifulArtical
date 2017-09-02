<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Paragraph;
use app\index\model\Article;
use app\index\service\Paragraphservice;


/**
 * 
 * @authors zhuchenshu
 * @date    2017-08-30 15:41:48
 * @version $Id$
 */

class ParagraphController extends Controller {
	protected $paragraphService = null;

    //构造函数实例化ArticleService
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        //实例化服务层
        $this->paragraphService = new Paragraphservice();
    }

	public function index()
	{
		$articleId = Request::instance()->param('article_id');
		$paragraphId = Request::instance()->param('id');
		if (is_null($paragraphId)) {
			$Paragraph = new Paragraph();
			$Paragraph->id = 0;
			$Paragraph->title = '';
			$Paragraph->content = '';
			$Paragraph->image = '';
			$Paragraph->is_before_attraction = '';
			$this->assign('Paragraph', $Paragraph);
		}
        $this->assign('id',$articleId);

        return $this->fetch();
	}

	public function add()
	{
		// 接收数据
		$param = Request::instance();

		// 调用service层保存方法
		$message = $this->paragraphService->addOrEditParagraph($param);

		// 返回相应界面
		if ($message['status'] === 'success') {
			// 跳转保存成功界面
			return $this->success($message['message'], url($message['route']));

		} else {
			// 跳转保存失败界面
			return $this->error($message['message'], url($message['route']));
		}
	}
	
	public function delete()
	{
		$id = Request::instance()->param('id');
		$articleId = Request::instance()->param('article_id');

		if (is_null($id)) {
			return $this->error('未获取到ID');
		}

		$Paragraph = Paragraph::get($id);

		if (is_null($Paragraph)) {
			return $this->error('未获取到对象信息！' ,url('article/secondadd'));
		}

		if ($Paragraph->delete()) {
			return $this->success('删除成功！',url('article/secondadd'));
		}

		return $this->error('删除失败！' ,url('article/secondadd'));
	}

	public function edit()
	{
		// 获取id
		$articleId = Request::instance()->param('article_id');
		$paragraphId = Request::instance()->param('id');
		
		if (is_null($paragraphId)) {
			return $this->error('未获取到ID');
		}

		// 根据id获取对象
		$Paragraph = Paragraph::get($paragraphId);
		// 将对象传给v层
		$this->assign('Paragraph', $Paragraph);
		// 就收返回数据
		return $this->fetch('index');
	}

	public function update()
	{
		// 接收参数
		$param = Request::instance();

		// 调用Service层保存方法
		$message = $this->paragraphService->addOrEditParagraph($param);

		// 返回保存结果
		if ($message['status'] === 'success') {
			// 返回保存成功界面
			return $this->success($message['message'], url($message['route']));
		} else {
			// 返回保存失败界面
			return $this->error($message['message'], url($message['route']));
		}
	}
}
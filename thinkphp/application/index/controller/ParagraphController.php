<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Paragraph;
use app\index\model\Article;

/**
 * 
 * @authors zhuchenshu
 * @date    2017-08-30 15:41:48
 * @version $Id$
 */

class ParagraphController extends Controller {
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
		$data = Request::instance()->post();
		$articleId = Request::instance()->param('article_id');
		$paragraph = new Paragraph();
		if ($paragraph->saveParagraph($data, $articleId)) {
			return $this->success('保存成功！', url('article/secondadd'));
		}
		return $this->error('保存失败！');
	}
	public function delete()
	{
		$id = Request::instance()->param('id');

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
		$id = Request::instance()->param('id/d');
		
		if (is_null($id)) {
			return $this->error('未获取到ID');
		}
		
		// 根据id获取对象
		$Paragraph = Paragraph::get($id);
		// 将对象传给v层
		$this->assign('Paragraph', $Paragraph);
		// 就收返回数据
		return $this->fetch('index');
	}

	public function update()
	{
		$data = Request::instance()->post('id/d');
		$Paragraph = new Paragraph();
		if ($Paragraph->updateParagraph($data)) {
			return $this->success('保存成功！', url('article/secondadd'));
		}

		return $this->error('保存失败！', url('article/secondadd'));
	}
}
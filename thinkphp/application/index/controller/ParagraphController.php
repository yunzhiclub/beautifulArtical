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
		$article_id = Request::instance()->param('id');
        $this->assign('id',$article_id);

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
		$id = Request::instance()->param('11');

		$Paragraph = Paragraph::get($id);

		if ($Paragraph->delete()) {
			return $this->success('删除成功！');
		}

		return $this->error('删除失败！');
	}
}
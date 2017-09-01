<?php
namespace app\index\service;

use app\index\model\Paragraph;

class Paragraphservice
{
	public function addOrEditParagraph($param)
	{
		// 初始化返回信息
		$message = [];
		$message['status'] = 'success';
		$message['message'] = '保存成功！';
		$message['route'] = 'article/secondadd';

		// 获取参数
		$articleId = $param->param('article_id');
		$id = $param->param('id');
		$data = $param->post();
		$file = request()->file('image');

		// 实例化一个空段落
		$Paragraph = new Paragraph();

		if (!is_null($id)) {
			// 编辑段落
			$Paragraph = Paragraph::get($id);
			
			// 调用m层更新方法
			if ($Paragraph->updateParagraph()) {
				// 更新成功
				$message['param']['id'] = $Paragraph->id;

			} else {
				// 更新失败
				$message['status'] = 'error';
				$message['message'] = '保存失败！';
				$message['route'] = 'index';
			}

			return $message;

		} else {
			// 新增段落是没有上传图片
			if (is_null($file)) {
				$message['status'] = 'error';
				$message['message'] = '请上传图片！';
				$message['route'] = 'index';
			}
		}

		if ($Paragraph->saveParagraph($data, $articleId)) {
			// 保存成功
			$message['param']['id'] = $Paragraph->id;
		} else {
			// 保存失败
			$message['status'] = 'error';
			$message['message'] = '保存失败！';
			$message['route'] = 'index';
		}

		return $message;
	}
	
}
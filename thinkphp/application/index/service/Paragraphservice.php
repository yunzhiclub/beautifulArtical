<?php
namespace app\index\service;

use app\index\model\Paragraph;

class Paragraphservice
{
	public function addOrEditParagraph($param)
	{
		// 获取参数
		$articleId = $param->param('articleId');
		$id = $param->param('id');
		$data = $param->post();

		// 初始化返回信息
		$message = [];
		$message['status'] = 'success';
		$message['message'] = '保存成功！';
		$message['route'] = 'article/secondadd';
		$message['id'] = $articleId;
		
		$file = request()->file('image');

		// 实例化一个空段落
		$Paragraph = new Paragraph();

		if (!is_null($id) && $id !== '0') {
			// 编辑段落
			$Paragraph = Paragraph::get($id);
			
			// 调用m层更新方法
			if ($Paragraph->updateParagraph($data, $id)) {
				// 更新成功
				$message['param']['id'] = $Paragraph->id;

			} else {
				// 更新失败
				$message['status'] = 'error';
				$message['message'] = '保存失败！';
				$message['route'] = 'article/secondadd';
			}

		} else {
			// 新增段落是没有上传图片
			if (is_null($file)) {
				$message['status'] = 'error';
				$message['message'] = '请上传图片！';
				$message['route'] = 'article/secondadd';
			}

			if ($Paragraph->saveParagraph($data, $articleId)) {
				// 保存成功
				$message['param']['id'] = $Paragraph->id;
			} else {
				// 保存失败
				$message['status'] = 'error';
				$message['message'] = '保存失败！';
				$message['route'] = 'article/secondadd';
			}
		}

		return $message;
	}

	public function deleteParagraph($param)
	{
		// 获取参数
		$id = $param->param('id');
		$articleId = $param->param('article_id');

		// 初始化返回信息
		$message = [];
		$message['message'] = '删除成功！';
		$message['status'] = 'success';
		$message['route'] = 'article/secondadd';
		$message['id'] = $articleId;

		// 获取段落id为空
		if (is_null($id) || $id === 0) {
			$message['status'] = 'error';
			$message['message'] = '未获取到id';

		} else {
			// 获取段落
			$Paragraph = Paragraph::get($id);

			// 获取段落为空
			if (is_null($Paragraph)) {
				$message['status'] = 'error';
				$message['message'] = '未获取到对象信息！';

			} else {
				// 删除失败
				if (!$Paragraph->delete()) {
					$message['status'] = 'error';
					$message['message'] = '删除失败！';
				}
			}
		}
		
		return $message;
	}
	
}
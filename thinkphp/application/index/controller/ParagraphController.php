<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Paragraph;

/**
 * 
 * @authors zhuchenshu
 * @date    2017-08-30 15:41:48
 * @version $Id$
 */

class ParagraphController extends Controller {
	public function index(){
		return $this->fetch();
	}
	public function add(){
		$paragraph = Request::instance()->post();
		$Paragraph = new Paragraph;
		$Paragraph->title = $paragraph['title'];
		$Paragraph->content = $paragraph['content'];
		// 传入图片
    	$file = request()->file('image');
    	// 返回图片路径
    	$image = Common::uploadImage($file);
    	// 保存图片路径
    	$Paragraph->image = $image;
    	$Paragraph->save();
	}

}
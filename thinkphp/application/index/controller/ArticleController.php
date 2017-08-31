<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article;
use app\index\model\Common;

/**
 * 
 * @authors 朱晨澍、朴世超
 * @date    2017-08-30 09:08:35
 * @version $Id$
 */

class ArticleController extends Controller {

	public function index()
	{
		return $this->fetch();
	}

    public function firstadd(){
    	
    	return $this->fetch();
    }
    public function addfirst(){
    	$title = Request::instance()->post('title');
    	$summary = Request::instance()->post('summary');
    	$Article = new Article;
    	$Article->title = $title;
    	$Article->summery = $summary;
    	$judgment = $Article->save();
    	if($judgment){
    		$this->success('success',url('secondadd',['id'=>$Article->id]));
    	}
    }
    public function secondadd(){
    	$id = Request::instance()->param('id/d');
    	$Article = Article::get($id);
    	$this->assign('title', $Article->title);
    	$this->assign('summery', $Article->summery);
    	$this->assign('id', $id);
    	return $this->fetch();
    }
    public function addsecond(){
    	$judgment = 0;
    	$id = Request::instance()->param('id/d');
    	$Article = Article::get($id);
    	$file = request()->file('image');
    	$image = Common::uploadImage($file);
    	$Article->cover = $image;
    	$judgment = $Article->save();
    	if($judgment){
    		$this->success('success',url('index'));
    	}
    }
}
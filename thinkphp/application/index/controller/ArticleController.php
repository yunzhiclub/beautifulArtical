<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article;
use app\index\model\Common;
use app\index\model\Attraction;


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
    // 返回firstadd界面
    public function firstadd(){
    	
    	return $this->fetch();
    }
    // firstadd界面完成后触发时间
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
    // 返回firstadd界面
    public function secondadd(){
        // 返回firstadd界面添加的信息
    	$id = Request::instance()->param('id/d');
    	$Article = Article::get($id);
    	$this->assign('title', $Article->title);
    	$this->assign('summery', $Article->summery);
    	$this->assign('id', $id);
        // 返回景点添加的信息
        //$attractionid = Request::instance()->param('attractionid/d');
        $Attraction = Attraction::all();
        // $this->assign('attractiontitle', $Attraction->title);
        // $this->assign('attractioncontent', $Attraction->content);
        // $this->assign('attractionimage', $Attraction->image);
        $this->assign('attraction', $Attraction);
        var_dump($Attraction);
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
<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article;
use app\index\model\Common;
use app\index\model\Attraction;
use app\index\model\Plan;
use app\index\service\Articleservice;

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
        $id = Request::instance()->param('id/d');
        // 判断是否为重写界面
        if( is_null($id)){
            $this->assign('title', '');
            $this->assign('summery', '');
            $this->assign('cover', '');
            $this->assign('haveid', '');
            return $this->fetch();
        }else{
            $Article = Article::get($id);
            $this->assign('title', $Article->title);
            $this->assign('summery', $Article->summery);
            $this->assign('cover', $Article->cover);
            $this->assign('haveid', $id);
            return $this->fetch();
        }
    }
    // firstadd界面完成后触发时间
    public function addfirst(){
        
        $id = Request::instance()->param('id/d');
        $title = Request::instance()->post('title');
        $summary = Request::instance()->post('summary');
        $file = request()->file('image');
        // 判断是否是重写 
        $Article = Articleservice::ifedit($id);
        $Article->title = $title;
        $Article->summery = $summary;
        // 获取文件 
        if(is_null($file)){
            $this->error('请插入图片',url('firstadd'));
         }
         // 保存文件，返回路径
        $image = Common::uploadImage($file);
        $Article->cover = $image;
        // 判断是否保存
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
        $this->assign('cover', $Article->cover);
    	$this->assign('id', $id);
        // 根据权重排序
        $Attraction = Attraction::order('weight')->select();
        $this->assign('attraction', $Attraction);
    	return $this->fetch();
    }
    public function addsecond(){
    	$judgment = 0;
    	$id = Request::instance()->param('id/d');
    	$Article = Article::get($id);
        // 添加订制师，报价，景点，段落的信息
    	$judgment = $Article->save();
    	if($judgment){
    		$this->success('success',url('index'));
    	}
        $this->error('失败',url('index'));
    }
}
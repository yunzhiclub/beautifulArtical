<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article;
use app\index\model\Common;
use app\index\model\Attraction;
use app\index\model\Plan;
use app\index\model\Paragraph;
use app\index\service\Articleservice;

/**
 * 
 * @authors 朱晨澍、朴世超
 * @date    2017-08-30 09:08:35
 * @version $Id$
 */

class ArticleController extends Controller {

    protected $articleService = null;

    //构造函数实例化ArticleService
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        //实例化服务层
        $this->articleService = new Articleservice();
    }

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

        //接受参数
        $param = Request::instance();

        //调用service中的保存方法
        $message =  $this->articleService->addOrEditAriticle($param);

        //返回相应的界面
        if ($message['status'] === 'success') {
            //跳转成功的界面
            $this->success($message['message'], url($message['route'], ['id' => $message['param']['id']]));

        } else {
            //跳转失败的界面
            $this->error($message['message'], url($message['route']));
        }
    }
    // 返回secondadd界面
    public function secondadd(){
        // 返回firstadd界面添加的信息
    	$id = Request::instance()->param('id/d');
    	$Article = Article::get($id);
    	$this->assign('title', $Article->title);
    	$this->assign('summery', $Article->summery);
        $this->assign('cover', $Article->cover);
    	$this->assign('id', $id);
        // 根据景点权重排序
        $Attraction = Attraction::order('weight')->where('article_id',$id)->select();
        $this->assign('attraction', $Attraction);
        // 获取传入景点的个数
        $length = sizeof($Attraction);
        $this->assign('length', $length);
        // 将段落按在景点的上下顺序分成两个类，并根据权重排序
        $ParagraphUp = Paragraph::where('is_before_attraction',1)->where('article_id',$id)->order('weight')->select();
        $ParagraphDown = Paragraph::where('is_before_attraction',0)->where('article_id',$id)->order('weight')->select();
        // $Paragraph = Paragraph::order('weight')->select();
        $this->assign('paragraphup', $ParagraphUp);
        $this->assign('paragraphdown', $ParagraphDown);
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
    public function upAttraction() {
        // 接收参数
        $param = Request::instance();
        $id = Request::instance()->param('articleId/d');
        //调用service中的方法
        $message =  $this->articleService->upAttraction($param); 
        $this->success('向上排序成功',url('secondadd',['id'=>$id]));
    }
    public function downAttraction() {
        // 接收参数
        $param = Request::instance();
        $id = Request::instance()->param('articleId/d');
        //调用service中的方法
        $message =  $this->articleService->downAttraction($param); 
        $this->success('向下排序成功',url('secondadd',['id'=>$id]));
    }
}
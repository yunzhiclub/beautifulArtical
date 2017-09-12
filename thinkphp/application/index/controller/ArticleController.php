<?php
namespace app\index\controller;

use app\index\controller\IndexController;
use think\Request;
use app\index\model\Article;
use app\index\model\Contractor;
use app\index\model\Attraction;
use app\index\model\Hotel;
use app\index\model\Plan;
use app\index\model\Paragraph;
use app\index\service\Articleservice;

/**
 * 
 * @authors 朱晨澍、朴世超、张喜硕
 * @date    2017-08-30 09:08:35
 * @version $Id$
 */

class ArticleController extends IndexController {

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
        $pageSize = config('paginate.var_page');
	    $articles = Article::order('id desc')->paginate($pageSize);
	    $this->assign('articles', $articles);
		return $this->fetch();
	}
    // 返回firstadd界面
    public function firstadd(){
        $articleId = Request::instance()->param('articleId/d');
        // 获取所有定制师
        $contractors = Contractor::all();
        $this->assign('contractors',$contractors);
        // 判断是否为重写界面
        if( is_null($articleId)){
            $this->assign('title', '');
            $this->assign('summery', '');
            $this->assign('cover', '');
            $this->assign('articleId', '');
            $this->assign('contractorId', '');
            return $this->fetch();
        }else{
            $Article = Article::get($articleId);
            $this->assign('title', $Article->title);
            $this->assign('summery', $Article->summery);
            $this->assign('cover', $Article->cover);
            $this->assign('articleId', $articleId);
            $this->assign('contractorId', $Article->contractor_id);
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
            $this->success($message['message'], url($message['route'], ['articleId' => $message['param']['articleId']]));

        } else {
            //跳转失败的界面
            $this->error($message['message']);
        }
    }
    // 返回secondadd界面
    public function secondadd(){
        // 接收参数
        $param = Request::instance();

        // 获取并传输plan
        $articleId = Request::instance()->param('articleId');
        $Plan = new Plan();
        $Plans = $Plan->getPlanByArticleId($articleId);
        // 使用number_format 格式化输入金额
        $date = $this->articleService->MoneyFormate($Plans);
        
        $this->assign('detailZhusuUnit',$date['detailZhusuUnit']);
        $this->assign('detailZhusuTotal',$date['detailZhusuTotal']);
        $this->assign('detailDijieUnit',$date['detailDijieUnit']);
        $this->assign('detailDijieTotal',$date['detailDijieTotal']);

        $this->assign('plans', $Plans);
        // 调用service中的保存方法
        $message = $this->articleService->secondAriticle($param);
        // 将serve中处理的数据传给前台
        // 标题
        $this->assign('title', $message['title']);
        // 摘要
        $this->assign('summery', $message['summery']);
        // 封面
        $this->assign('cover', $message['cover']);
        // 文章id
        $this->assign('articleId', $message['articleId']);
        //景点信息
        $this->assign('attraction', $message['attraction']);
        // 景点数量
        $this->assign('length', $message['length']);
        // 段落（景点上）
        $this->assign('paragraphUp', $message['paragraphUp']);
        // 段落（景点下）
        $this->assign('paragraphDown', $message['paragraphDown']);
        // 酒店
        $this->assign('hotel',$message['hotel']);
        // 判断是否有酒店
        if(sizeof($message['hotel'])==0){
            $this->assign('judgeHotel','0');
        }else{
            $this->assign('judgeHotel','1');
        }

        // 抓取定制师数据
        $this->assign("contractor",$message['contractor']);
        // 判断是否有定制师
        if(sizeof($message['contractor'])==0){
            $this->assign('judgeContractor','0');
        }else{
            $this->assign('judgeContractor','1');
        }
        // 返回v层数据
    	return $this->fetch();

    }
    public function addsecond(){
        $this->success('文章编辑成功',url('index'));
    }
    public function delete() {
        // 接收参数
        $param = Request::instance();
        //调用service中的方法
        $message =  $this->articleService->deleteArticle($param);

        if($message['status'] == 'success') {
            $this->success($message['message'],url('article/index'));
        } else {
            $this->error($message['message'], url('article/index'));
        }
    }

    public function preview() {
        $articleId = Request::instance()->param('articleId/d');
        $this->assign('articleId', $articleId);
        $this->main();
        return $this->fetch();
    }

    public function upAttraction() {
        // 接收参数
        $param = Request::instance();
        $articleId = Request::instance()->param('articleId/d');
        //调用service中的方法
        $message =  $this->articleService->upAttraction($param); 
        $this->success('向上排序成功',url('secondadd',['articleId'=>$articleId]));
    }
    public function downAttraction() {
        // 接收参数
        $param = Request::instance();
        $articleId = Request::instance()->param('articleId/d');
        //调用service中的方法
        $message =  $this->articleService->downAttraction($param); 
        $this->success('向下排序成功',url('secondadd',['articleId'=>$articleId]));
    }

    //返回main界面
    public function main() {
        $articleId = Request::instance()->param('articleId');
        // 获取当前景点根据权重的排序
        $Attractions = Attraction::order('weight')->where('article_id',$articleId)->select();

        $Article = Article::get($articleId);
        $this->assign('article',$Article);

        $contractorId = $Article->contractor_id;
        $Contractor = Contractor::get($contractorId);
        $this->assign('contractor',$Contractor);
        $this->assign('attractions',$Attractions);

        $Plans = Plan::where('article_id',$articleId)->select();
        $this->assign('plans',$Plans);

        $paragraphUps = Paragraph::where('is_before_attraction',1)->where('article_id',$articleId)->order('weight')->select();
        $paragraphDowns = Paragraph::where('is_before_attraction',0)->where('article_id',$articleId)->order('weight')->select();
        $this->assign('paragraphUps',$paragraphUps);
        $this->assign('paragraphDowns',$paragraphDowns);

        $Hotels = [];

        foreach ($Attractions as $key => $value) {
            $hotelId = $value->hotel_id;
            if(!is_null($hotelId)) {
                $tempHotel = Hotel::where('id', $hotelId)->find();
                if (!is_null($tempHotel)) {
                    array_push($Hotels, $tempHotel);
                }
            }
            $tempHotel = null;
        }
        $this->assign('hotels',$Hotels);

        return $this->fetch();
    }
}
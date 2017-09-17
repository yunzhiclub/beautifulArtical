<?php

namespace app\index\service;

use app\index\model\Article;
use app\index\model\Common;
use app\index\model\Attraction;
use app\index\model\Paragraph;
use app\index\model\Hotel;
use app\index\model\Plan;
use app\index\model\Contractor;
use app\index\model\Material;
use app\index\model\Detail;
/**
 *
 * @authors zhuchenshu
 * @date    2017-09-01 09:24:18
 * @version $Id$
 */
class Articleservice
{
    /*
     * @param param 用来穿参数
     * @param $controler 用来跳转用的
     */
    public function addAriticle($parma)
    {
        //初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'secondadd';
        $message['message'] = '添加成功，请继续完善文章详情';

        
        $title = $parma->post('title');
        $summery = $parma->post('summery');
        $contractorId = $parma->post('contractorId/d');
        $file = request()->file('image');
        //实例化一个空文章
        $Article = new Article();

        // 新增的时候有没有上传图片
        if(is_null($file)) {
            $message['status'] = 'error';
            $message['message'] = '请上传图片';
            $message['route'] = 'firstadd';
            return $message;
        }
        
        $Article->title = $title;
        $Article->summery = $summery;
        $Article->contractor_id = $contractorId;

        $imagePath = Common::uploadImage($file);
        $Article->cover = $imagePath;
        
        if($Article->save()) {
            //保存成功
            $message['param']['articleId'] = $Article->id;
        } else {
            //保存失败
            $message['status'] = 'error';
            $message['message'] = '没有添加成功，请重新添加';
            $message['route'] = 'firstadd';
        }
        // firstadd界面传入行程路线图片
        $routes = request()->file('routes');
        $judge = request()->post('optionsRadios');
        $Paragraph = new Paragraph();
        
        // 判断是否添加图片
        if($judge==1){
            // 按段落保存
            $Paragraph->content = '';
            $Paragraph->title = "行程路线";
            $Paragraph->article_id = $Article->id;
            $Paragraph->is_before_attraction = 1;
            // 保存文件，返回路径
            if(!is_null($routes)){
                $imagePath = Common::uploadImage($routes);
                $Paragraph->image = $imagePath;
            }
            $Paragraph->save();
            }
        

        $especialMassageService = $parma->post('especialMassageService');
        $especialMassageQuality = $parma->post('especialMassageQuality');
        $especialMassageQuotes = $parma->post('especialMassageQuotes');
        $especialMassageCost = $parma->post('especialMassageCost');
        $especialMassageNoCost = $parma->post('especialMassageNoCost');
        // 将默认的段落添加到景点中
        if(!empty($especialMassageService)){
            $this->especialName($especialMassageService,$Article->id);
        }
        if(!empty($especialMassageQuality)){
            $this->especialName($especialMassageQuality,$Article->id);
        }
        if(!empty($especialMassageQuotes)){
            $this->especialName($especialMassageQuotes,$Article->id);
        }
        if(!empty($especialMassageCost)){
            $this->especialName($especialMassageCost,$Article->id);
        }
        if(!empty($especialMassageNoCost)){
            $this->especialName($especialMassageNoCost,$Article->id);
        }
        
        return $message;
    }
    public function EditAriticle($parma)
    {
        //初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'secondadd';
        $message['message'] = '添加成功，请继续完善文章详情';
        //获取到参数
        $articleId = $parma->param('articleId/d');
        $title = $parma->post('title');
        $summery = $parma->post('summery');
        $contractorId = $parma->post('contractorId/d');
        $file = request()->file('image');
        //实例化一个空文章

        //编辑文章
        $Article = Article::get($articleId);
        // 判断图片是否更改
        if(!is_null($file)) {
            // 删除之前保存的图片,这样写是有问题的有待改进(增加附件列表上传后进行sha1加密，比较两个文件时候相同后再进行删除)
            $imagePath = PUBLIC_PATH . '/' . $Article->cover;
            Common::deleteImage($imagePath);
        }
            if( $Article->title == $title && $Article->summery == $summery && is_null($file) && $Article->contractor_id == $contractorId){
                $message['status'] = 'success';
                $message['message'] = '修改成功';
                $message['route'] = 'secondadd';
                $message['param']['articleId'] = $Article->id;
                return $message;
            }
        
        
        $Article->title = $title;
        $Article->summery = $summery;
        $Article->contractor_id = $contractorId;

        if(!is_null($file)) {
            // 保存文件，返回路径
            $imagePath = Common::uploadImage($file);
            $Article->cover = $imagePath;
        }
        
        if($Article->save()) {
            //保存成功
            $message['param']['articleId'] = $Article->id;
        }
        // firstadd界面传入行程路线图片
        $routes = request()->file('routes');
        $judge = request()->post('optionsRadios');
        $Paragraph = Paragraph::where('title',"行程路线")->where('article_id',$articleId)->find();
        if(empty($Paragraph)){
            $Paragraph = new Paragraph;
        }
        if(!empty( $Paragraph->image)){
            $imagePath = PUBLIC_PATH . '/' . $Paragraph->image;
            Common::deleteImage($imagePath);
        }
        // 判断是否添加图片
        if($judge==1){
            // 按段落保存
            $Paragraph->content = '';
            $Paragraph->title = "行程路线";
            $Paragraph->article_id = $Article->id;
            $Paragraph->is_before_attraction = 1;
            // 保存文件，返回路径
            if(!is_null($routes)){
                $imagePath = Common::uploadImage($routes);
                $Paragraph->image = $imagePath;
            }
            $Paragraph->save();
            }else{
                $Paragraph = Paragraph::where('title',"行程路线")->where('article_id',$articleId)->find();
                if(!empty($Paragraph)){
                    $Paragraph->delete();
                }
        }
        return $message;
    }
    public function especialName($especialmassage,$articleId) {
        $Paragraph = Paragraph::where('title',$especialmassage)->where('article_id',null)->find();

        $newParagraph = new Paragraph;
        $newParagraph->title = $Paragraph->title;
        $newParagraph->content = $Paragraph->content;
        var_dump($Paragraph->is_before_attraction);
        if($Paragraph->is_before_attraction == 0){
            $newParagraph->is_before_attraction = false;
        }else{
            $newParagraph->is_before_attraction = true;
        }      
        $newParagraph->article_id = $articleId;

        $newParagraph->save();
    }
    public function upAttraction($param) {
        // 获取参数
        $articleId = $param->param('articleId/d');
        // 获取要改变位置的序列号
        $number = $param->param('number/d');
        // 获取当前景点根据权重的排序
        $Attractions = Attraction::order('weight')->where('article_id',$articleId)->select();
        $number=$number-1;
        // 当前景点与上一个景点的权重交换
        $median = $Attractions[$number]->weight;
        $Attractions[$number]->weight = $Attractions[$number-1]->weight;
        $Attractions[$number-1]->weight = $median;
        // 保存交换后的景点
        $Attractions[$number]->save();
        $Attractions[$number-1]->save();
    }
    public function downAttraction($param){
        // 获取参数
        $articleId = $param->param('articleId/d');
        // 获取要改变位置的序列号
        $number = $param->param('number/d');
        // 获取当前景点根据权重的排序
        $Attractions = Attraction::order('weight')->where('article_id',$articleId)->select();
        $number=$number-1;
        // 当前景点与下一个景点的权重交换
        $median = $Attractions[$number]->weight;
        $Attractions[$number]->weight = $Attractions[$number+1]->weight;
        $Attractions[$number+1]->weight = $median;
        // 保存交换后的景点
        $Attractions[$number]->save();
        $Attractions[$number+1]->save();
    }
    public function secondAriticle($param) {
        // 传入文章id
        $articleId = $param->param('articleId/d');
        $Article = Article::get($articleId);

        $message = [];
        $message['title'] = $Article->title;
        $message['summery'] = $Article->summery;
        $message['cover'] = $Article->cover;
        $message['articleId'] = $articleId;

        // 根据景点权重排序
        $Attraction = Attraction::order('weight')->where('article_id',$articleId)->select();
        $message['attraction'] = $Attraction;

        // 获取传入景点的个数
        $length = sizeof($Attraction);
        $message['length'] = $length;
        // 将文章中的各个景点的酒店合并到一个对象组中
        $Hotels = [];

        foreach ($Attraction as $key => $value) {
            $hotelId = $value->hotel_id;
            if(!is_null($hotelId)) {
                $tempHotel = Hotel::where('id', $hotelId)->find();
                if (!is_null($tempHotel)) {
                    array_push($Hotels, $tempHotel);
                }
            }
            $tempHotel = null;
        }
        $Hotels = array_unique($Hotels);
        // 将段落按在景点的上下顺序分成两个类，并根据权重排序
        $paragraphUp = Paragraph::where('is_before_attraction',1)->where('article_id',$articleId)->order('weight')->select();
        $paragraphDown = Paragraph::where('is_before_attraction',0)->where('article_id',$articleId)->order('weight')->select();
        // $Paragraph = Paragraph::order('weight')->select();
        $message['paragraphUp'] = $paragraphUp;
        $message['paragraphDown'] = $paragraphDown;
        $Contractor = Contractor::get($Article->contractor_id);
        $message['contractor'] = $Contractor;
        $message['hotel'] = $Hotels;

        return $message;
    }
    /**
     * 张喜硕
     * 删除文章
     * @return $message
     * $message['message'] 提示信息
     * $message['status'] 状态，成功为success，失败为error
     */
    public function deleteArticle($param) {

        $message = [];
        $message['message'] = '删除成功';
        $message['status'] = 'success';
        $articleId = $param->param('articleId/d');
        $Article = Article::get($articleId);

        // 验证文章是否为空
        if(is_null($Article)) {
            $message['message'] = '文章为空';
            $message['status'] = 'error';
            return $message;
        }

        // 删除段落
        $Paragraphs = Paragraph::where('article_id',$articleId)->select();
        if(!is_null($Paragraphs)) {
            foreach ($Paragraphs as $Paragraph) {
                $image = $Paragraph->image;
                if(!$Paragraph->delete()) {
                    $message['message'] = '删除段落失败';
                    $message['status'] = 'error';
                    return $message;
                }
                Common::deleteImage('upload/'.$image);
            }
        }

        // 删除景点
        $Attractions = Attraction::where('article_id',$articleId)->select();
        $TempAttraction = new Attraction();
        if(!is_null($Attractions)) {
            foreach ($Attractions as $Attraction) {
                if(!$TempAttraction->deleteAttraction($Attraction->id)) {
                    $message['message'] = '删除景点失败';
                    $message['status'] = 'error';
                }
            }
        }

        // 删除方案报价
        $Plans = Plan::where('article_id',$articleId)->select();
        if(!is_null($Plans)) {
            foreach ($Plans as $Plan) {
                $Details = Detail::where('plan_id',$Plan->id)->select();
                foreach ($Details as $Detail) {
                    if(!$Detail->delete()) {
                        $message['message'] = '删除明细失败';
                        $message['status'] = 'error';
                    }
                }
                if(!$Plan->delete()) {
                    $message['message'] = '删除方案报价失败';
                    $message['status'] = 'error';
                }
            }
        }

        // 删除文章
        $cover = $Article->cover;
        if(!$Article->delete()) {
            $message['message'] = '删除文章失败';
            $message['status'] = 'error';
            return $message;
        }
        Common::deleteImage('upload/'.$cover);

        return $message;
    }
    /**
     * 保存订制师ID 
     * @param  id       $contractorId 订制师ID
     * @param  id       $articleId    文章ID
     * @return boolen                 保存成功返回true，否则返回false
     */
    public function saveContractorId($contractorId, $articleId)
    {
        $Article = Article::get($articleId);
        $Article->contractor_id = $contractorId;

        if ($Article->save()) {
            return true;
        }
        return false;
    }

    public function MoneyFormate($Plans) {
                
        // 遍历传入的报价方案    
        foreach ($Plans as $key => $value) {
            // 格式化总金额
            $TotalCost = $this->fromate($value->total_cost);
            $value->total_cost = $TotalCost;

            // 格式化成人单价
            $adultUnitPrice = $this->fromate($value->adult_unit_price);
            $value->adult_unit_price = $adultUnitPrice;

            // 格式化儿童单价
            $childUnitPrice = $this->fromate($value->child_unit_price);
            $value->child_unit_price = $childUnitPrice;

            // 格式化总价
            $totalPrice = $this->fromate($value->total_price);
            $value->total_price = $totalPrice;    
        }
    }
    // 格式化金额函数
    public function fromate($money){
        // 强制转化成Int类型，非数字转化成0
        $money = (float)$money;
        if(!$money){
                $money = 0;
            }
        // 格式化的结果为安千位分隔，保存小数点后两位
        $cost= number_format($money,2);
        return $cost;
    }
}
 



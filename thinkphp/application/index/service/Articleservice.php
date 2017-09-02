<?php

namespace app\index\service;

use app\index\model\Article;
use app\index\model\Common;
use app\index\model\Attraction;
use app\index\model\Paragraph;
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
    public function addOrEditAriticle($parma)
    {
        //初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'secondadd';
        $message['message'] = '添加成功，请继续完善文章详情';

        //获取到参数
        $id = $parma->param('id/d');
        $title = $parma->post('title');
        $summery = $parma->post('summery');
        $file = request()->file('image');

        //实例化一个空文章
        $Article = new Article();

        if(!is_null($id)) {
            //编辑文章
            $Article = Article::get($id);
            // 判断图片是否更改
            if(!is_null($file)) {
                // 删除之前保存的图片,这样写是有问题的有待改进(增加附件列表上传后进行sha1加密，比较两个文件时候相同后再进行删除)
                $imagePath = PUBLIC_PATH . '/' . $Article->cover;
                Common::deleteImage($imagePath);
            }
            if( $Article->title == $title && $Article->summery == $summery && is_null($file)){
                $message['status'] = 'success';
                $message['message'] = '修改成功';
                $message['route'] = 'secondadd';
                $message['param']['id'] = $Article->id;
                return $message;
            }
        } else {
            // 新增的时候有没有上传图片
            if(is_null($file)) {
                $message['status'] = 'error';
                $message['message'] = '请上传图片';
                $message['route'] = 'firstadd';
            }
        }
        
        $Article->title = $title;
        $Article->summery = $summery;

        if(!is_null($file)) {
            // 保存文件，返回路径
            $imagePath = Common::uploadImage($file);
            $Article->cover = $imagePath;
        }
        
        if($Article->save()) {
            //保存成功
            $message['param']['id'] = $Article->id;
        } else {
            //保存失败
            $message['status'] = 'error';
            $message['message'] = '没有添加成功，请重新添加';
            $message['route'] = 'firstadd';
        }

        return $message;
    }
    public function upAttraction($param) {
        // 获取参数
        $articleid = $param->param('articleId/d');
        // 获取要改变位置的序列号
        $number = $param->param('number/d');
        // 获取当前景点根据权重的排序
        $Attractions = Attraction::order('weight')->where('article_id',$articleid)->select();
        $number=$number-1;
        // 当前景点与上一个景点的权重交换
        $Median = $Attractions[$number]->weight;
        $Attractions[$number]->weight = $Attractions[$number-1]->weight;
        $Attractions[$number-1]->weight = $Median;
        // 保存交换后的景点
        $Attractions[$number]->save();
        $Attractions[$number-1]->save();
    }
    public function downAttraction($param){
        // 获取参数
        $articleid = $param->param('articleId/d');
        // 获取要改变位置的序列号
        $number = $param->param('number/d');
        // 获取当前景点根据权重的排序
        $Attractions = Attraction::order('weight')->where('article_id',$articleid)->select();
        $number=$number-1;
        // 当前景点与下一个景点的权重交换
        $Median = $Attractions[$number]->weight;
        $Attractions[$number]->weight = $Attractions[$number+1]->weight;
        $Attractions[$number+1]->weight = $Median;
        // 保存交换后的景点
        $Attractions[$number]->save();
        $Attractions[$number+1]->save();
    }
    public function secondAriticle($param) {
        // 传入文章id
        $articleid = $param->param('id/d');
        $Article = Article::get($articleid);

        $message = [];
        $message['title'] = $Article->title;
        $message['summery'] = $Article->summery;
        $message['cover'] = $Article->cover;
        $message['id'] = $articleid;

        // 根据景点权重排序
        $Attraction = Attraction::order('weight')->where('article_id',$articleid)->select();
        $message['attraction'] = $Attraction;

        // 获取传入景点的个数
        $length = sizeof($Attraction);
        $message['length'] = $length;

        // 将段落按在景点的上下顺序分成两个类，并根据权重排序
        $ParagraphUp = Paragraph::where('is_before_attraction',1)->where('article_id',$articleid)->order('weight')->select();
        $ParagraphDown = Paragraph::where('is_before_attraction',0)->where('article_id',$articleid)->order('weight')->select();
        // $Paragraph = Paragraph::order('weight')->select();
        $message['paragraphup'] = $ParagraphUp;
        $message['paragraphdown'] = $ParagraphDown;

        return $message;
    }
    public function deleteAriticle($param) {
        // 获取文章id
        $articleid = $param->param('id/d');
        // 根据文章id获取文章实体，并删除
        $Article = Article::get($articleid);
        Common::deleteImage('upload/'.$Article->cover);
        $Attraction->delete();
        // 根据文章id获取段落组，并删除
        $Paragraph = Paragraph::where('article_id',$articleid);
        $length = sizeof($Paragraph);
        for($i = 0;$i < $length;$i++){
            Common::deleteImage('upload/'.$Paragraph[$i]->image);
            $Paragraph[$i]->delete();
        }
        // 根据文章id获取景点组，并删除
        $Attraction = Attraction::where('article_id',$articleid);
        $length = sizeof($Attraction);
        for($i = 0;$i < $length;$i++){
            Common::deleteImage('upload/'.$Attraction[$i]->image);
            $Attraction[$i]->delete();
        }
        // 根据文章id获取方案报价，并删除
        $Plan = Plan::where('article_id',$articleid);
        $Plan->delete();
        // 根据文章id获取订制师，并删除
        $Contractor = Contractor::where('article_id',$articleid);
        $Contractor->delete();
    }
}
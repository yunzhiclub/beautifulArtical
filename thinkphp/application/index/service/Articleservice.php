<?php

namespace app\index\service;

use app\index\model\Article;
use app\index\model\Common;
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
        $summary = $parma->post('summary');
        $file = request()->file('image');

        //实例化一个空文章
        $Article = new Article();

        if (!is_null($id)) {
            //编辑文章
            $Article = Article::get($id);
            // 判断图片是否更改
            if (!is_null($file)) {
                // 删除之前保存的图片,这样写是有问题的有待改进(增加附件列表上传后进行sha1加密，比较两个文件时候相同后再进行删除)
                $imagePath = PUBLIC_PATH . '/' . $Article->cover;
                Common::deleteImage($imagePath);
            }
        } else {
            // 新增的时候有没有上传图片
            if(is_null($file)){
                $message['status'] = 'error';
                $message['message'] = '请上传图片';
                $message['route'] = 'firstadd';
            }
            //删除之前保存的图片
            //Common::deleteImage('D:/xampp/htdocs/'.__ROOT__.'/upload/ '.$Article->cover);
            return $Article;
        }

        $Article->title = $title;
        $Article->summery = $summary;

        // 保存文件，返回路径
        $imagePath = Common::uploadImage($file);
        $Article->cover = $imagePath;


        if($Article->save()){
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
}
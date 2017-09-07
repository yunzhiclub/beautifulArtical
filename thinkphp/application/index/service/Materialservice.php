<?php
namespace app\index\service;

use app\index\model\Material;
use app\index\model\Common;

/**
 * 
 * @authors liming zhuchenshu
 * @date    2017-09-07 09:09:54
 * @version $Id$
 */

class Materialservice  {
    public function getAll() {
        $material = new Material();
        return $material->select();
    }
    public function materialAdd($parma) {
    	//初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'index';
        $message['message'] = '景点素材添加成功';

        //获取到参数
        $content = $parma->post('content');
        $designation = $parma->post('designation');
        $file = request()->file('image');

        // 新建素材实体
        $Material = new Material;

        if(!is_null($file)) {
            // 保存文件，返回路径
            $imagePath = Common::uploadImage($file);
            $Material->image = $imagePath;
        }

        $Material->content = $content;
        $Material->designation = $designation;

        if($Material->save()){
        	$message['status'] = 'success';
        	$message['route'] = 'index';
        	$message['message'] = '景点素材添加成功';
        }else{
        	$message['status'] = 'error';
        	$message['route'] = 'index';
        	$message['message'] = '景点素材添加失败';
        }
        return $message;
    }
    public function materialUpdate($parma)  {
        // 初始化信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'index';
        $message['message'] = '景点素材编辑成功';

        // 接受传来的素材id
        $materialId = $parma->param('materialId/d');

        $Material = Material::get($materialId);

        $Material->content = $parma->post('content');
        $Material->designation = $parma->post('designation');
        $file = request()->file('image');

        if(!is_null($file)){
            // 删除原有图片

            $imagePath = Common::uploadImage($file);
            // 保存新加图片
            $Material->image = $imagePath;
        }
        if(!$Material->save() ) {
            $message['status'] = 'error';
            $message['route'] = 'index';
            $message['message'] = '景点素材没有改变';
        } 
    }
    public function materialEdit($parma) {
        // 初始化信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'index';
        $message['message'] = '景点素材添加成功';

        // 接受传来的素材id
        $materialId = $parma->param('materialId/d');
        $Material = Material::get($materialId);
        var_dump($Material);

        $message['content'] = $Material->content;
        $message['designation'] = $Material->designation;
        $message['image'] = $Material->image;
        $message['materialId'] = $materialId;

        return $message;
    } 
}
<?php
namespace app\index\service;

use app\index\model\Material;
use app\index\model\Common;

/**
 * 
 * @authors zhuchenshu
 * @date    2017-09-07 09:09:54
 * @version $Id$
 */

class Materialservice  {
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
}
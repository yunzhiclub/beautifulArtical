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

    public function deleteMaterial($param)
    {
        // 初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['message'] = '删除成功！';
        $message['route'] = 'index';

        // 接收数据
        $materialId = $param->param('id/d');

        // 素材id为空
        if (is_null($materialId) || $materialId === 0) {
            $message['status'] = 'error';
            $message['message'] = '未获取到素材';

        } else {
            // 获取素材对象
            $Material = Material::get($materialId);

            // 素材对象为空
            if (is_null($Material)) {
                $message['status'] = 'error';
                $message['message'] = '未获取到素材';

            } else {
                $image = $Material->image;
                // 删除素材失败
                if (!$Material->delete()) {
                    $message['status'] = 'error';
                    $message['message'] = '删除失败';

                } else {
                    // 删除照片
                    Common::deleteImage('upload/'.$image);
                }
            }
        }
        return $message;
    }
}
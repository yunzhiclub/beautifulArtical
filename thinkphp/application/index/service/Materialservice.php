<?php
namespace app\index\service;

use app\index\model\Material;
use app\index\model\Attraction;
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

        // 未获取到素材id
        if (is_null($materialId) || $materialId === 0) {
            $message['status'] = 'error';
            $message['message'] = '未获取到素材';

        } else {
            // 获取素材对象
            $Material = Material::get($materialId);

            // 获取对象为空
            if (is_null($Material)) {
                $message['status'] = 'error';
                $message['message'] = '未获取到素材';

            } else {
                // 更新数据
                $Material->content = $parma->post('content');
                $Material->designation = $parma->post('designation');
                $file = request()->file('image');

                if(!is_null($file)){
                    // 删除原有图片
                        Common::deleteImage('upload/'.$Material->image);
                    $imagePath = Common::uploadImage($file);
                    // 保存新加图片
                    $Material->image = $imagePath;
                }

                if(!$Material->save() ) {
                    $message['status'] = 'error';
                    $message['message'] = '景点素材没有改变';
                } 
            }
        }       
        return $message;
    }
    public function materialEdit($parma) {
        // 初始化信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'index';
        $message['message'] = '景点素材添加成功';

        // 接受传来的素材id
        $materialId = $parma->param('materialId/d');

        // 未获取到素材id
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
                // 编辑素材
                $message['material'] = $Material;
            }
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
        $materialId = $param->param('materialId/d');

        // 素材id为空
        if (is_null($materialId) || $materialId === 0) {
            $message['status'] = 'error';
            $message['message'] = '未获取到素材';

        } else {
            $Attraction = new Attraction();
            $list = $Attraction->where('material_id', '=', $materialId)->select();
            if (!empty($list)) {
                $message['status'] = 'error';
                $message['message'] = '该素材已被使用，不能删除！';
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
            
        }
        return $message;
    }

    public function searchMaterial($materialName, $pageSize) {
        $material = new Material();
        if(!empty($materialName)) {
            $material->where('designation', 'like', '%'. $materialName. '%');
        }
        $materials = $material->order('id desc')->paginate($pageSize);
        return $materials;
    }
}
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

class Articleservice {
    public static function ifedit($id,$file){
    	 if(is_null($id)){
        	$Article = new Article;
        	return $Article;
        }else{
            $Article = Article::get($id);
            // 判断图片是否更改
            if(is_null($file)){
                $this->success('你没有更改图片',url('secondadd',['id'=>$Article->id]));
            }
            //删除之前保存的图片
            //Common::deleteImage('D:/xampp/htdocs/'.__ROOT__.'/upload/ '.$Article->cover);
            return $Article;
        }
    }
}
<?php

namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: zhangxishuo
 * Date: 2017/8/30
 * Time: 16:54
 * @uploadImage 上传文件
 * @param 需要上传的文件
 * @return 文件存储后的路径
 */
class Common {

    public static function uploadImage($file) {
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            return $info->getSaveName();
        }else{
            return $file->getError();
        }
    }
}
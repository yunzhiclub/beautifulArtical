<?php
namespace app\index\model;

use think\Model;
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-08-30 20:52:49
 * @version $Id$
 */

class Common extends Model {
    
    public static function uploadImage($file) {
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            return $info->getSaveName();
        }else{
            return $file->getError();
        }
    }
}
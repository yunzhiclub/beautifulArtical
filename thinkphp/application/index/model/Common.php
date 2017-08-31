<?php

namespace app\index\model;

use app\index\model\Paragraph;

class Common
{
    /**
     * @param $className 类名
     * @param $keyWords  关键字
     * @param $articleId 文章ID
     */
    public static function getWeight($className, $keyWords, $articleId)
    {
        dump($articleId);
        $object = new $className();

        $object->where('articleId', $articleId)->max($keyWords);
        $object++;
        return $object;
    }

    /**
     * Created by PhpStorm.
     * User: zhangxishuo
     * Date: 2017/8/30
     * Time: 16:54
     * @uploadImage 上传文件
     * @param 需要上传的文件
     * @return 文件存储后的路径
     */
    public static function uploadImage($file)
    {
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
            return $info->getSaveName();
        } else {
            return $file->getError();
        }
    }
}
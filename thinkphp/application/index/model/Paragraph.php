<?php
namespace app\index\model;

use think\Model;
use think\Reuquest;
use app\index\model\Common;
/**
 * 
 * @authors zhuchenshu
 * @date    2017-08-30 16:25:40
 * @version $Id$
 */

class Paragraph extends Model {
    /**
     * @param $className 类名
     * @param $keyWords  关键字
     * @param $articleId 文章ID
     */
    public static function getWeight($keyWords, $articleId)
    {
        
        $object = new Paragraph();
        
        $object->where('article_id', $articleId)->max($keyWords);
        $object++;
        return $object;
    }

    public function saveParagraph($data, $articleId)
    {
		$this->title = $data['title'];
		$this->content = $data['content'];
		$this->article_id = $articleId['article_id'];
		$this->weight = $this->getWeight("weight", $this->article_id);
		
		// 传入图片
    	$file = request()->file('image');
    	// 返回图片路径
    	$image = Common::uploadImage($file);
    	// 保存图片路径
    	$this->image = $image;

    	if ($this->save()) {
    		// $this->success('保存成功！', url('article/add'));
    	}

    	// return $this->error('保存失败！');
    }
}
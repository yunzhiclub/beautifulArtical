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

class Paragraph extends Model 
{
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
        $this->is_before_attraction = (boolean)$data['is_before_attraction'];
		$this->article_id = $articleId;
		$this->weight = $this->getWeight("weight", $this->article_id);
		
		// 传入图片
    	$file = request()->file('image');
    	// 返回图片路径
    	$image = Common::uploadImage($file);
    	// 保存图片路径
    	$this->image = $image;

    	return $this->save();
    }

    /**
     * 更新段落信息
     * @param  $data         接收的表单信息
     * @return boolean       更新成功返回true，否则返回false
     */
    public function updateParagraph($data)
    {
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->is_before_attraction = (boolean)$data['is_before_attraction'];
        
        // 传入图片
        $file = request()->file('image');
        // 返回图片路径
        $image = Common::uploadImage($file);
        // 保存图片路径
        $this->image = $image;

        if ($this->save()) {
            return true;
        }
        return false;
    }
}
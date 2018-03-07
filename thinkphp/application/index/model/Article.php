<?php
namespace app\index\model;

use think\Model;
/**
 * 
 * @authors zhuchenshu
 * @date    2017-08-30 19:55:43
 * @version $Id$
 */

class Article extends Model
{
	public function updateArticleByTitleAndSummery($title, $summery) {
        // 设置字段，并保存
        $this->title = $title;
        $this->summery = $summery;
        $this->save();
        return $this;
    }
}
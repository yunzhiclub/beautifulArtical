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
    /**
     * 更新部分信息
     * @param $title    标题
     * @param $summery  摘要
     * @param $beginDate 出发日期
     * @return $this
     * @author panjie
     */
	public function updateArticleByTitleAndSummeryAndBeginDate($title, $summery, $beginDate) {
        // 设置字段，并保存
        $this->title = $title;
        $this->summery = $summery;
        $this->begin_date = $beginDate;
        $this->save();
        return $this;
    }
}
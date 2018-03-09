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
    // 日程信息
    protected $attractions = null;
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

    /**
     * 日程信息
     * @return array
     */
    public function getAttractions() {
        if (is_null($this->attractions)) {
            $this->loadAttractions();
        }
        return $this->attractions;
    }

    /**
     * 重新加载日程信息。适用于更新最新的关联数据
     */
    public function reloadAttractions() {
        $this->loadAttractions();
    }

    /**
     * 加载日程信息
     */
    private function loadAttractions() {
        $this->attractions = Attraction::order('weight')->where('article_id', $this->id)->select();
        if (is_null($this->attractions)) {
            $this->attractions = array();
        }
    }

    /**
     * 获取文章封面图片
     * @return [type] [description]
     */
    public function getArticleCover() {
        $images = json_decode($this->cover);
        return $images;
    }
}
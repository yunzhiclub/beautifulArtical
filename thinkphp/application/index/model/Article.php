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
	 * 保存订制师ID 
	 * @param  id 		$contractorId 订制师ID
	 * @param  id 		$articleId    文章ID
	 * @return boolen                 保存成功返回true，否则返回false
	 */
    public function saveContractorId($contractorId, $articleId)
    {
        $this->id = $articleId;
        $this->contractor_id = $contractorId;

    	if ($this->save()) {
    		return true;
    	}
    	return false;
    }
}
<?php
namespace app\index\model;

use think\Model;
use app\index\model\Article;
use app\index\service\Articleservice;

/**
 * @author 朴世超
 */
class Contractor extends Model
{
	/**
	 * 保存订制师
	 * @param  	$Data      接收的表单信息
	 * @param  	$articleId 接收的文章id
	 * @return  boolen	   保存成功返回true，否则返回false
	 */
	public function saveContractor($data, $articleId)
	{
		$this->designation = $Data['designation'];
		$this->phone = $Data['phone'];
		$this->fax = $Data['fax'];
		$this->mobile = $Data['mobile'];
		$this->email = $Data['email'];

		
		if ($this->save()) {
			
			$Articleservice = new Articleservice();
			if ($Articleservice->saveContractorId($this->id, $articleId)) {
				return true;
			}
		}
		return false;
	}
}
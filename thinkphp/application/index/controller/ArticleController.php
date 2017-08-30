<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article;

/**
 * 
 * @authors 朱晨澍、朴世超
 * @date    2017-08-30 09:08:35
 * @version $Id$
 */

class ArticleController extends Controller {

	public function index()
	{
		return $this->fetch();
	}

    public function firstadd(){
    	return $this->fetch();
    }

    public function secondadd(){
    	return $this->fetch();
    }
}
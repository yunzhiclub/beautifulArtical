<?php
namespace app\index\controller;

use think\Controller;

/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-08-30 09:08:35
 * @version $Id$
 */

class ArticleController extends Controller {
    public function add(){
    	return $this->fetch();
    }
}
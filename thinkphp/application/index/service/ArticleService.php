<?php

namespace app\index\service;

use app\index\model\Article;
use app\index\model\Common;
use app\index\model\Attraction;
use app\index\model\Paragraph;
use app\index\model\Hotel;
use app\index\model\Plan;
use app\index\model\Contractor;
use app\index\model\Material;
use app\index\model\Detail;
use app\index\model\AttractionMaterial;
use app\index\service\AttractionService;
use app\index\filter\Filter;
use think\db\exception\DataNotFoundException;

/**
 *
 * @authors zhuchenshu
 * @date    2017-09-01 09:24:18
 * @version $Id$
 */
class ArticleService
{
    /**
     * 更新某个文章的标题和摘要
     * @param $id 要更新的文章ID
     * @param $title 标准
     * @param $subtitle 副标题
     * @param $summery 摘要
     * @param $beginDate 行程开始日期
     * @author panjie
     * @return Article
     * @throws \think\Exception\DbException
     */
    static public function updateArticleByIdAndSubtitleAndTitleAndSummeryAndBeginDate($id,$title,$subtitle,$summery,$beginDate)
    {
        $article = Article::get($id);
        if (is_null($article)) {
            throw new DataNotFoundException("要更新的实体不存在或已删除");
        }

        // 更新基本信息
        return $article->updateArticleByTitleAndSubtitleAndSummeryAndBeginDate($title,$subtitle,$summery,$beginDate);
    }


    public static function findById($articleId)
    {
        return Article::get($articleId);
    }


    /*
     * @param param 用来穿参数
     * @param $controler 用来跳转用的
     * firstadd界面的内容增加
     */
    public function addAriticle($parma)
    {
        //初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'secondadd';
        $message['message'] = '添加成功，请继续完善文章详情';

        $title        = $parma->post('title');
        $subtitle     = $parma->post('subtitle');
        $summery      = $parma->post('summery');
        $contractorId = $parma->post('contractorId/d');
        $files        = request()->file('images');
        //实例化一个空文章
        $Article = new Article();

        //新建一个保存上传文件路径的数组
        $imagePaths = [];
        if(!empty($files)) {
            // 最多上传10张图片
            if (sizeof($files) > 10) {
                $message['status']  = 'error';
                $message['message'] = '最多上传' . config('maxImage.coverCount') . '张图片，请重新选择';

                return $message;
            }
            
            //开始保存图片的路径数据
            foreach ($files as $key => $value) {
                $imagePath = Common::uploadImage($value);
                array_push($imagePaths, $imagePath);
            }

            //将图片数组保存到实体中
            $Article->cover = json_encode($imagePaths);
        } else {
            $Article->cover = '';
        }

        // 新增的时候有没有上传图片
        // if (is_null($file)) {
        //     $message['status'] = 'error';
        //     $message['message'] = '请上传图片';
        //     $message['route'] = 'firstadd';
        //     return $message;
        // }

        $Article->title         = $title;
        $Article->subtitle      = $subtitle;
        $Article->summery       = $summery;
        $Article->contractor_id = $contractorId;

        // $imagePath = Common::uploadImage($file);
        // $Article->cover = $imagePath;

        if ($Article->validate(true)->save()) {
            //保存成功
            $message['param']['articleId'] = $Article->id;
        } else {
            //保存失败
            $message['status'] = 'error';
            $message['message'] = '摘要未添加，请重新添加';
            $message['route'] = 'firstadd';
            return $message;
        }
        // firstadd界面传入行程路线图片
        $routes = request()->file('routes');
        $judge = request()->post('optionsRadios');
        $Paragraph = new Paragraph();

        // 判断是否添加图片
        if ($judge == 1) {
            // 按段落保存
            $Paragraph->content = '';
            $Paragraph->title = "行程路线";
            $Paragraph->article_id = $Article->id;
            $Paragraph->is_before_attraction = 1;
            // 保存文件，返回路径
            if (!is_null($routes)) {
                $imagePath = Common::uploadImage($routes);
                $Paragraph->image = $imagePath;
            }
            $Paragraph->save();
        }
        $especialMassageService = $parma->post('especialMassageService');
        $especialMassageQuality = $parma->post('especialMassageQuality');
        $especialMassageQuotes = $parma->post('especialMassageQuotes');
        $especialMassageCost = $parma->post('especialMassageCost');
        $especialMassageNoCost = $parma->post('especialMassageNoCost');
        // 将默认的段落添加到景点中
        if (!empty($especialMassageService)) {
            $this->especialName($especialMassageService, $Article->id);
        }
        if (!empty($especialMassageQuality)) {
            $this->especialName($especialMassageQuality, $Article->id);
        }
        if (!empty($especialMassageQuotes)) {
            $this->especialName($especialMassageQuotes, $Article->id);
        }
        if (!empty($especialMassageCost)) {
            $this->especialName($especialMassageCost, $Article->id);
        }
        if (!empty($especialMassageNoCost)) {
            $this->especialName($especialMassageNoCost, $Article->id);
        }

        return $message;
    }

    // firstadd的界面編輯
    public function EditAriticle($parma)
    {
        //初始化返回信息
        $message = [];
        $message['status'] = 'success';
        $message['route'] = 'secondadd';
        $message['message'] = '添加成功，请继续完善文章详情';
        //获取到参数
        $articleId = $parma->param('articleId/d');
        $title = $parma->post('title');
        $subtitle = $parma->post('subtitle');
        $summery = $parma->post('summery');
        $contractorId = $parma->post('contractorId/d');
        $files = request()->file('images');

        //编辑文章
        $Article = Article::get($articleId);
        // 获取封面路径
        $imagePaths = $Article->getArticleCover();

        // 文件不为空，将新增文件保存
        if (!empty($files)) {
            foreach ($files as $key => $value) {
                $imagePath = Common::uploadImage($value);
                array_push($imagePaths, $imagePath);
            }
            $Article->cover = json_encode($imagePaths);
        }
        if ($Article->title == $title && $Article->summery == $summery && empty($files) && $Article->contractor_id == $contractorId) {
            $message['status'] = 'success';
            $message['message'] = '修改成功';
            $message['route'] = 'secondadd#changeCtrAndCov';
            $message['param']['articleId'] = $Article->id;
            //return $message;
        }
        $Article->title = $title;
        $Article->subtitle = $subtitle;
        $Article->summery = $summery;
        $Article->contractor_id = $contractorId;

        if ($Article->save()) {
            //保存成功
            $message['param']['articleId'] = $Article->id;
        }
        // firstadd界面传入行程路线图片
        $routes = request()->file('routes');

        $Paragraph = Paragraph::where('title', "行程路线")->where('article_id', $articleId)->find();
        if (empty($Paragraph)) {
            $Paragraph = new Paragraph;
        }
        if (!empty($Paragraph->image) && !empty($routes)) {
            $imagePath = PUBLIC_PATH . '/' . $Paragraph->image;
            Common::deleteImage($imagePath);
        }
        // 判断是否添加图片
        $judge = request()->post('optionsRadios');
        if ($judge == 1) {
            // 按段落保存
            $Paragraph->content = '';
            $Paragraph->title = "行程路线";
            $Paragraph->article_id = $Article->id;
            $Paragraph->is_before_attraction = 1;
            // 保存文件，返回路径
            if (!is_null($routes)) {
                $imagePath = Common::uploadImage($routes);
                $Paragraph->image = $imagePath;
            }
            if (!$Paragraph->save()) {
                //return $message;
            }
        } else {
            $Paragraph = Paragraph::where('title', "行程路线")->where('article_id', $articleId)->find();
            if (!empty($Paragraph)) {
                $Paragraph->delete();
            }
        }

        // 判断是否有默认段落，
        // 如果添加但后台没有加上，如果后台有不做处理
        // 如果不添加后台没有忽略，如果后台有删除
        $especialMassageService = $parma->post('especialMassageService');
        $especialMassageQuality = $parma->post('especialMassageQuality');
        $especialMassageQuotes = $parma->post('especialMassageQuotes');
        $especialMassageCost = $parma->post('especialMassageCost');
        $especialMassageNoCost = $parma->post('especialMassageNoCost');

        $backEspecialMassageService = $this->backEspecial("九大服务", $articleId);
        $backEspecialMassageQuality = $this->backEspecial("六大品质", $articleId);
        $backEspecialMassageQuotes = $this->backEspecial("报价说明", $articleId);
        $backEspecialMassageCost = $this->backEspecial("费用包括", $articleId);
        $backEspecialMassageNoCost = $this->backEspecial("费用不包括", $articleId);

        $this->dealEspesial($especialMassageService, $backEspecialMassageService, $Article->id);
        $this->dealEspesial($especialMassageQuality, $backEspecialMassageQuality, $Article->id);
        $this->dealEspesial($especialMassageQuotes, $backEspecialMassageQuotes, $Article->id);
        $this->dealEspesial($especialMassageCost, $backEspecialMassageCost, $Article->id);
        $this->dealEspesial($especialMassageNoCost, $backEspecialMassageNoCost, $Article->id);

        return $message;
    }

    public function dealEspesial($especialMassage, $backEspecialMassage, $article_id)
    {
        if (!empty($especialMassage)) {
            // 判断后台是否添加
            if (empty($backEspecialMassage)) {
                $this->especialName($especialMassage, $article_id);
            }
        } else {
            if (!empty($backEspecialMassage)) {
                $this->deleteEspecialName($backEspecialMassage->title, $article_id);
            }
        }
    }

    public function backEspecial($title, $article_id)
    {
        return Paragraph::where('title', '=', $title)->where('article_id', $article_id)->find();
    }

    public function deleteEspecialName($especialmassage, $articleId)
    {
        $Paragraph = Paragraph::where('title', '=', $especialmassage)->where('article_id', $articleId)->find();
        $Paragraph->delete();
    }

    // 添加文章的固定内容
    public function especialName($especialmassage, $articleId)
    {
        $Paragraph = Paragraph::where('title', '=', $especialmassage)->find();

        $newParagraph = new Paragraph();
        $newParagraph->title = $Paragraph->title;
        $newParagraph->content = $Paragraph->content;
        $newParagraph->weight = $Paragraph->weight;

        if ($Paragraph->is_before_attraction == 0) {
            $newParagraph->is_before_attraction = false;
        } else {
            $newParagraph->is_before_attraction = true;
        }
        $newParagraph->article_id = $articleId;

        $newParagraph->save();
    }

    public function upAttraction($param)
    {
        $message = [];
        $message['message'] = '向上排序成功';
        $message['status'] = 'success';

        $articleId = $param->param('articleId/d');
        // 获取位置
        $number = $param->param('number/d');
        // 获取排序景点
        $Attractions = Attraction::order('weight')->where('article_id', $articleId)->select();
        $number--;
        // 交换权重
        $tempWeight = $Attractions[$number]->weight;
        $Attractions[$number]->weight = $Attractions[$number - 1]->weight;
        $Attractions[$number - 1]->weight = $tempWeight;
        // 交换时间
        $tempDate = $Attractions[$number]->date;
        $Attractions[$number]->date = $Attractions[$number - 1]->date;
        $Attractions[$number - 1]->date = $tempDate;

        if (!$Attractions[$number]->save() || !$Attractions[$number - 1]->save()) {
            $message['message'] = '排序失败';
            $message['status'] = 'error';
        }

        return $message;
    }

    public function downAttraction($param)
    {
        $message = [];
        $message['message'] = '向下排序成功';
        $message['status'] = 'success';

        $articleId = $param->param('articleId/d');
        // 获取位置
        $number = $param->param('number/d');
        // 获取排序景点
        $Attractions = Attraction::order('weight')->where('article_id', $articleId)->select();
        $number--;
        // 交换权重
        $tempWeight = $Attractions[$number]->weight;
        $Attractions[$number]->weight = $Attractions[$number + 1]->weight;
        $Attractions[$number + 1]->weight = $tempWeight;
        // 交换时间
        $tempDate = $Attractions[$number]->date;
        $Attractions[$number]->date = $Attractions[$number + 1]->date;
        $Attractions[$number + 1]->date = $tempDate;

        if (!$Attractions[$number]->save() || !$Attractions[$number + 1]->save()) {
            $message['message'] = '排序失败';
            $message['status'] = 'error';
        }

        return $message;
    }

    public function secondAriticle($param)
    {
        // 传入文章id
        $articleId = $param->param('articleId/d');
        $Article = Article::get($articleId);

        $message = [];
        $message['title'] = $Article->title;
        $message['subtitle'] = $Article->subtitle;
        $message['summery'] = $Article->summery;
        $message['cover'] = $Article->cover;
        $message['articleId'] = $articleId;

        // 根据景点权重排序
        $Attraction = Attraction::order('weight')->where('article_id', $articleId)->select();
        $message['attraction'] = $Attraction;

        // 获取传入景点的个数
        $length = sizeof($Attraction);
        $message['length'] = $length;
        // 将文章中的各个景点的酒店合并到一个对象组中
        $Hotels = [];

        foreach ($Attraction as $key => $value) {
            $hotelId = $value->hotel_id;
            if (!is_null($hotelId)) {
                $tempHotel = Hotel::where('id', $hotelId)->find();
                if (!is_null($tempHotel)) {
                    array_push($Hotels, $tempHotel);
                }
            }
            $tempHotel = null;
        }
        $Hotels = array_unique($Hotels);
        // 将段落按在景点的上下顺序分成两个类，并根据权重排序
        $paragraphUp = Paragraph::where('is_before_attraction', 1)->where('article_id', $articleId)->order('weight desc')->select();
        $paragraphDown = Paragraph::where('is_before_attraction', 0)->where('article_id', $articleId)->order('weight desc')->select();
        // $Paragraph = Paragraph::order('weight')->select();
        $message['paragraphUp'] = $paragraphUp;
        $message['paragraphDown'] = $paragraphDown;
        $Contractor = Contractor::get($Article->contractor_id);
        $message['contractor'] = $Contractor;
        $message['hotel'] = $Hotels;

        return $message;
    }

    /**
     * 张喜硕
     * 删除文章
     * @return $message
     * $message['message'] 提示信息
     * $message['status'] 状态，成功为success，失败为error
     */
    public function deleteArticle($param)
    {

        $message = [];
        $message['message'] = '删除成功';
        $message['status'] = 'success';
        $articleId = $param->param('articleId/d');
        $Article = Article::get($articleId);

        // 验证文章是否为空
        if (is_null($Article)) {
            $message['message'] = '文章为空';
            $message['status'] = 'error';
            return $message;
        }

        // 删除段落
        $Paragraphs = Paragraph::where('article_id', $articleId)->select();
        if (!is_null($Paragraphs)) {
            foreach ($Paragraphs as $Paragraph) {
                $image = $Paragraph->image;
                if (!$Paragraph->delete()) {
                    $message['message'] = '删除段落失败';
                    $message['status'] = 'error';
                    return $message;
                }
                Common::deleteImage('upload/' . $image);
            }
        }

        // 删除景点
        $Attractions = Attraction::where('article_id', $articleId)->select();
        $attractionService = new AttractionService();
        if (!is_null($Attractions)) {
            foreach ($Attractions as $Attraction) {
                if (!$attractionService->deleteAttraction($Attraction['id'])) {
                    $message['message'] = '删除景点失败';
                    $message['status'] = 'error';
                }
            }
        }

        // 删除方案报价
        $Plans = Plan::where('article_id', $articleId)->select();
        if (!is_null($Plans)) {
            foreach ($Plans as $Plan) {
                $Details = Detail::where('plan_id', $Plan->id)->select();
                foreach ($Details as $Detail) {
                    if (!$Detail->delete()) {
                        $message['message'] = '删除明细失败';
                        $message['status'] = 'error';
                    }
                }
                if (!$Plan->delete()) {
                    $message['message'] = '删除方案报价失败';
                    $message['status'] = 'error';
                }
            }
        }

        // 删除文章
        if (!$Article->delete()) {
            $message['message'] = '删除文章失败';
            $message['status'] = 'error';
            return $message;
        }

        // 刪除文章封面所有的圖片
        $cover = $Article->cover;
        $covers = json_decode($cover);
        if(!empty($covers)) {
            foreach ($covers as $_cover) {
                Common::deleteImage('upload/' . $_cover);
            }
        }
        
        return $message;
    }

    /**
     * 保存订制师ID
     * @param  id $contractorId 订制师ID
     * @param  id $articleId 文章ID
     * @return boolen                 保存成功返回true，否则返回false
     */
    public function saveContractorId($contractorId, $articleId)
    {
        $Article = Article::get($articleId);
        $Article->contractor_id = $contractorId;

        if ($Article->save()) {
            return true;
        }
        return false;
    }

    public function searchArticle($articleTitle, $pageSize)
    {
        if (!empty($articleTitle)) {
            // 取出匹配的定制师
            $articles = Article::where('title', 'like', '%' . $articleTitle . '%')->order('id desc')->paginate($pageSize, false, [
                'query' => [
                    'articleTitle' => $articleTitle,
                ],
                'var_page' => 'page',
            ]);
            return $articles;
        }

        $articles = Article::order('id desc')->paginate($pageSize);
        return $articles;
    }

    /**
     * 朱晨澍
     * 克隆文章
     * @param  $articleId  文章id
     * @return $message
     * $message['message'] 提示信息
     * $message['status'] 状态，成功为success，失败为error
     */
    public function cloneArticle($articalId) {
        $message = [];
        $message['message'] = '克隆失败';
        $message['status'] = 'error';

        // 根据传入的文章id找到要克隆的文章
        $Artical = Article::get($articalId);
        // 创建新的文章，并增加相关属性
        $newArtical = Common::deepCopy($Artical);
        $newArtical['id'] = null;
        $newArtical['cover'] = Common::mvImage(json_decode($Artical['cover']), 'article');
        $newArtical['title'] = '新建文章';

        if($newArtical->isUpdate(false)->save()) {
            // 找出原文章所关联的行程，并进行复制
            $cloneAttraction = $this->cloneAttractionByArticle($articalId, $newArtical);
            
            // 找出原文章所关联的段落，并进行复制
            $cloneParagraph = $this->cloneParagraphByArticle($articalId, $newArtical);
            
            // 找出原文章所关联的报价，并进行复制
            $clonePlan = $this->clonePlanByArticle($articalId, $newArtical);

            if ($cloneAttraction and $cloneParagraph and $clonePlan === false) {
                return $message;
            }
            
        } else {
            return $message;
        }

        $message['message'] = '克隆成功';
        $message['status'] = 'success';
        return $message;
    }
    
    /**
     * 朱晨澍
     * 克隆行程
     * @param  $articleId  原文章id $newArtical 新文章id
     * @return $message
     */
    public function cloneAttractionByArticle($articalId, $newArtical) {
        $Attractions = Attraction::where('article_id',$articalId)->select();
            foreach ($Attractions as $Attraction) {
                $newAttraction = Common::deepCopy($Attraction);

                $newAttraction->id = null;
                $newAttraction->article_id = $newArtical['id'];
                $newAttraction['image'] = Common::mvImage($Attraction->image, 'attraction');
                var_dump($newAttraction['image']);

                if(!$newAttraction->isUpdate(false)->save()) {
                    return false;
                }

                // 找出原行程所关联的素材，并进行复制
                $AttractionMaterials = AttractionMaterial::where('attraction_id',$Attraction->id)->select();
                foreach ($AttractionMaterials as $AttractionMaterial) {
                    $n = serialize($AttractionMaterial);
                    $newAttractionMaterial = unserialize($n);

                    $newAttractionMaterial->attraction_id = $newAttraction->id;

                    if(!$newAttractionMaterial->isUpdate(false)->save()) {
                        return false;
                    }
                }
            }
        return true;    
    }

    /**
     * 朱晨澍
     * 克隆段落
     * @param  $articleId  原文章id $newArtical 新文章id
     * @return $message
     */ 
    public function cloneParagraphByArticle($articalId, $newArtical) {
        $Paragraphs = Paragraph::where('article_id',$articalId)->select();
            foreach ($Paragraphs as $Paragraph) {
                $newParagraph = Common::deepCopy($Paragraph);

                $newParagraph->id = null;
                $newParagraph->article_id = $newArtical['id'];
                $newParagraph['image'] = Common::mvImage($Paragraph['image'], 'paragraph');
                
                if(!$newParagraph->isUpdate(false)->save()) {
                    return false;
                }

            }
        return true; 
    }

    /**
     * 朱晨澍
     * 克隆报价
     * @param  $articleId  原文章id $newArtical 新文章id
     * @return $message
     */ 
    public function clonePlanByArticle($articalId, $newArtical) {
        $Plans = Plan::where('article_id',$articalId)->select();
            foreach ($Plans as $Plan) {

                $newPlan = Common::deepCopy($Plan);

                $newPlan->id = null;
                $newPlan->article_id = $newArtical['id'];

                if(!$newPlan->isUpdate(false)->save()) {
                    return false;
                }

                $details = Detail::where('plan_id', $Plan['id'])->select();
                foreach ($details as $detail) {
                    
                    $newdetail = Common::deepCopy($detail);

                    $newdetail->id = null;
                    $newdetail->plan_id = $newPlan['id'];

                    if(!$newdetail->isUpdate(false)->save()) {
                        return false;
                    }

                }
            }
        return true; 
    }

    /**
     * 删除封面图片
     */
    public function deleteImage($param) {
        //定义返回信息
        $message['status'] = 'success';

        $articleId = $param->param('articleId/d');
        $key = $param->param('imageKey/d');

        //从数据库取出数据
        $article = Article::get($articleId);
        $images = $article->getArticleCover();

        $imagePath =  PUBLIC_PATH . '/' .$images[$key - 1];
        //删除图片
        Common::deleteImage($imagePath);

        //获取图片中的数组元素
        $arrayLength = count($images);

        if ($key === $arrayLength) {
            //说明只有一个元素
            unset($images[$key - 1]);
        } else {
            //从数组中移除这个元素
            $i = $key - 1;
            for (; $i < $arrayLength - 1; $i++) {
                $images[$i] = $images[$i + 1];
            }

            unset($images[$i]);
        }

        $article->cover = json_encode($images);

        //从数据库更新数据
        if (!$article->save()) {
            $message['status'] = 'error';
        }

        return $message;

    }
    
}
 



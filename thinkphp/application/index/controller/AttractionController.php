<?php

namespace app\index\controller;

use app\index\model\Attraction;
use app\index\model\AttractionModel;
use app\index\model\Common;
use app\index\model\Hotel;
use app\index\model\HotelModel;
use app\index\model\Material;
use app\index\service\AttractionService;
use app\index\service\HotelService;
use app\index\service\Materialservice;
use think\Request;

/**
 * 
 * @authors 张喜硕
 */

class AttractionController extends IndexController {
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->attractionService = new AttractionService();
        $this->hotelService      = new HotelService();
    }

    public function add() {
        $hotel = $this->hotelService->getNullHotel();
        $material = new Material();

        $articleId = Request::instance()->param('articleId');

        $this->assign('material', $material);
        $this->assign('hotel', $hotel);
        $this->assign('articleId', $articleId);
        $this->assign('attraction', $this->attractionService->getNullAttraction($articleId));
        return $this->fetch();
    }

    public function save() {
        $param = Request::instance();
        $articleId = Request::instance()->param('articleId');
        $message = $this->attractionService->saveAttraction($param);
        if($message['status'] == 'success') {
            return $this->success($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        } else {
            return $this->error($message['message']);
        }
    }

    public function edit() {
        $articleId    = Request::instance()->param('articleId');
        $attractionId = Request::instance()->param('attractionId');
        $attraction   = Attraction::get($attractionId);
        $hotel    = Hotel::get($attraction->hotel_id);
        $material = new Material();
        $this->assign('material', $material);
        $this->assign('hotel', $hotel);
        $this->assign('articleId', $articleId);
        $this->assign('attraction', $attraction);
        $this->assign('image', json_decode($attraction->image));
        return $this->fetch('add');
    }

    public function update() {
        $param     = Request::instance();
        $articleId = Request::instance()->param('articleId');
        $message   = $this->attractionService->updateAttraction($param);
        if($message['status'] == 'success') {
            return $this->success($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        } else {
            return $this->error($message['message']);
        }
    }

    public function delete() {
        $param     = Request::instance();
        $articleId = Request::instance()->param('articleId');
        $message   = $this->attractionService->deleteAttraction($param);
        if($message['status'] == 'success') {
            return $this->success($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        } else {
            return $this->error($message['message'], url('article/secondadd', ['articleId' => $articleId]));
        }
    }

    public function getCity() {
        $countryIndex = Request::instance()->param('country');

        $hotel     = new Hotel();
        $countries = $hotel->getAllCountries();
        $cities    = $hotel->getCitiesByCountry($countries[$countryIndex]);

        return $cities;
    }

    public function getStar() {
        $countryIndex = Request::instance()->param('country');
        $cityIndex    = Request::instance()->param('city');

        $hotel     = new Hotel();
        $countries = $hotel->getAllCountries();
        $cities    = $hotel->getCitiesByCountry($countries[$countryIndex]);
        $stars     = $hotel->getStarsByCountryAndCity($countries[$countryIndex], $cities[$cityIndex]);

        return $stars;
    }

    public function getHotelName() {
        $countryIndex = Request::instance()->param('country');
        $cityIndex    = Request::instance()->param('city');
        $starIndex    = Request::instance()->param('star');

        $hotel     = new Hotel();
        $countries = $hotel->getAllCountries();
        $cities    = $hotel->getCitiesByCountry($countries[$countryIndex]);
        $stars     = $hotel->getStarsByCountryAndCity($countries[$countryIndex], $cities[$cityIndex]);
        $names     = $hotel->getHotelsByCountryAndCityAndStar($countries[$countryIndex], $cities[$cityIndex], $stars[$starIndex]);

        return $names;
    }
}
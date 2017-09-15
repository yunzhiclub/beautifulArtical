package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import java.sql.Date;

import static org.assertj.core.api.Assertions.assertThat;

/**
 * Created by Mr Chen on 2017/8/30.
 */
@RunWith(SpringRunner.class)
@SpringBootTest
public class AttractionRepositoryTest {
    @Autowired
    AttractionRepository attractionRepository;
    @Autowired
    ArticleRepository articleRepository;
    @Autowired
    PlanRepository planRepository;
    @Autowired
    ContractorRespository contractorRespository;
    @Autowired
    HotelRepository hotelRepository;


    @Test
    public void savetest(){
        // 定制师数据
        Contractor contractor = new Contractor("张友善","1225458878","654846345","57468435435","zhangyoushan@yunzhi.com");
        contractorRespository.save(contractor);
        // 方案报价数据
        Date date = new Date(2017,06,31);
        Plan plan =new Plan();
        planRepository.save(plan);
        //文章数据
        Article article = new Article(plan,contractor,"我的一天","美好的一天","url");
        articleRepository.save(article);
        //酒店数据
        Hotel hotel = new Hotel("zxc","zxc","zxc","zxc","sasa");
        hotelRepository.save(hotel);
        Attraction attraction = new Attraction();
        attraction.setArticle(article);
        attraction.setHotel(hotel);
        attractionRepository.save(attraction);
        assertThat(attractionRepository.findOne(attraction.getId())).isNotNull();

    }
}


package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.Article;
import com.mengyunzhi.article.entity.Contractor;
import com.mengyunzhi.article.entity.Plan;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

import java.sql.Date;

import static org.assertj.core.api.Assertions.assertThat;


/**
 * Created by Mr Chen on 2017/8/29.
 */
public class ArticleRepositoryTest extends ArticleApplicationTests {
    @Autowired ArticleRepository articleRepository;
    @Autowired PlanRepository planRepository;
    @Autowired ContractorRespository contractorRespository;

    @Test
    public void savetest(){
        Contractor contractor = new Contractor("张友善","1225458878","654846345","57468435435","zhangyoushan@yunzhi.com");
        contractorRespository.save(contractor);
        // 断言定制师不为空
        assertThat(contractor.getId()).isNotNull();
        Date date = new Date(2017,06,31);
        Plan plan =new Plan();
        planRepository.save(plan);

        // 断言方案报价实体不为空
        assertThat(plan.getId()).isNotNull();

        // 持久化一个文章实体
        Article article = new Article();
        articleRepository.save(article);
        assertThat(articleRepository.findOne(article.getId())).isNotNull();

    }
}

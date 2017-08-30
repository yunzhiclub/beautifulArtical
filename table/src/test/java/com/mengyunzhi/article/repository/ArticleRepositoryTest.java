package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;
import static org.assertj.core.api.Assertions.assertThat;


/**
 * Created by Mr Chen on 2017/8/29.
 */
@RunWith(SpringRunner.class)
@SpringBootTest
public class ArticleRepositoryTest {
    @Autowired ArticleRepository articleRepository;
    @Autowired PlanRepository planRepository;
    @Autowired ContractorRespository contractorRespository;

    @Test
    public void savetest(){
        Contractor contractor = new Contractor("张友善","1225458878","654846345","57468435435","zhangyoushan@yunzhi.com");
        contractorRespository.save(contractor);
        assertThat(contractor.getId()).isNotNull();

        Plan plan =new Plan("20170830", (long) 10.0,"$","地接",10,1,1,10,10,"kfls");
        planRepository.save(plan);

        assertThat(plan.getId()).isNotNull();

        Article article = new Article(plan,contractor,"我的一天","美好的一天","url");
        assertThat(article.getTitle()).isNotNull();
        assertThat(article.getSummery()).isNotNull();
        assertThat(article.getId()).isNotNull();

    }
}

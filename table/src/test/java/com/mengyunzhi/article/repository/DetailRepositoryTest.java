package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;
import static org.assertj.core.api.Assertions.assertThat;
/**
 * Created by Mr Chen on 2017/8/30.
 */
@RunWith(SpringRunner.class)
@SpringBootTest
public class DetailRepositoryTest {
    @Autowired
    PlanRepository planRepository;
    @Autowired
    DetailRepository detailRepository;
    @Test
    public void savetest(){
        Plan plan = planRepository.save(new Plan());
        assertThat(plan.getId()).isNotNull();
        Detail detail = new Detail();
        detail.setPlan(plan);
        detail.setNumber(10);
        detailRepository.save(detail);
        assertThat(detail.getId()).isNotNull();
    }


}

package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.Plan;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;
import static org.assertj.core.api.Assertions.assertThat;

public class PlanRepositoryTest extends ArticleApplicationTests {
    @Autowired
    private PlanRepository planRepository;
    @Test
    public void savetest() {
        Plan plan = planRepository.save(new Plan());
        assertThat(plan.getId()).isNotNull();
    }
}

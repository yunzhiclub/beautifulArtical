package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.Contractor;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

import static org.assertj.core.api.Assertions.assertThat;

/**
 * Created by Poshichao on 17/8/29.
 */

public class ContractorRespositoryTest extends ArticleApplicationTests {
    @Autowired
    private ContractorRespository contractorRespository;

    @Test
    public void save() {
        Contractor contractor = new Contractor();
        contractor.setDesignation("张友善");
        contractor.setPhone("1225458878");
        contractor.setFax("654846345");
        contractor.setMobile("57468435435");
        contractor.setEmail("zhangyoushan@yunzhi.com");
        contractorRespository.save(contractor);
        
        assertThat(contractor.getId()).isNotNull();
    }

}
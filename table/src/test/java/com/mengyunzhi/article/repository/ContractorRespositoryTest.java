package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import static org.assertj.core.api.Assertions.assertThat;

/**
 * Created by Poshichao on 17/8/29.
 */

@RunWith(SpringRunner.class)
@SpringBootTest
public class ContractorRespositoryTest {
    @Autowired
    private ContractorRespository contractorRespository;

    @Test
    public void save() {
        Contractor contractor = new Contractor();
        contractor.setName("张友善");
        contractor.setPhone("1225458878");
        contractor.setFax("654846345");
        contractor.setMobile("57468435435");
        contractor.setEmail("zhangyoushan@yunzhi.com");
        contractorRespository.save(contractor);
        
        assertThat(contractor.getId()).isNotNull();
    }

}
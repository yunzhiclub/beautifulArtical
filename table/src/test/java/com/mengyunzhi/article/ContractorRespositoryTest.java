package com.mengyunzhi.article;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

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
        contractorRespository.save(new Contractor());

    }

}
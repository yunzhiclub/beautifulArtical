package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

@RunWith(SpringRunner.class)
@SpringBootTest
public class DetailRepositoryTest {

    @Autowired
    private DetailRepository detailRepository;

    @Test
    public void saveTest() {
        detailRepository.findAll();
    }
}
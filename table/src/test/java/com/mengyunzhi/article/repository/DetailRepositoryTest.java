package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

public class DetailRepositoryTest extends ArticleApplicationTests {

    @Autowired
    private DetailRepository detailRepository;

    @Test
    public void saveTest() {
        detailRepository.findAll();
    }
}
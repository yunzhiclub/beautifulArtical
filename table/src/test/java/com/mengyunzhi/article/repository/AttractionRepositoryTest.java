package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.Attraction;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

public class AttractionRepositoryTest extends ArticleApplicationTests {

    @Autowired
    private AttractionRepository attractionRepository;

    @Test
    public void save() {
        attractionRepository.save(new Attraction());
    }
}
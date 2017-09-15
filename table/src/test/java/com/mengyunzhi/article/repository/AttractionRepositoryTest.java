package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import java.sql.Date;

import static org.assertj.core.api.Assertions.assertThat;

/**
 * Created by Mr Chen on 2017/8/30.
 */
@RunWith(SpringRunner.class)
@SpringBootTest
public class AttractionRepositoryTest {
    @Autowired
    AttractionRepository attractionRepository;
    @Autowired
    MaterialRepository materialRepository;

    @Test
    public void savetest(){
        Material material = new Material();
        material.setDesignation("测试素材");
        materialRepository.save(material);
        Attraction attraction = new Attraction();
    }
}


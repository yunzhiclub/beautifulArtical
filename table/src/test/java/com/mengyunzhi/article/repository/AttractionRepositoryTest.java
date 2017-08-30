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


    @Test
    public void savetest(){
        Attraction attraction = new Attraction("fdn","hao","jjjfdk","kkk","iii","url","url",10L);
        attractionRepository.save(attraction);
        assertThat(attraction.getId()).isNotNull();
        assertThat(attraction.getName()).isNotNull();
        assertThat(attraction.getWeight()).isNotNull();
        
    }
}


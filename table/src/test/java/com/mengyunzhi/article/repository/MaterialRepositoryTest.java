package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import static org.assertj.core.api.Assertions.assertThat;

@RunWith(SpringRunner.class)
@SpringBootTest
public class MaterialRepositoryTest {
    @Autowired
    private MaterialRepository materialRepository;

    @Test
    public void save() {
        Material material = new Material();
        materialRepository.save(material);

        assertThat(material.getId()).isNotNull();
    }
}
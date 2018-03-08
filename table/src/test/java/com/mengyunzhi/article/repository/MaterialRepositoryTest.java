package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.Material;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

import static org.assertj.core.api.Assertions.assertThat;

public class MaterialRepositoryTest extends ArticleApplicationTests {
    @Autowired
    private MaterialRepository materialRepository;

    @Test
    public void save() {
        Material material = new Material();
        material.setDesignation("测试素材");
        material.setContent("测试内容");
        material.setImages("测试图片");
        materialRepository.save(material);

        assertThat(material.getId()).isNotNull();
    }
}
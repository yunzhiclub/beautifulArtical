package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import javax.transaction.Transactional;

import static org.assertj.core.api.Assertions.assertThat;

@RunWith(SpringRunner.class)
@SpringBootTest
@Transactional
public class ParagraphRepositoryTest {
    @Autowired
    ParagraphRepository paragraphRepository;
    @Autowired
    ArticleRepository articleRepository;

    @Test
    public void saveParagraph() {
        Article article = new Article();
        article = articleRepository.save(article);

        Paragraph paragraph = new Paragraph();
        paragraph.setArticle(article);
        paragraph.setTitle("测试文章");
        paragraph = paragraphRepository.save(paragraph);

        assertThat(paragraph.getId()).isNotNull();
        assertThat(paragraphRepository.findOne(paragraph.getId())).isNotNull();
    }
}

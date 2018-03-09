package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.Article;
import com.mengyunzhi.article.entity.Paragraph;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

import static org.assertj.core.api.Assertions.assertThat;

public class ParagraphRepositoryTest extends ArticleApplicationTests {
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

package com.mengyunzhi.article.repository;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

/**
 * Created by Mr Chen on 2017/8/29.
 */
@Entity
public class Paragraph {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    private Article article;
    private String title;
    private String content;
    private String image;

    public Paragraph(Article article, String title, String content, String image) {
        this.article = article;
        this.title = title;
        this.content = content;
        this.image = image;
    }
    public Paragraph(){

    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Article getArticle() {
        return article;
    }

    public void setArticle(Article article) {
        this.article = article;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

}

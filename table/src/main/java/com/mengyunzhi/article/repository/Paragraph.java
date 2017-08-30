package com.mengyunzhi.article.repository;

import javax.persistence.*;

@Entity
public class Paragraph {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    @ManyToOne
    private Article article;

    // 段落标题
    private String title;

    // 内容
    private String content;

    // 图片
    private String image;

    // 权重
    private int weight;

    public Paragraph() {
    }

    public Paragraph(Article article, String title, String content, String image, int weight) {
        this.article = article;
        this.title = title;
        this.content = content;
        this.image = image;
        this.weight = weight;
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

    public int getWeight() {
        return weight;
    }

    public void setWeight(int weight) {
        this.weight = weight;
    }
}

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
    @Column(length = 3000)
    private String content;

    // 图片
    private String image;

    // 权重
    private int weight;

    // 是否景点前
    private boolean isBeforeAttraction;

    @Override
    public String toString() {
        return "Paragraph{" +
                "id=" + id +
                ", article=" + article +
                ", title='" + title + '\'' +
                ", content='" + content + '\'' +
                ", image='" + image + '\'' +
                ", weight=" + weight +
                ", isBeforeAttraction=" + isBeforeAttraction +
                '}';
    }

    public Paragraph() {
    }

    public Paragraph(Article article, String title, String content, String image, int weight, boolean isBeforeAttraction) {
        this.article = article;
        this.title = title;
        this.content = content;
        this.image = image;
        this.weight = weight;
        this.isBeforeAttraction = isBeforeAttraction;
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

    public boolean isBeforeAttraction() {
        return isBeforeAttraction;
    }

    public void setBeforeAttraction(boolean beforeAttraction) {
        isBeforeAttraction = beforeAttraction;
    }

}

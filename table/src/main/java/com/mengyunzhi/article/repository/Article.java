package com.mengyunzhi.article.repository;

import javax.persistence.*;

/**
 * Created by Mr Chen on 2017/8/29.
 */
@Entity
public class Article {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;


    @ManyToOne
    private Contractor contractor;

    // 文章标题
    private String title;
    // 文章摘要
    private String summery;
    // 文章封面
    private String cover;



    public Article(Plan plan, Contractor contractor, String title, String summery, String cover) {

        this.contractor = contractor;
        this.title = title;
        this.summery = summery;
        this.cover = cover;
    }
    public Article(){
        
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Contractor getContractor() {
        return contractor;
    }

    public void setContractor(Contractor contractor) {
        this.contractor = contractor;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getSummery() {
        return summery;
    }

    public void setSummery(String summery) {
        this.summery = summery;
    }

    public String getCover() {
        return cover;
    }

    public void setCover(String cover) {
        this.cover = cover;
    }
    @Override
    public String toString() {
        return "Article{" +
                "id=" + id +
                ", contractor=" + contractor +
                ", title='" + title + '\'' +
                ", summery='" + summery + '\'' +
                ", cover='" + cover + '\'' +
                '}';
    }
}

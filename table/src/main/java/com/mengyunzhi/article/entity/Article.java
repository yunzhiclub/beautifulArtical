package com.mengyunzhi.article.entity;

import javax.persistence.*;
import java.sql.Date;
import java.util.ArrayList;
import java.util.List;

/**
 * 文章
 * Created by Mr Chen on 2017/8/29.
 */
@Entity
public class Article {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    // 定制师
    @ManyToOne
    private Contractor contractor;
    @OneToMany(mappedBy = "article")
    private List<Attraction> attractions = new ArrayList<>();       // 日程
    // 文章标题
    private String title;
    // 文章副标题
    private String subtitle;
    // 文章摘要
    @Column(length = 3000)
    private String summery;
    // 文章封面
    @Column(length = 2000)
    private String cover;
    // 出发日期
    private Date beginDate;

    public Article(){
        
    }

    public String getSubtitle() {
        return subtitle;
    }

    public void setSubtitle(String subtitle) {
        this.subtitle = subtitle;
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

    public Date getBeginDate() {
        return beginDate;
    }

    public void setBeginDate(Date beginDate) {
        this.beginDate = beginDate;
    }

    public List<Attraction> getAttractions() {
        return attractions;
    }

    public void setAttractions(List<Attraction> attractions) {
        this.attractions = attractions;
    }

    @Override
    public String toString() {
        return "Article{" +
                "id=" + id +
                ", contractor=" + contractor +
                ", attractions=" + attractions +
                ", title='" + title + '\'' +
                ", subtitle='" + subtitle + '\'' +
                ", summery='" + summery + '\'' +
                ", cover='" + cover + '\'' +
                ", beginDate=" + beginDate +
                '}';
    }
}

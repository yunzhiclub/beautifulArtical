package com.mengyunzhi.article.repository;

import javax.persistence.*;
import java.sql.Date;
import java.text.DecimalFormat;

@Entity
public class Plan {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    @OneToOne
    private Article article; //文章实体
    private Integer adultNum;   // 成人数
    private Integer childNum;   // 儿童数
    private String currency; // 币种
    private DecimalFormat totalCost; // 总费用
    private Date lastPayTime; // 最晚付款时间

    public Plan(Article article, Integer adultNum, Integer childNum, String currency, DecimalFormat totalCost, Date lastPayTime) {
        this.article = article;
        this.adultNum = adultNum;
        this.childNum = childNum;
        this.currency = currency;
        this.totalCost = totalCost;
        this.lastPayTime = lastPayTime;
    }

    public Plan() {
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

    public Integer getAdultNum() {
        return adultNum;
    }

    public void setAdultNum(Integer adultNum) {
        this.adultNum = adultNum;
    }

    public Integer getChildNum() {
        return childNum;
    }

    public void setChildNum(Integer childNum) {
        this.childNum = childNum;
    }

    public String getCurrency() {
        return currency;
    }

    public void setCurrency(String currency) {
        this.currency = currency;
    }

    public DecimalFormat getTotalCost() {
        return totalCost;
    }

    public void setTotalCost(DecimalFormat totalCost) {
        this.totalCost = totalCost;
    }

    public Date getLastPayTime() {
        return lastPayTime;
    }

    public void setLastPayTime(Date lastPayTime) {
        this.lastPayTime = lastPayTime;
    }

    @Override
    public String toString() {
        return "Plan{" +
                "id=" + id +
                ", article=" + article +
                ", adultNum=" + adultNum +
                ", childNum=" + childNum +
                ", currency='" + currency + '\'' +
                ", totalCost=" + totalCost +
                ", lastPayTime=" + lastPayTime +
                '}';
    }
}

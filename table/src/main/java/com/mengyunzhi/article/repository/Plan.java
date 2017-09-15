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
    private String type; // 类型：机票，签证，旅游，保险
    private DecimalFormat adultUnitPrice;   // 成人单价
    private DecimalFormat childUnitPrice;   // 儿童单价
    private DecimalFormat totalPrice; //总价
    private String remark; // 备注
    private DecimalFormat totalCost; // 总费用
    private Date lastPayTime; // 最晚付款时间

    public Plan(Article article, Integer adultNum, Integer childNum, String currency, String type, DecimalFormat adultUnitPrice, DecimalFormat childUnitPrice, DecimalFormat totalPrice, String remark, DecimalFormat totalCost, Date lastPayTime) {
        this.article = article;
        this.adultNum = adultNum;
        this.childNum = childNum;
        this.currency = currency;
        this.type = type;
        this.adultUnitPrice = adultUnitPrice;
        this.childUnitPrice = childUnitPrice;
        this.totalPrice = totalPrice;
        this.remark = remark;
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

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public DecimalFormat getAdultUnitPrice() {
        return adultUnitPrice;
    }

    public void setAdultUnitPrice(DecimalFormat adultUnitPrice) {
        this.adultUnitPrice = adultUnitPrice;
    }

    public DecimalFormat getChildUnitPrice() {
        return childUnitPrice;
    }

    public void setChildUnitPrice(DecimalFormat childUnitPrice) {
        this.childUnitPrice = childUnitPrice;
    }

    public DecimalFormat getTotalPrice() {
        return totalPrice;
    }

    public void setTotalPrice(DecimalFormat totalPrice) {
        this.totalPrice = totalPrice;
    }

    public String getRemark() {
        return remark;
    }

    public void setRemark(String remark) {
        this.remark = remark;
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
                ", type='" + type + '\'' +
                ", adultUnitPrice=" + adultUnitPrice +
                ", childUnitPrice=" + childUnitPrice +
                ", totalPrice=" + totalPrice +
                ", remark='" + remark + '\'' +
                ", totalCost=" + totalCost +
                ", lastPayTime=" + lastPayTime +
                '}';
    }
}
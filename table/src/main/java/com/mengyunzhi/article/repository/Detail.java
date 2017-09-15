package com.mengyunzhi.article.repository;

import javax.persistence.*;
import java.text.DecimalFormat;

/**
 * Created by Mr Chen on 2017/8/30.
 */
@Entity
public class Detail {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    private String type; // 类型：机票，签证，旅游，保险
    private DecimalFormat adultUnitPrice;   // 成人单价
    private DecimalFormat childUnitPrice;   // 儿童单价
    private DecimalFormat totalPrice; //总价
    private String remark; // 备注
    @ManyToOne
    private Plan plan;

    public Detail(String type, DecimalFormat adultUnitPrice, DecimalFormat childUnitPrice, DecimalFormat totalPrice, String remark, Plan plan) {
        this.type = type;
        this.adultUnitPrice = adultUnitPrice;
        this.childUnitPrice = childUnitPrice;
        this.totalPrice = totalPrice;
        this.remark = remark;
        this.plan = plan;
    }

    public Detail() {
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
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

    public Plan getPlan() {
        return plan;
    }

    public void setPlan(Plan plan) {
        this.plan = plan;
    }

    @Override
    public String toString() {
        return "Detail{" +
                "id=" + id +
                ", type='" + type + '\'' +
                ", adultUnitPrice=" + adultUnitPrice +
                ", childUnitPrice=" + childUnitPrice +
                ", totalPrice=" + totalPrice +
                ", remark='" + remark + '\'' +
                ", plan=" + plan +
                '}';
    }
}

package com.mengyunzhi.article.entity;

import org.hibernate.annotations.ColumnDefault;

import javax.persistence.*;
import java.text.DecimalFormat;

@Entity
public class Detail {
    @Id @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    private String designation;             // 名称
    private DecimalFormat adultUnitPrice;   // 成人单价
    private DecimalFormat childUnitPrice;   // 儿童单价
    private DecimalFormat totalPrice;       // 总价

    @ColumnDefault("'无'")
    private String remark;                  // 备注

    @ManyToOne
    private Plan plan;                      // 关联Plan实体

    public Detail() {
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getDesignation() {
        return designation;
    }

    public void setDesignation(String designation) {
        this.designation = designation;
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
}

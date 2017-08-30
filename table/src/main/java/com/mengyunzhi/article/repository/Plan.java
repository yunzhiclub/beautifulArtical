package com.mengyunzhi.article.repository;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import java.sql.Date;

@Entity
public class Plan {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    private Date travelDate; // 出行日期
    private Long peopleNum; // 出行人数
    private String currency; // 币种
    private String type; // 类型
    private Integer number; // 数量
    private Integer frequency; // 频次
    private Integer unitPrice; // 单价
    private Integer totalCost; // 总费用
    private Integer totalPrice; //总价
    private String remark; // 备注

    public Plan(Date travelDate, Long peopleNum, String currency, String type, Integer number, Integer frequency, Integer unitPrice, Integer totalCost, Integer totalPrice, String remark) {
        this.travelDate = travelDate;
        this.peopleNum = peopleNum;
        this.currency = currency;
        this.type = type;
        this.number = number;
        this.frequency = frequency;
        this.unitPrice = unitPrice;
        this.totalCost = totalCost;
        this.totalPrice = totalPrice;
        this.remark = remark;
    }

    public Plan() {
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Date getTravelDate() {
        return travelDate;
    }

    public void setTravelDate(Date travelDate) {
        this.travelDate = travelDate;
    }

    public Long getPeopleNum() {
        return peopleNum;
    }

    public void setPeopleNum(Long peopleNum) {
        this.peopleNum = peopleNum;
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

    public Integer getNumber() {
        return number;
    }

    public void setNumber(Integer number) {
        this.number = number;
    }

    public Integer getFrequency() {
        return frequency;
    }

    public void setFrequency(Integer frequency) {
        this.frequency = frequency;
    }

    public Integer getUnitPrice() {
        return unitPrice;
    }

    public void setUnitPrice(Integer unitPrice) {
        this.unitPrice = unitPrice;
    }

    public Integer getTotalCost() {
        return totalCost;
    }

    public void setTotalCost(Integer totalCost) {
        this.totalCost = totalCost;
    }

    public Integer getTotalPrice() {
        return totalPrice;
    }

    public void setTotalPrice(Integer totalPrice) {
        this.totalPrice = totalPrice;
    }

    public String getRemark() {
        return remark;
    }

    public void setRemark(String remark) {
        this.remark = remark;
    }

    @Override
    public String toString() {
        return "Plan{" +
                "id=" + id +
                ", travelDate=" + travelDate +
                ", peopleNum=" + peopleNum +
                ", currency='" + currency + '\'' +
                ", type='" + type + '\'' +
                ", number=" + number +
                ", frequency=" + frequency +
                ", unitPrice=" + unitPrice +
                ", totalCost=" + totalCost +
                ", totalPrice=" + totalPrice +
                ", remark='" + remark + '\'' +
                '}';
    }
}

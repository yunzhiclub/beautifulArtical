package com.mengyunzhi.article.repository;

import javax.persistence.*;
import java.sql.Date;

@Entity
public class Plan {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    private Date travelDate; // 出行日期
    private Long peopleNum; // 出行人数
    private String currency; // 币种
    private Integer totalCost; // 总费用

    public Plan(Date travelDate, Long peopleNum, String currency, Integer totalCost) {
        this.travelDate = travelDate;
        this.peopleNum = peopleNum;
        this.currency = currency;
        this.totalCost = totalCost;
    }
    public Plan(){

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

    public Integer getTotalCost() {
        return totalCost;
    }

    public void setTotalCost(Integer totalCost) {
        this.totalCost = totalCost;
    }

    @Override
    public String toString() {
        return "Plan{" +
                "id=" + id +
                ", travelDate=" + travelDate +
                ", peopleNum=" + peopleNum +
                ", currency='" + currency + '\'' +
                ", totalCost=" + totalCost +
                '}';
    }
}

package com.mengyunzhi.article.repository;

import javax.persistence.*;

@Entity
public class Hotel {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    // 酒店名称
    private String designation;

    // 所在城市
    private String city;

    // 酒店星级
    private String starLevel;

    // 酒店备注
    private String remark;

    public Hotel() {
    }

    public Hotel(String designation, String city, String starLevel, String remark) {
        this.designation = designation;
        this.city = city;
        this.starLevel = starLevel;
        this.remark = remark;
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

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getStarLevel() {
        return starLevel;
    }

    public void setStarLevel(String starLevel) {
        this.starLevel = starLevel;
    }

    public String getRemark() {
        return remark;
    }

    public void setRemark(String remark) {
        this.remark = remark;
    }

    @Override
    public String toString() {
        return "Hotel{" +
                "id=" + id +
                ", designation='" + designation + '\'' +
                ", city='" + city + '\'' +
                ", starLevel='" + starLevel + '\'' +
                ", remark='" + remark + '\'' +
                '}';
    }
}

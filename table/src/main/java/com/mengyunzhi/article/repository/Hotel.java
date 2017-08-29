package com.mengyunzhi.article.repository;

import javax.persistence.*;

@Entity
public class Hotel {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    // 酒店名称
    @Column(length = 10)
    private String name;

    // 所在城市
    @Column(length = 10)
    private String city;

    // 酒店星级
    @Column(length = 10)
    private String starLevel;

    // 酒店备注
    @Column(length = 10)
    private String remark;

    public Hotel() {
    }

    public Hotel(String name, String city, String starLevel, String remark) {
        this.name = name;
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

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
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
}

package com.mengyunzhi.article.repository;

import javax.persistence.*;

@Entity
public class Material {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    @Column(length = 3000)
    private String content;         //描述
    private String designation;     //名称
    @Column(length = 300)
    private String images;          //图片
    private String country;         // 国家
    private String area;            // 地区

    @Override
    public String toString() {
        return "Material{" +
                "id=" + id +
                ", content='" + content + '\'' +
                ", designation='" + designation + '\'' +
                ", images='" + images + '\'' +
                ", country='" + country + '\'' +
                ", area='" + area + '\'' +
                '}';
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }

    public String getArea() {
        return area;
    }

    public void setArea(String area) {
        this.area = area;
    }

    public Material() {
    }


    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getDesignation() {
        return designation;
    }

    public void setDesignation(String designation) {
        this.designation = designation;
    }

    public String getImages() {
        return images;
    }

    public void setImages(String images) {
        this.images = images;
    }

}

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
    private String images;          //图片

    public Material() {
    }


    @Override
    public String toString() {
        return "Material{" +
                "id=" + id +
                ", content='" + content + '\'' +
                ", designation='" + designation + '\'' +
                ", image='" + images + '\'' +
                '}';
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

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
    private String image;           //图片

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

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    @Override
    public String toString() {
        return "Material{" +
                "id=" + id +
                ", content='" + content + '\'' +
                ", designation='" + designation + '\'' +
                ", image='" + image + '\'' +
                '}';
    }
}

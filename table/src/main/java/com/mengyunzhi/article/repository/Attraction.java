package com.mengyunzhi.article.repository;

import javax.persistence.*;

/**
 * Created by Mr Chen on 2017/8/30.
 */
@Entity
public class Attraction {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    @ManyToOne
    private Article article;

    @OneToOne
    private Hotel hotel;

    @ManyToOne
    private Material material;          //素材

    private String meal;
    private String car;
    private String guide;
    private String title;
    private int weight;


    public Attraction() {
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

    public Hotel getHotel() {
        return hotel;
    }

    public void setHotel(Hotel hotel) {
        this.hotel = hotel;
    }

    public String getMeal() {
        return meal;
    }

    public void setMeal(String meal) {
        this.meal = meal;
    }

    public String getCar() {
        return car;
    }

    public void setCar(String car) {
        this.car = car;
    }

    public String getGuide() {
        return guide;
    }

    public void setGuide(String guide) {
        this.guide = guide;
    }

    public int getWeight() {
        return weight;
    }

    public void setWeight(int weight) {
        this.weight = weight;
    }

    public Material getMaterial() {
        return material;
    }

    public void setMaterial(Material material) {
        this.material = material;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }


    @Override
    public String toString() {
        return "Attraction{" +
                "id=" + id +
                ", article=" + article +
                ", hotel=" + hotel +
                ", material=" + material +
                ", meal='" + meal + '\'' +
                ", car='" + car + '\'' +
                ", guide='" + guide + '\'' +
                ", title='" + title + '\'' +
                ", weight=" + weight +
                '}';
    }
}

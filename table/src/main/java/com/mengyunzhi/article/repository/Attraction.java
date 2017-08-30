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






    private String title;
    private String description;
    private String name;
    private String meal;
    private String car;
    private String guide;
    private String image;
    private int weight;


    public Hotel getHotel() {
        return hotel;
    }

    public void setHotel(Hotel hotel) {
        this.hotel = hotel;
    }

    public Article getArticle() {
        return article;
    }

    public void setArticle(Article article) {
        this.article = article;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
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

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public int getWeight() {
        return weight;
    }

    public void setWeight(int weight) {
        this.weight = weight;
    }

    public Attraction() {
    }

    @Override
    public String toString() {
        return "Attraction{" +
                "id=" + id +
                ", article=" + article +
                ", hotel=" + hotel +
                ", title='" + title + '\'' +
                ", description='" + description + '\'' +
                ", name='" + name + '\'' +
                ", meal='" + meal + '\'' +
                ", car='" + car + '\'' +
                ", guide='" + guide + '\'' +
                ", image='" + image + '\'' +
                ", weight=" + weight +
                '}';
    }


}
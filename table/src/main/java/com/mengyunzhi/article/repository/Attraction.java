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
    private String designation;
    private String meal;
    private String car;
    private String guide;
    private String image;
    private int weight;


    public Attraction() {
    }

    public Attraction(Article article, Hotel hotel, String title, String description, String designation, String meal, String car, String guide, String image, int weight) {
        this.article = article;
        this.hotel = hotel;
        this.title = title;
        this.description = description;
        this.designation = designation;
        this.meal = meal;
        this.car = car;
        this.guide = guide;
        this.image = image;
        this.weight = weight;
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

    public String getDesignation() {
        return designation;
    }

    public void setDesignation(String designation) {
        this.designation = designation;
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

    @Override
    public String toString() {
        return "Attraction{" +
                "id=" + id +
                ", article=" + article +
                ", hotel=" + hotel +
                ", title='" + title + '\'' +
                ", description='" + description + '\'' +
                ", designation='" + designation + '\'' +
                ", meal='" + meal + '\'' +
                ", car='" + car + '\'' +
                ", guide='" + guide + '\'' +
                ", image='" + image + '\'' +
                ", weight=" + weight +
                '}';
    }
}

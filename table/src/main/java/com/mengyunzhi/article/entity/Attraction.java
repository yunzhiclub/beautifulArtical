package com.mengyunzhi.article.entity;

import javax.persistence.*;
import java.sql.Date;
import java.util.HashSet;
import java.util.Set;

/**
 * Created by Mr Chen on 2017/8/30.
 * 日程
 */
@Entity
public class Attraction {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    @ManyToOne
    private Article article;

    @ManyToOne
    private Hotel hotel;

    @ManyToMany
    private Set<Material> material = new HashSet<Material>();

    private String trip;
    @Column(length = 500)
    private String description;
    @Column(length = 300)
    private String image;          //图片
    private Date date;
    private String meal;
    private String car;
    private String guide;
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

    public Set<Material> getMaterial() {
        return material;
    }

    public void setMaterial(Set<Material> material) {
        this.material = material;
    }

    public String getTrip() {
        return trip;
    }

    public void setTrip(String trip) {
        this.trip = trip;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
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

    @Override
    public String toString() {
        return "Attraction{" +
                "id=" + id +
                ", article=" + article +
                ", hotel=" + hotel +
                ", material=" + material +
                ", trip='" + trip + '\'' +
                ", description='" + description + '\'' +
                ", image='" + image + '\'' +
                ", date=" + date +
                ", meal='" + meal + '\'' +
                ", car='" + car + '\'' +
                ", guide='" + guide + '\'' +
                ", weight=" + weight +
                '}';
    }
}

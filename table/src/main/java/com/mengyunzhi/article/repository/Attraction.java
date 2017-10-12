package com.mengyunzhi.article.repository;

import javax.persistence.*;
import java.sql.Date;
import java.util.HashSet;
import java.util.Set;

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

    @ManyToOne
    private Hotel hotel;

    @ManyToMany
    private Set<Material> material = new HashSet<Material>();

    private String trip;
    @Column(length = 500)
    private String description;
    private Date date;
    private String meal;
    private String car;
    private String guide;
    private int weight;

    public Attraction() {
    }

    public Attraction(Article article, Hotel hotel, Set<Material> material, String trip, String description, Date date, String meal, String car, int weight) {
        this.article = article;
        this.hotel = hotel;
        this.material = material;
        this.trip = trip;
        this.description = description;
        this.date = date;
        this.meal = meal;
        this.car = car;
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
                ", date=" + date +
                ", meal='" + meal + '\'' +
                ", car='" + car + '\'' +
                ", weight=" + weight +
                '}';
    }
}

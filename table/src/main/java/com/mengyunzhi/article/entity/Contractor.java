package com.mengyunzhi.article.entity;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

/**
 * 定制师
 */
@Entity
public class Contractor {
    @Id @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;

    private String designation;
    private String phone;
    private String fax;
    private String mobile;
    private String email;

    public Contractor(String designation, String phone, String fax, String mobile, String email) {
        this.designation = designation;
        this.phone = phone;
        this.fax = fax;
        this.mobile = mobile;
        this.email = email;
    }

    public Contractor() {
    }

    public Long getId() {
        return id;
    }

    public String getDesignation() {
        return designation;
    }

    public String getPhone() {
        return phone;
    }

    public String getFax() {
        return fax;
    }

    public String getMobile() {
        return mobile;
    }

    public String getEmail() {
        return email;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public void setDesignation(String designation) {
        this.designation = designation;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public void setFax(String fax) {
        this.fax = fax;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    @Override
    public String toString() {
        return "Contractor{" +
                "id=" + id +
                ", name='" + designation + '\'' +
                ", phone='" + phone + '\'' +
                ", fax='" + fax + '\'' +
                ", mobile='" + mobile + '\'' +
                ", email='" + email + '\'' +
                '}';
    }
}

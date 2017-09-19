package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorValue;
import javax.persistence.Entity;

@Entity
@DiscriminatorValue("tourism")
public class TourismDetail extends Detail {
}

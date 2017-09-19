package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorValue;
import javax.persistence.Entity;

@Entity
@DiscriminatorValue("plane")
public class PlaneDetail extends Detail {
}

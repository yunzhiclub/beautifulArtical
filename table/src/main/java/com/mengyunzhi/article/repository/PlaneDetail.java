package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorColumn;
import javax.persistence.Entity;

@Entity
@DiscriminatorColumn(name = "plane")
public class PlaneDetail extends Detail {
}

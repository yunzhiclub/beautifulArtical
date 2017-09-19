package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorColumn;
import javax.persistence.Entity;

@Entity
@DiscriminatorColumn(name = "tourism")
public class TourismDetail extends Detail {
}

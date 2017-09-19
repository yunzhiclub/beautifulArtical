package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorColumn;
import javax.persistence.Entity;

@Entity
@DiscriminatorColumn(name = "visa")
public class VisaDetail extends Detail {
}

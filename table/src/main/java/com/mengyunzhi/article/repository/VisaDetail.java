package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorValue;
import javax.persistence.Entity;

@Entity
@DiscriminatorValue("visa")
public class VisaDetail extends Detail {
}

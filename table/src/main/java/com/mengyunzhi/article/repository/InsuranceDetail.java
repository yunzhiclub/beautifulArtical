package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorValue;
import javax.persistence.Entity;

@Entity
@DiscriminatorValue("insurance")
public class InsuranceDetail extends Detail {
}

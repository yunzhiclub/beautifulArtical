package com.mengyunzhi.article.repository;

import javax.persistence.DiscriminatorColumn;
import javax.persistence.Entity;

@Entity
@DiscriminatorColumn(name = "insurance")
public class InsuranceDetail extends Detail {
}

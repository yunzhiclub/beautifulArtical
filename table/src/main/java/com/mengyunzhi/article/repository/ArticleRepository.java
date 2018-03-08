package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.entity.Article;
import org.springframework.data.repository.CrudRepository;

/**
 * Created by Mr Chen on 2017/8/29.
 */
public interface ArticleRepository extends CrudRepository<Article, Long> {
}

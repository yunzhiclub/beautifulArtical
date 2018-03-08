package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.entity.Paragraph;
import org.springframework.data.repository.CrudRepository;

public interface ParagraphRepository extends CrudRepository<Paragraph, Long> {
}

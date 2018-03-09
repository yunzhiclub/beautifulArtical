package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.entity.Hotel;
import org.springframework.data.repository.CrudRepository;

public interface HotelRepository extends CrudRepository<Hotel, Long> {
}

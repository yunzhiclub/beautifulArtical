package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.Hotel;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

import static org.assertj.core.api.Assertions.assertThat;

public class HotelRepositoryTest extends ArticleApplicationTests {
    @Autowired
    private HotelRepository hotelRepository;

    @Test
    public void saveHotel() {
        Hotel hotel = new Hotel();
        hotel.setDesignation("测试酒店");

        hotel = hotelRepository.save(hotel);
        assertThat(hotelRepository.findOne(hotel.getId())).isNotNull();
    }
}

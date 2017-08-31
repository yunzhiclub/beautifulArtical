package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import javax.transaction.Transactional;

import static org.assertj.core.api.Assertions.assertThat;

@RunWith(SpringRunner.class)
@SpringBootTest
@Transactional
public class HotelRepositoryTest {
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

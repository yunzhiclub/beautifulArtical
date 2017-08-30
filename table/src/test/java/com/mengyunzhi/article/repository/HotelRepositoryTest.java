package com.mengyunzhi.article.repository;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;
import static org.assertj.core.api.Assertions.assertThat;

@RunWith(SpringRunner.class)
@SpringBootTest
public class HotelRepositoryTest {
    @Autowired
    private HotelRepository hotelRepository;

    @Test
    public void saveHotel() {
        Hotel hotel = new Hotel("zxc","zxc","zxc","zxc");
        assertThat(hotel.getId()).isNull();
        hotel = hotelRepository.save(hotel);
        assertThat(hotel.getId()).isNotNull();
        assertThat(hotel.getId()).isNotZero();
        assertThat(hotelRepository.findOne(hotel.getId())).isNotNull();
    }
}

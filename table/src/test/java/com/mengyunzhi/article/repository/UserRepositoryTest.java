package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.entity.User;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;

import static org.assertj.core.api.Assertions.assertThat;

@RunWith(SpringRunner.class)
@SpringBootTest
public class UserRepositoryTest {
    @Autowired
    private UserRepository userRepository;

    @Test
    public void save()
    {
        User user = new User();
        user.setUsername("zhangyoushan");
        user.setPassword("123");
        userRepository.save(user);
        assertThat(user.getId()).isNotNull();
    }
}
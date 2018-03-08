package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.ArticleApplicationTests;
import com.mengyunzhi.article.entity.User;
import org.junit.Test;
import org.springframework.beans.factory.annotation.Autowired;

import static org.assertj.core.api.Assertions.assertThat;

public class UserRepositoryTest extends ArticleApplicationTests {
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
package com.mengyunzhi.article.repository;

import com.mengyunzhi.article.entity.User;
import org.springframework.data.repository.CrudRepository;

public interface UserRepository extends CrudRepository<User, Long>{
}

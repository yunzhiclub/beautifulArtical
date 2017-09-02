package com.mengyunzhi.article;

import com.mengyunzhi.article.repository.User;
import com.mengyunzhi.article.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.ApplicationListener;
import org.springframework.context.event.ContextRefreshedEvent;
import org.springframework.core.Ordered;
import org.springframework.stereotype.Component;

import java.util.logging.Logger;

/**
 * 在项目初始化的时候增加数据
 */
@Component
public class ApiInitDataListener implements ApplicationListener<ContextRefreshedEvent>, Ordered {
    private Logger logger = Logger.getLogger(ApiInitDataListener.class.getName());

    // 自动加载application.properties中的配置项:spring.jpa.hibernate.ddl-auto
    @Value("${spring.jpa.hibernate.ddl-auto}")
    protected String jpaDdlAuto;

    @Autowired
    protected UserRepository userRepository;

    @Override
    public void onApplicationEvent(ContextRefreshedEvent contextRefreshedEvent) {
        logger.info("初始化系统管理员");
        addUser();
    }

    /**
     * 在初始化时的执行顺序，数值超小，执行超靠前。
     *
     * @return
     */
    @Override
    public int getOrder() {
        return HIGHEST_PRECEDENCE + 10;
    }

    public void addUser() {
        User user = new User();
        user.setUsername("admin");
        user.setPassword("admin");
        userRepository.save(user);
    }
}

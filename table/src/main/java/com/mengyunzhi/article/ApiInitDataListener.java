package com.mengyunzhi.article;

import com.mengyunzhi.article.repository.Paragraph;
import com.mengyunzhi.article.repository.ParagraphRepository;
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

    @Autowired
    protected ParagraphRepository paragraphRepository;

    @Override
    public void onApplicationEvent(ContextRefreshedEvent contextRefreshedEvent) {
        logger.info("初始化系统管理员");
        addUser();
        addParagraph();
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

    public void addParagraph() {
        //增加九大服务
        Paragraph paragraph = new Paragraph();
        paragraph.setTitle("九大服务");
        paragraph.setContent("");
        paragraph.setBeforeAttraction(true);
        paragraphRepository.save(paragraph);
        //六大品质
        Paragraph paragraph1 = new Paragraph();
        paragraph1.setTitle("六大品质");
        paragraph1.setBeforeAttraction(true);
        paragraph1.setContent("");
        paragraphRepository.save(paragraph1);
        Paragraph paragraph2 = new Paragraph();
        paragraph2.setTitle("报价说明");
        paragraph2.setContent("");
        paragraph2.setBeforeAttraction(false);
        paragraphRepository.save(paragraph2);
        Paragraph paragraph3 = new Paragraph();
        paragraph3.setTitle("费用包括");
        paragraph3.setContent("");
        paragraph3.setBeforeAttraction(false);
        paragraphRepository.save(paragraph3);
        Paragraph paragraph4 = new Paragraph();
        paragraph4.setTitle("费用不包括");
        paragraph4.setContent("");
        paragraph4.setBeforeAttraction(false);
        paragraphRepository.save(paragraph4);
    }
}

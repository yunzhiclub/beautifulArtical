package com.mengyunzhi.article;

import com.mengyunzhi.article.entity.Paragraph;
import com.mengyunzhi.article.repository.ParagraphRepository;
import com.mengyunzhi.article.entity.User;
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
        paragraph.setWeight(5);
        paragraph.setContent(
                "<ul class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\">\n" +
                        "    <li>\n" +
                        "        <p>\n" +
                        "             全程商务专车，专业当地华人双语导游\n" +
                        "        </p>\n" +
                        "    </li>\n" +
                        "    <li>\n" +
                        "        <p>\n" +
                        "            独立成团，不与陌生人拼团\n" +
                        "        </p>\n" +
                        "    </li>\n" +
                        "    <li>\n" +
                        "        <p>\n" +
                        "            真正纯玩品质，承诺0购物0自费\n" +
                        "        </p>\n" +
                        "    </li>\n" +
                        "    <li>\n" +
                        "        <p>\n" +
                        "            导游带您深入小众美景，去除不安全地带\n" +
                        "        </p>\n" +
                        "    </li>\n" +
                        "    <li>\n" +
                        "        <p>\n" +
                        "            全程甄选酒店，安全舒适 \n" +
                        "        </p>\n" +
                        "    </li>\n" +
                        "    <li>\n" +
                        "        <p>\n" +
                        "            私家尊享，7* 24小时专属旅行管家<br/>\n" +
                        "        </p>\n" +
                        "    </li>\n" +
                        "</ul>");
        paragraph.setIsBeforeAttraction(0);
        paragraphRepository.save(paragraph);
        //六大品质
        Paragraph paragraph1 = new Paragraph();
        paragraph1.setTitle("六大品质");
        paragraph1.setWeight(4);
        paragraph1.setIsBeforeAttraction(1);
        paragraph1.setContent("<ul class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\">\n" +
                "    <li>\n" +
                "        <p>\n" +
                "            更省心：不用你操心，机票酒店活动签证租车...，麻烦的是全都有人包办。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n" +
                "            更个性：行程随便调，量身打造玩啥你说了算，满意再付全款。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n" +
                "            更舒心：专业更靠谱，100+位资深专业定制师，让你行程不留遗憾。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n" +
                "            更自由：不在人挤人，定制专属路线，旅行团去不了的地方你能去。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n" +
                "            更划算：不花冤枉钱，九项服务一价全包，定制的服务，跟团的价格。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n" +
                "            更安全：全程有保障，专属行后保障团队，遇到问题有人管出行不担心。<br/>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "</ul>");
        paragraphRepository.save(paragraph1);
        Paragraph paragraph3 = new Paragraph();
        paragraph3.setWeight(3);
        paragraph3.setTitle("费用包括");
        paragraph3.setContent("<ul class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\">\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>酒店星级：全程4星酒店，两间三人间，含早餐。注意，欧洲三人间可能是三张单人床，也可能是一张大床加一张沙发床或折叠床，或者是两张单人床加一个沙发床或折叠床，以酒店根据入住情况安排为准。</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>全程晚数：13晚住宿，详细信息以一下“酒店安排”为准。</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>用餐：早餐：酒店内西式自助早餐，正餐自理（导游会推荐用餐）。</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>交通：7-9座位旅游车，优秀司机兼导游服务，六人用车，用车时间：（9.21-23及9.25-27及10.1全天用车，4号巴黎送机）</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>保险：中意财险申根无忧环球旅行综合保障钻石款（15-17天）/6人。</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>司导全程小费。</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>司导全程用餐补助。</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>司导全程住宿补助。</span>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            <span>司导服务费，车辆燃油费、过路费、高速费、停车费、进城费。</span><br/>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "</ul>");
        paragraph3.setIsBeforeAttraction(0);
        paragraphRepository.save(paragraph3);
        Paragraph paragraph4 = new Paragraph();
        paragraph4.setWeight(2);
        paragraph4.setTitle("费用不包括");
        paragraph4.setContent("<ul class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\">\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            以上费用未提及包括的其他费用\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            大小机票\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            门票\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            客人在境外的任何个人费用\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            根据欧盟规定司导每天工作十小时，超时需要支付加班费。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            英国加班费：司导每小时50英镑（15-17座司导每小时60英镑），司导分团，司机和导游每小时100英镑。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            西葡加班费：司导每小时50欧元，司导分团，司机和导游每小时140欧元，但不足两小时按两小时收费（只限前两小时加班）。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            其他欧洲国家的加班费，司导每小时50欧元，司导分团，司机和导游每小时100欧元.\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            欧洲国家加班费不足每小时，按整小时收费。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            公务费用，邀请费用。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            单间差费用：已包含。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            如报价时不包含景点门票，活动内容等费用或导游陪同入内项目，如需要导游一同前往，请支付导游陪同所产生的费用（如门票、船票、火车票、缆车费等）。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            酒店内电话、传真、洗熨、收费电视、饮料等费用。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            服务项目未提到的其他一切收费，如特种门票（夜总会、博览会、缆车等）。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            洗衣、理发、电话、饮料、烟酒、付费电视、行李搬运等私人费用。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            旅游费用不包括因旅游者违约、自身过错、自由活动期间内引起的人身或财产损失。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            欧洲的一些城市会收取城市税，入住酒店时会代收取，根据不同星际位置等价格也不同，预计1-3欧/人/天。<br/>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "</ul>");
        paragraph4.setIsBeforeAttraction(0);
        paragraphRepository.save(paragraph4);
        Paragraph paragraph2 = new Paragraph();
        paragraph2.setTitle("报价说明");
        paragraph2.setWeight(1);
        paragraph2.setContent("<ul class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\">\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            米兰的Hiton Garden Inn Milan North 酒店的最晚免费取消日期为2017年9月12日12:00之前。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            未按预定日期入住酒店（NO SHOW）,收取全部酒店费用。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            9座一下用车出发前15天取消，收取用车费用的20%，出发前十五天内收取50%，出发前7天内取消收取用车费用100%。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            9座以上旅游用车一旦预定无法取消，收取用车费用的100%。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            以签证拒绝取消保险，取消日期在保险生效日期前一个工作日，每份保险收取服务费用20元。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            报价单最晚付款日期内未付款报价视为无效，需要重新核算资源价格。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            酒店双人间可入住两人，酒店内会放置两张床或一张大床。放置两套床上用品视酒店情况安排；双人间若住三人，根据酒店要求可能会加收第三人加床早餐等费用，由此产生的费用有客人直接付给前台。\n" +
                "        </p>\n" +
                "    </li>\n" +
                "    <li>\n" +
                "        <p>\n"+
                "            酒店单人间可入住一人，房间内设置一张单人床，也可能是一张大床或两张单人床，视酒店情况安排。三人间可入住三人，房间内设三张单人床，或一张大床加一个沙发床（折叠床），或者两张单人床加一张沙发床（折叠床），视酒店情况安排。四人间可入住四人，房间内设四张单人床，或两间间的套房<br/>\n" +
                "        </p>\n" +
                "    </li>\n" +
                "</ul>");
        paragraph2.setIsBeforeAttraction(0);
        paragraphRepository.save(paragraph2);
    }
}

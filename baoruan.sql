/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50638
 Source Host           : localhost
 Source Database       : baoruan

 Target Server Type    : MySQL
 Target Server Version : 50638
 File Encoding         : utf-8

 Date: 07/26/2020 21:46:42 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `sf_admin`
-- ----------------------------
DROP TABLE IF EXISTS `sf_admin`;
CREATE TABLE `sf_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户序号',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `nickname` varchar(20) NOT NULL COMMENT '姓名',
  `userpsw` varchar(50) NOT NULL COMMENT '密码',
  `group` tinyint(5) NOT NULL COMMENT '用户组',
  `islock` tinyint(1) NOT NULL COMMENT '是否锁定 0锁定，1不锁定',
  `lastip` varchar(16) NOT NULL COMMENT '上次登录ip',
  `lasttime` int(20) NOT NULL COMMENT '最后登录时间',
  `lastouttime` int(20) NOT NULL COMMENT '上次登出时间',
  `loginno` int(20) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `addtime` int(20) NOT NULL COMMENT '用户添加时间',
  `city` int(20) NOT NULL COMMENT '所属城市',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `isreg` int(1) NOT NULL DEFAULT '0' COMMENT '是否通过验证',
  `avatar` varchar(50) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `sf_admin`
-- ----------------------------
BEGIN;
INSERT INTO `sf_admin` VALUES ('1', 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '0.0.0.0', '1595764241', '1595764232', '11', '1532572873', '0', 'admin@qq.com', '1', null);
COMMIT;

-- ----------------------------
--  Table structure for `sf_cate`
-- ----------------------------
DROP TABLE IF EXISTS `sf_cate`;
CREATE TABLE `sf_cate` (
  `id` int(20) NOT NULL,
  `cate_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sf_lists`
-- ----------------------------
DROP TABLE IF EXISTS `sf_lists`;
CREATE TABLE `sf_lists` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `picurl` varchar(200) DEFAULT NULL,
  `contents` text,
  `type` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sf_msgboard`
-- ----------------------------
DROP TABLE IF EXISTS `sf_msgboard`;
CREATE TABLE `sf_msgboard` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `mytel` varchar(11) CHARACTER SET utf8 DEFAULT NULL COMMENT '预留电话',
  `myemail` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '预留邮箱',
  `adtime` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '添加时间',
  `myname` varchar(10) CHARACTER SET utf8 DEFAULT NULL COMMENT '姓名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `sf_pic`
-- ----------------------------
DROP TABLE IF EXISTS `sf_pic`;
CREATE TABLE `sf_pic` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `picurl` varchar(200) DEFAULT NULL,
  `picurl_small` varchar(200) DEFAULT NULL,
  `pic_addr` varchar(200) DEFAULT NULL,
  `type` int(5) DEFAULT NULL COMMENT '1 首页头图 2首页行业 3首页list 4别人使用 5产品介绍头图 6产品介绍 7产品介绍服务优势 8产品介绍适用行业 9定制开发头图 10定制开发tab 11定制开发服务流程 12定制开发客户案例 13关于我们头图',
  `pic_title` varchar(100) DEFAULT NULL,
  `pic_content` text,
  `position` tinyint(5) DEFAULT NULL COMMENT '1背景 2底部',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `sf_pic`
-- ----------------------------
BEGIN;
INSERT INTO `sf_pic` VALUES ('6', '/Uploads/pic/2020-07-25/5f1bb011b9563.jpg', null, null, '5', '111xxxxxxx11', null, null), ('11', '/Uploads/pic/2020-07-18/5f12c8e6c4178.jpg', null, null, '5', '1111111111', null, null), ('12', '/Uploads/pic/2020-07-25/5f1bb4ac60f78.jpg', null, null, '9', '定制开发111', '345432543', null), ('16', '/Uploads/pic/2020-07-25/5f1bea7da9ac7.png', null, null, '13', null, null, null), ('17', '/Uploads/pic/2020-07-25/5f1ba9cc628a5.png', null, null, '1', null, null, null), ('18', '/Uploads/pic/2020-07-25/5f1ba9d54f23d.jpg', null, null, '1', null, null, null), ('19', '/Uploads/pic/2020-07-25/5f1ba9efba5f3.png', null, null, '1', null, null, null), ('20', '/Uploads/pic/2020-07-25/5f1baa3e788b6.png', null, null, '2', '这个是介绍', '&lt;p&gt;介绍一下&lt;/p&gt;&lt;p&gt;介绍222&lt;/p&gt;&lt;p&gt;介绍333&lt;/p&gt;', null), ('21', '/Uploads/pic/2020-07-25/5f1baa61edf56.png', null, null, '2', '介绍2', '&lt;p&gt;再介绍一下&lt;/p&gt;&lt;p&gt;解析122&lt;/p&gt;&lt;p&gt;结论222&lt;/p&gt;', null), ('22', '/Uploads/pic/2020-07-25/5f1baa8e234f7.jpg', null, null, '2', '这个也可以介绍', '&lt;p&gt;较少的&lt;/p&gt;&lt;p&gt;零零落落&lt;/p&gt;&lt;p&gt;u 贴哦&lt;/p&gt;', null), ('24', '/Uploads/pic/2020-07-25/5f1baaf7d1b69.png', null, null, '3', null, null, null), ('25', '/Uploads/pic/2020-07-25/5f1bab01bad44.png', null, null, '3', null, null, null), ('26', '/Uploads/pic/2020-07-25/5f1bab0a040b5.png', null, null, '3', null, null, null), ('27', '/Uploads/pic/2020-07-25/5f1bab1550497.png', null, null, '3', null, null, null), ('28', '/Uploads/pic/2020-07-25/5f1bab21b374c.png', null, null, '3', null, null, null), ('29', '/Uploads/pic/2020-07-25/5f1bab2c13c5e.png', null, null, '3', null, null, null), ('30', '/Uploads/pic/2020-07-25/5f1bab35f06cc.png', null, null, '3', null, null, null), ('31', '/Uploads/pic/2020-07-25/5f1bab432a1c6.png', null, null, '4', null, null, null), ('32', '/Uploads/pic/2020-07-25/5f1bab528228f.png', null, null, '4', null, null, null), ('33', '/Uploads/pic/2020-07-25/5f1bab71336b3.jpg', null, null, '4', null, null, null), ('34', '/Uploads/pic/2020-07-25/5f1bab84be664.png', null, null, '4', null, null, null), ('35', '/Uploads/pic/2020-07-25/5f1bab98281bf.jpg', null, null, '4', null, null, null), ('36', '/Uploads/pic/2020-07-25/5f1babbb9c881.jpg', null, null, '4', null, null, null), ('37', '/Uploads/pic/2020-07-25/5f1bab528228f.png', null, null, '4', null, null, null), ('38', '/Uploads/pic/2020-07-25/5f1babbb9c881.jpg', null, null, '4', null, null, null), ('39', '/Uploads/pic/2020-07-25/5f1bab84be664.png', null, null, '4', null, null, null), ('40', '/Uploads/pic/2020-07-25/5f1bab432a1c6.png', null, null, '4', null, null, null), ('41', null, null, null, '6', '冰红茶', '行在内存中但是可以持久化到磁盘\r\n所以在对不同数据集进行高速读写时需要权衡内存\r\n因为数据量不能大于硬件内存\r\n在内存数据库方面的另一个优点', null), ('42', null, null, null, '6', '数据类型', '际项目中比较常用的是 string\r\nhash 如果你是 Rs 中高级用户', null), ('43', null, null, null, '6', '持久化机制是什么', '化方式： 是指用数据集快照的方式半持久化模式) \r\n记录 r数据库的所有键值对\r\n在某个时间点将数据件\r\n 持久化结束后', null), ('44', null, null, null, '6', '能问题和解决方案', '最好不要写内存快照\r\n如果 Master 写内存快照\r\nsave 命令调度 rdbSave函数\r\n会阻塞主线程的工作\r\n当快照比较大时对性能影响是非常大的', null), ('45', '/Uploads/pic/2020-07-25/5f1bb16947c77.png', null, null, '7', '技术运维支持', '平台设施和运维团队时刻待命为你提供尽可能的尽量避免在压力很大的主库上增加从尽量避免在压力很大的主库上增加从', null), ('46', '/Uploads/pic/2020-07-25/5f1bb2902bbb2.png', null, null, '7', '高性价比服务', '为了主从复制的速度和连接的稳定性， Master 和 Slave 最好在同一个局域网', null), ('47', '/Uploads/pic/2020-07-25/5f1bb2a698666.png', null, null, '7', '过期键的删除策略', '过期键的删除策略过期键的删除策略过期键的删除策略过期键的删除策略', null), ('48', '/Uploads/pic/2020-07-25/5f1bb2bf06fcc.png', null, null, '7', '回收策略', '中挑选最近最少使用的数据淘汰中挑选最近最少使用的数据淘汰', null), ('49', '/Uploads/pic/2020-07-25/5f1bb3472c2a7.png', null, null, '8', '医疗', null, null), ('50', '/Uploads/pic/2020-07-25/5f1bb36b16bbb.png', null, null, '8', '定制', null, null), ('51', '/Uploads/pic/2020-07-25/5f1bb375b7ec4.png', null, null, '8', '11112', null, null), ('52', '/Uploads/pic/2020-07-25/5f1bb3abb21f4.png', null, null, '8', 'test', null, null), ('53', '/Uploads/pic/2020-07-25/5f1bb4f5768dc.png', '/Uploads/pic/2020-07-25/5f1bb4f578272.png', null, '10', '定制开发1', '淘汰策略 | 淘汰策略', null), ('54', '/Uploads/pic/2020-07-25/5f1bb8210f18d.png', '/Uploads/pic/2020-07-25/5f1bb82111049.png', null, '10', '定制开发222', '432534343', null), ('55', '/Uploads/pic/2020-07-25/5f1bb86cee062.png', '/Uploads/pic/2020-07-25/5f1bb86cef47c.png', null, '10', '6543', '期时间的数据集', null), ('56', '/Uploads/pic/2020-07-25/5f1bb8aa52df8.png', null, null, '11', '淘汰策略', '从已设置过期时间的数据集从已设置过期时间的数据集', null), ('57', '/Uploads/pic/2020-07-25/5f1bb921c20a1.png', null, null, '11', '的同步机制了', '的同步机制了的同步机制了', null), ('58', '/Uploads/pic/2020-07-25/5f1bb9383f2a2.png', null, null, '11', '客户端都有哪些', '特软企鹅我太软弱', null), ('59', '/Uploads/pic/2020-07-25/5f1bb95b3b1d2.png', null, null, '12', '置键的过期时间的同', '置键的过期时间的同', null), ('60', '/Uploads/pic/2020-07-25/5f1bb9aa252a4.png', null, null, '12', '不要写内存快', '不要写内存快', null), ('61', '/Uploads/pic/2020-07-25/5f1bb95b3b1d2.png', null, null, '12', '65265425', '524654', null), ('62', '/Uploads/pic/2020-07-25/5f1bb8aa52df8.png', null, null, '12', '定制开发222', '定制开发222', null), ('63', '/Uploads/pic/2020-07-25/5f1beabe25958.png', '/Uploads/pic/2020-07-25/5f1beabe272f8.png', null, '14', '公司介绍', '南京宝銮信息科技有限公司是一家优秀的企业信息平台解决方案提供商，为企业提供学习平台+内容+运营服务的专业化解决方案。平台采用专业的互联网技术，以大数据和智能应用为发展路径，实现企业信息化管理。客户领域包括教育、地产、汽车、医药、医疗、金融、营销、公关、会展、电商、快消、零售、能源、政府等。宝銮科技具有优秀的设计和开发能力、严格的流程和质量控制体系，人员配置完备，可为客户提供商业咨询、需求分析、设计、开发、测试、运维、运营和推广等专业的、高质量的解决方案，帮助客户解决在互联网的系统建设和运营发展中的诸多问题!为企业打造先进、易用、定制化的学习平台。', '1'), ('64', '/Uploads/pic/2020-07-25/5f1beae9278de.png', '/Uploads/pic/2020-07-25/5f1beae9292f6.png', null, '14', '品牌理念', '公司基于互联网技术、构建企业人员知识成长生态系统、助企业实现人才领先，人员快速成长。为企业提供专业的企业培训系统.在线考试、线上培训、社区互动等,创建您的企业大学。', '2');
COMMIT;

-- ----------------------------
--  Table structure for `sf_sys`
-- ----------------------------
DROP TABLE IF EXISTS `sf_sys`;
CREATE TABLE `sf_sys` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '基本设置id',
  `webname` varchar(20) DEFAULT NULL COMMENT '网站名称',
  `webtitle` varchar(50) DEFAULT NULL COMMENT '网站标题',
  `weblogo` varchar(50) DEFAULT NULL COMMENT '网站logo',
  `icp` varchar(20) DEFAULT NULL,
  `companyname` varchar(20) DEFAULT NULL COMMENT '公司名称',
  `tel` varchar(15) DEFAULT NULL COMMENT '电话',
  `hremail` varchar(40) DEFAULT NULL COMMENT '招聘邮箱',
  `email` varchar(40) DEFAULT NULL COMMENT 'email',
  `qq` int(15) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL COMMENT '公司地址',
  `keywords` varchar(80) DEFAULT NULL COMMENT '关键字',
  `description` varchar(100) DEFAULT NULL COMMENT '网页描述',
  `baiduapi` varchar(40) DEFAULT NULL COMMENT '百度api',
  `aboutus` text COMMENT '关于我们',
  `map` varchar(40) DEFAULT NULL COMMENT '定点',
  `cityid` int(20) DEFAULT NULL COMMENT '城市id',
  `art_pic` varchar(80) DEFAULT NULL COMMENT '文章默认图片',
  `lp_pic` varchar(80) DEFAULT NULL COMMENT '默认楼盘图片',
  `domain` varchar(100) DEFAULT NULL COMMENT '用户默认头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `sf_sys`
-- ----------------------------
BEGIN;
INSERT INTO `sf_sys` VALUES ('1', 'xx', '江苏xx网', '/Uploads/pic/2020-07-26/5f1d70e033c61.jpeg', '苏ICP备15060946号', '江苏xx有限公司', '025-11112222', '', 'xxx@123.com', '0', '1111nanjing1111', '', '', '478wObXOssnSH1jSC9vO0USOubpise6M', '&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	江苏脉度网络科技有限公司&lt;span&gt;www.51sfang.com&lt;/span&gt;（以下简称&lt;span&gt;“&lt;/span&gt;江苏脉度·徐州上房网&lt;span&gt;”&lt;/span&gt;）坐落在中国淮海中心城市——徐州云龙核心区，毗邻徐州云龙区政府和地铁&lt;span&gt;1&lt;/span&gt;号线庆丰路站。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	公司使命：用技术让美好走进生活；让百姓住好房（徐州上房）。\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	公司愿景：成为卓越高效的互联网技术营销推广专家；\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;成为徐州以交付为核心驱动的地产专业信息服务平台。&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	公司价值观：技术第一，客户至上；服务卓越，执行高效；真诚真棒，敢拼敢闯。公司口号：脉度一下，就能搞定；买房卖房，关注交房，就上上房。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	我们的产品：网络品牌推广、脉度网络品牌维护、徐州上房公众号等。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	我们深耕地产行业&lt;span&gt;&amp;amp;&lt;/span&gt;互联网服务业多年，拥有强大的地产行业数据库资源和业脉资源。秉承&lt;span&gt;“&lt;/span&gt;技术第一，客户至上，共创共赢&lt;span&gt;”&lt;/span&gt;的经营理念，用技术让美好世界走进百姓视野和生活，江苏脉度以成为淮海经济区乃至全国卓越高效的信息及互联网资源整合服务机构为企业发展战略目标与方向，凭借强大的技术优势和资源整合能力，与众多媒体及平台形成联盟合作伙伴。 &lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	江苏脉度以&lt;span&gt;“&lt;/span&gt;网络品牌推广&lt;span&gt;”&lt;/span&gt;和&lt;span&gt;“&lt;/span&gt;脉度网络品牌维护&lt;span&gt;”&lt;/span&gt;为主营业务线，两大业务线以&lt;span&gt;SEM+SEO&lt;/span&gt;技术为主，以最快捷的方式提供给用户最真实的房地产互联网资讯服务，为客户提供最专业的互联网营销推广解决方案；同时利用专业资源和优势，以让老百姓住好房为使命，让老百姓“买房放心，上房省心”，全心全力运作“徐州上房”平台。通过细分行业的成熟解决方案帮助政府解决民生问题，帮助房地产商提升消费者体验。 &lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	江苏脉度·徐州上房网，以强大领先的搜索平台和卓越技术为后盾，竭诚为全国房企和大型企事业单位提供专业的互联网服务，欢迎合作洽谈。诚邀优秀人才加盟脉度共创辉煌。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;', '118.790663,32.04812', null, null, null, 'www.baidu.com');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

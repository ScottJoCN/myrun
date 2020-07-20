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

 Date: 07/19/2020 23:57:53 PM
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
INSERT INTO `sf_admin` VALUES ('1', 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2', '1', '0.0.0.0', '1595086412', '1595086392', '9', '1532572873', '0', 'admin@qq.com', '1', null);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `sf_pic`
-- ----------------------------
BEGIN;
INSERT INTO `sf_pic` VALUES ('6', '/Uploads/pic/2020-07-18/5f12981ecbc06.png', null, null, '5', '11111', null, null), ('11', '/Uploads/pic/2020-07-18/5f12c8e6c4178.jpg', null, null, '5', '1111111111', null, null), ('12', '/Uploads/pic/2020-07-18/5f12c9684b3d8.png', null, null, '9', '定制开发', null, null), ('16', '/Uploads/pic/2020-07-18/5f1302d08ce7e.jpg', null, null, '13', null, null, null);
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
  `user_pic` varchar(80) DEFAULT NULL COMMENT '用户默认头像',
  `listkw` varchar(80) DEFAULT NULL COMMENT '列表页关键词',
  `listdes` varchar(100) DEFAULT NULL COMMENT '列表页描述',
  `artkw` varchar(80) DEFAULT NULL COMMENT '新闻页关键词',
  `artdes` varchar(100) DEFAULT NULL COMMENT '新闻页描述',
  `mapkw` varchar(80) DEFAULT NULL COMMENT '地图找房关键词',
  `mapdes` varchar(100) DEFAULT NULL COMMENT '地图找房描述',
  `artbg` varchar(80) DEFAULT NULL COMMENT '默认文章背景图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `sf_sys`
-- ----------------------------
BEGIN;
INSERT INTO `sf_sys` VALUES ('1', 'xx', '江苏xx网', null, '苏ICP备15060946号', '江苏xx有限公司', '19911112222', '', 'xxx@123.com', '0', '', '', '', '478wObXOssnSH1jSC9vO0USOubpise6M', '&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	江苏脉度网络科技有限公司&lt;span&gt;www.51sfang.com&lt;/span&gt;（以下简称&lt;span&gt;“&lt;/span&gt;江苏脉度·徐州上房网&lt;span&gt;”&lt;/span&gt;）坐落在中国淮海中心城市——徐州云龙核心区，毗邻徐州云龙区政府和地铁&lt;span&gt;1&lt;/span&gt;号线庆丰路站。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	公司使命：用技术让美好走进生活；让百姓住好房（徐州上房）。\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	公司愿景：成为卓越高效的互联网技术营销推广专家；\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;成为徐州以交付为核心驱动的地产专业信息服务平台。&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	公司价值观：技术第一，客户至上；服务卓越，执行高效；真诚真棒，敢拼敢闯。公司口号：脉度一下，就能搞定；买房卖房，关注交房，就上上房。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	我们的产品：网络品牌推广、脉度网络品牌维护、徐州上房公众号等。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	我们深耕地产行业&lt;span&gt;&amp;amp;&lt;/span&gt;互联网服务业多年，拥有强大的地产行业数据库资源和业脉资源。秉承&lt;span&gt;“&lt;/span&gt;技术第一，客户至上，共创共赢&lt;span&gt;”&lt;/span&gt;的经营理念，用技术让美好世界走进百姓视野和生活，江苏脉度以成为淮海经济区乃至全国卓越高效的信息及互联网资源整合服务机构为企业发展战略目标与方向，凭借强大的技术优势和资源整合能力，与众多媒体及平台形成联盟合作伙伴。 &lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	江苏脉度以&lt;span&gt;“&lt;/span&gt;网络品牌推广&lt;span&gt;”&lt;/span&gt;和&lt;span&gt;“&lt;/span&gt;脉度网络品牌维护&lt;span&gt;”&lt;/span&gt;为主营业务线，两大业务线以&lt;span&gt;SEM+SEO&lt;/span&gt;技术为主，以最快捷的方式提供给用户最真实的房地产互联网资讯服务，为客户提供最专业的互联网营销推广解决方案；同时利用专业资源和优势，以让老百姓住好房为使命，让老百姓“买房放心，上房省心”，全心全力运作“徐州上房”平台。通过细分行业的成熟解决方案帮助政府解决民生问题，帮助房地产商提升消费者体验。 &lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p class=&quot;MsoNormal&quot; align=&quot;left&quot; style=&quot;margin-left:-7.05pt;text-align:left;text-indent:2em;&quot;&gt;\r\n	江苏脉度·徐州上房网，以强大领先的搜索平台和卓越技术为后盾，竭诚为全国房企和大型企事业单位提供专业的互联网服务，欢迎合作洽谈。诚邀优秀人才加盟脉度共创辉煌。&lt;span&gt;&lt;/span&gt; \r\n&lt;/p&gt;', '118.790663,32.04812', null, null, null, null, null, null, '', '', null, null, null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

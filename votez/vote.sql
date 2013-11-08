# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# 主机: wb-pc:3306
# 生成日期: 2004 年 09 月 22 日 12:39
# 服务器版本: 4.0.18
# PHP 版本: 4.3.6
# 
# 数据库 : `vote`
# 

# --------------------------------------------------------

#
# 表的结构 `choice`
#

CREATE TABLE `choice` (
  `id` int(11) NOT NULL auto_increment,
  `choice` varchar(100) NOT NULL default '',
  `extends` int(11) default NULL,
  `IsDefault` set('a','b') default NULL,
  `num` int(80) default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `choice` (`choice`)
) TYPE=MyISAM AUTO_INCREMENT=22 ;

#
# 导出表中的数据 `choice`
#

INSERT INTO `choice` VALUES (14, '还是挺好的', 4, 'b', 0);
INSERT INTO `choice` VALUES (18, '其他网站', 7, 'b', 0);
INSERT INTO `choice` VALUES (15, '还是不错', 4, 'b', 1);
INSERT INTO `choice` VALUES (16, '我喜欢今天', 4, 'b', 1);
INSERT INTO `choice` VALUES (17, '今天是我有生以来最美的', 4, 'a', 4);
INSERT INTO `choice` VALUES (19, '友情链接', 7, 'b', 1);
INSERT INTO `choice` VALUES (20, '朋友介绍', 7, 'b', 1);
INSERT INTO `choice` VALUES (21, '广告信息', 7, 'b', 1);

# --------------------------------------------------------

#
# 表的结构 `manage`
#

CREATE TABLE `manage` (
  `names` varchar(20) NOT NULL default '',
  `pass` varchar(80) NOT NULL default '',
  `id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='管理帐号';

#
# 导出表中的数据 `manage`
#

INSERT INTO `manage` VALUES ('it-zero', '8bb493a4f0b6da7b5414b3dd86860897', 1);

# --------------------------------------------------------

#
# 表的结构 `title`
#

CREATE TABLE `title` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL default '',
  `choice` set('a','b') default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

#
# 导出表中的数据 `title`
#

INSERT INTO `title` VALUES (4, '今天大家好吗！', 'b');
INSERT INTO `title` VALUES (7, '您是从什么地方听说本站的？', 'a');

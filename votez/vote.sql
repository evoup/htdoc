# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# ����: wb-pc:3306
# ��������: 2004 �� 09 �� 22 �� 12:39
# �������汾: 4.0.18
# PHP �汾: 4.3.6
# 
# ���ݿ� : `vote`
# 

# --------------------------------------------------------

#
# ��Ľṹ `choice`
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
# �������е����� `choice`
#

INSERT INTO `choice` VALUES (14, '����ͦ�õ�', 4, 'b', 0);
INSERT INTO `choice` VALUES (18, '������վ', 7, 'b', 0);
INSERT INTO `choice` VALUES (15, '���ǲ���', 4, 'b', 1);
INSERT INTO `choice` VALUES (16, '��ϲ������', 4, 'b', 1);
INSERT INTO `choice` VALUES (17, '����������������������', 4, 'a', 4);
INSERT INTO `choice` VALUES (19, '��������', 7, 'b', 1);
INSERT INTO `choice` VALUES (20, '���ѽ���', 7, 'b', 1);
INSERT INTO `choice` VALUES (21, '�����Ϣ', 7, 'b', 1);

# --------------------------------------------------------

#
# ��Ľṹ `manage`
#

CREATE TABLE `manage` (
  `names` varchar(20) NOT NULL default '',
  `pass` varchar(80) NOT NULL default '',
  `id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='�����ʺ�';

#
# �������е����� `manage`
#

INSERT INTO `manage` VALUES ('it-zero', '8bb493a4f0b6da7b5414b3dd86860897', 1);

# --------------------------------------------------------

#
# ��Ľṹ `title`
#

CREATE TABLE `title` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL default '',
  `choice` set('a','b') default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

#
# �������е����� `title`
#

INSERT INTO `title` VALUES (4, '�����Һ���', 'b');
INSERT INTO `title` VALUES (7, '���Ǵ�ʲô�ط���˵��վ�ģ�', 'a');

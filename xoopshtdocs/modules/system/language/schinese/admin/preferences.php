<?php
// $Id: preferences.php,v 1.1 2008/02/28 12:17:36 cvs Exp $
//%%%%%%	Admin Module Name  AdminGroup 	%%%%%
// dont change
define("_AM_DBUPDATED",_MD_AM_DBUPDATED);

define("_MD_AM_SITEPREF","ƫ������");
define("_MD_AM_SITENAME","��վ����");
define("_MD_AM_SLOGAN","��վ�ں�");
define("_MD_AM_ADMINML","����Ա�ʼ���ַ");
define("_MD_AM_LANGUAGE","Ĭ������");
define("_MD_AM_STARTPAGE","��վ��ҳ����ģ��");
define("_MD_AM_NONE","��");
define("_MD_AM_SERVERTZ","����������ʱ��");
define("_MD_AM_DEFAULTTZ","��վĬ��ʱ��");
define("_MD_AM_DTHEME","Ĭ������");
define("_MD_AM_THEMESET","������");
define("_MD_AM_ANONNAME","�����û�������");
define("_MD_AM_MINPASS","������С����");
define("_MD_AM_NEWUNOTIFY","���»�Աע��ʱ���ʼ�֪ͨ");
define("_MD_AM_SELFDELETE","�����Աɾ���Լ����ʺ�");
define("_MD_AM_LOADINGIMG","��ʾ����������...����̬ͼƬ");
define("_MD_AM_USEGZIP","ʹ��gzipѹ��");
define("_MD_AM_UNAMELVL","��Ա�ʺŵ���������");
define("_MD_AM_STRICT","�ϸ�ֻ������ĸ�����֣�");
define("_MD_AM_MEDIUM","�е�");
define("_MD_AM_LIGHT","���ɣ���ʹ�ú��֣�");
define("_MD_AM_USERCOOKIE","���û�Ա�ʺŵ�cookies���ơ������û�Ա����ÿ�ζ������û���");
define("_MD_AM_USERCOOKIEDSC","ʹ�ô�cookie�����Ա�ʺ�һ�꣨�����ԱԸ�⣩������д�cookie����¼���Զ���ʾ��Ա�ʺš�");
define("_MD_AM_USEMYSESS","ʹ�ö���session");
define("_MD_AM_USEMYSESSDSC","�Ƿ�ʹ�ö���session.");
define("_MD_AM_SESSNAME","Session����");
define("_MD_AM_SESSNAMEDSC","Session���ƣ����ö���session�������ã�");
define("_MD_AM_SESSEXPIRE","Session��Чʱ��");
define("_MD_AM_SESSEXPIREDSC","���sesssion��Чʱ��[�Է��Ӽ�]��ֻ�е����ö���seesionʱ����Ч��");
define("_MD_AM_BANNERS","���ú�����");
define("_MD_AM_MYIP","����IP��ַ");
define("_MD_AM_MYIPDSC","���㰴ͳ�ƽ������������IP�����");
define("_MD_AM_ALWDHTML","����ʹ�õ�HTML��ǩ��");
define("_MD_AM_INVLDMINPASS","������С���ȡ�");
define("_MD_AM_INVLDUCOOK","��Ч���ʺ�cookies���ơ�");
define("_MD_AM_INVLDSCOOK","��Ч��session cookies���ơ�");
define("_MD_AM_INVLDSEXP","��Ч��sessionʱ�䡣");
define("_MD_AM_ADMNOTSET","����Ա�ʼ���ַδ���á�");
define("_MD_AM_YES","��");
define("_MD_AM_NO","��");
define("_MD_AM_DONTCHNG","�����޸ģ�");
define("_MD_AM_REMEMBER","Ϊ����ϵͳ�������޸��ļ����뽫���ļ���������Ϊ666��");
define("_MD_AM_IFUCANT","����޷��޸����ԵĻ��ͱ����ֶ��޸��ļ���");


define("_MD_AM_COMMODE","Ĭ�ϵ�������ʾģʽ");
define("_MD_AM_COMORDER","Ĭ�ϵ���������ʽ");
define("_MD_AM_ALLOWHTML","������������ʹ��HTML");
define("_MD_AM_DEBUGMODE","�򿪲��ģʽ");
define("_MD_AM_DEBUGMODEDSC","�򿪺󽫻���ʾ������Ϣ����վ��ʽ���к���رմ˹��ܡ�");
define("_MD_AM_AVATARALLOW","�����ϴ�ͷ��");
define('_MD_AM_AVATARMP','���ٷ���������');
define('_MD_AM_AVATARMPDSC','ֻ�з�����������Ŀ�Ļ�Ա�ſ����ϴ�ͷ��');
define("_MD_AM_AVATARW","ͷ������ȣ����أ�");
define("_MD_AM_AVATARH","ͷ�����߶ȣ����أ�");
define("_MD_AM_AVATARMAX","ͷ���ļ���С���ֽڣ�");
define("_MD_AM_AVATARCONF","�Զ���ͷ������");
define("_MD_AM_CHNGUTHEME","�޸����л�Ա������");
define("_MD_AM_NOTIFYTO","��Աע��ʱ֪ͨȺ��");
define("_MD_AM_ALLOWTHEME","�����Աѡ������");
define("_MD_AM_ALLOWIMAGE","�����Ա�ڷ������������ʾͼƬ");

define("_MD_AM_USERACTV","��Ҫͨ��Email�����ʺ�");
define("_MD_AM_AUTOACTV","ע����Զ�����");
define("_MD_AM_ADMINACTV","�ɹ���Ա�ֶ�����");
define("_MD_AM_ACTVTYPE","ѡ���Աע��ļ��ʽ");
define("_MD_AM_ACTVGROUP","ѡ�񼤻��ʼ�Ҫ���͵�Ⱥ��");
define("_MD_AM_ACTVGROUPDSC","ֻ��ѡ�� '�ɹ���Ա����' ����Ч");
define('_MD_AM_USESSL', 'ʹ��SSL���ܷ�ʽ��¼?');
define('_MD_AM_SSLPOST', 'SSL Post������');
define('_MD_AM_SSLPOSTDSC', 'ͨ��POST����Sessionֵʱ���õı���������������˽�˱�������ѡһ�������ײµ������ơ�');
define('_MD_AM_DEBUGMODE0','�ر�');
define('_MD_AM_DEBUGMODE1','PHP ���');
define('_MD_AM_DEBUGMODE2','MySQL/Blocks ���');
define('_MD_AM_DEBUGMODE3','Smarty ģ����');
define('_MD_AM_MINUNAME', '�ʺ���С����');
define('_MD_AM_MAXUNAME', '�ʺ���󳤶�');
define('_MD_AM_GENERAL', '������������');
define('_MD_AM_USERSETTINGS', '��Ա��������');
define('_MD_AM_ALLWCHGMAIL', '�����Ա�޸��ʼ���ַ');
define('_MD_AM_ALLWCHGMAILDSC', '');
define('_MD_AM_IPBAN', 'IP����');
define('_MD_AM_BADEMAILS', '�û�ע��ʱ����ʹ�õ�Email');
define('_MD_AM_BADEMAILSDSC', '���� <strong>|</strong> �ָ��ؼ��ʣ������ִ�Сд����ʹ��regex��');
define('_MD_AM_BADUNAMES', '���õ��ʺ�����');
define('_MD_AM_BADUNAMESDSC', '���� <strong>|</strong> �ָ��ؼ��ʣ������ִ�Сд����ʹ��regex��');
define('_MD_AM_DOBADIPS', '����IP���ι���');
define('_MD_AM_DOBADIPSDSC', 'ʹ�ô�IP��ַ���û����޷����������վ');
define('_MD_AM_BADIPS', '����Ҫ���ε�IP��ַ��<br />���� <strong>|</strong> �ָ��ؼ��ʣ������ִ�Сд����ʹ��regex��');
define('_MD_AM_BADIPSDSC', '^aaa.bbb.ccc ���ܾ���aaa.bbb.ccc��ͷ��IP��ַ�ķ��ʡ�<br />aaa.bbb.ccc$ ���ܾ���aaa.bbb.ccc��β��IP��ַ�ķ��ʡ� <br />aaa.bbb.ccc ���ܾ�����aaa.bbb.ccc��IP��ַ�ķ��ʡ�');
define('_MD_AM_PREFMAIN', 'ƫ������');
define('_MD_AM_METAKEY', 'Meta �ؼ���');
define('_MD_AM_METAKEYDSC', '�ؼ��ֱ�����ڴ���վ�����Ҫ���ݡ�ͨ���ɶ���ؼ�����ɡ��������ؼ������ð�Ƕ��ţ�,���������� XOOP, PHP, mySQL, portal system��');
define('_MD_AM_METARATING', 'Meta �ȼ�');
define('_MD_AM_METARATINGDSC', '�ȼ������������վ����ʺ����估���ݵĵȼ�');
define('_MD_AM_METAOGEN', 'һ��');
define('_MD_AM_METAO14YRS', '14��');
define('_MD_AM_METAOREST', '����');
define('_MD_AM_METAOMAT', '����');
define('_MD_AM_METAROBOTS', 'Meta ������');
define('_MD_AM_METAROBOTSDSC', '�����˱��������֪��������ʲô�������ݿɹ�����������');
define('_MD_AM_INDEXFOLLOW', '����������');
define('_MD_AM_NOINDEXFOLLOW', '�޵���������');
define('_MD_AM_INDEXNOFOLLOW', '������������');
define('_MD_AM_NOINDEXNOFOLLOW', '�޵�����������');
define('_MD_AM_METAAUTHOR', 'Meta ����');
define('_MD_AM_METAAUTHORDSC', '�������ƣ�email����ַ��');
define('_MD_AM_METACOPYR', 'Meta ��Ȩ');
define('_MD_AM_METACOPYRDSC', '��Ȩ�������������վҳ���ļ�����ѭ�İ�Ȩ˵����');
define('_MD_AM_METADESC', 'Meta ����');
define('_MD_AM_METADESCDSC', '��������൱����վ��ժҪ��ͨ����һС����������');
define('_MD_AM_METAFOOTER', 'Meta ��ҳ��');
define('_MD_AM_FOOTER', 'ҳβע��');
define('_MD_AM_FOOTERDSC', 'ȷ��ʹ��������ַ, ����������ģ��ҳ�潫��������������');
define('_MD_AM_CENSOR', '���д�����');
define('_MD_AM_DOCENSOR', '�������д�����');
define('_MD_AM_DOCENSORDSC', '����ѡ��򿪣�������������е����д�� ��Ϊ��������վ�ٶȣ�����رմ�ѡ�');
define('_MD_AM_CENSORWRD', '���д���');
define('_MD_AM_CENSORWRDDSC', '����Ҫ���õ����д��<br />ʹ�� <strong>|</strong> �ֿ��������ִ�Сд��');
define('_MD_AM_CENSORRPLC', '���д��ｫ��ȡ��Ϊ:');
define('_MD_AM_CENSORRPLCDSC', '���д��ｫ�ᱻȡ��������������ַ�');

define('_MD_AM_SEARCH', '����ѡ��');
define('_MD_AM_DOSEARCH', '����ȫվ����');
define('_MD_AM_DOSEARCHDSC', '��������ȫվ��Χ�����ݡ�');
define('_MD_AM_MINSEARCH', '�ؼ�����С����');
define('_MD_AM_MINSEARCHDSC', '����ʱ������������');
define('_MD_AM_MODCONFIG', 'ģ������ѡ��');
define('_MD_AM_DSPDSCLMR', '��ʾע����������');
define('_MD_AM_DSPDSCLMRDSC', 'ѡ���ǣ�����ע��ҳ����ʾ��������');
define('_MD_AM_REGDSCLMR', 'ע����������');
define('_MD_AM_REGDSCLMRDSC', '��Աע��ʱ��ʾ������');
define('_MD_AM_ALLOWREG', '�����»�Աע��');
define('_MD_AM_ALLOWREGDSC', '������ٽ����»�Ա����ѡ����');
define('_MD_AM_THEMEFILE', '��/themes/yourtheme/templates����ģ���ģ���ļ�');
define('_MD_AM_THEMEFILEDSC', '�������ѡ������/themes/yourtheme/templates���˸��£�ģ���.htmlģ���ļ����Զ����£������ټ���ʹ�û���ľ��ļ�����վ��ʽ���к���رոù��ܡ�');
define('_MD_AM_CLOSESITE', '�ر���վ');
define('_MD_AM_CLOSESITEDSC', '��վ�رպ�ֻ�����б���ȨȺ��Ļ�Ա���ܽ��롣');
define('_MD_AM_CLOSESITEOK', 'ѡ����վ�رպ���Ȩ����Ļ�ԱȺ��');
define('_MD_AM_CLOSESITEOKDSC', '��վ��߹���Ȩ�߲������ơ�');
define('_MD_AM_CLOSESITETXT', '��վ�ر�ԭ��');
define('_MD_AM_CLOSESITETXTDSC', '��վ�ر�ʱ�ö������Զ���ʾ����ҳ��');
define('_MD_AM_SITECACHE', '��վ����');
define('_MD_AM_SITECACHEDSC', '���汣����վ�����ݣ���ģ�顢����ȡ�');
define('_MD_AM_MODCACHE', 'ģ�黺��');
define('_MD_AM_MODCACHEDSC', '����ģ�����ݡ�');
define('_MD_AM_NOMODULE', 'û��ģ��ʹ�û��档');
define('_MD_AM_DTPLSET', 'Ĭ��ģ����');
define('_MD_AM_SSLLINK', 'SSL��¼ҳ���URL');

// added for mailer
define("_MD_AM_MAILER","�ʼ�����");
define("_MD_AM_MAILER_MAIL","");
define("_MD_AM_MAILER_SENDMAIL","");
define("_MD_AM_MAILER_","");
define("_MD_AM_MAILFROM","�����˵�ַ");
define("_MD_AM_MAILFROMDESC","");
define("_MD_AM_MAILFROMNAME","����������");
define("_MD_AM_MAILFROMNAMEDESC","");
// RMV-NOTIFY
define("_MD_AM_MAILFROMUID","����");
define("_MD_AM_MAILFROMUIDDESC","��ϵͳ����һ������Ϣ����ʾ�ķ���������");
define("_MD_AM_MAILERMETHOD","�ʼ��ַ���ʽ");
define("_MD_AM_MAILERMETHODDESC","���ڷַ��ʼ��ķ�ʽ��Ĭ��Ϊ��mail�����������ַ�ʽ�޷���������������Ҫ��������ʽ");
define("_MD_AM_SMTPHOST","SMTP������");
define("_MD_AM_SMTPHOSTDESC","�������ӵ�SMTP�������б�.");
define("_MD_AM_SMTPUSER","SMTPAuth���û���");
define("_MD_AM_SMTPUSERDESC","�ܶ�SMTP����������������֤���ܣ����������Ļ�Ա��");
define("_MD_AM_SMTPPASS","SMTPAuth������");
define("_MD_AM_SMTPPASSDESC","��������SMTP�������Ļ�Ա������");
define("_MD_AM_SENDMAILPATH","sendmail·��");
define("_MD_AM_SENDMAILPATHDESC","��������Web�������ϵ�Sendmail���򣨻��������ʼ����������򣩵�·��.");
define("_MD_AM_THEMEOK","�û���ѡ����");
define("_MD_AM_THEMEOKDSC","�ɹ��û�ѡ�������");


// Xoops Authentication constants
define("_MD_AM_AUTH_CONFOPTION_XOOPS", "XOOPS ���ݿ�");
define("_MD_AM_AUTH_CONFOPTION_LDAP", "��׼LDAPĿ¼");
define("_MD_AM_AUTH_CONFOPTION_AD", "΢��Ŀ¼ &copy");
define("_MD_AM_AUTHENTICATION", "��֤��ʽ����");
define("_MD_AM_AUTHMETHOD", "��֤����");
define("_MD_AM_AUTHMETHODDESC", "ѡ��Ի�Ա��ݽ�����֤�ķ�����");
define("_MD_AM_LDAP_MAIL_ATTR", "LDAP - �ʼ�������");
define("_MD_AM_LDAP_MAIL_ATTR_DESC","LDAP Ŀ¼�����ʼ�������ơ�");
define("_MD_AM_LDAP_NAME_ATTR","LDAP - ͨ����(CN)��������");
define("_MD_AM_LDAP_NAME_ATTR_DESC","LDAPĿ¼��ͨ����(Common Name)�������ơ�");
define("_MD_AM_LDAP_SURNAME_ATTR","LDAP - �յ�������");
define("_MD_AM_LDAP_SURNAME_ATTR_DESC","LDAPĿ¼����(Surname)��������.");
define("_MD_AM_LDAP_GIVENNAME_ATTR","LDAP - ����������");
define("_MD_AM_LDAP_GIVENNAME_ATTR_DSC","LDAPĿ¼����(Given Name)��������.");
define("_MD_AM_LDAP_BASE_DN", "LDAP - ����������");
define("_MD_AM_LDAP_BASE_DN_DESC", "LDAPĿ¼���Ļ���������(Distinguished Name).");
define("_MD_AM_LDAP_PORT","LDAP - �˿ں�");
define("_MD_AM_LDAP_PORT_DESC","��¼LDAPĿ¼�������Ķ˿ںš�");
define("_MD_AM_LDAP_SERVER","LDAP - ��������");
define("_MD_AM_LDAP_SERVER_DESC","LDAPĿ¼������������.");

define("_MD_AM_LDAP_MANAGER_DN", "LDAP ����Ա������");
define("_MD_AM_LDAP_MANAGER_DN_DESC", "������������Ա��������");
define("_MD_AM_LDAP_MANAGER_PASS", "LDAP ����Ա������");
define("_MD_AM_LDAP_MANAGER_PASS_DESC", "������������Ա������");
define("_MD_AM_LDAP_VERSION", "LDAP �汾Э��");
define("_MD_AM_LDAP_VERSION_DESC", "LDAP �汾Э�飺2��3");
define("_MD_AM_LDAP_USERS_BYPASS", "���ؽ���LDAP��֤���˻�");
define("_MD_AM_LDAP_USERS_BYPASS_DESC", "ʹ��XOOPS�������֤��ʽ");

define("_MD_AM_LDAP_USETLS", " Use TLS connection");
define("_MD_AM_LDAP_USETLS_DESC", "Use a TLS (Transport Layer Security) connection. TLS use standard 389 port number<BR>" .
								  " and the LDAP version must be set to 3.");

define("_MD_AM_LDAP_LOGINLDAP_ATTR","����������Ա��LDAP����");
define("_MD_AM_LDAP_LOGINLDAP_ATTR_D","������������DN��ѡ�������õ�¼��Ϊ��ʱ, ������XOOPS�еĵ�¼��һ��");
define("_MD_AM_LDAP_LOGINNAME_ASDN", "����������ʹ�õĵ�¼��");
define("_MD_AM_LDAP_LOGINNAME_ASDN_D", "LDAP����������DN����ʹ�õ�XOOPS��¼�����磺uid=<loginname>,dc=xoops,dc=org��<br />���̲߳�������������ֱ����Ŀ¼�������ж�ȡ");

define("_MD_AM_LDAP_FILTER_PERSON", "LDAP��ѯ�û�������������");
define("_MD_AM_LDAP_FILTER_PERSON_DESC", "�û�������Ա������LDAP��������@@loginname@@ ���滻Ϊ�û��ĵ�¼��������㲻�������������գ�" .
		"<br />���磺(&(objectclass=person)(samaccountname=@@loginname@@)) for AD" .
		"<br />���磺(&(objectclass=inetOrgPerson)(uid=@@loginname@@)) for LDAP");

define("_MD_AM_LDAP_DOMAIN_NAME", "����");
define("_MD_AM_LDAP_DOMAIN_NAME_DESC", "Windows���������Ŀ¼��������ADS����NT��������");

define("_MD_AM_LDAP_PROVIS", "�Զ�������Ա�ʺ�");
define("_MD_AM_LDAP_PROVIS_DESC", "���û��XOOPS�û����ݿ⣬��ô���Զ�����");

define("_MD_AM_LDAP_PROVIS_GROUP", "Ԥ���»�ԱȺ��");
define("_MD_AM_LDAP_PROVIS_GROUP_DSC", "�»�Ա���ᱻ�趨Ϊ��Ⱥ��");

define("_MD_AM_LDAP_FIELD_MAPPING_ATTR", "Xoops-Auth server fields mapping");
define("_MD_AM_LDAP_FIELD_MAPPING_DESC", "Describe here the mapping between the Xoops database field and the LDAP Authentication system field." .
		"<br><br>Format [Xoops Database field]=[Auth system LDAP attribute]" .
		"<br>for example : email=mail" .
		"<br>Separate each with a |" .
		"<br><br>!! For advanced users !!");
		
define("_MD_AM_LDAP_PROVIS_UPD", "Maintain xoops account provisionning");
define("_MD_AM_LDAP_PROVIS_UPD_DESC", "The Xoops User account is always synchronized with the Authentication Server");



?>
<?php
// �趨 cookie
setcookie("cookie[three]", "cookiethree",time()+60*60*24*30);
setcookie("cookie[two]", "cookietwo",time()+60*60*24*30);
setcookie("cookie[one]", "cookieone",time()+60*60*24*30);

// ˢ��ҳ�����ʾ����
if (isset($_COOKIE['cookie'])) {
   foreach ($_COOKIE['cookie'] as $name => $value) {
       echo "$name : $value <br />\n";
   }
}
?> 
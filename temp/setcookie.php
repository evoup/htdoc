<?php
// 设定 cookie
setcookie("cookie[three]", "cookiethree",time()+60*60*24*30);
setcookie("cookie[two]", "cookietwo",time()+60*60*24*30);
setcookie("cookie[one]", "cookieone",time()+60*60*24*30);

// 刷新页面后，显示出来
if (isset($_COOKIE['cookie'])) {
   foreach ($_COOKIE['cookie'] as $name => $value) {
       echo "$name : $value <br />\n";
   }
}
?> 
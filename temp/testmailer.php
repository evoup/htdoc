<?php
$to      ='evoex@126.com';
$subject = '����';
$message = '����';
$headers = 'From:test@test.cn' . "\r\n" .
   'Reply-To: test@test.cn' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers);

?>
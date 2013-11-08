<?
session_start();
session_unregister("admins");
session_unregister("votes");
session_destroy();
echo "<meta http-equiv='refresh' content='0;url=admin.php'>";
?>
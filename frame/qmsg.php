<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 短消息提示 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<script language=JavaScript1.2>
<!--
function boom(n) {
if (window.top.moveBy) {
for (i = 10; i > 0; i--) {
for (j = n; j > 0; j--) {
window.top.moveBy(0,i);
window.top.moveBy(i,0);
window.top.moveBy(0,-i);
window.top.moveBy(-i,0);
         }
      }
   }
}

function callJS(jsStr) {
  return eval(jsStr)
}
// End -->
</script>


</HEAD>

<BODY onload=callJS('boom(3)')>





<div style='margin-top:30px'>你有新短消息，请注意查收。</div><BR>
<div align=center style='margin-top:20px'><A HREF="javascript:window.close()" onclick='void(0);'>查收</A></div>
</BODY>
</HTML>

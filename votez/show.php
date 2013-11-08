<?
include ("const.php");
top("查看投票结果");
link_data();
$query1="select * from title where id=".$_GET["id"];
$result1=mysql_query($query1);
$row1=mysql_fetch_array($result1);
?>
<script language="javascript"></script>
<style type="text/css">
<!--
body {
	background-color: #EEEEEE;
}
.style4 {color: #CC0000}
.style5 {color: #000000}
.style7 {color: #666666}
-->
</style><table width="80%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td height="249" valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="48" bgcolor="#CECFCE"><div align="center" class="style5">关于“<?=$row1["title"]?> ”的主题投票结果如下： </div></td>
      </tr>
    </table>
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="179">
            <?
			$query2="select * from choice where extends=".$_GET["id"];
			$result2=mysql_query($query2);
			$query3="select sum(num) as nums from choice where extends=".$_GET["id"];
			$result3=mysql_query($query3);
			if($row3=mysql_fetch_array($result3))
			{
			   $nums=$row3["nums"];
			}
			while ($row2=mysql_fetch_array($result2))
			{
			?>
            <table width="100%"  border="0" cellpadding="0" cellspacing="4" bgcolor="#FFFFFF">
              <tr>
                <td width="19%" height="21"><span class="style7">
                  <?=$row2["choice"];?></span></td>
                <td width="61%"><img src="dot1.gif" width="<?=number_format((($row2["num"]/$nums)*100),2);?>%" height="15"></td>
                <td width="9%"><div align="right"><span class="style4"><?=number_format((($row2["num"]/$nums)*100),2);?></span>%</div></td>
                <td width="11%"><div align="right"><span class="style4"><?=$row2["num"];?></span>人</div></td>
              </tr>
            </table>
<?
}
?>
          </td>
        </tr>
      </table>
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="#FFFFFF"><div align="right">共有<font color="#CC0000"><?=$nums;?></font>人参与投票</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<div align="center"><br>
  <br>
  <a href="javascript:window.close()" class="red">关闭窗口</a><br>
  <br>
</div>
<center>
  <a href="http://www.it-zero.com" class="top">IT零距离版权所有</a> 技术支持:<a href="mailto:admin@it-zero.com" class="red">先知</a>
</center>


<? include("const.php"); 
session_start();
$_SESSION["logincode"]=rand("1000","9999");
top("��ӭ����IT����롪��ͶƱ����ϵͳ��PHPV1.0��");
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form name="form1" method="post" action="pass.php">
  <table width="31%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CECFCE">
    <tr>
      <td height="34" bgcolor="#CCCCCC"><div align="center">�����½</div></td>
    </tr>
  </table>
  <table width="31%"  border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <td bgcolor="#FFFFFF"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td width="32%"><div align="right">�����ʺţ�</div></td>
          <td colspan="2"><input name="names" type="text" class="inputs" id="names"></td>
        </tr>
        <tr>
          <td><div align="right">�������룺</div></td>
          <td colspan="2"><input name="password" type="password" class="inputs" id="password"></td>
        </tr>
        <tr>
          <td><div align="right">��֤�룺</div></td>
          <td width="20%"><input name="codes" type="text" class="inputs" id="codes" size="6" value=""></td>
          <td width="48%"><span style="color: #FF0000">��֤�룺</span><? echo $_SESSION["logincode"]; ?></td>
        </tr>
        <tr>
          <td colspan="3">            <div align="center">
              <input name="Submit" type="submit" class="inputs" value="�ύ">
      &nbsp;&nbsp;
              <input name="Submit2" type="reset" class="inputs" value="����">
              <input name="actions" type="hidden" id="actions" value="1">
</div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>


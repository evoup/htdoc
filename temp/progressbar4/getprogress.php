<?php
if(isset($_GET['progress_key'])) {
echo "0";//if don put zero will return null obj error
  $status = apc_fetch('upload_'.$_GET['progress_key']);
  //echo $status['filename'];
  if ($status['done']!=0) {//��ô���񲻵�?
	  echo "100";
	  }
  else{
  echo iconv("gb2312","utf-8",$status['filename']).'|'.$status['total'].'|'.$status['current'].'|'.$status['current']/$status['total']*70;//ԭ����100������60�����ˣ�ģ��������
  }

}
?>

<?php
if(isset($_GET['progress_key'])) {
  $status = apc_fetch('upload_'.$_GET['progress_key']);

  print_r($status);

 // $status = apc_fetch('uploadtest_'.$_GET['progress_key']);

 // $status['key'] = 'upload_'.$_GET['progress_key'];
 // print_r($status);
}
?>

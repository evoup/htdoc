
<?php
////��ȫ:�鿴classupload���297��,ȥ���������һ������,��Ϊ��֧��forefox��֪��δʲô
require_once("../include/class_UPLOAD.php");
include("../include/dbclass.php");
//�õ����ע�룬���Կ�������һҳ��session��ȥ
session_start();
if(!isset($_SESSION['xid'])){

$_SESSION['xid']=intval($_GET['id']);
echo $_SESSION['xid'];
}
$upload =& new UPLOAD_FILES();
if($_FILES){
  foreach($_FILES as $key => $file){
    $upload->set("name",$file["name"]); // Uploaded file name.
    $upload->set("type",$file["type"]); // Uploaded file type.
    $upload->set("tmp_name",$file["tmp_name"]); // Uploaded tmp file name.
    $upload->set("error",$file["error"]); // Uploaded file error.
    $upload->set("size",$file["size"]); // Uploaded file size.
    $upload->set("fld_name",$key); // Uploaded file field name.
    $upload->set("max_file_size",409600); // Max size allowed for uploaded file in bytes = 400 KB.
    $upload->set("supported_extensions",array("gif" => "image/gif" ,"jpg" => "image/pjpeg","jpeg" => "image/pjpeg" ,"png" => "image/x-png")); // Allowed extensions and types for uploaded file.
    $upload->set("randon_name",true); // Generate a unique name for uploaded file? bool(true/false).
    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
    $upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).
    $upload->set("dst_dir",$_SERVER["DOCUMENT_ROOT"]."/upload_dir/"); // Destination directory for uploaded files.$upload->set("dst_dir",$_SERVER["DOCUMENT_ROOT"]."/upload_dir/"); // Destination directory for uploaded files.
    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
  }
}
?>
<html>
<head>
<title>��ȫ�ϴ�</title>
<style>
.TABLE,TD,INPUT{
  font-size:11px;
  font-family:Verdana,Arial;  
}
</style>
<script type="text/javascript">
	function preview(){
		var x = document.getElementById("fi");
var y = document.getElementById("pic4");
		if(!x || !x.value) return;
		if(x.value.indexOf(".jpg")<0
			&& x.value.indexOf(".jpeg")<0
			&& x.value.indexOf(".gif")<0){
			alert("��ѡ����ƺ�����ͼ���ļ���");
		}else{
			//alert("ͨ��");
y.src = "file://" + x.value;
		}
	}
</script>











</head>
<body>
<form name="upload" id="upload" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
<table cellpadding=2 cellspacing=2 border=0 align=center>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
      <table cellpadding=2 cellspacing=2 border=0 align=center>
        <tr>
          <td><b>ѡ���ϴ��ļ���</b></td>
          <td>
            <input type="file" name="file" id="fi" size="20" onchange="preview()">
          </td>
        </tr>
      </table>
    </td>
  </tr>
	  <tr><td><img id="pic4"  width=98 alt="ͼƬ�ڴ���ʾ"  SRC="../image/preview_wait.gif" >
</td></tr>
 
    <td align=center><input type="submit" name="submit" id="submit" value="�ϴ�"></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
    <?php

    if($upload->succeed_files_track || $upload->fail_files_track){
     print "<pre>";
     print "<b>�ϴ��ɹ�:<br></b>";
     print_r($upload->succeed_files_track); 
print_r("###########################".$upload->succeed_files_track[0]["msg"]);
$new_file=$upload->succeed_files_track[0]["new_file_name"];
print_r("<br>###########################".$upload->succeed_files_track[0]["new_file_name"]);
     print "<b>�ϴ�ʧ��:<br></b>";
     print_r($upload->fail_files_track); 
     print "</pre>";

if($upload->succeed_files_track){
$sql="INSERT INTO usrimg(src) VALUES('{$new_file}')";
$db->query($sql);
echo $_SESSION['xid'];
$xid=$_SESSION['xid'];
$sql1="select * from usrimg where src='{$new_file}';";
echo $sql1;
$row5=$db->getfirst($sql1);
echo "row5[0]��".$row5[id];
$sql2="update usr t1,usrimg t2 set t1.usrimg='{$row5[id]}' where t1.id='{$xid}'";
$db->query($sql2);}

    }
    ?>
    </td>
  </tr>
</table>
</form>
</body>
</html>
<?php
define('IN_EVP', true);
error_reporting(7);
////安全:查看classupload里的297行,去掉了下面的一个条件,因为不支持forefox不知道未什么
require_once("../include/class_UPLOAD.php");
include("../include/dbclass.php");
include('../include/snapshot.class.php');
include('../include/session_mysql.php');
//该点存在注入，可以考虑在上一页存session进去
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
    //$upload->set("max_file_size",409600); // Max size allowed for uploaded file in bytes = 400 KB.
$upload->set("max_file_size",809600); // Max size allowed for uploaded file in bytes = 400 KB.
    $upload->set("supported_extensions",array("gif" => "image/gif" ,"jpg" => "image/pjpeg","jpeg" => "image/pjpeg" ,"png" => "image/x-png")); // Allowed extensions and types for uploaded file.
    $upload->set("randon_name",true); // Generate a unique name for uploaded file? bool(true/false).
    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
    $upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).
    $upload->set("dst_dir",$_SERVER["DOCUMENT_ROOT"]."/upload_dir/"); // Destination directory for uploaded files.$upload->set("dst_dir",$_SERVER["DOCUMENT_ROOT"]."/upload_dir/"); // Destination directory for uploaded files.
    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
$dst=$upload->dstname;//evoupV1.1在原来classupload.php里加了个dstname成员，引用它得到生成的目标文件名
  }
}




if (isset($_POST['submit'])) {

	//LOGO FILE UPLOADED
	$myimage = new ImageSnapshot;
	//If loading from an uploaded file:
	//必须获得服务段的文件,而不是采取同样的自动全局变量,因为上传只允许一次操作
//$myimage->ImageField = $_FILES['file'];
$myimage->ImageFile = $_SERVER['DOCUMENT_ROOT'] . '/upload_dir/'.$dst;
	//OR if loading from a variable containing the image contents:
	//$myimage->ImageContents = $my_image_var;
	$myimage->Width = 62;
	$myimage->Height =  62;
	$myimage->Resize = true; //if false, snapshot takes a portion from the unsized image.
	$myimage->ResizeScale = 100;
	$myimage->Position = center;
	$myimage->Compression = 95;
	
	/*
	//getting img into var
	if ($myimage->ProcessImage() !== false) {
		$img = $myimage->GetImageContents();
	} else {
		echo $myimage->Err;
	}
	*/
	
	//saving to a filename
	if ($myimage->SaveImageAs('../upload_dir/thumb/'.$dst)) {
		//echo '<div style="width:' . $_POST['Width'] . 'px;height:' . $_POST['Height'] . 'px;border:1px solid #f00;"><img src="temp.jpg" border="0" /></div>';
	} else {
		echo $myimage->Err;
	}
	//END LOGO FILE UPLOADED
} else {
	$_POST['Width'] = 100;
	$_POST['Height'] = 75;
	$_POST['ResizeScale'] = 100;
}



?>

<html >
<head>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<title>安全上传</title>
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
			&& x.value.indexOf(".gif")<0
			&& x.value.indexOf(".JPG")<0
		&& x.value.indexOf(".JPEG")<0
		&& x.value.indexOf(".GIF")<0)
		{
			alert("您选择的似乎不是图像文件。");
		}else{
			//alert("通过");
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
          <td><b>选择上传文件：</b></td>
          <td>
            <input type="file" name="userfile" id="fi" size="20" onChange="preview()">
          </td>
        </tr>
      </table>
    </td>
  </tr>
	  <tr><td><img id="pic4"  width="98" alt="图片在此显示"  SRC="../image/preview_wait.gif" >
</td></tr>
 
    <td align="center"><input type="submit" name="submit" id="submit" value="上传"></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
    <?php

    if($upload->succeed_files_track || $upload->fail_files_track){
     print "<pre>";
     print "<b>上传成功:<br></b>";
     print_r($upload->succeed_files_track); 
print_r("###########################".$upload->succeed_files_track[0]["msg"]);
$new_file=$upload->succeed_files_track[0]["new_file_name"];
print_r("<br>###########################".$upload->succeed_files_track[0]["new_file_name"]);
     print "<b>上传失败:<br></b>";
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
echo "row5[0]是".$row5[id];
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
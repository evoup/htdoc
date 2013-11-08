<?php
define('IN_EVP', true);
//include("../include/checkpostandget.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
include("../include/common.php");
session_start();
if ($_SESSION['admin_id']!=1) die("没有权限!");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">body{ font-size:12px}a:visited{color: #000000}</style>

</head>
<body style="margin-top:0px; margin-left:0px;">
<?php
if ($_POST['postit']=='postit'){

include ("../include/class_UPLOAD.php");
$upload =& new UPLOAD_FILES();

if($_FILES){
  foreach($_FILES as $key => $file){

    $upload->set("name",$file["name"]); // Uploaded file name.
    $upload->set("realname",$file["name"]); // 修改，结合自己的库，需要显示实际附件的中文名
    $upload->set("type",$file["type"]); // Uploaded file type.
    
    $upload->set("tmp_name",$file["tmp_name"]); // Uploaded tmp file name.
    
    $upload->set("error",$file["error"]); // Uploaded file error.
    
    $upload->set("size",$file["size"]); // Uploaded file size.
    
    $upload->set("fld_name",$key); // Uploaded file field name.
    
    $upload->set("max_file_size",4096000); // Max size allowed for uploaded file in bytes = 4000 KB.
    
    $upload->set("supported_extensions",array("gif" => "image/gif" ,"jpg" => "image/pjpeg","jpeg" => "image/pjpeg" ,"png" => "image/x-png")); // Allowed extensions and types for uploaded file.
    
    $upload->set("randon_name",TRUE); // Generate a unique name for uploaded file? bool(true/false).

    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false)
    
    $upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).

    $upload->set("dst_dir",$_SERVER["DOCUMENT_ROOT"]."/upload_dir/thumb/"); // Destination directory for uploaded files.

    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
  }
}

$upname= $upload->returnOKfilename();//返回了上传成功后的图片

echo "<script>alert(parent.document.getElementById('thumb_art_pic').value='".$upname."')</script>";

	echo "处理上传OK!<a href='".$_SERVER['PHP_SELF']."'>返回</a>";
	//上传完成了
	//上传完成后出现一个按钮让用户返回后再次上传
}
else{
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="file"/>&nbsp;&nbsp;<input type="submit" value="上传" />
&nbsp;&nbsp;(最大20M)
<input type=hidden value=postit name=postit>

<?php
}
?>
</body>
</html>
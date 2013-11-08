
<link rel=stylesheet href="../css/css.css" type="text/css">


<?php
/**
 * Example file
 * 
 * @author   Marcos Thiago <fabismt@yahoo.com.br>
 * @version  1.0
 * @since    06/2004
 * @package  UPLOAD_FILES
 */

require_once("../include/class_UPLOAD.php");
$upload =& new UPLOAD_FILES();

if($_FILES){
  foreach($_FILES as $key => $file){

    $upload->set("name",$file["name"]); // Uploaded file name.

    $upload->set("type",$file["type"]); // Uploaded file type.
    
    $upload->set("tmp_name",$file["tmp_name"]); // Uploaded tmp file name.
    
    $upload->set("error",$file["error"]); // Uploaded file error.
    
    $upload->set("size",$file["size"]); // Uploaded file size.
    
    $upload->set("fld_name",$key); // Uploaded file field name.
    
    $upload->set("max_file_size",40960); // Max size allowed for uploaded file in bytes = 40 KB.
    
    $upload->set("supported_extensions",array("gif" => "image/gif" ,"jpg" => "image/pjpeg","jpeg" => "image/pjpeg" ,"png" => "image/x-png")); // Allowed extensions and types for uploaded file.
    
    $upload->set("randon_name",FALSE); // Generate a unique name for uploaded file? bool(true/false).

    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
    
    $upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).

    $upload->set("dst_dir",$_SERVER["DOCUMENT_ROOT"]."/upload_dir/"); // Destination directory for uploaded files.

    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
  }
}
?>
<html>
<head>
<title>SIMPLE SECURE UPLOAD</title>
<style>
.TABLE,TD,INPUT{
  font-size:11px;
  font-family:Verdana,Arial;  
}
</style>
</head>
<body>
<form name="upload" id="upload" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">



<TABLE class=adminoption width="86%" align=center>
<TBODY>
<TR>
<TD vAlign=top align=middle width="25%">选择文件</TD>
<TD width="60%"><INPUT type=file name=newupfile[]><BR><INPUT type=file name=newupfile[]><BR><INPUT type=file name=newupfile[]><BR><INPUT type=file name=newupfile[]><BR><INPUT type=file name=newupfile[]><BR></TD></TR></TBODY></TABLE>











<table cellpadding=2 cellspacing=2 border=0 align=center>
  <tr><td>&nbsp;</td></tr>
  
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
      <table cellpadding=0 cellspacing=0 border=0 align=center>
        <tr>
          <td><b>文件 1:</b></td>
          <td>
            <input type="file" name="file" id="file" size="20">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
      <table cellpadding=0 cellspacing=0 border=0 align=center>
        <tr>
          <td><b>文件 2:</b></td>
          <td>
            <input type="file" name="file_1" id="file_1" size="20">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
      <table cellpadding=0 cellspacing=0 border=0 align=center>
        <tr>
          <td><b>文件 3:</b></td>
          <td>
            <input type="file" name="file_2" id="file_2" size="20">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
      <table cellpadding=0 cellspacing=0 border=0 align=center>
        <tr>
          <td><b>文件 4:</b></td>
          <td>
            <input type="file" name="file_3" id="file_3" size="20">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align=center><input type="submit" name="submit" id="submit" value="Upload"></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>
    <?php
    if($upload->succeed_files_track || $upload->fail_files_track){
     // print "<pre>";
     // print "<b>Succeed Files Track Array:<br></b>";
     // print_r($upload->succeed_files_track); 
      //print "<b>Fail Files Track Array:<br></b>";
     // print_r($upload->fail_files_track); 
     // print "</pre>";
    }
    ?>
    </td>
  </tr>
</table>
</form>
</body>
</html>
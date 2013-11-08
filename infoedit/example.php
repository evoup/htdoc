<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h4>Image Upload Test</h4>
<?php
include('../include/snapshot.class.php');
if (isset($_POST['submit'])) {
	//LOGO FILE UPLOADED
	$myimage = new ImageSnapshot;
	//If loading from an uploaded file:
	$myimage->ImageField = $_FILES['userfile'];
	//OR if loading from a variable containing the image contents:
	//$myimage->ImageContents = $my_image_var;
	$myimage->Width = $_POST['Width'];
	$myimage->Height =  $_POST['Height'];
	$myimage->Resize = $_POST['Resize']; //if false, snapshot takes a portion from the unsized image.
	$myimage->ResizeScale = $_POST['ResizeScale'];
	$myimage->Position = $_POST['Position'];
	$myimage->Compression = 90;
	
	/*
	//getting img into var
	if ($myimage->ProcessImage() !== false) {
		$img = $myimage->GetImageContents();
	} else {
		echo $myimage->Err;
	}
	*/
	
	//saving to a filename
	if ($myimage->SaveImageAs('../upload_dir/thumb/temp.jpg')) {
		echo '<div style="width:' . $_POST['Width'] . 'px;height:' . $_POST['Height'] . 'px;border:1px solid #f00;"><img src="temp.jpg" border="0" /></div>';
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

<br />
<br />


<form name="test" method="post" action="" enctype="multipart/form-data">

<input type="file" name="userfile" />

<br />
<br />

thumb width: <input type="text" name="Width" value="<?php echo $_POST['Width']; ?>" size="3" />

<br />
<br />

thumb height: <input type="text" name="Height" value="<?php echo $_POST['Height']; ?>" size="3" />

<br />
<br />

Resize Image: <select name="Resize"><option value="true"<?php if ($_POST['Resize'] == 'true') { echo ' selected="selected"'; } ?>>True</option><option value="false"<?php if ($_POST['Resize'] == 'false') { echo ' selected="selected"'; } ?>>False</option></select>

<br />
<br />

Resize Scale: <select name="ResizeScale">
<?php
for ($x=100;$x >= 0;$x--) {
	$s = '';
	if ($x == $_POST['ResizeScale']) {
		$s = ' selected="selected"';
	}
	echo '<option value="' . $x . '"' . $s . '>' . $x . '</option>' . "\n";
}
?>
</select>

<br />
<br />

Snapshot Position: <select name="Position">
<option value="center"<?php if ($_POST['Position'] == 'center') { echo ' selected="selected"'; } ?>>Center</option>
<option value="random"<?php if ($_POST['Position'] == 'random') { echo ' selected="selected"'; } ?>>Random</option>
<option value="topleft"<?php if ($_POST['Position'] == 'topleft') { echo ' selected="selected"'; } ?>>Top Left</option>
<option value="topcenter"<?php if ($_POST['Position'] == 'topcenter') { echo ' selected="selected"'; } ?>>Top Center</option>
<option value="topright"<?php if ($_POST['Position'] == 'topright') { echo ' selected="selected"'; } ?>>Top Right</option>
<option value="bottomleft"<?php if ($_POST['Position'] == 'bottomleft') { echo ' selected="selected"'; } ?>>Bottom Left</option>
<option value="bottomcenter"<?php if ($_POST['Position'] == 'bottomcenter') { echo ' selected="selected"'; } ?>>Bottom Center</option>
<option value="bottomright"<?php if ($_POST['Position'] == 'bottomright') { echo ' selected="selected"'; } ?>>Bottom Right</option>
</select>

<br />
<br />

<input type="submit" name="submit" value="upload!" />

</form>


</body>
</html>

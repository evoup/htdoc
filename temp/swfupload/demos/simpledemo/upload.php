<?php
	// Work-around for setting up a session because Flash Player doesn't send the cookies
	//手工传递session_id因为flash不发送cookie
ini_set('session.save_handler', 'files'); 
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	}
	
	session_start();

	if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
		echo "There was a problem with the upload";
		exit(0);
	} else {
		echo "Flash requires that we output something or it won't fire the uploadSuccess event";
	}
?>
<?php 


global $Config ;

// SECURITY: You must explicitelly enable this "uploader". 
//
$Config['Enabled'] = true ;
//快速上传也是改成true
$Config['Enabled'] = true ;
// Path to uploaded files relative to the document root.
//$Config['UserFilesPath'] = '/UserFiles/' ;
//继续改，改成年月形式的
$todayy = date("Y");
$todaym = date("m");
//echo $todayy."-".$todaym;
$Config['UserFilesPath'] = '/UserFiles/'.$todayy.'-'.$todaym.'/' ;

// Fill the following value it you prefer to specify the absolute path for the
// user files directory. Usefull if you are using a virtual directory, symbolic
// link or alias. Examples: 'C:\\MySite\\UserFiles\\' or '/root/mysite/UserFiles/'.
// Attention: The above 'UserFilesPath' must point to the same directory.
$Config['UserFilesAbsolutePath'] = '/var/www/htdoc/UserFiles/'.$todayy.'-'.$todaym.'/' ;

// Due to security issues with Apache modules, it is reccomended to leave the
// following setting enabled.
$Config['ForceSingleExtension'] = true ;

$Config['AllowedExtensions']['File']	= array() ;
$Config['DeniedExtensions']['File']		= array('php','php2','php3','php4','php5','phtml','pwml','inc','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','com','dll','vbs','js','reg','cgi') ;

$Config['AllowedExtensions']['Image']	= array('jpg','gif','jpeg','png') ;
$Config['DeniedExtensions']['Image']	= array() ;

$Config['AllowedExtensions']['Flash']	= array('swf','fla') ;
$Config['DeniedExtensions']['Flash']	= array() ;

//$Config['AllowedExtensions']['uploadfile']= array();
//$Config['DeniedExtensions']['uploadfile']= array() ;



?>
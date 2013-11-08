<?php
include_once("lib/nusoap.php"); //插入文件
$server=new soap_server();     //生成对象
$server->configureWSDL("test_wsdl", "");
$server->wsdl->schemaTargetNamespace="urn:test_wsdl"; 
$server->register("hello", //方法名 
array( 
"name"=>"xsd:string", 
"call"=>"xsd:string", 
"tele"=>"xsd:string", 
),//输入参数 
array( 
"return"=>"xsd:string", 
),//输出参数 
"urn:test_wsdl",//名字空间
"urn:test_wsdl#hello",//名字空间#要操作的函数名 
"rpc",//style 
"encoded",//use
"This is test."//说明 
); 
//test方法实现 
function hello($name,$call,$tele) { 
if($name==""){ 
return new soap_fault("Client","","Must supply a valid name."); 
} 
return "Hello, " . $name." ".$call." ".$tele; 
} 
//Use the request to (try to) invoke the service 
$HTTP_RAW_POST_DATA=isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:""; 
$server->service($HTTP_RAW_POST_DATA);
?>
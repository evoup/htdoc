<?php
include_once("lib/nusoap.php"); //�����ļ�
$server=new soap_server();     //���ɶ���
$server->configureWSDL("test_wsdl", "");
$server->wsdl->schemaTargetNamespace="urn:test_wsdl"; 
$server->register("hello", //������ 
array( 
"name"=>"xsd:string", 
"call"=>"xsd:string", 
"tele"=>"xsd:string", 
),//������� 
array( 
"return"=>"xsd:string", 
),//������� 
"urn:test_wsdl",//���ֿռ�
"urn:test_wsdl#hello",//���ֿռ�#Ҫ�����ĺ����� 
"rpc",//style 
"encoded",//use
"This is test."//˵�� 
); 
//test����ʵ�� 
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
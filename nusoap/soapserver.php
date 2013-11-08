<?
require_once('nusoap.php');
include('soapfunc.php');
$soap = new soap_server;
$soap->register('reverse');
$soap->register('add2numbers');
$soap->register('dumpsql');
$soap->service($HTTP_RAW_POST_DATA);
?>
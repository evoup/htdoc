<?
include('nusoap.php');
$client = new soapclientnusoap('http://akata2.vicp.net/nusoap/soapserver.php');
$str = "This string will be reversed";
$params1 = array('str'=>$str);
$reversed = $client->call('reverse',$params1);
echo "If you reverse '$str', you get '$reversed'<br>\n";
$n1 = 5;
$n2 = 14;
$params2 = array('num1'=>$n1, 'num2'=>$n2);
$added = $client->call('add2numbers', $params2);
//echo "If you add $n1 and $n2 you get $added<br>\n";
$params1 = array('str'=>$str);
$p=$client->call('dumpsql',$params1);
echo "'$p'" ;
?>